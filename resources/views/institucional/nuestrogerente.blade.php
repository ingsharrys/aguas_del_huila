<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Nuestro Gerente</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-2">Nuestro Gerente</h2>
                <p class="text-lg">Inicio / Institucional </span class="font-bold"> / Nuestro Gerente</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="grid grid-cols-[30%_70%] gap-8">
                <div class="w-full mx-auto">
                    <img src="{{ asset('storage/img/gerente_genaro_lozada.jpeg') }}" alt="Nuestro Gerente" title="Nuestro Gerente" class="w-full h-auto object-cover rounded-lg">
                </div>

                <div class="w-full mx-auto">

                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">GENARO LOZADA MENDIETA</h3>

                    <div class="prose max-w-none text-justify text-gray-900">
                        Abogado de la Universidad Nacional de Colombia, Lozada Mendieta, cuenta con más de 12 años de experiencia en el sector público, se venía desempeñando como Jefe de Control interno disciplinario en la Gobernación del Huila, ha ejercido como Alcalde del municipio de Elías en dos oportunidades, Asesor Jurídico en la Gobernación del Huila, Secretario de Educación y Asesor jurídico del municipio de Pitalito, y director territorial sur de la Corporación Autónoma Regional del Alto Magdalena CAM.
                    </div>

                    </br>
                    </br>

                    <a href="mailto:gerencia@aguasdelhuila.gov.co" target="_blank" class="flex items-center gap-1 hover:underline text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                        gerencia@aguasdelhuila.gov.co
                    </a>

                </div>

            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
