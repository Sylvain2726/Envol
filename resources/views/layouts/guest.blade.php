<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>Envol Stock</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="bg  flex justify-center items-center h-screen " >
            <div class="p-6 m-4  max-w-sm md:max-w-xl w-full  bg-gradient-to-br to-sky-500/30 from-sky-500/70  from-30% to-70% shadow-2xl shadow-sky-400 rounded-xl px-6">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

{{-- class="flex justify-center items-center h-screen bg-gradient-to-r from-indigo-100 from-20% via-emerald-300/60 via-30% to-white to-80% px-6"
 --}}
