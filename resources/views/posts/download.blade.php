<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila |  Descargas</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-2">Descargas</h2>
                <p class="text-lg">Inicio </span class="font-bold">/  Descargas</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                @foreach($posts as $post)
                <div class="w-full h-16 rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    @if ($post->id == 4)
                    <a href="{{ route('posts.show') }}" class="hover:text-[#00C81F]">{{ $post->nombre }}</a>
                    @else
                    <a href="{{ route('posts.file', $post->slug) }}" class="hover:text-[#00C81F]">{{ $post->nombre }}</a>
                    @endif
                </div>
                @endforeach

            </div>
        </section>

        @include('partials.footer')

    </body>
</html>
