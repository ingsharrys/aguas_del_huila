<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>{{ $post->nombre }}</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-96 overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">{{ $post->nombre }}</h2>
                <p class="text-lg">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('posts.download') }}" class="hover:text-[#00C81F]">Documentos</a> /
                
                    @foreach($breadcrumbs as $index => $crumb)
                        @if($loop->last)
                            <span class="font-bold">{{ $crumb->nombre }}</span>
                        @else
                            <a class="hover:text-[#00C81F]" href="{{ url('documentos/' . $crumb->slug) }}">
                                {{ $crumb->nombre }}
                            </a> /
                        @endif
                    @endforeach
                </p>
            </div>
        </div>


        <!-- noticias -->
        <section class="px-2 lg:px-32 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Columna izquierda – Lista de secciones -->
                <aside class="bg-white shadow-md p-4 rounded-lg border-t-8 border-[#0047DC]">
                    @if($crumb->slug == "diagnostico-sanitario-rural-2025")
                        <h2 class="text-lg font-semibold mb-4 text-[#0047DC]">Base de Datos 2025</h2>
                    @else
                        <h2 class="text-lg font-semibold mb-4 text-[#0047DC]">Secciones</h2>
                    @endif

                    @forelse($hijos as $child)
                    <div class="mb-2">
                        <a href="{{ route('posts.file', $child->full_path) }}"
                        class="block px-3 py-2 rounded text-black bg-gray-50 hover:bg-gray-100 hover:text-[#00C81F]">
                            {{ $child->nombre }}
                        </a>
                    </div>
                    @empty

                    @endforelse
                </aside>

                <!-- Columna derecha – Contenido -->
                <div class="lg:col-span-2 bg-white shadow-md p-6 rounded-lg">
                    <div class="prose max-w-none text-black">
                        {!! $post->contenido !!}
                    </div>

                    <!-- Archivos disponibles para comentarios -->
                    @if($post->slug == 'participacion-en-formulacion-de-politicas-publicas')

                            <details class="border-b group">

                                <summary class="cursor-pointer list-none flex justify-between items-center px-6 py-5 bg-green-700 hover:bg-green-900">

                                    <div>

                                        <h3 class="font-semibold text-white">
                                            Comentarios Abiertos
                                        </h3>

                                    </div>

                                    <svg
                                        class="w-5 h-5 transition-transform group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"/>

                                    </svg>

                                </summary>

                                <div class="px-6 pb-6">

                                    @forelse($comentariosAbiertos as $archivoAbierto)
                                    <div class="flex flex-wrap justify-between gap-3 pt-4">

                                        <div>

                                            <h3 class="font-semibold text-[#0047DC]">
                                                {{ $archivoAbierto->nombre }}
                                            </h3>

                                            <p class="text-sm text-gray-500 mt-1">
                                                Vigencia del comentario:
                                                <strong>
                                                    @if($archivoAbierto->fin)
                                                        hasta {{ \Carbon\Carbon::parse($archivoAbierto->fin)->format('d/m/Y') }}
                                                    @else
                                                        hasta nuevo aviso
                                                    @endif
                                                </strong>
                                            </p>

                                        </div>
                                        
                                        <a href="{{ route('posts.document', [$archivoAbierto->post->slug, $archivoAbierto->slug]) }}" class="flex w-48 px-4 py-2 rounded-lg bg-[#0047DC] hover:bg-blue-900 text-white justify-center gap-2">
                                            Comentar
                                        </a>
                                        
                                    </div>
                                    @empty
            
                                        <div class="p-8 text-center text-gray-500">
            
                                            Actualmente no existen procesos de participación ciudadana abiertos.
            
                                        </div>
                                    @endforelse

                                </div>

                            </details>


                            
                            <details class="border-b group">

                                <summary class="cursor-pointer list-none flex justify-between items-center px-6 py-5 bg-red-600 hover:bg-red-700">

                                    <div>
                                        
                                        <h3 class="font-semibold text-white">
                                            Comentarios Cerrados
                                        </h3>
                                        
                                    </div>
                                    
                                    <svg
                                    class="w-5 h-5 transition-transform group-open:rotate-180"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"/>

                                    </svg>
                                    
                                </summary>
                                
                                <div class="px-6 pb-6">
                                    
                                    @forelse($comentariosCerrados as $archivoCerrado)
                                    <div class="flex flex-wrap justify-between gap-3 pt-4">

                                        <div>

                                            <h3 class="font-semibold text-[#0047DC]">
                                                {{ $archivoCerrado->nombre }}
                                            </h3>

                                            <p class="text-sm text-gray-500 mt-1">

                                                Comentario el 

                                                <strong>
                                                    {{ \Carbon\Carbon::parse($archivoCerrado->fin)->format('d/m/Y') }}
                                                </strong>

                                            </p>

                                        </div>

                                        <a href="{{ route('posts.document', [$archivoCerrado->post->slug, $archivoCerrado->slug]) }}" class="flex w-48 px-4 py-2 rounded-lg bg-[#0047DC] hover:bg-blue-900 text-white justify-center gap-2">
                                            Ver Comentarios
                                        </a>

                                    </div>
                                    
                                    @empty
            
                                        <div class="p-8 text-center text-gray-500">
            
                                            Actualmente no existen procesos de participación ciudadana Cerrados.
            
                                        </div>
            
                                    @endforelse

                                </div>

                            </details>

                    <!-- Archivos normales -->
                    @else

                    @if(count($archivos) > 0)
                        <h3 class="text-xl font-semibold mt-6 mb-3 text-[#0047DC]">Archivos Disponibles</h3>
                        <ul id="listaArchivos">

                            @include('partials.archivos', [
                                'archivos' => $archivos
                            ])

                        </ul>
                        <div id="loader" class="text-black text-center py-5 hidden">Cargando archivos...</div>
                    @endif

                    @endif

                </div>

            </div>
        </section>

        
        <!-- Buscador de normas -->
        @if($post->slug == 'sistema-de-normas')
        <section class="px-2 lg:px-32 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Columna izquierda – filtro -->
                <aside class="bg-white shadow-md p-4 rounded-lg border-t-8 border-[#0047DC]">
                    <h2 class="text-lg font-semibold mb-4 text-[#0047DC]">Buscador de Normas</h2>

                    <form method="GET" action="{{ url()->current() }}" class="space-y-5">

                        <!-- Tipo -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tipo de documento
                            </label>

                            <select name="tipo" class="border border-gray-300 rounded-lg p-2 w-full text-black">

                                <option value="" class="text-gray-900">Todos</option>

                                @foreach($tiposNormas as $tipo)

                                    <option
                                        class="text-gray-900"
                                        value="{{ $tipo->id }}"
                                        {{ request('tipo')==$tipo->id ? 'selected':'' }}
                                    >

                                        {{ $tipo->nombre }}

                                    </option>

                                @endforeach

                            </select>
                            
                        </div>

                        <!-- Nombre -->

                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">

                                Nombre del documento

                            </label>

                            <input
                                type="text"
                                name="nombre"
                                value="{{ request('nombre') }}"
                                placeholder="Ej. Resolución 123 de 2025"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-900"
                            >

                        </div>

                        <button
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex w-full text-center justify-center gap-2 cursor-pointer">

                            Buscar

                        </button>

                        @if(request()->filled('tipo') || request()->filled('nombre'))

                            <a
                                href="{{ url()->current() }}"
                                class="block mt-2 text-center bg-gray-300 rounded-lg py-2 hover:bg-gray-400 cursor-pointer">

                                Limpiar filtros

                            </a>

                        @endif

                    </form>
                </aside>

                <!-- Columna derecha – Contenido -->
                <div class="lg:col-span-2 bg-white shadow-md p-6 rounded-lg">

                    <h3 class="text-xl font-semibold mb-4 text-[#0047DC]">
                        Archivos disponibles
                    </h3>

                    @if($archivosNormas->count())

                        <ul id="listaArchivos">
                            @include('partials.archivos',[
                                'archivos'=>$archivosNormas
                            ])
                        </ul>

                    @else

                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center">

                            <h4 class="font-semibold text-gray-700">
                                No se encontraron documentos.
                            </h4>

                            <p class="text-sm text-gray-500 mt-2">
                                Intente cambiar los filtros de búsqueda.
                            </p>

                        </div>

                    @endif
                </div>

            </div>
        </section>
        @endif

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
