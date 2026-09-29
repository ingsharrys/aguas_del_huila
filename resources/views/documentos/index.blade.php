<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Gestión de Calidad</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-96 overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Gestión de Calidad</h2>
                <p class="text-lg flex flex-wrap justify-center gap-2">
                    <a href="/" class="hover:text-[#00C81F]">
                        Inicio
                    </a>
                    <span>/</span>
                    <a href="{{ route('transparencia') }}"
                    class="hover:text-[#00C81F]">
                        Transparencia y Acceso a la Información Pública
                    </a>
                    <span>/</span>
                    <a href="{{ route('gestion-calidad') }}"
                    class="hover:text-[#00C81F]">
                        Procedimientos que se siguen para tomar decisiones en las diferentes áreas
                    </a>
                    @if($carpeta)

                        @php
                            $niveles = explode('/', $carpeta);
                            $rutaActual = '';
                        @endphp


                        @foreach($niveles as $nivel)

                            @php
                                $rutaActual .= ($rutaActual ? '/' : '') . $nivel;
                            @endphp

                            <span>/</span>

                            <a href="{{ route('gestion-calidad', $rutaActual) }}"
                            class="hover:text-[#00C81F]">

                                {{ $nivel }}

                            </a>

                        @endforeach

                    @endif
                </p>
            </div>
        </div>


        <!-- carpetas y archivos -->
        <section class="px-2 lg:px-32 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Columna izquierda – Lista de carpetas -->
                <aside class="bg-white shadow-md p-4 rounded-lg border-t-8 border-[#0047DC]">

                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold mb-4 text-[#0047DC]">Secciones</h2>
                        <!-- boton de volver -->
                        @if($carpeta)
    
                            @php
                                $partes = explode('/', $carpeta);
                                array_pop($partes);
                                $anterior = implode('/', $partes);
                            @endphp
    
                            <div class="mb-2">
                                <a href="{{ route('gestion-calidad', $anterior) }}"
                                class="block px-3 py-2 rounded text-black bg-gray-50 hover:bg-gray-100 hover:text-[#00C81F] transition">
                                    Volver
                                </a>
                            </div>
    
                        @endif
                    </div>


                    @forelse($carpetas as $dir)

                        @php
                            $nombre = basename($dir);
                            $ruta = trim($carpeta.'/'.$nombre, '/');
                        @endphp

                        <div class="mb-2">
                            <a href="{{ route('gestion-calidad', $ruta) }}"
                            class="block px-3 py-2 rounded text-black bg-gray-50 hover:bg-gray-100 hover:text-[#00C81F] transition">
                                {{ $nombre }}
                            </a>
                        </div>

                    @empty

                        <div class="mb-2">
                            No existen carpetas
                        </div>

                    @endforelse

                </aside>

                <!-- Columna derecha – Archivos -->
                <div class="lg:col-span-2 bg-white p-6 shadow-md rounded-lg">

                    <h3 class="text-xl font-semibold mt-6 mb-3 text-[#0047DC]">Archivos Disponibles</h3>

                    <ul id="listaArchivos">

                        @forelse($archivos as $archivo)

                            <li class="flex flex-col sm:flex-row gap-2 justify-between py-4">
                                <div class="flex gap-4 pr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2">
                                        <path d="m15 10 5 5-5 5"/>
                                        <path d="M4 4v7a4 4 0 0 0 4 4h12"/>
                                    </svg>

                                    <a href="{{ Storage::url($archivo) }}"
                                    class="text-black hover:text-[#0047DC]">
                                        {{ basename($archivo) }}
                                    </a>
                                </div>

                                <div class="flex gap-2">

                                    <a href="{{ Storage::url($archivo) }}"
                                    download
                                    class="flex w-48 px-4 py-2 rounded-lg bg-[#00C81F] hover:bg-green-700 text-white justify-center gap-2">
                                        Descargar
                                    </a>

                                </div>
                            </li>

                        @empty

                            <div class="p-4 text-gray-500">
                                No hay archivos en esta carpeta.
                            </div>

                        @endforelse

                    </ul>

                </div>

            </div>
        </section>

    

        <script>

            let page = 2;

            let loading = false;

            let finished = false;

            window.addEventListener('scroll', function(){

                if(finished || loading)
                    return;

                const loader = document.getElementById('loader');

                if(window.innerHeight + window.scrollY >= document.body.offsetHeight - 300){

                    loading = true;

                    loader.classList.remove('hidden');

                    fetch(window.location.pathname + '?page=' + page, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {

                        if (html.trim() === '') {
                            finished = true;
                            return;
                        }

                        document
                            .getElementById('listaArchivos')
                            .insertAdjacentHTML('beforeend', html);

                        page++;

                    })
                    .finally(() => {

                        loading = false;

                        loader.classList.add('hidden');

                    });

                }

            });

            </script>

        @include('partials.footer')

    </body>
</html>
