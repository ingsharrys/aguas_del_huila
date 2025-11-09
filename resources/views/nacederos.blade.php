<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Nacederos</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Nacederos</h2>
                <p class="text-lg">Inicio </span class="font-bold"> / Nacederos</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <style type="text/css">
                .embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
            </style>
            <div class="embed-container">
                <iframe frameborder="0" height="800px" src="https://giscaceres.maps.arcgis.com/apps/MapSeries/index.html?appid=13b90794ebe744ddbcbac7fff610b1e1" width="100%"></iframe>
            </div>
            <br />
            <br />
            <style type="text/css">
                .embed-container {position: relative; padding-bottom: 100%; height: 0; max-width: 100%;} .embed-container iframe, .embed-container object, .embed-container iframe{position: absolute; top: 0; left: 0; width: 100%; height: 100%;} small{position: absolute; z-index: 40; bottom: 0; margin-bottom: -15px;}
            </style>
            <div class="embed-container">
                <iframe frameborder="0" height="500" marginheight="0" marginwidth="0" scrolling="no" src="//giscaceres.maps.arcgis.com/apps/Embed/index.html?webmap=7f508b795f6f4612805cec5e6c1c2cea&amp;extent=-76.6244,1.5528,-74.4130,3.8432&amp;home=true&amp;zoom=true&amp;scale=true&amp;disable_scroll=false&amp;theme=light" title="Aguas del Huila" width="500"></iframe>
            </div>


        </section>

        @include('partials.footer')

    </body>
</html>
