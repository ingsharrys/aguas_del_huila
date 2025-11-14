<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Denuncias</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Denuncias</h2>
                <p class="text-lg">Inicio / Participa </span class="font-bold"> / Denuncias</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Proceso para radicación de denuncias</h3>

        <p class="prose max-w-none text-justify text-gray-900">Denuncia Actos de Corrupción
<br>
<br>
            Si su queja o denuncia se refiere a posibles hechos de corrupción de servidores públicos de Aguas del Huila S.A. E.S.P, por favor lea la información que le presentamos a continuación.
<br>
<br>
            <span class="text-md font-bold text-[#0047DC]">¿Qué es una denuncia?</span>
<br>
<br>
            Es el relato que un ciudadano realiza, en cumplimiento de su deber de solidaridad, para enterar a las autoridades de la existencia de hechos irregulares, con el fin de activar los mecanismos de investigación y sanción.
<br>
<br>
            <span class="text-md font-bold text-[#0047DC]">¿Quiénes son servidores públicos?</span>
<br>
<br>
            El artículo 123 de la Constitución Política de Colombia establece que: “Son servidores públicos los miembros de las corporaciones públicas, los empleados y trabajadores del Estado y de sus entidades descentralizadas territorialmente o por servicios”. En el mismo artículo se reconoce la posibilidad de que algunos particulares desempeñen temporalmente funciones públicas.
<br>
<br>
            <span class="text-md font-bold text-[#0047DC]">¿Qué se entiende por corrupción?</span>
<br>
<br>
            La corrupción se describe como el fenómeno que atenta contra la dignidad de una persona, grupo o nación, que se atribuye al servidor público que en el ejercicio de sus funciones obtiene un beneficio particular para él o para un tercero, por ejemplo: beneficios pecuniarios, políticos, o de posición social.
<br>
<br>
            <span class="text-md font-bold text-[#0047DC]">Se sugiere tener en cuenta los siguientes ítems al presentar su denuncia:</span>
<br>
<br>
            Presente una relación clara, detallada y precisa de los hechos de los cuales tiene conocimiento.
            En lo posible, exprese cómo ocurrieron los hechos, dónde y cuándo.
            Señale quién o quiénes lo hicieron, si es de su conocimiento.
            Adjunte las evidencias que sustentan su relato, en caso de tenerlas suministre su nombre y dirección de residencia, teléfono y correo electrónico si dispone para contactarlo en el evento de ser necesario o para mantenerlo informado del curso de su denuncia.
            En el evento de preferir presentar la denuncia de forma anónima, asegúrese de que ésta amerite credibilidad y acompáñela de evidencias que permitan orientar la investigación.
            Informe si los hechos han sido puestos en conocimiento de otra autoridad, indique cuál.
<br>
<br>
            <span class="text-md font-bold text-[#0047DC]">¿Cómo presentar su denuncia?</span>
<br>
<br>
            A través de la Página Web de Aguas del Huila en el siguiente link <a href="{{ route('pqr') }}" target="_blank" class="text-md font-bold text-[#0047DC]">aguasdelhuila.gov.co/pqr</a>
<br>
<br>
            Radicando su denuncia porescrito en la oficina ubicada en la Calle 21 No. 1C-17 - Neiva (Huila)
<br>
<br>
            Comunicándose con nosotros a través de la línea 01 8000 952858- (8) 8753181
        </p>

        </section>

        @include('partials.footer')

    </body>
</html>
