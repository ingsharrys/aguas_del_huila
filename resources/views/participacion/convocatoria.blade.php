<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Convocatorias</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Convocatorias</h2>
                <p class="text-lg">Inicio / Participa </span class="font-bold"> / Convocatorias</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="prose max-w-none text-justify text-gray-900">
                Sección de convocatorias
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-4">
                
                <!-- Neiva -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <p class="text-black">
                            No hay convocatorias disponibles actualmente
                        </p>
                    </div>
                </div>

            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
