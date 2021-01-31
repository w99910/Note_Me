@extends('layouts.guest_layout')
@section('content')
{{--<div class="w-full h-screen relative flex flex-col text-secondary items-center justify-center px-4 py-4 sm:px-8 sm:py-5 z-30" id="app">--}}
<div class="w-full h-screen relative flex flex-col text-secondary items-center justify-center z-30" id="app">
        @error('email')
        <toast message="{{$message}}" time=".5" start="{{true}}" delay="1"></toast>
        @enderror
           <landing-page csrf="{{csrf_token()}}" img_src="{{url('/')}}" current_locale="{{$locale}}" encoded_messages="{{json_encode($localization)}}"></landing-page>
</div>
@endsection
@push('scripts')
    <script>

       // document.addEventListener('DOMContentLoaded',function(){
       //      console.log('ready');
       //      $(".owl-carousel").owlCarousel({
       //          autoplay: true,
       //          autoplayTimeout:4900,
       //          items:1,
       //          loop:true,
       //          smartSpeed: 1500,
       //      })
       //  });
       //  let tl=gsap.timeline({defaults:{ease:'power1.out'}});
       //  tl.from('.greeting_text',{
       //      y:'-100%',
       //      duration:1,
       //  });

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
