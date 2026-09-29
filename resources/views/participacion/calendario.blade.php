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
                <p class="text-lg">Inicio / Participa </span class="font-bold"> / Calendario de Actividades</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="max-w-6xl mx-auto py-10 px-4">

                <div class="mb-6">
                    <a href="{{ asset('storage/posts/CALENDARIO-AMBIENTAL-2026.pdf') }}"
                    download
                    class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-[#00C81F] hover:bg-green-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg> Descargar</a>
                </div>

                <div class="border rounded-lg shadow-lg overflow-hidden">
                    <iframe src="{{ asset('storage/posts/CALENDARIO-AMBIENTAL-2026.pdf') }}" width="100%" height="800px"></iframe>
                </div>

            </div>

        </section>

        <!-- 
        <section class="px-2 lg:px-32 py-8">

            <style type="text/css">
                .embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
            </style>
            <div class="embed-container">
                <iframe frameborder="0" height="600" scrolling="no" src="https://calendar.google.com/calendar/embed?src=aguasdelhuila.gov.co_9u9rfq709vk323ql1hfok6ubog%40group.calendar.google.com&amp;ctz=America%2FBogota" style="border: 0" width="800"></iframe>
            </div>

        </section>
         -->

        @include('partials.footer')

    </body>
</html>
