<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Note Me</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{secure_asset('OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{secure_asset('OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.theme.default.min.css')}}">
    <!-- Scripts -->

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>--}}
</head>
<body class="font-lora sm:overflow-hidden overflow-x-hidden">
{{--<div class="top-0 text-secondary z-10 text-xl right-0 w-2/12 h-20 absolute flex justify-evenly">--}}
{{--       <button>Login</button>--}}
{{--       <button>Sign Up</button>--}}
{{--</div>--}}
     @yield('content', 'Default Content')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/owl.carousel.min.js')}}"></script>
@stack('scripts')


</body>
</html>
