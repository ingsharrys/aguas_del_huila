<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Atención y Servicios a la Ciudadanía</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Atención y Servicios a la Ciudadanía</h2>
                <p class="text-lg">Inicio</span class="font-bold"> / Atención y Servicios a la Ciudadanía</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <!-- Encuesta Servicios Recibidos por Trámites -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="{{ route('encuesta.tramite') }}" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-area-icon lucide-chart-area"><path d="M3 3v16a2 2 0 0 0 2 2h16"/><path d="M7 11.207a.5.5 0 0 1 .146-.353l2-2a.5.5 0 0 1 .708 0l3.292 3.292a.5.5 0 0 0 .708 0l4.292-4.292a.5.5 0 0 1 .854.353V16a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1z"/></svg>
                        <h3 class="text-2xl font-bold py-4">Encuesta Servicios Recibidos por Trámites</h3>
                    </a>               
                </div>

            <!-- Peticiones, quejas y reclamos -->
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="{{ route('pqr') }}" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                        <h3 class="text-2xl font-bold py-4">Peticiones, quejas, reclamos, Sugerencia, Denuncia y Felicitación</h3>
                    </a>               
                </div>            

            <!-- Directorio de contactos -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="https://aguasdelhuila.gov.co/institucional/directorio-aguas-del-huila" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-contact-icon lucide-contact"><path d="M16 2v2"/><path d="M7 22v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2"/><path d="M8 2v2"/><circle cx="12" cy="11" r="3"/><rect x="3" y="4" width="18" height="18" rx="2"/></svg>
                        <h3 class="text-2xl font-bold py-4">Directorio de contactos</h3>
                    </a>               
                </div>                      

            <!-- calendario -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="{{ route('calendario') }}" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-icon lucide-calendar"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                        <h3 class="text-2xl font-bold py-4">Calendario de eventos</h3>
                    </a>               
                </div>            

            <!-- Plan de participación ciudadana -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="/storage/posts/archivos/2019/MIPG/PlanesInstitucionales/2.%20%20Plan%20de%20Participacin%20Ciudadana.pdf" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text-icon lucide-file-text"><path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                        <h3 class="text-2xl font-bold py-4">Plan de participación ciudadana</h3>
                    </a>               
                </div>            

            <!-- Datos Abiertos -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="https://www.datos.gov.co/browse?q=aguas+del+huila+&sortBy=relevance&page=1&pageSize=20" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cloud-download-icon lucide-cloud-download"><path d="M12 13v8l-4-4"/><path d="m12 21 4-4"/><path d="M4.393 15.269A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.436 8.284"/></svg>
                        <h3 class="text-2xl font-bold py-4">Datos Abiertos</h3>
                    </a>               
                </div>            

            <!-- Informes de gestión -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="{{ route('posts.file', 'informes-de-gestion') }}" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-line-icon lucide-chart-line"><path d="M3 3v16a2 2 0 0 0 2 2h16"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                        <h3 class="text-2xl font-bold py-4">Informes de gestión</h3>
                    </a>               
                </div>            

            <!-- actividades -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="{{ route('posts.file', 'actividades-de-participacion-ciudadana') }}" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days-icon lucide-calendar-days"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                        <h3 class="text-2xl font-bold py-4">Actividades de Participación Ciudadana</h3>
                    </a>               
                </div>            

            <!-- correo -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="mailto:notificacionesjudiciales@aguasdelhuila.gov.co" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-at-sign-icon lucide-at-sign"><circle cx="12" cy="12" r="4"/><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8"/></svg>
                        <h3 class="text-md font-bold py-4">Para notificaciones enviar a notificacionesjudiciales@aguasdelhuila.gov.co</h3>
                    </a>               
                </div>            

            <!-- Denuncias -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="{{ route('denuncias') }}" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pen-line-icon lucide-file-pen-line"><path d="m18.226 5.226-2.52-2.52A2.4 2.4 0 0 0 14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-.351"/><path d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><path d="M8 18h1"/></svg>
                        <h3 class="text-2xl font-bold py-4">Denuncias</h3>
                    </a>               
                </div>

                <!-- Acceso de Proponente -->            
                <div class="w-full mx-auto text-[#0047DC] hover:text-[#00C81F]">
                    <a href="https://procesos.aguasdelhuila.gov.co/login" class="flex flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-key-icon lucide-user-key"><path d="M20 11v6"/><path d="M20 13h2"/><path d="M3 21v-2a4 4 0 0 1 4-4h6a4 4 0 0 1 2.072.578"/><circle cx="10" cy="7" r="4"/><circle cx="20" cy="19" r="2"/></svg>
                        <h3 class="text-2xl font-bold py-4">Acceso de Proponente</h3>
                    </a>               
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

        @include('partials.footer')

    </body>
</html>
