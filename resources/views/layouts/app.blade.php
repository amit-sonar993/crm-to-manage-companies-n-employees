<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @include('layouts.admin-lte-style')

        @yield('plugins_css')

        @yield('custom_css')


    </head>
    <body class="font-sans antialiased">
        <div class="wrapper min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <x-aside/>
            <!-- Page Content -->
            <main class="content-wrapper">
            @include('flash-message')
                {{ $slot }}
            </main>
        </div>

        @if(isset($model))
            {{ $model }}
        @endif
        @include('layouts.admin-lte-script')
        @yield('plugins_script')
        @yield('custom_script')
    </body>
</html>
