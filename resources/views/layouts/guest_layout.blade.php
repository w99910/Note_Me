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
</head>
<body class="font-lora sm:overflow-hidden overflow-x-hidden">
@yield('content', 'Default Content')
<div class="fixed w-full h-full top-20 left-0 flex items-center justify-center z-10">
    <video id="video1" class=" fixed w-full top-0 left-0 z-10" preload>
        <source src="{{secure_asset('/videos/test.mp4')}}" type="video/mp4">
    </video>
    <video id="video2" class=" fixed w-full top-0 left-0 z-0" preload>
        <source src="{{secure_asset('/videos/test_2.mp4')}}" type="video/mp4">
    </video>
    {{--         <video id="video" controls="controls" class="w-1/2 h-1/2">--}}
    {{--             <source src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">--}}
    {{--         </video>--}}
</div>
<script src="{{secure_asset('js/app.js') }}"></script>
<script src="{{secure_asset('OwlCarousel2-2.3.4/OwlCarousel2-2.3.4/docs/assets/owlcarousel/owl.carousel.min.js')}}"></script>
@stack('scripts')
</body>
</html>
