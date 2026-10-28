<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Organigrama</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Organigrama</h2>
                <p class="text-lg">Inicio / Institucional</span class="font-bold"> / Organigrama</span></p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">
            <div class="grid grid-cols-1 gap-8">
    
                <!-- Organigrama -->
                <div class="bg-white shadow rounded-lg p-6 border-t-8 border-[#0047DC]">
                    <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                        Organigrama
                    </h2>

                    <div class="w-full max-h-[900px] border rounded-lg shadow-lg overflow-hidden">
                        <object
                            data="{{ asset('storage/img/cronograma_del_2026-1.svg') }}"
                            type="image/svg+xml"
                            class="w-full h-full"
                            aria-label="Organigrama Aguas del Huila 2026">

                            <p class="p-4 text-center">
                                Su navegador no soporta imágenes SVG.
                                <a href="{{ asset('storage/img/cronograma_del_2026-1.svg') }}"
                                target="_blank"
                                class="text-blue-600 underline">
                                    Abrir el organigrama
                                </a>
                            </p>

                        </object>
                    </div>

                    <p class="text-xl text-black my-4">
                        
                    </p>
                
                </div>
        
            </div>
        </div>


        @include('partials.footer')

    </body>
</html>
