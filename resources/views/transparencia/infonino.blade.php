<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Información para niños, niñas y adolescentes</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Información para niños, niñas y adolescentes</h2>
                <p class="text-lg">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('transparencia') }}" class="hover:text-[#00C81F]">Transparencia y Acceso a la Información Pública</a> /
                    <span class="font-bold">Información para niños, niñas y adolescentes</span>
                </p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">
            <h2 class="text-center text-xl font-bold uppercase">Pon a prueba tus conocimientos</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
                @foreach ($tests as $test)
                <!-- Card 1 -->
                <a href="{{ route('test.publico', $test->slug) }}"
                    class="group bg-white rounded-3xl border border-gray-200 shadow-md
                        hover:bg-gray-200 hover:shadow-xl hover:-translate-y-2
                        transition-all duration-300 ease-in-out
                        flex flex-col items-center justify-center
                        text-center p-10">

                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-droplets preview-icon"><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/></svg>

                    <h3 class="mt-8 text-xl font-bold text-black leading-tight">
                        {{ $test->nombre }}
                    </h3>

                </a>
                @endforeach

                <!-- Card 3 -->
                <a href="{{ route('supergota') }}"
                    class="group bg-white rounded-3xl border border-gray-200 shadow-md
                        hover:bg-gray-200 hover:shadow-xl hover:-translate-y-2
                        transition-all duration-300 ease-in-out
                        flex flex-col items-center justify-center
                        text-center p-10">

                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-palette preview-icon"><path d="M12 22a1 1 0 0 1 0-20 10 9 0 0 1 10 9 5 5 0 0 1-5 5h-2.25a1.75 1.75 0 0 0-1.4 2.8l.3.4a1.75 1.75 0 0 1-1.4 2.8z"/><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/></svg>

                    <h3 class="mt-8 text-xl font-bold text-black leading-tight">
                        Pintando a Super Gota
                    </h3>

                </a>
        
            </div>
        </div>

        @include('partials.footer')

    </body>
</html>
