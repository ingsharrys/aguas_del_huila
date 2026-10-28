<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Buen manejo del agua</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Buen manejo del agua</h2>
                <p class="text-lg">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('transparencia') }}" class="hover:text-[#00C81F]">Transparencia y Acceso a la Información Pública</a> /
                    <a href="{{ route('infonino') }}" class="hover:text-[#00C81F]">Información para niños, niñas y adolescentes</a> /
                    <span class="font-bold">Buen manejo del agua</span>
                </p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">

        
            </div>
        </div>

        @include('partials.footer')

    </body>
</html>
