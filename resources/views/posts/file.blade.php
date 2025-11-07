<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>{{ $post->nombre }}</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-2">{{ $post->nombre }}</h2>
                <p class="text-lg">Inicio / Descargas </span class="font-bold">/ {{ $post->nombre }}</span></p>
            </div>
        </div>


        <!-- noticias -->
        <section class="px-2 lg:px-32 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Columna izquierda – Lista de secciones -->
                <aside class="bg-white shadow-md p-4 rounded-lg border-t-8 border-[#0047DC]">
                    <h2 class="text-lg font-semibold mb-4 text-[#0047DC]">Secciones</h2>

                    @forelse($hijos as $child)
                    <div class="mb-2">
                        <a href="{{ route('posts.show', $child->slug) }}" 
                        class="block px-3 py-2 rounded text-black bg-gray-50 hover:bg-gray-100 hover:text-[#00C81F]">
                            {{ $child->nombre }}
                        </a>
                    </div>
                    @empty
                        <div class="block px-3 py-2 rounded text-black bg-gray-50 hover:bg-gray-100 hover:text-[#00C81F]">
                            Sin registros
                        </div>
                    @endforelse
                </aside>

                <!-- Columna derecha – Contenido -->
                <div class="lg:col-span-2 bg-white shadow-md p-6 rounded-lg">
                    <div class="prose max-w-none text-black">
                        {!! $post->contenido !!}
                    </div>

                    @if(count($archivos) > 0)
                    <h3 class="text-xl font-semibold mt-6 mb-3 text-[#0047DC]">Archivos Disponibles</h3>
                    <ul class="list-disc ml-6">
                        @foreach($archivos as $file)
                        <li>
                            <a href="{{ asset('storage/' . $file->archivo) }}" 
                            class="text-[#00C81F] hover:text-[#0047DC]" target="_blank">
                                {{ $file->nombre }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

            </div>
        </section>

        @include('partials.footer')

    </body>
</html>
