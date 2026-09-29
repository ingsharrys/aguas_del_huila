<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Misión y visión</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Misión y visión</h2>
                <p class="text-lg">Inicio / Institucional</span class="font-bold"> / Misión y visión</span></p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
                <!-- NUESTRA MISIÓN -->
                <div class="bg-white shadow rounded-lg p-6 border-t-8 border-[#0047DC]">
                    <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                        NUESTRA MISIÓN
                    </h2>
        
                    <p class="space-y-2 text-black">AGUAS DEL HUILA S.A E.S.P., es una empresa prestadora de servicios integrales con proyección nacional que genera bienestar social y responsabilidad sociombiental.</p>
                </div>
        
                <!-- NUESTRA VISIÓN -->
                <div class="bg-white shadow rounded-lg p-6 border-t-8 border-[#0047DC]">
                    <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                        NUESTRA VISIÓN
                    </h2>
        
                    <p class="space-y-2 text-black">En el 2031, Aguas del Huila será el oprador especilizado surcolombiano de servicios públicos domiciliarios y servicios integrales. "Llevamos más que agua"</p>
                </div>
        
            </div>
        </div>


        @include('partials.footer')

    </body>
</html>
