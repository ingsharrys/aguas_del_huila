<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Peticiones, quejas y reclamos</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Peticiones, quejas y reclamos</h2>
                <p class="text-lg">Inicio / Participa </span class="font-bold"> / PQR</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

        <iframe id="blockrandom"
            name="iframe"
            src="http://extranet.aguasdelhuila.gov.co/site.aspx?Codigo=D368389F-817B-4485-A1F0-B6C28E5F2532"
            width="100%"
            height="1800"
            scrolling="yes"
            frameborder="0"
                        title="Peticiones, quejas y reclamos"
                    class="wrapper">
            Esta opción no funcionará correctamente. Lamentablemente, su navegador no soporta URLs embebidas.
        </iframe>

        </section>

        @include('partials.footer')

    </body>
</html>
