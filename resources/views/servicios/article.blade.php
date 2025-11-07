<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>{{ $servicio->titulo }}</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-2">{{ $servicio->titulo }}</h2>
                <p class="text-lg">Inicio / Servicios </span class="font-bold">/ Blog</span></p>
            </div>
        </div>


        <!-- servicios -->
        <section class="px-2 lg:px-32 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-[70%_30%] gap-8">
                <div class="w-full mx-auto">
                    <img src="{{ asset('storage/'.$servicio->imagen_portada) }}" alt="{{ $servicio->titulo }}" class="w-full h-96 object-cover rounded-lg mb-6">

                    <h1 class="text-3xl font-bold text-[#0047DC] mb-4">{{ $servicio->titulo }}</h1>
                    <p class="text-gray-500 text-sm mb-8">
                        Publicado el {{ $servicio->created_at->format('d M Y') }} 
                        por <strong>Aguas del Huila</strong>
                    </p>

                    <div class="prose max-w-none text-justify text-gray-900">
                        {!! $servicio->contenido !!}
                    </div>

                    <hr class="my-10">

                </div>

                <!-- servicios relacionadas -->
                <div class="w-full mx-auto">
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Servicios relacionadas</h3>
                    <div class="grid grid-cols-3 md:grid-cols-1 gap-6">
                        @foreach($relacionadas as $relacion)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <!-- Imagen de portada -->
                                <img src="{{ asset('storage/' . $relacion->imagen_portada) }}" 
                                    alt="{{ $relacion->titulo }}" 
                                    class="w-full h-48 object-cover">

                                <!-- Contenido -->
                                <div class="p-4 text-[#0047DC] text-left">
                                    <!-- Título -->
                                    <h3 class="text-lg font-bold mb-2 hover:text-[#00C81F] transition-colors">
                                        <a href="{{ route('servicios.article', [$relacion->slug, $relacion->id]) }}">
                                            {{ Str::limit($relacion->titulo, 70) }}
                                        </a>
                                    </h3>

                                    <!-- Fecha y usuario -->
                                    <div class="text-sm text-gray-500 flex justify-between items-center">
                                        <span>{{ $relacion->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        @include('partials.footer')

    </body>
</html>
