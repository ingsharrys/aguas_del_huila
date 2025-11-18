<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- carrusel banners -->
        <div class="swiper mySwiper w-full h-[400px] sm:h-[300px] lg:h-[500px] overflow-hidden shadow-lg -top-8">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                <div class="swiper-slide relative">
                    <img 
                    src="{{ asset('storage/' . $banner->imagen) }}" 
                    alt="{{ $banner->titulo }}" 
                    class="w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-start text-white text-center px-16 md:px-32">
                    <h2 class="text-3xl lg:text-5xl font-bold mb-4">{{ $banner->titulo }}</h2>
                    <p class="text-lg mb-6">{{ $banner->subtitulo }}</p>
                    @if($banner->enlace)
                        <a href="{{ $banner->enlace }}" target="_blank" class="bg-[#00C81F] px-3 py-1 border border-white rounded-lg text-white hover:bg-[#00A038] transition">{{ $banner->boton }}</a>
                    @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Botones de navegación -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- servicios linea -->
        <section class="px-2 lg:px-32 py-8 bg-white">
            <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                <h2 class="text-4xl">Servicios en línea</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-16 px-2 md:px-32 pt-8 text-[#0047DC] font-bold text-center">
                <div class="flex flex-column justify-center">
                    <a href="{{ route('pagos') }}" target="_blank">
                        <img src="{{ asset('storage/img/servicios-linea.png') }}" class="w-50 h-auto mb-2" alt="img servicios">
                        <h3 class="">Servicios en línea</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="{{ route('pqr') }}" target="_blank" class="justify-items-center">
                        <img src="{{ asset('storage/img/pqrs.png') }}" class="w-50 h-auto mb-2" alt="img servicios">
                        <h3>Petición, Quejas, Recargas y Sugerencia</h3>
                    </a>
                </div>
                

                <div class="flex flex-column justify-center">
                    <a href="{{ route('preguntasfrecuentes') }}" target="_blank">
                        <img src="{{ asset('storage/img/preguntas.png') }}" class="w-50 h-auto mb-2" alt="img servicios">
                        <h3>Preguntas Frecuentes</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="{{ route('transparencia') }}" target="_blank" class="justify-items-center">
                        <img src="{{ asset('storage/img/transparencia.png') }}" class="w-50 h-auto mb-2" alt="img servicios">
                        <h3>Ley de Transparencia y Acceso a la Información</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="{{ route('posts.show') }}" target="_blank">
                        <img src="{{ asset('storage/img/plan-departamental.png') }}" class="w-50 h-auto mb-2" alt="img servicios">
                        <h3>Plan Departamental de Aguas</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="https://aguapotable.aguasdelhuila.gov.co/ControlDoc" target="_blank">
                        <img src="{{ asset('storage/img/sanitario-rural.png') }}" class="w-50 h-auto" alt="img servicios">
                        <h3>Diágnostico Sanitario Rural</h3>
                    </a>
                </div>

            </div>
        </section>

        <!-- pago facturas -->
        <section class="px-2 lg:px-32 py-4">

            <div class="grid grid-cols-1 w-full h-[500px] pb-8 md:pb-16 content-end justify-center bg-bottom bg-no-repeat bg-cover" style="background-image: url('{{ asset('storage/img/fondo-pagos-home.webp') }}');">
                <div class="flex flex-column justify-center">
                    <a href="{{ route('pagos') }}" target="_blank" class="justify-items-center">
                        <h2 class="text-2xl md:text-5xl text-center py-8">Ahora Tus Facturas<br>Las Puedes<br><span class="font-bold">Pagar en línea</span></h2>
                        <img src="{{ asset('storage/img/btn-pse.png') }}" class="w-50 h-auto" alt="img servicios">
                    </a>
                </div>
            </div>
        </section>

        <!-- Videos youtube -->
        <section class="px-2 lg:px-32 py-8 bg-white">
            <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                <h2 class="text-4xl">Huila Gestiona sus Residuos</h2>
            </div>

            <div class="swiper videosSlide w-full">
                <div class="swiper-wrapper">
                    @foreach ($videosYouTube as $video)
                        @if(isset($video['id']['videoId']))
                            <div class="swiper-slide">
                                <div class="aspect-video rounded-lg overflow-hidden shadow-md">
                                    <iframe 
                                        src="https://www.youtube.com/embed/{{ $video['id']['videoId'] }}" 
                                        frameborder="0" 
                                        allowfullscreen 
                                        class="w-full h-full">
                                    </iframe>
                                </div>
                                <h3 class="mt-3 text-[#0047DC] font-semibold text-sm">
                                    {{ $video['snippet']['title'] }}
                                </h3>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Botones de navegación -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </section>

        <!-- Imagen limpieza -->
        <section class="px-2 lg:px-32 py-8 flex" style="background: linear-gradient(to bottom, #00C81F 50%, #FFF 50%); flex-direction: column; align-items: center;">
            <div class="w-full lg:w-4xl text-center pb-8 text-white font-bold">
                <h2 class="text-2xl md:text-4xl">Aprende a separar correctamente tus residuos con nuestras guías visuales y fáciles de seguir</h2>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 pt-8 text-[#0047DC] font-bold text-center">
                
            <!-- Imagen 1 -->
            <div class="relative group overflow-hidden rounded-lg shadow-md">
                <img src="{{ asset('storage/img/Tips-residuos.webp') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Tips residuos" title="Tips residuos">
                <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <span class="text-white text-lg font-semibold">Código de colores</span>
                </div>
            </div>

            <!-- Imagen 2 -->
            <div class="relative group overflow-hidden rounded-lg shadow-md">
                <img src="{{ asset('storage/img/Tips-residuos-1.webp') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Residuos orgánicos" title="Residuos orgánicos">
                <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <span class="text-white text-lg font-semibold">Residuos orgánicos</span>
                </div>
            </div>

            <!-- Imagen 3 -->
            <div class="relative group overflow-hidden rounded-lg shadow-md">
                <img src="{{ asset('storage/img/Tips-residuos-2.webp') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Residuos reciclables" title="Residuos reciclables">
                <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <span class="text-white text-lg font-semibold">Residuos reciclables</span>
                </div>
            </div>

            <!-- Imagen 4 -->
            <div class="relative group overflow-hidden rounded-lg shadow-md">
                <img src="{{ asset('storage/img/Tips-residuos-3.webp') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Residuos peligrosos" title="Residuos peligrosos">
                <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <span class="text-white text-lg font-semibold">Residuos peligrosos</span>
                </div>
            </div>

            </div>
        </section>

        <!-- noticias -->
        <section class="px-2 lg:px-32 py-8">
            <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                <h2 class="text-4xl">Últimas Noticias</h2>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 pt-8 text-[#0047DC] font-bold text-center">

                @foreach($noticias as $noticia)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Imagen de portada -->
                        <img src="{{ asset('storage/' . $noticia->imagen_portada) }}" 
                            alt="{{ $noticia->titulo }}" 
                            title="{{ $noticia->titulo }}" 
                            class="w-full h-48 object-cover">

                        <!-- Contenido -->
                        <div class="p-4 text-[#0047DC] text-left">
                            <!-- Título -->
                            <h3 class="text-lg font-bold mb-2 hover:text-[#00C81F] transition-colors">
                                <a href="{{ route('noticias.article', [$noticia->slug, $noticia->id]) }}">
                                    {{ Str::limit($noticia->titulo, 70) }}
                                </a>
                            </h3>

                            <!-- Fecha y usuario -->
                            <div class="text-sm text-gray-500 flex justify-between items-center">
                                <span>{{ $noticia->created_at->format('d M Y') }}</span>
                                <span class="font-semibold">{{ $noticia->autor->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Si no hay noticias -->
            @if($noticias->isEmpty())
                <div class="text-center text-white mt-8">
                    <p>No hay noticias disponibles por el momento.</p>
                </div>
            @endif

        </section>

        <!-- servicios -->
        <section class="px-2 lg:px-32 py-8 bg-[#00C81F]">
            <div class="w-full text-center pb-8 text-white font-bold">
                <h2 class="text-4xl">Portafolio de Servicios</h2>
                <h2 class="text-xl">Aguas del Huila S.A E.S.P Llevamos más que agua</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-16 px-2 md:px-32 pt-8 text-white font-bold text-center">

                @foreach($servicios as $servicio)
                    <div class="flex flex-column justify-center">
                        <a href="{{ route('servicios.article', [$servicio->slug, $servicio->id]) }}" target="_blank">
                            <img src="{{ asset('storage/' . $servicio->icono) }}" class="w-50 h-auto mb-2" alt="{{ $servicio->titulo }}" title="{{ $servicio->titulo }}">
                            <h3 class="">{{ $servicio->nombre }}</h3>
                        </a>
                    </div>
                @endforeach

            </div>

        </section>

        <!-- sitio interes -->
        <section class="px-2 lg:px-32 py-8 bg-white">
            <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                <h2 class="text-4xl">Sitios de Interés</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-16 px-2 md:px-32 py-8 text-white font-bold text-center">

                <div class="flex justify-center items-center">
                    <a href="https://www.presidencia.gov.co/" target="_blank" class="block w-40 h-20">
                        <img src="{{ asset('storage/img/Presidencia-logo.png') }}" 
                            alt="Presidencia" title="Presidencia" 
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.minhacienda.gov.co/" target="_blank" class="block w-40 h-20">
                        <img src="{{ asset('storage/img/minvivienda.png') }}" 
                            alt="Minvivienda" title="Minvivienda" 
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.huila.gov.co/" target="_blank" class="block w-40 h-20">
                        <img src="{{ asset('storage/img/huilacrecegober.png') }}" 
                            alt="Huila Crece" title="Huila Crece" 
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.mintic.gov.co/portal/inicio/Glosario/G/5306:Gobierno-en-Linea-GEL" target="_blank" class="block w-40 h-20">
                        <img src="{{ asset('storage/img/gobierno-linea.png') }}" 
                            alt="Gobierno en Línea" title="Gobierno en Línea" 
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.mintic.gov.co/portal/inicio/" target="_blank" class="block w-40 h-20">
                        <img src="{{ asset('storage/img/superservicios.png') }}" 
                            alt="Superservicios" title="Superservicios" 
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.procuraduria.gov.co/Pages/Inicio.aspx" target="_blank" class="block w-40 h-20">
                        <img src="{{ asset('storage/img/logo-procuraduria.png') }}" 
                            alt="Procuraduría" title="Procuraduría" 
                            class="w-full h-full object-contain">
                    </a>
                </div>

            </div>

        </section>

        @include('partials.footer')

        <!-- Swiper CSS -->
        <script>
            const swiper = new Swiper('.mySwiper', {
                loop: true,
                autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                },
                pagination: {
                el: '.swiper-pagination',
                clickable: true,
                },
                navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
                },
                effect: 'fade',
            });
        </script>
        <!-- Slide youtube CSS -->
        <script>
            const swiperVideo = new Swiper('.videosSlide', {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 20,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
            });
        </script>

    </body>
</html>
