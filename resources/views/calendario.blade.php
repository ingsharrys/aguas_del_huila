<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Calendario de Actividades</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Calendario de Actividades</h2>
                <p class="text-lg">Inicio </span class="font-bold"> / Calendario de Actividades</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <style type="text/css">
                .embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
            </style>
            <div class="embed-container">
                <iframe frameborder="0" height="600" scrolling="no" src="https://calendar.google.com/calendar/embed?src=aguasdelhuila.gov.co_9u9rfq709vk323ql1hfok6ubog%40group.calendar.google.com&amp;ctz=America%2FBogota" style="border: 0" width="800"></iframe>
            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
