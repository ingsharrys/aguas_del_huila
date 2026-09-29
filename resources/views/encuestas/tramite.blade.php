<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Encuesta de satisfacción de tramites y servicios</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Encuesta de satisfacción de tramites y servicios</h2>   
                <p class="text-lg flex flex-wrap justify-center gap-2">             
                    <a href="/" class="hover:text-[#00C81F]">
                        Inicio
                    </a>
                    <span>/</span>
                    <a href="https://aguasdelhuila.gov.co/atencion-y-servicios-a-la-ciudadania" class="hover:text-[#00C81F]">
                        Atención y Servicios a la Ciudadanía
                    </a>
                    <span>/</span>
                    </span class="font-bold"> Encuesta de satisfacción de tramites y servicios</span>
                </p>
            </div>
        </div>

        <!-- formulario -->
        <section class="px-2 lg:px-32 py-8">
            <div class="bg-white shadow-lg rounded-xl border-t-8 border-[#0047DC]">

                <div class="p-8 w-full">

                    <p class="text-gray-600 mb-8">
                        Su opinión es muy importante para mejorar la calidad de nuestros
                        trámites y servicios.
                    </p>

                    @if(session('success'))
                        <div
                            class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800"
                            role="alert"
                        >
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 text-green-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2A9 9 0 1112 3a9 9 0 0111 9z"/>
                                </svg>

                                <span class="font-semibold">
                                    {{ session('success') }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('tramite.store') }}" method="POST">

                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-black">

                            <!-- Nombre -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    Nombre Completo *
                                </label>

                                <input
                                    type="text"
                                    name="nombre"
                                    value="{{ old('nombre') }}"
                                    class="w-full border rounded-lg px-4 py-3"
                                    required
                                >
                            </div>

                            <!-- Correo -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    Correo Electrónico *
                                </label>

                                <input
                                    type="email"
                                    name="correo"
                                    value="{{ old('correo') }}"
                                    class="w-full border rounded-lg px-4 py-3"
                                    required
                                >
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    Teléfono *
                                </label>

                                <input
                                    type="text"
                                    name="telefono"
                                    value="{{ old('telefono') }}"
                                    class="w-full border rounded-lg px-4 py-3"
                                >
                            </div>

                            <!-- Trámite -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    Indique el trámite o servicios realizado *
                                </label>

                                <input
                                    type="text"
                                    name="tramite"
                                    value="{{ old('tramite') }}"
                                    class="w-full border rounded-lg px-4 py-3"
                                    required
                                >
                            </div>

                            <!-- Medio -->
                            <div>
                                <label class="block font-semibold mb-3">
                                    ¿Por cual medio tuvo acceso al trámite y/o servicio de la entidad? *
                                </label>

                                <div class="space-y-2">

                                    @foreach([
                                        'Presencial',
                                        'Página web',
                                        'Dispositivo Móvil',
                                    ] as $item)

                                        <label class="flex items-center gap-2">

                                            <input
                                                type="radio"
                                                name="medio"
                                                value="{{ $item }}"
                                                {{ old('medio')==$item ? 'checked':'' }}
                                            >

                                            {{ $item }}

                                        </label>

                                    @endforeach

                                </div>
                            </div>

                            <!-- Información -->
                            <div>

                                <label class="block font-semibold mb-3">
                                    ¿La información para realizar el trámite (pasos a seguir, requisitos, etc) o para solicitar el servicio fue clara y completa? *
                                </label>

                                <div class="space-y-2">

                                    @foreach(['Excelente','Buena','Regular','Mala', 'Muy Mala'] as $item)

                                        <label class="flex items-center gap-2">

                                            <input
                                                type="radio"
                                                name="informacion"
                                                value="{{ $item }}"
                                                {{ old('informacion')==$item ? 'checked':'' }}
                                            >

                                            {{ $item }}

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                            <!-- Facilidad -->
                            <div>

                                <label class="block font-semibold mb-3">
                                    ¿El acceso para realizar el trámite o solicitar el servicio fue fácil y adecuado? *
                                </label>

                                <div class="space-y-2">

                                    @foreach(['Si','No'] as $item)

                                        <label class="flex items-center gap-2">

                                            <input
                                                type="radio"
                                                name="facilidad"
                                                value="{{ $item }}"
                                                {{ old('facilidad')==$item ? 'checked':'' }}
                                            >

                                            {{ $item }}

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                            <!-- Grupo -->
                            <div>

                                <label class="block font-semibold mb-3">
                                    Seleccione el grupo al cual pertenece *
                                </label>

                                <div class="space-y-2">

                                    @foreach([
                                        'Ciudadano',
                                        'Empresa',
                                    ] as $item)

                                        <label class="flex items-center gap-2">

                                            <input
                                                type="radio"
                                                name="grupo"
                                                value="{{ $item }}"
                                                {{ old('grupo')==$item ? 'checked':'' }}
                                            >

                                            {{ $item }}

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                            <!-- Beneficio -->
                            <div>

                                <label class="block font-semibold mb-3">
                                    ¿Cuál es el grado de beneficio con el trámite solicitado frente a su actividad económica? *
                                </label>

                                <div class="space-y-2">

                                    @foreach([
                                        'Alto',
                                        'Moderado',
                                        'Leve',
                                        'Sin afectación'
                                    ] as $item)

                                        <label class="flex items-center gap-2">

                                            <input
                                                type="radio"
                                                name="beneficio"
                                                value="{{ $item }}"
                                                {{ old('beneficio')==$item ? 'checked':'' }}
                                            >

                                            {{ $item }}

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                            <!-- Costos -->
                            <div class="lg:col-span-3">

                                <label class="block font-semibold mb-2">
                                    ¿Cuáles fueron los costos en que incurrió al solicitar el trámite?
                                </label>

                                <textarea
                                    name="costos"
                                    rows="5"
                                    class="w-full border rounded-lg px-4 py-3"
                                    placeholder="Ejemplo: Transporte, fotocopias, llamadas telefónicas, internet..."
                                >{{ old('costos') }}</textarea>

                            </div>

                        </div>

                        <div class="mt-8">

                            <!-- Tratamiento de datos -->
                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-4">
                                <div class="flex items-start gap-3">
                                    <input
                                        type="checkbox"
                                        id="autoriza_datos"
                                        name="autoriza_datos"
                                        value="1"
                                        required
                                        class="mt-1 rounded border-gray-300 text-[#0047DC] focus:ring-[#0047DC]"
                                    >
                                    <label for="autoriza_datos" class="text-sm text-gray-700 leading-relaxed">
                                        Autorizo el tratamiento de mis datos personales de conformidad con la normativa vigente sobre protección de datos personales.
                                    </label>
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="bg-[#0047DC] hover:bg-[#0037AE] text-white px-8 py-3 rounded-lg font-semibold transition cursor-pointer"
                            >
                                Enviar Encuesta
                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </section>


        @include('partials.footer')

    </body>
</html>
