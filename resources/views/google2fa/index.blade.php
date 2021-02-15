<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <style>
        input[type="checkbox"] {
            -webkit-appearance: none;
            display: none;
            visibility: hidden;
        }

        .check {
            position: relative;
            display: block;
            width: 40px;
            height: 20px;
            background: #092c3e;
            cursor: pointer;
            border-radius: 20px;
            overflow: hidden;
            transition: ease-in 0.3s;
        }

        input[type='checkbox']:checked ~ .check {
            background: #F3F3F3;
        }

        .check:before {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            background-color: #F3F3F3;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            transition: 0.5s;
            display: block;
            background-size: contain;
            /*background-image: url("/images/night.png");*/
        }

        input[type='checkbox']:checked ~ .check:before {
            transform: translateX(20px);
            right: 2px;
            background-color: #092c3e;
            /*background-image: url("/images/sun_1.png");*/
        }

        .customTooltip * {
            font-family: "Poppins" !important;
        }

        .note_container::-webkit-scrollbar {
            background: transparent;
            width: 0px;
        }

    </style>
</head>
<body>
<div id="app" class="h-screen w-screen font-poppins flex flex-col">
    <div class="nav bg-white dark:bg-gray-700 border-b-2 dark:border-gray-200 border-gray-600 px-4 py-1 w-full">
        <div class="flex items-center justify-between w-full">
            <h1 class="text-3xl text-title dark:text-gray-100 font-bowlby add_stroke">Note Me</h1>
            <div class="flex justify-between items-center w-5/12 text-dark-black dark:text-gray-200">
                <div class="w-1/2 flex items-center justify-evenly">
                    <div class="flex items-center py-2">
                        <label class="flex items-center justify-center px-2 py-1">
                            <img src="{{asset('images/translate.png')}}" class="w-8 h-8" alt="translate">
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
    <div class="w-full dark:bg-gray-700 overflow-auto h-full flex justify-center items-center antialiased">
       <div class="w-1/2 px-6 py-2 h-1/2 flex flex-col justify-center bg-white shadow-xl border-2 dark:text-gray-200 border-gray-600 dark:bg-gray-800">
           @error('message')
        <div class="w-full h-12 flex items-center text-center">{{$message}}</div>
        @enderror
           <h1 class="text-xl text-dark-yellow font-bold add_stroke">Verify two factor authenticator</h1>
           <form class="w-full h-7/10 flex justify-evenly items-center flex-col py-3" method="POST" action="{{ route('verify2fa') }}">
            @csrf
            <div class="flex items-center h-1/6 justify-evenly w-full">
                <div class="w-5/12">
                    <p><b>One Time Password:</b></p>
                </div>
                <div class="w-7/12">
                    <input type="password" class="w-full focus:border-none " name="one_time_password" id="one_time_password" required>
                </div>
            </div>
            <div class="w-7/12 mt-4 self-end">
                <button type="submit" class="p-2 border-2 border-gray-600 bg-aboout" name="button">Proceed</button>
            </div>
        </form>
       </div>
    </div>
</div>

</body>
</html>
