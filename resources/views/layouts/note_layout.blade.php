<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <style>
        input[type="checkbox"]{
            -webkit-appearance: none;
            display: none;
            visibility: hidden;
        }
        .check{
            position: relative;
            display: block;
            width:40px;
            height:20px;
            background: #092c3e;
            cursor: pointer;
            border-radius: 20px;
            overflow:hidden;
            transition:ease-in 0.3s;
        }
        input[type='checkbox']:checked ~ .check{
            background:#F3F3F3;
        }
        .check:before{
            content:'';
            position:absolute;
            top:2px;
            left:2px;
            background-color: #F3F3F3;
            width:16px;
            height:16px;
            border-radius: 50%;
            transition:0.5s;
            display: block;
            background-size: contain;
            /*background-image: url("/images/night.png");*/
        }
        input[type='checkbox']:checked ~ .check:before{
            transform: translateX(20px);
            right:2px;
            background-color:#092c3e;
            /*background-image: url("/images/sun_1.png");*/
        }
        .customTooltip * {
            font-family: "Poppins" !important;
        }
    </style>
</head>
<body>
<div id="app" class="h-screen w-screen bg-dark-black font-poppins flex flex-col">
    <div class="nav bg-white dark:bg-gray-700 border-b-2 dark:border-gray-200 border-gray-600 px-4 py-1 w-full">
        <div class="flex items-center justify-between w-full">
            <h1 class="text-3xl text-title dark:text-gray-100 font-bowlby add_stroke">Note Me</h1>
            <div class="flex justify-between items-center sm:w-8/12 lg:w-5/12 text-dark-black dark:text-gray-200">
                <a href="{{route('create_note')}}" class="bg-green-400 dark:bg-about border-2 border-gray-500 dark:border-gray-200 text-white px-2 py-1 text-sm">{{ __('messages.create_new_note') }}</a>
                <div class="w-1/2 flex items-center justify-evenly">
                    <div class="flex items-center py-2">
                        <label class="flex items-center justify-center px-2 py-1">
                            <img src="{{secure_asset('images/translate.png')}}" class="w-8 h-8" alt="translate">
                            <select class="locale-intro border-none focus:outline-none focus:ring-0 dark:bg-transparent">
                                <option value="en" class="dark:text-dark-black">en</option>
                                <option value="mm" class="dark:text-dark-black">mm</option>
                                <option value="es" class="dark:text-dark-black">es</option>
                                <option value="jpn" class="dark:text-dark-black">jpn</option>
                            </select>
                        </label>
                    </div>
                    <label for="checkbox" class="flex">
                        <input id="checkbox" type="checkbox" value="false"/>
                        <span class="check"></span>
                    </label>
                </div>
                <i class="far fa-bell text-dark-yellow mx-1"></i>
                <span class="mx-2 truncate">{{Auth()->user()->name}}</span>
                <div class="w-12 mb-2">
                   <avatar></avatar>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full overflow-auto h-full flex">
        <div class="w-20 flex dark:bg-gray-900 flex-col justify-between text-3xl items-center h-full">
            <div class="h-3/5 w-full flex flex-col justify-around items-center">
                <a href="{{route('dashboard')}}"><i class="fas fa-sticky-note text-dark-blue"></i></a>
                <a href="{{route('profile')}}"><i class="fas fa-user text-dark-purple"></i></a>
                <a href="{{route('calendar')}}"><i class="far fa-calendar-alt text-dark-yellow"></i></a>
                <a href="{{route('contact')}}"><i class="fas fa-address-card text-dark-red"></i></a>

                <i class="help cursor-pointer fas fa-exclamation-circle text-dark-yellow"></i>
            </div>
            <div class="mb-4">
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="focus:outline-none"><img src="{{secure_asset('images/logout.png')}}" class="w-8"></button>
                </form>
            </div>
        </div>
        @yield('content')
    </div>
</div>
@stack('scripts')
</body>
</html>
