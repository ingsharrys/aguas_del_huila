<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Gestión de Calidad</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Gestión de Calidad</h2>
                <p class="text-lg">Inicio / Institucional </span class="font-bold"> / Gestión de Calidad</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="w-full mx-auto">

                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">POLÍTICA DE CALIDAD</h3>

                    <div class="prose max-w-none text-justify text-gray-900">
                        AGUAS DEL HUILA S.A E.S.P., Desarrolla su gestión bajo los siguientes principios:
                        </br>
                        </br>
                        - Satisfacción integral del cliente
                        </br>
                        - Desarrollo de la gestión con personal competente y comprometido en la búsqueda de la eficacia y la eficiencia de los procesos de la entidad .
                        </br>
                        - Manejo eficiente y transparente de los recursos financieros, técnicos y tecnológicos de la entidad.
                        </br>
                        - Administración integral, sistematizada, confiable y transparente de la información de la entidad.
                        </br>
                        - Mejoramiento continuo del Sistema de Gestión de Calidad de la entidad.
                    </div>
                    
                    </br>
                    </br>

                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">OBJETIVOS DE CALIDAD</h3>

                    <div class="prose max-w-none text-justify text-gray-900">
                        AGUAS DEL HUILA S.A E.S.P., Desarrolla su gestión bajo los siguientes principios:
                        </br>
                        </br>
                        - Incrementar la eficiencia y la eficacia de los procesos.
                        </br>
                        - Desarrollar el nivel de competencia y liderazgo del talento humano.
                        </br>
                        - Aumentar el nivel de confiabilidad y oportunidad de la información.
                        </br>
                        - Incrementar el nivel de satisfacción de las necesidades y exceptivas de la comunidad en general.
                    </div>

                </div>

                <div class="w-full mx-auto">
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">MAPA DE PROCESOS</h3>
                    <img src="{{ asset('storage/img/mapa_de_procesos_aguas_del_huila.jpg') }}" alt="Organigrama" title="Organigrama" class="w-full h-auto object-cover rounded-lg">
                </div>
            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
