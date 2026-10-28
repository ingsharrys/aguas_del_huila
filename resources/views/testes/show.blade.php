<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - {{ $test->nombre }}</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">{{ $test->nombre }}</h2>
                <p class="text-lg">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('transparencia') }}" class="hover:text-[#00C81F]">Transparencia y Acceso a la Información Pública</a> /
                    <a href="{{ route('infonino') }}" class="hover:text-[#00C81F]">Información para niños, niñas y adolescentes</a> /
                    <span class="font-bold">{{ $test->nombre }}</span>
                </p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">

                <div class="px-6 py-6">

                    @if ($test->descripcion)
                        <div class="mt-3 text-gray-600">
                            {!! nl2br(e($test->descripcion)) !!}
                        </div>
                    @endif

                </div>

            </div>

            <form action="{{ route('test.publico.store', $test->slug) }}" method="POST">

                @csrf

                <div class="space-y-6 grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <div>

                        <label for="nombre"
                            class="block text-sm font-medium text-gray-700 mb-1">

                            Nombre Completo
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            value="{{ old('nombre') }}"
                            required
                            maxlength="255"
                            placeholder="Escriba su nombre completo"
                            class="block w-full text-sm text-black border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 px-2 py-4 select2-field
                                    @error('nombre')
                                        border-red-500
                                    @enderror">

                        @error('nombre')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Municipio -->
                    <div id="contenedor_municipio">
                        <label for="municipio" class="block text-sm font-semibold text-gray-800 mb-2">
                            Municipio <span class="font-bold text-red-800">*</span>
                        </label>

                        <select
                            id="municipio"
                            name="municipio_id"
                            required
                            class="block w-full text-sm text-black border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 px-2 py-4 select2-field">

                            <option value="">Seleccione un municipio</option>

                            @foreach ($municipios as $municipio)

                                <option
                                    value="{{ $municipio->id }}"
                                    {{ old('municipio_id') == $municipio->id ? 'selected' : '' }}>

                                    {{ $municipio->nombre }}

                                </option>

                            @endforeach

                        </select>

                        @error('municipio_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    @foreach ($test->preguntas as $index => $pregunta)

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">

                            <div class="p-6">

                                {{-- Número y pregunta --}}
                                <div class="flex items-start gap-4">

                                    <div class="flex-shrink-0">

                                        <div class="w-10 h-10 rounded-full bg-blue-100
                                                    flex items-center justify-center
                                                    font-bold text-blue-700">

                                            {{ $index + 1 }}

                                        </div>

                                    </div>


                                    <div class="flex-1">

                                        <h2 class="text-lg font-semibold text-gray-800">
                                            {{ $pregunta->pregunta }}
                                        </h2>

                                    </div>

                                </div>


                                {{-- Opciones --}}
                                <div class="mt-5 space-y-3 ml-0 sm:ml-14">

                                    @foreach ($pregunta->opciones as $opcion)

                                        <label
                                            class="flex items-center gap-3 p-4
                                                border border-gray-200 rounded-lg cursor-pointer
                                                transition-all duration-200
                                                hover:bg-gray-50 hover:border-blue-300
                                                has-[:checked]:border-blue-500
                                                has-[:checked]:bg-blue-50
                                                has-[:checked]:shadow-sm">

                                            <input
                                                type="radio"
                                                name="respuestas[{{ $pregunta->id }}]"
                                                value="{{ $opcion->id }}"
                                                class="peer sr-only">

                                            <span
                                                class="flex-shrink-0 w-8 h-8 rounded-full
                                                    flex items-center justify-center
                                                    font-semibold text-gray-600
                                                    border border-gray-300
                                                    peer-checked:bg-blue-600
                                                    peer-checked:text-white
                                                    peer-checked:border-blue-600
                                                    transition-colors">
                                                {{ $opcion->letra }}
                                            </span>

                                            <span
                                                class="text-gray-700
                                                    peer-checked:text-blue-700
                                                    peer-checked:font-semibold">
                                                {{ $opcion->texto }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                
                <!-- mensaje -->
                <div class="mt-6">
                    <label for="mensaje" class="block text-sm font-semibold text-gray-800 mb-2">
                        Escriba una acción que desde hoy puede realizar en su hogar o finca para ahorrar y proteger el agua: <span class="font-bold text-red-800">*</span>
                    </label>

                    <textarea
                        id="mensaje"
                        name="mensaje"
                        class="block w-full text-sm text-black border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 px-2 py-4"
                        placeholder="Ingrese la acción que realizará para ahorrar y proteger el agua"
                        rows="4"
                        required>{{ old('mensaje') }}</textarea>

                    @error('mensaje')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Botón --}}
                @if ($test->preguntas->count())

                    <div class="mt-6 flex justify-end">

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3
                                text-sm font-semibold text-white
                                bg-blue-600 rounded-lg
                                hover:bg-blue-700 transition-colors cursor-pointer">

                            Finalizar test

                        </button>

                    </div>

                @else

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-5 text-yellow-800">
                        Este test todavía no tiene preguntas disponibles.
                    </div>

                @endif

            </form>

        </div>

        <!-- Modal de resultado -->
        @if(isset($mostrarResultado) && $mostrarResultado && isset($intento))

            <div
                id="modalResultado"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
                x-data
            >
                <div
                    class="w-full max-w-lg bg-white rounded-2xl shadow-xl"
                    onclick="event.stopPropagation()"
                >

                    <div class="p-6 text-center">

                        @if($intento->porcentaje >= 60)

                            <div class="mx-auto w-16 h-16 rounded-full bg-green-100
                                        flex items-center justify-center">

                                <svg class="w-8 h-8 text-green-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"/>

                                </svg>

                            </div>

                            <h2 class="mt-4 text-2xl font-bold text-gray-800">
                                ¡Felicitaciones!
                            </h2>

                            <p class="mt-2 text-gray-600">
                                Has completado el test satisfactoriamente.
                            </p>

                        @else

                            <div class="mx-auto w-16 h-16 rounded-full bg-yellow-100
                                        flex items-center justify-center">

                                <svg class="text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big preview-icon"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>

                            </div>

                            <h2 class="mt-4 text-2xl font-bold text-gray-800">
                                ¡Test completado!
                            </h2>

                            <p class="mt-2 text-gray-600">
                                Te invitamos a continuar aprendiendo sobre el
                                cuidado y protección del agua.
                            </p>

                        @endif

                        <div class="mt-6">

                            <p class="text-sm text-gray-500">
                                Tu resultado
                            </p>

                            <p class="mt-1 text-5xl font-bold text-blue-600">
                                {{ number_format($intento->porcentaje, 0) }}%
                            </p>

                            <p class="mt-3 text-gray-600">
                                Respuestas correctas:
                                <strong>
                                    {{ $intento->respuestas_correctas }}
                                </strong>
                                de
                                <strong>
                                    {{ $intento->total_preguntas }}
                                </strong>
                            </p>

                        </div>

                        <div class="mt-6 text-left">

                            <p class="text-sm font-semibold text-gray-700">
                                Tu compromiso con el cuidado del agua
                            </p>

                            <div class="mt-2 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <p class="text-sm text-gray-700">
                                    {{ $intento->comentario }}
                                </p>
                            </div>

                        </div>

                        <a href="{{ route('test.publico', $test->slug) }}" 
                            class="mt-6 inline-flex items-center justify-center
                                px-6 py-3 text-sm font-semibold text-white
                                bg-blue-600 rounded-lg
                                hover:bg-blue-700 transition-colors cursor-pointer"
                        >
                            Cerrar
                        </a>

                    </div>

                </div>
            </div>

        @endif

        <!-- Modal de error -->
         @if(isset($errorTest))

            <div
                id="modalErrorTest"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
            >

                <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl">

                    <div class="p-6 text-center">

                        <div class="mx-auto w-16 h-16 rounded-full bg-yellow-100
                                    flex items-center justify-center">

                            <svg class="text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rotate-ccw-clock preview-icon"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/></svg>

                        </div>

                        <h2 class="mt-4 text-xl font-bold text-gray-800">
                            Test ya realizado.
                        </h2>

                        <p class="mt-3 text-gray-600">
                            {{ $errorTest }}
                        </p>

                        <a href="{{ route('test.publico', $test->slug) }}" 
                            class="mt-6 inline-flex items-center justify-center
                                px-6 py-3 text-sm font-semibold text-white
                                bg-blue-600 rounded-lg
                                hover:bg-blue-700 transition-colors cursor-pointer"
                        >
                            Entendido
                        </a>

                    </div>

                </div>

            </div>

        @endif

        @include('partials.footer')

    </body>
</html>
