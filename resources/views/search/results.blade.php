<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Resultados de busqueda</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Resultados de busqueda</h2>
                <p class="text-lg">Inicio </span class="font-bold"> / Resultados de busqueda</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8 text-black">

            <h1 class="text-3xl font-bold text-[#0047DC] mb-6">
                Resultados de búsqueda para: <span class="text-[#00C81F]">"{{ $q }}"</span>
            </h1>
            
            @if($noticias->count() || $servicios->count() || $paginas->count() || $archivos->count())

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                @if($noticias->count())
                <div class="w-full">
                    <h2 class="text-xl font-semibold text-[#0047DC] my-4">Noticias</h2>
                    @foreach($noticias as $n)
                        <a href="{{ route('noticias.article', [$n->slug, $n->id]) }}" target="_blank" class="block py-2 hover:text-[#00C81F]">
                            {{ $n->titulo }}
                        </a>
                    @endforeach
                </div>
                @endif

                @if($servicios->count())
                <div class="w-full">
                    <h2 class="text-xl font-semibold text-[#0047DC] my-4">Servicios</h2>
                    @foreach($servicios as $s)
                        <a href="{{ route('servicios.article', [$s->slug, $s->id]) }}" target="_blank" class="block py-2 hover:text-[#00C81F]">
                            {{ $s->nombre }}
                        </a>
                    @endforeach
                </div>
                @endif

                @if($paginas->count())
                <div class="w-full">
                    <h2 class="text-xl font-semibold text-[#0047DC] my-4">Páginas</h2>
                    @foreach($paginas as $p)
                        <a href="{{ route('posts.file', $p->slug) }}" target="_blank" class="block py-2 hover:text-[#00C81F]">
                            {{ $p->nombre }}
                        </a>
                    @endforeach
                </div>
                @endif

                @if($archivos->count())
                <div class="w-full">
                    <h2 class="text-xl font-semibold text-[#0047DC] my-4">Archivos</h2>
                    @foreach($archivos as $a)
                        <a href="{{ asset('storage/' . $a->archivo) }}" target="_blank" class="block py-2 hover:text-[#00C81F]">
                            {{ $a->nombre }}
                        </a>
                    @endforeach
                </div>
                @endif

                @if($secciones->count())
                <div class="w-full">
                    <h2 class="text-xl font-semibold text-[#0047DC] my-4">Secciones</h2>
                    @foreach($secciones as $sec)
                        <a href="{{ route($sec->route) }}" target="_blank" class="block py-2 hover:text-[#00C81F]">
                            {{ $sec->titulo }}
                        </a>
                    @endforeach
                </div>
                @endif

            </div>

            @else
                <p class="text-gray-500">No se encontraron resultados.</p>
            @endif

        </section>

        @include('partials.footer')

    </body>
</html>
