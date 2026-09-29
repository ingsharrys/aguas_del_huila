<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Encuesta de Evaluación</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Encuesta de Evaluación</h2>   
                <p class="text-lg flex flex-wrap justify-center gap-2">             
                    <a href="/" class="hover:text-[#00C81F]">
                        Inicio
                    </a>
                    <span>/</span>
                    <a href="https://aguasdelhuila.gov.co/transparencia-y-acceso-a-la-informacion-publica" class="hover:text-[#00C81F]">
                        Transparencia y Acceso a la Información Pública
                    </a>
                    <span>/</span>
                    </span class="font-bold"> Encuesta de Evaluación</span>
                </p>
            </div>
        </div>

        <!-- formulario -->
        <section class="px-2 lg:px-32 py-8">
            <div class="bg-white shadow-lg rounded-xl border-t-8 border-[#0047DC]">

                <div class="p-8 w-full">

                    <p class="text-gray-600 mb-8">
                        Su opinión es muy importante para mejorar la calidad de nuestros servicios
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

                    <form action="{{ route('evaluacion.store') }}" method="POST">

                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-black">

                            <!-- Actualizado -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    ¿ Qué tan actualizada se encuentra la información publicada por Aguas del Huila? *
                                </label>

                                <select name="actualizada" class="w-full border rounded-lg px-4 py-3" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Desactualizada">Desactualizada</option>
                                    <option value="Poco Actualizada">Poco Actualizada</option>
                                    <option value="Medianamente Actualizada">Medianamente Actualizada</option>
                                    <option value="Actualizada">Actualizada</option>
                                    <option value="Muy Actualizada">Muy Actualizada</option>
                                </select>

                            </div>

                            <!-- informacion -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    ¿Encontró la información que buscaba en la sección transparencia y acceso a la información pública? *
                                </label>

                                <select name="informacion" class="w-full border rounded-lg px-4 py-3" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Si, toda">Si, toda</option>
                                    <option value="Solo una parte">Solo una parte</option>
                                    <option value="No encontré la información">No encontré la información</option>
                                </select>

                            </div>

                            <!-- satisfaccion -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    ¿Estás satisfecho con la distribución y diseño de la sección? *
                                </label>

                                <select name="satisfaccion" class="w-full border rounded-lg px-4 py-3" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Nada Satisfecho">Nada Satisfecho</option>
                                    <option value="Poco Satisfecho">Poco Satisfecho</option>
                                    <option value="Medianamente Satisfecho">Medianamente Satisfecho</option>
                                    <option value="Satisfecho">Satisfecho</option>
                                    <option value="Muy Satisfecho">Muy Satisfecho</option>
                                </select>

                            </div>

                            <!-- facilidad -->
                            <div>
                                <label class="block font-semibold mb-2">
                                    ¿Fue fácil buscar la información de tu interés dentro de la sección? *
                                </label>

                                <select name="facilidad" class="w-full border rounded-lg px-4 py-3" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>

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
                                Enviar
                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </section>


        @include('partials.footer')

    </body>
</html>
