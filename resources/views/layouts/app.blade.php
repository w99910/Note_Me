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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="h-screen w-screen bg-dark-black font-lora flex flex-col">
        <div class="nav flex items-center justify-between px-4 py-3">
            <h1 class="text-3xl text-primary font-bowlby">Note Me</h1>
            <div class="flex justify-between items-center w-1/12 text-white">
                <i class="far fa-bell"></i>
                <span>{{Auth()->user()->name}}</span>
                <img src="{{ Avatar::create(Auth()->user()->name)->toBase64() }}" class="w-12" />
            </div>
        </div>
        <main class="w-full h-full px-3 pb-3 pt-2 relative">
            @yield('content')
            <div class="absolute bottom-0 right-0 w-full flex justify-center mb-2 items-center h-16">
               <div class="w-6/12 h-full flex justify-evenly items-center text-3xl rounded-full bg-secondary">
                   <i class="fas fa-sticky-note text-dark-blue"></i>
                   <i class="fas fa-user text-dark-purple"></i>
                   <i class="fas fa-plus-circle text-5xl text-white"></i>
                   <i class="far fa-calendar-alt text-dark-yellow"></i>
                   <i class="fas fa-address-card text-dark-red"></i>
               </div>
            </div>
        </main>
    </div>
</body>
</html>
