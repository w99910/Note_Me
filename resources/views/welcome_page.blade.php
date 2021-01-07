@extends('layouts.guest_layout')
@section('content')
<div class="w-full h-screen relative flex flex-col bg-dark-black text-secondary items-center justify-center px-4 py-4 sm:px-8 sm:py-5" id="app">
        <div class="w-full h-1/5 flex overflow-hidden text-center items-center justify-center text-6xl text-primary font-bowlby">
            <div class="greeting_text">Note Me</div>
        </div>
    <div class="w-full h-full sm:h-4/5 flex sm:flex-row flex-col items-center">
        <div class="flex items-center justify-center w-full sm:w-6/12 sm:m-0 m-4">
            <img src="{{asset('/images/note_me_04.png')}}" alt="note_me" class="w-full">
        </div>
        @error('email')
        <toast message="{{$message}}" time="1"></toast>
        @enderror
<Guest_Form csrf="{{csrf_token()}}"></Guest_Form>
    </div>

</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            console.log();
            $(".owl-carousel").owlCarousel({
                autoplay: true,
                autoplayTimeout:4900,
                items:1,
                loop:true,
                smartSpeed: 1500,
            })
        });
        let tl=gsap.timeline({defaults:{ease:'power1.out'}});
        tl.from('.greeting_text',{
            y:'-100%',
            duration:1,
        });

        // tl.fromTo('#content-text',{
        //     x:'-100%',
        //     duration:1,
        //     stagger:2,
        //
        // },{
        //     x:'100%',
        //     duration:1,
        //     stagger:2,
        //
        // })

    </script>

@endpush
