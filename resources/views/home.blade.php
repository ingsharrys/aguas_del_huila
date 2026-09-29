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
                    <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-start text-white text-left px-16 md:px-32">
                    <h2 class="text-2xl lg:text-4xl font-bold mb-2">{{ $banner->titulo }}</h2>
                    <p class="text-lg mb-6">{{ $banner->subtitulo }}</p>
                    @if($banner->enlace)
                        <a href="{{ $banner->enlace }}" class="px-3 py-1 border border-white rounded-lg text-white hover:bg-[#00A038] transition" aria-label="{{ $banner->titulo }}" style="background: #008A14;">{{ $banner->boton }}</a>
                    @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Botón Play/Pause -->
            <button
                id="swiper-toggle"
                type="button"
                class="absolute bottom-5 right-5 z-20 bg-[#0047DC] hover:bg-blue-800 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg transition cursor-pointer"
                aria-label="Pausar carrusel"
            >
                <!-- Icono Pause -->
                <svg id="icon-pause" xmlns="http://www.w3.org/2000/svg"
                    width="22" height="22" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path d="M5.5 3.5A.5.5 0 0 1 6 4v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm4 0A.5.5 0 0 1 10 4v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z"/>
                </svg>

                <!-- Icono Play -->
                <svg id="icon-play"
                    xmlns="http://www.w3.org/2000/svg"
                    width="22"
                    height="22"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                    class="hidden">

                    <path d="M10.804 8.697 5.5 11.884A.5.5 0 0 1 4.75 11.46V4.54a.5.5 0 0 1 .75-.424l5.304 3.187a.5.5 0 0 1 0 .848z"/>

                </svg>

            </button>

            <!-- Botones de navegación -->
            <div class="swiper-button-next" aria-label="Siguiente" role="button"></div>
            <div class="swiper-button-prev" aria-label="Anterior" role="button"></div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- servicios linea -->
        <section class="px-2 lg:px-32 py-8 bg-white">
            <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                <h2 class="text-4xl">Servicios en línea</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-7 gap-6 px-2 md:px-32 pt-8 text-[#0047DC] font-bold text-center">
                <div class="flex flex-column justify-center">
                    <a href="{{ route('pagos') }}" class="justify-items-center" aria-label="Pagos">
                        <img src="{{ asset('storage/img/servicios-linea.png') }}" class="h-auto mb-2" alt="Pagos">
                        <h3 class="">Servicios en línea</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="{{ route('pqr') }}" class="justify-items-center" aria-label="PQRS">
                        <img src="{{ asset('storage/img/pqrs.png') }}" class="h-auto mb-2" alt="PQRS">
                        <h3>Petición, Quejas, Recargas y Sugerencia</h3>
                    </a>
                </div>
                
                <div class="flex flex-column justify-center">
                    <a href="{{ route('preguntasfrecuentes') }}" class="justify-items-center" aria-label="Preguntas Frecuentes">
                        <img src="{{ asset('storage/img/preguntas.png') }}" class="h-auto mb-2" alt="Preguntas Frecuentes">
                        <h3>Preguntas Frecuentes</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="https://aguasdelhuila.gov.co/documentos/mipg" class="justify-items-center" aria-label="MIPG">
                        <img src="{{ asset('storage/img/mipg.jpg') }}" class="h-auto mb-2" alt="MIPG">
                        <h3>MIPG</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="{{ route('transparencia') }}" class="justify-items-center" aria-label="Transparencia">
                        <img src="{{ asset('storage/img/transparencia.png') }}" class="h-auto mb-2" alt="Transparencia">
                        <h3>Ley de Transparencia y Acceso a la Información</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="{{ route('posts.show') }}" class="justify-items-center" aria-label="PDA">
                        <img src="{{ asset('storage/img/plan-departamental.png') }}" class="h-auto mb-2" alt="PDA">
                        <h3>Plan Departamental de Aguas</h3>
                    </a>
                </div>

                <div class="flex flex-column justify-center">
                    <a href="https://aguasdelhuila.gov.co/documentos/diagnostico-sanitario-rural-2025" class="justify-items-center" aria-label="Sanitario Rural">
                        <img src="{{ asset('storage/img/sanitario-rural.png') }}" class="h-auto" alt="Sanitario rural">
                        <h3>Diágnostico Sanitario Rural</h3>
                    </a>
                </div>

            </div>
        </section>

        <!-- pago facturas -->
        <section class="px-2 lg:px-32 py-4">

            <div 
                class="relative grid grid-cols-1 w-full h-[400px] pb-8 md:pb-16 content-center justify-center bg-center bg-no-repeat bg-cover overflow-hidden"
                style="background-image: url('{{ asset('storage/img/fondo-pagos-aguas.jpg') }}'); border-radius: 30px;"
            >
        
                <!-- Contenido -->
                <div class="relative z-10 flex flex-column justify-center">
                    <a 
                        href="{{ route('pagos') }}" 
                        class="justify-items-center"
                        aria-label="Ir a pagos en línea"
                    >
                        <p class="text-2xl md:text-5xl text-center py-8 text-white font-semibold leading-tight drop-shadow-lg" style="background: #002a82;">
                            Ahora Tus Facturas<br>
                            Las Puedes<br>
                            <span class="font-bold">
                                Pagar en línea
                            </span>
                        </p>
        
                        <img 
                            src="{{ asset('storage/img/btn-pse.png') }}"
                            class="w-50 h-auto"
                            alt="Botón de pagos PSE"
                        >
                    </a>
                </div>
        
            </div>
        
        </section>

        <!-- Videos youtube -->
        <section class="px-2 lg:px-32 py-8 bg-white" id="videos_aguas">
            <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                <h2 class="text-4xl">Huila Gestiona sus Residuos</h2>
            </div>

            <div class="swiper videosSlide w-full">
                <div class="swiper-wrapper">
                    @foreach ($videosYouTube as $video)
                        <div class="swiper-slide">
                            <div class="aspect-video rounded-lg overflow-hidden shadow-md">
                                <iframe
                                    id="youtube-player-{{ $loop->index }}"
                                    src="https://www.youtube.com/embed/{{ $video['videoId'] }}?enablejsapi=1"
                                    class="w-full h-full"
                                    title="Video de YouTube: {{ $video['title'] }}"
                                    aria-label="Video institucional de YouTube"
                                    loading="lazy"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <h3 class="mt-3 text-[#0047DC] font-semibold text-sm">
                                {{ $video['title'] }}
                            </h3>
                        </div>
                    @endforeach

                </div>

                <!-- Botones de navegación -->
                <div class="swiper-button-prev" aria-label="Anterior" role="button"></div>
                <div class="swiper-button-next" aria-label="Siguiente" role="button"></div>
            </div>
        </section>

        <!-- Imagen limpieza -->
        <section class="px-2 lg:px-32 py-8 flex" style="background: linear-gradient(to bottom, #008A14 50%, #FFF 50%); flex-direction: column; align-items: center;">
            <div class="w-full lg:w-4xl text-center pb-8 text-white font-bold">
                <h2 class="text-2xl md:text-3xl">Aprende a separar correctamente tus residuos con nuestras guías visuales y fáciles de seguir</h2>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 pt-8 md:px-32 text-[#0047DC] font-bold text-center">
                
                <!-- Imagen 1 -->
                <div class="relative group overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('storage/img/Tips-residuos.webp') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Tips residuos">
                    <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <span class="text-white text-lg font-semibold">Código de colores</span>
                    </div>
                </div>

                <!-- Imagen 2 -->
                <div class="relative group overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('storage/img/Tips-residuos-1.webp') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Residuos orgánicos">
                    <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <span class="text-white text-lg font-semibold">Residuos orgánicos</span>
                    </div>
                </div>

                <!-- Imagen 3 -->
                <div class="relative group overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('storage/img/Tips-residuos-2.webp') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Residuos reciclables">
                    <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <span class="text-white text-lg font-semibold">Residuos reciclables</span>
                    </div>
                </div>

                <!-- Imagen 4 -->
                <div class="relative group overflow-hidden rounded-lg shadow-md">
                    <img src="{{ asset('storage/img/Tips-residuos-3.webp') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Residuos peligrosos">
                    <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <span class="text-white text-lg font-semibold">Residuos peligrosos</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- Medio ambiente -->
        <section class="flex">
                <div class="relative group overflow-hidden shadow-md">
                    <img src="{{ asset('storage/banners/2026/cuidemos-la-naturaleza-ahora-2026.jpg') }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-110" alt="Tips residuos">
                    <div class="absolute inset-0 bg-[#0047DC]/70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 p-2">
                        <span class="text-white text-2xl font-semibold">Cuidemos hoy lo que aún vemos en azul y verde. El mañana depende de nuestras acciones</span>
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
                            class="w-full h-48 object-cover">

                        <!-- Contenido -->
                        <div class="p-4 text-[#0047DC] text-left">
                            <!-- Título -->
                            <h3 class="text-lg font-bold mb-2 hover:text-[#00C81F] transition-colors">
                                <a href="{{ route('noticias.article', [$noticia->slug, $noticia->id]) }}" aria-label="{{ Str::limit($noticia->titulo, 70) }}">
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
        <section class="px-2 lg:px-32 py-8" style="background: #008A14;">
            <div class="w-full text-center pb-8 text-white font-bold">
                <h2 class="text-4xl">Portafolio de Servicios</h2>
                <h2 class="text-xl">Aguas del Huila S.A E.S.P Llevamos más que agua</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-8 px-2 md:px-32 pt-8 text-white font-bold text-center">

                @foreach($servicios as $servicio)
                    <div class="flex flex-column justify-center">
                        <a href="{{ route('servicios.article', [$servicio->slug, $servicio->id]) }}" class="justify-items-center" aria-label="{{ $servicio->titulo }}">
                            <img src="{{ asset('storage/' . $servicio->icono) }}" class="h-auto mb-2" alt="{{ $servicio->titulo }}">
                            <h3 class="">{{ $servicio->nombre }}</h3>
                        </a>
                    </div>
                @endforeach

            </div>

        </section>

        <!-- sitio interes -->
        <section class="px-2 lg:px-32 py-8 bg-white" id="directorio-de-entidades">
            <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                <h2 class="text-4xl">Sitios de Interés</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-16 px-2 md:px-32 py-8 text-white font-bold text-center">

                <div class="flex justify-center items-center">
                    <a href="https://www.presidencia.gov.co/" class="block w-40 h-20" aria-label="Presidencia">
                        <img src="{{ asset('storage/img/Presidencia-logo.png') }}" 
                            alt="Presidencia"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.minhacienda.gov.co/" class="block w-40 h-20" aria-label="Minhacienda">
                        <img src="{{ asset('storage/img/minvivienda.png') }}" 
                            alt="Minvivienda"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.huila.gov.co/" class="block w-40 h-20" aria-label="huila Crece">
                        <img src="{{ asset('storage/img/huilacrecegober.png') }}" 
                            alt="Huila Crece"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.mintic.gov.co/portal/inicio/Glosario/G/5306:Gobierno-en-Linea-GEL" class="block w-40 h-20" aria-label="MinTic">
                        <img src="{{ asset('storage/img/gobierno-linea.png') }}" 
                            alt="Gobierno en Línea"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.mintic.gov.co/portal/inicio/" class="block w-40 h-20" aria-label="MinTic Servicios">
                        <img src="{{ asset('storage/img/superservicios.png') }}" 
                            alt="Superservicios"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.procuraduria.gov.co/Pages/Inicio.aspx" class="block w-40 h-20" aria-label="Procuraduría">
                        <img src="{{ asset('storage/img/logo-procuraduria.png') }}" 
                            alt="Procuraduría"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.cra.gov.co/" class="block w-40 h-20" aria-label="CRA">
                        <img src="{{ asset('storage/img/logo/logo-cra.png') }}" 
                            alt="CRA"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.minsalud.gov.co/Paginas/InicioV2.aspx" class="block w-40 h-20" aria-label="Salud">
                        <img src="{{ asset('storage/img/logo/Logo_Ministerio_de_Salud_y_Prote.png') }}" 
                            alt="Salud"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.asamblea-huila.gov.co/" class="block w-40 h-20" aria-label="Asamble">
                        <img src="{{ asset('storage/img/logo/logo-asamblea-huila.png') }}" 
                            alt="Asamble"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.contraloria.gov.co/" class="block w-40 h-20" aria-label="Contraloria">
                        <img src="{{ asset('storage/img/logo/contraloria_general_republica.png') }}" 
                            alt="Contraloria"
                            class="w-full h-full object-contain">
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <a href="https://www.cam.gov.co/" class="block w-40 h-20" aria-label="CAM">
                        <img src="{{ asset('storage/img/logo/cam-logo.webp') }}" 
                            alt="CAM"
                            class="w-full h-full object-contain">
                    </a>
                </div>

            </div>

        </section>

        @include('partials.footer')

        <!-- Swiper CSS -->
        <script>
            const swiper = new Swiper('.mySwiper', {
                loop: false,
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

            const toggleButton = document.getElementById('swiper-toggle');

            const playIcon = document.getElementById('icon-play');

            const pauseIcon = document.getElementById('icon-pause');

            let autoplayActivo = true;

            toggleButton.addEventListener('click', () => {

                if (autoplayActivo) {

                    swiper.autoplay.stop();

                    autoplayActivo = false;

                    playIcon.classList.remove('hidden');
                    pauseIcon.classList.add('hidden');

                    toggleButton.setAttribute('aria-label', 'Reanudar carrusel');

                } else {

                    swiper.autoplay.start();

                    autoplayActivo = true;

                    playIcon.classList.add('hidden');
                    pauseIcon.classList.remove('hidden');

                    toggleButton.setAttribute('aria-label', 'Pausar carrusel');

                }

            });
        </script>
        <!-- Slide youtube CSS -->
        <script src="https://www.youtube.com/iframe_api"></script>
        <script>
            const swiperVideo = new Swiper('.videosSlide', {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 20,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
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

            let players = [];

            function onYouTubeIframeAPIReady() {

                document.querySelectorAll("iframe[id^='youtube-player-']")
                    .forEach((iframe) => {

                        players.push(
                            new YT.Player(iframe.id, {

                                events: {

                                    onStateChange: function (event) {

                                        switch (event.data) {

                                            // Reproduciendo
                                            case YT.PlayerState.PLAYING:
                                                swiperVideo.autoplay.stop();
                                                break;

                                            // Pausado
                                            case YT.PlayerState.PAUSED:
                                                swiperVideo.autoplay.start();
                                                break;

                                            // Finalizado
                                            case YT.PlayerState.ENDED:
                                                swiperVideo.autoplay.start();
                                                break;
                                        }

                                    }

                                }

                            })
                        );

                    });

            }
        </script>

    </body>
</html>
