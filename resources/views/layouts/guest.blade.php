<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{!! asset('img/logo/logo.png') !!}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&family=Poppins:wght@700&display=swap"
            rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-700 antialiased">
        <div class="min-h-screen h-full justify-center sm:mx-12 md:mx-16 flex flex-col items-center bg-white">
            <div class="h-max sm:max-w-sm p-8 bg-white shadow-lg overflow-hidden rounded-lg">
                <div>
                    <a href="#" class="flex place-self-center justify-center my-4 text-3xl font-bold text-yellow-300">
                        <img class="w-10 h-10 mr-2" src="{!! asset('img/logo/logo.png') !!}" alt="logo">
                        SIMBA
                    </a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
