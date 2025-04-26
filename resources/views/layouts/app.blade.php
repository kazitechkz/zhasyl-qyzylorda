<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <x-app-layout-styles></x-app-layout-styles>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @stack('css')
    </head>
    <body class="font-sans antialiased">
    <section class="body">

        <!-- start: header -->
        @include("layouts.header")
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            @include("layouts.sidebar-left")
            <!-- end: sidebar -->
            <section role="main" class="content-body">
                @include("layouts.page-header")

                <!-- start: page -->
                {{$slot}}
                <!-- end: page -->
            </section>
        </div>


    </section>
    <x-app-layout-scripts></x-app-layout-scripts>
    @livewireScripts
    <script src="{{asset("js/app.js")}}"></script>
    <script type="module">
        Echo.join("user-presence");
    </script>
    @admin
    <script type="module">

        Echo.join("user-presence")
            .joining((user) => {
            toastr.info(user.name + " Подключился к платформе")
            })
            .leaving((user) => {
                toastr.info(user.name + " Отключился от платформы")
            });

    </script>
    @endadmin
    @stack('js')



    </body>
</html>
