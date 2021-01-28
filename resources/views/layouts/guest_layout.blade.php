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
{{--    <link rel="stylesheet" href="{{asset('OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.carousel.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.theme.default.min.css')}}">--}}
</head>
<body class="font-lora sm:overflow-hidden overflow-x-hidden">
@yield('content', 'Default Content')

    <video id="video1" class=" fixed w-full top-0 left-0 z-10" preload>
        <source src="{{secure_asset('/videos/test.mp4')}}" type="video/mp4">
    </video>
    <video id="video2" class=" fixed w-full top-0 left-0 z-0" preload>
        <source src="{{secure_asset('/videos/test_2.mp4')}}" type="video/mp4">

    </video>
{{--    <img src="{{asset('images/test_1.png')}}" alt="landing_page_image" class="fixed w-full top-0 left-0 m-0">--}}
<script src="{{secure_asset('js/app.js') }}"></script>
{{--<script src="{{asset('OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/owl.carousel.min.js')}}"></script>--}}
@stack('scripts')
</body>
</html>
