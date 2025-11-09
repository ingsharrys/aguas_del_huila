<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Inducción Aguas del Huila</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Inducción Aguas del Huila</h2>
                <p class="text-lg">Inicio / Institucional </span class="font-bold"> / Inducción Aguas del Huila</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="grid grid-cols-1 gap-8">
                <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Inducción Aguas del Huila</h3>
            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
