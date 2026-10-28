<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Peticiones, quejas y reclamos</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Peticiones, quejas, reclamos, Sugerencia, Denuncia y Felicitación</h2>
                <p class="text-lg">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('participa') }}" class="hover:text-[#00C81F]">Participa</a> /
                    <span class="font-bold">PQRSDF</span>
                </p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">
            
            <div class="mx-auto bg-gray-50 border border-gray-300 rounded-xl p-8">
                <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-2xl font-bold text-[#0047DC]">Información de Accesibilidad</h2>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Sede:</span> Calle 21 No. 1C - 17 - Neiva, Huila</p>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Teléfono de Contacto:</span> (+57) 3174034811</p>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Correo Electrónico:</span> info@aguasdelhuila.gov.co</p>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Horarios de Atención:</span></p>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Lunes a Jueves:</span> Mañana 7AM a 12M - Tarde 2PM a 6PM</p>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Viernes:</span> Mañana 7AM a 12M - Tarde 2PM a 5PM</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-[#0047DC]">Consulte el estado de su PQRSDF</h2>
                        <form action="{{ route('pqr.search') }}" method="POST" class="mt-4 space-y-6">

                            @csrf

                            <!-- Pregunta 1 -->
                            <div>
                                <label for="pqrsdf_code" class="block text-sm font-semibold text-gray-800 mb-3">
                                    Código Único de Seguimiento
                                </label>
                                <input
                                    type="text"
                                    name="pqrsdf_code"
                                    class="w-full border-gray-300 rounded-lg shadow-sm bg-white focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el código único de seguimiento"
                                    required
                                >
                            </div>
                            
                            <div class="flex justify-start gap-4 flex-wrap">
                                <button
                                    type="submit"
                                    class="cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 font-medium text-white hover:opacity-90"
                                >
                                    Buscar PQRSDF
                                </button>
                            
                                <a href="{{ route('carteleravirtual') }}" class="cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl border-2 border-green-700 hover:bg-green-600 px-4 py-3 font-medium text-black hover:text-white">
                                    Cartelera Virtual
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <h2 class="text-2xl font-bold text-[#0047DC]">Radicación de PQRSDF</h2>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Apreciado Usuario:</span> Registre aquí sus peticiones, quejas, reclamos, sugerencias, denuncias o felicitaciones sobre temas de competencia de Aguas del Huila S.A. E.S.P. Puede hacerlo de forma identificada o anónima. El servicio no tiene costo.</p>
                        <p class="mt-2 text-gray-600">Al radicar recibirá un <span class="font-bold">código único de seguimiento</span> para consultar el estado de su solicitud. Las respuestas se emiten dentro de los términos de la Ley 1755 de 2015.</p>
                        <p class="mt-2 text-gray-600">Si lo realiza de forma <span class="font-bold">anonima</span>, la respuesta se publicará en la <a href="{{ route('carteleravirtual') }}" class="text-blue-600 hover:underline">Cartelera Virtual</a></p>
                        <p class="mt-2 text-gray-600"><span class="font-bold">AL ENVIAR ESTE FORMULARIO ESTA ACEPTANDO LA POLITICA DE TRATAMIENTO DE DATOS PERSONALES CONTENIDA EN EL SIGUIENTE LINK: </span> <a href="https://aguasdelhuila.gov.co/archivos/documentos/politicas/politica-de-privacidad-y-tratamiento-de-datos-personales-2026" target="_blank" class="text-[#0047DC] hover:text-blue-700 underline">Política de privacidad y tratamiento de datos personales - 2026</a></p>
                    </div>
                </div>

                @if($errors->any())
                    <div id="errores-formulario" class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800" role="alert">
                        <p class="font-semibold mb-2">No se pudo radicar la solicitud. Revise lo siguiente:</p>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach($errors->all() as $mensaje)
                                <li>{{ $mensaje }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <script>document.addEventListener('DOMContentLoaded', () => document.getElementById('errores-formulario')?.scrollIntoView({ behavior: 'smooth', block: 'center' }));</script>
                @endif

                <form action="{{ route('pqr.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                        <!-- Pregunta 1 -->
                        <div>
                            <label for="discapacidad" class="block text-sm font-semibold text-gray-800 mb-3">
                                ¿Se reconoce como persona en condición de discapacidad?
                            </label>
                            <select
                                id="discapacidad"
                                name="discapacidad"
                                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                onchange="toggleTipoDiscapacidad()"
                                required
                            >
                                <option value="">Seleccione una opción</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    
                        <!-- Pregunta 2 -->
                        <div id="tipo_discapacidad_container" class="hidden">
                            <label for="tipo_discapacidad" class="block text-sm font-semibold text-gray-800 mb-3">
                                2. Tipo de discapacidad
                            </label>
                            <select
                                id="tipo_discapacidad"
                                name="tipo_discapacidad"
                                disabled
                                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                onchange="toggleOtraDiscapacidad()"
                                required
                            >
                                <option value="">Seleccione una opción</option>
                                <option value="visual">Visual</option>
                                <option value="auditiva">Auditiva</option>
                                <option value="fisica_motora">Física o motora</option>
                                <option value="cognitiva">Cognitiva</option>
                                <option value="otra">Otra</option>
                            </select>
                        </div>
                    
                        <!-- Otra discapacidad -->
                        <div id="otra_discapacidad_container" class="hidden">
                            <label for="otra_discapacidad" class="block text-sm font-semibold text-gray-800 mb-2">
                                Especifique el tipo de discapacidad
                            </label>
                            <input
                                type="text"
                                id="otra_discapacidad"
                                name="otra_discapacidad"
                                disabled
                                class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                placeholder="Ingrese el tipo de discapacidad"
                            >
                        </div>
                    
                        <!-- Identificado / Anónimo (Radio Cards Moderno) -->
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 space-y-2">
                            <label class="block text-sm font-semibold text-gray-800">
                                ¿Desea ser identificado o anónimo?
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                
                                <!-- Opción: Identificado -->
                                <label for="identificado" class="relative flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition-all shadow-sm has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50 has-[:checked]:ring-2 has-[:checked]:ring-blue-500/20">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2.5 bg-blue-100 text-blue-600 rounded-lg shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-semibold text-gray-900">Identificado</span>
                                            <span class="block text-xs text-gray-500">Se registrarán sus datos de contacto</span>
                                        </div>
                                    </div>
                                    <input type="radio" id="identificado" name="identificado_anonimo" value="identificado" checked onchange="toggleFormulario()" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer" />
                                </label>

                                <!-- Opción: Anónimo -->
                                <label for="anonimo" class="relative flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition-all shadow-sm has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50 has-[:checked]:ring-2 has-[:checked]:ring-blue-500/20">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2.5 bg-gray-100 text-gray-600 rounded-lg shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-semibold text-gray-900">Anónimo</span>
                                            <span class="block text-xs text-gray-500">No se solicitará información personal</span>
                                        </div>
                                    </div>
                                    <input type="radio" id="anonimo" name="identificado_anonimo" value="anonimo" onchange="toggleFormulario()" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer" />
                                </label>

                            </div>
                        </div>
                    </div>

                    <!-- Cartelera física -->
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-4" id="info-cartelera">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info preview-icon text-blue-900"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                            <div>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    Al tratarse de una solicitud <span class="font-bold">anónima</span>, la respuesta a su petición será publicada en la página web en la <a href="{{ route('carteleravirtual') }}" class="text-blue-600 hover:underline">Cartelera Virtual</a> y se emitirá dentro de los tiempos establecidos por la ley, según el tipo de solicitud. Una vez emitida, será publicada en la <a href="{{ route('carteleravirtual') }}" class="text-blue-600 hover:underline">Cartelera Virtual</a> de la entidad, donde estará visible al público por 5 días hábiles.
                                </p>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    Transcurrido este tiempo, el documento desaparecerá de la vista pública de la cartelera, pero usted podrá seguir consultando su respuesta en cualquier momento ingresando su código de seguimiento en <span class="font-bold">nuestro buscador</span>
                                </p>
                            </div>
                        </div>
                    </div>
                
                    <!-- Datos personales - usuario identificado -->
                    <div class="bg-white border border-gray-300 rounded-xl p-5" id="datos-identificado">
                        <h2 class="block font-semibold text-gray-800 mb-2 border-b-2 border-gray-300 pb-2">
                            Datos personales/empresariales
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <!-- Pregunta -->
                            <div>
                                <label for="tipo_solicitante" class="block text-sm font-semibold text-gray-800 mb-3">
                                    Tipo Solicitante <span class="font-bold text-red-800">*</span>
                                </label>
                                <select
                                    id="tipo_solicitante"
                                    name="tipo_solicitante"
                                    class="campo-identificado block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                >
                                    <option value="">Seleccione una opción</option>
                                    <option value="Persona Natural">Persona Natural</option>
                                    <option value="Persona Jurídica">Persona Jurídica</option>
                                    <option value="Niños, Niñas y Adolescentes">Niños, Niñas y Adolescentes</option>
                                    <option value="Apoderado">Apoderado</option>
                                </select>
                            </div>

                            <!-- Pregunta -->
                            <div id="contenedor_tipo_identificacion">
                                <label for="tipo_identificacion" class="block text-sm font-semibold text-gray-800 mb-3">
                                    Tipo Identificación <span class="font-bold text-red-800">*</span>
                                </label>
                                <select
                                    id="tipo_identificacion"
                                    name="tipo_identificacion"
                                    class="campo-identificado block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                >
                                    <option value="">Seleccione una opción</option>
                                    <option value="Adulto sin identificación">Adulto sin identificación</option>
                                    <option value="Carné diplomatico">Carné diplomatico</option>
                                    <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                                    <option value="Cédula de extrangería">Cédula de extrangería</option>
                                    <option value="NUI">Número único de identificación</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                    <option value="Tarjeta profesional">Tarjeta profesional</option>
                                    <option value="Número de identificación tributaría">Número de identificación tributaría</option>
                                </select>
                            </div>

                            <!-- numero de identificación / nit -->
                            <div id="numero_identificacion">
                                <label for="numero_identificacion" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Número de identificación / NIT <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="numero_identificacion"
                                    name="numero_identificacion"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el número de identificación / NIT"
                                >
                            </div>

                            <!-- razon social -->
                            <div id="razon_social">
                                <label for="razon_social" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Razón Social <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="razon_social"
                                    name="razon_social"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese la razón social"
                                >
                            </div>

                            <!-- nombre usuario -->
                            <div id="nombre_usuario">
                                <label for="nombre_usuario" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Nombre Usuario <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="nombre_usuario"
                                    name="nombre_usuario"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el nombre del usuario"
                                >
                            </div>

                            <!-- apellido usuario -->
                            <div id="apellido_usuario">
                                <label for="apellido_usuario" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Apellido Usuario <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="apellido_usuario"
                                    name="apellido_usuario"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el apellido del usuario"
                                >
                            </div>
                            
                            <!-- correo electronico -->
                            <div id="correo_principal_container">
                                <label for="correo_electronico" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Correo Electrónico <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="correo_electronico"
                                    name="correo_electronico"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el correo electrónico"
                                >
                            </div>
                            
                            <!-- País -->
                            <div>
                                <label for="pais" class="block text-sm font-semibold text-gray-800 mb-2">
                                    País <span class="font-bold text-red-800">*</span>
                                </label>

                                <select
                                    id="pais"
                                    name="pais"
                                    class="campo-identificado block w-full text-sm text-black border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                >
                                    <option value="">Seleccione un país</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            <!-- Otro país -->
                            <div id="contenedor_otro_pais" class="hidden">
                                <label for="otro_pais" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Nombre del país <span class="font-bold text-red-800">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="otro_pais"
                                    name="otro_pais"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el nombre del país"
                                >
                            </div>

                            <!-- Departamento -->
                            <div id="contenedor_departamento">
                                <label for="departamento" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Departamento <span class="font-bold text-red-800">*</span>
                                </label>

                                <select
                                    id="departamento"
                                    name="departamento_id"
                                    class="campo-identificado block w-full text-sm text-black border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                >

                                    <option value="">Seleccione un departamento</option>

                                    @foreach($departamentos as $departamento)

                                        <option value="{{ $departamento->id }}">

                                            {{ $departamento->nombre }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>

                            <!-- Municipio -->
                            <div id="contenedor_municipio">
                                <label for="municipio" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Municipio <span class="font-bold text-red-800">*</span>
                                </label>

                                <select
                                    id="municipio"
                                    name="municipio_id"
                                    class="campo-identificado block w-full text-sm text-black border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 px-2 py-4 select2-field"
                                >
                                    <option value="">Seleccione un municipio</option>
                                </select>
                            </div>

                            <!-- direccion -->
                            <div>
                                <label for="direccion" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Dirección <span class="font-bold text-red-800">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="direccion"
                                    name="direccion"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese la dirección"
                                >
                            </div>

                            <!-- telefono fijo -->
                            <div>
                                <label for="fijo" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Teléfono Fijo <span class="font-bold text-red-800">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="fijo"
                                    name="fijo"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el teléfono fijo"
                                >
                            </div>

                            <!-- telefono movil -->
                            <div>
                                <label for="movil" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Teléfono Móvil <span class="font-bold text-red-800">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="movil"
                                    name="movil"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el teléfono móvil"
                                >
                            </div>

                        </div>
                    </div>
                
                    <!-- Datos PQRSF -->
                    <div class="bg-white border border-gray-300 rounded-xl p-5">
                        <h2 class="block font-semibold text-gray-800 mb-2 border-b-2 border-gray-300 pb-2">
                            Datos PQRSF
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <!-- Pregunta -->
                            <div>
                                <label for="tipo_pqrsf" class="block text-sm font-semibold text-gray-800 mb-3">
                                    Tipo de PQRSF <span class="font-bold text-red-800">*</span>
                                </label>
                                <select
                                    id="tipo_pqrsf"
                                    name="tipo_pqrsf"
                                    class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                    required
                                >
                                    <option value="">Seleccione una opción</option>
                                    <optgroup label="Notificaciones">
                                        <option value="Fallos">Fallos</option>
                                        <option value="Avisos">Avisos</option>
                                        <option value="Sentencias">Sentencias</option>
                                        <option value="PDA">PDA</option>
                                        <option value="Edictos">Edictos</option>
                                    </optgroup>

                                    <optgroup label="Peticiones">
                                        <option value="Solicitud disponibilidad de servicios">Solicitud disponibilidad de servicios</option>
                                        <option value="Denuncia">Denuncia</option>
                                        <option value="Solicitud de permiso laboral">Solicitud de permiso laboral</option>
                                        <option value="Derechos de petición">Derechos de petición</option>
                                        <option value="Memorandos">Memorandos</option>
                                        <option value="Cobros">Cobros</option>
                                        <option value="Solicitud de certificado">Solicitud de certificado</option>
                                        <option value="Acciones populares">Acciones populares</option>
                                        <option value="Acciones de tutelas">Acciones de tutelas</option>
                                        <option value="Solicitud certificado laboral">Solicitud certificado laboral</option>
                                        <option value="Solicitud visita técnica">Solicitud visita técnica</option>
                                    </optgroup>

                                    <optgroup label="Quejas">
                                        <option value="Prestación de servicios">Prestación de servicios</option>
                                        <option value="Daños causados por obras">Daños causados por obras</option>
                                    </optgroup>

                                    <optgroup label="Reclamos">
                                        <option value="Facturación">Facturación</option>
                                        <option value="Solicitud de información">Solicitud de información</option>
                                    </optgroup>

                                    <optgroup label="Sugerencias">
                                        <option value="Citaciones - Invitaciones">Citaciones - Invitaciones</option>
                                        <option value="Propuesta">Propuesta</option>
                                    </optgroup>
                                </select>
                            </div>

                            <!-- Tipo de respuesta -->
                            <div>
                                <label for="tipo_respuesta" class="block text-sm font-semibold text-gray-800 mb-3">
                                    ¿Por cuál canal prefiere recibir la respuesta? <span class="font-bold text-red-800">*</span>
                                </label>
                                <select
                                    id="tipo_respuesta"
                                    name="tipo_respuesta"
                                    class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                    onchange="toggleFormulario()"
                                    required
                                >
                                    <option value="">Seleccione una opción</option>
                                    <option value="Cartelera Virtual">Cartelera Virtual</option>
                                    <option value="Correo Electrónico">Correo electrónico</option>
                                    <option value="Físico / Mensajería">Físico / Mensajería</option>
                                </select>
                            </div>

                            <!-- Seccion anonima - correo electronico -->
                            <div id="correo_mensajeria_container" class="hidden">
                                <label for="correo_electronico_mensajeria" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Correo Electrónico <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="correo_electronico_mensajeria"
                                    name="correo_electronico"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el correo electrónico"
                                    disabled
                                >
                            </div>

                            <!-- dirección mensajeria -->
                            <div id="direccion_mensajeria_container" class="hidden">
                                <label for="direccion_mensajeria" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Dirección de Mensajería <span class="font-bold text-red-800">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="direccion_mensajeria"
                                    name="direccion_mensajeria"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="EJ: Calle 1 # 1-1, Barrio Centro, Neiva, Huila"
                                    required
                                >
                            </div>

                            <!-- asunto -->
                            <div>
                                <label for="asunto" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Asunto <span class="font-bold text-red-800">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="asunto"
                                    name="asunto"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el asunto"
                                    required
                                >
                            </div>

                            <!-- descripcion -->
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <label for="descripcion" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Descripción <span class="font-bold text-red-800">*</span>
                                </label>

                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese la descripción"
                                    rows="4"
                                    required
                                ></textarea>
                            </div>

                            <!-- Documentos adjuntos (opcional) -->
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">

                                <label for="documentos" class="mb-2 block text-sm font-medium text-gray-700">Documentos adjuntos <span class="font-normal text-gray-400">(Opcional)</span></label>

                                <div class="rounded-lg border-2 border-dashed border-gray-300 p-6 text-center transition hover:border-green-500">

                                    <input type="file" name="documentos[]" id="documentos" multiple accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="hidden">

                                    <label for="documentos" class="block cursor-pointer">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3 text-gray-400"> <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/> <polyline points="17 8 12 3 7 8"/> <line x1="12" x2="12" y1="3" y2="15"/></svg>

                                        <p class="text-sm font-medium text-gray-700">Seleccionar documentos</p>

                                        <p class="mt-1 text-xs text-gray-500">Puedes adjuntar hasta 5 archivos.</p>

                                        <p class="mt-1 text-xs text-gray-400">PDF, imágenes, Word, Excel, o PowerPoint.</p>

                                        <p class="mt-1 text-xs text-gray-400">Tamaño máximo: 10 MB por archivo.</p>

                                    </label>
                                </div>

                                <!-- Mensajes de validación -->
                                <div id="errorDocumentos" class="mt-2 hidden rounded-lg bg-red-50 p-3 text-sm text-red-700" role="alert"></div>

                                <!-- Archivos seleccionados -->
                                <div id="listaDocumentos" class="mt-3 space-y-2"></div>

                                @error('documentos')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                @error('documentos.*')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>

                        </div>
                    </div>
                
                    <!-- Tratamiento de datos -->
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                        <div class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                id="autoriza"
                                name="autoriza"
                                value="1"
                                required
                                class="mt-1 rounded border-gray-300 text-[#0047DC] focus:ring-[#0047DC]"
                            >
                            <label for="autoriza" class="text-sm text-gray-700 leading-relaxed">
                                Autorizo el tratamiento de mis datos personales de conformidad con la normativa vigente sobre protección de datos personales.
                            </label>
                        </div>
                    </div>
                
                    <button type="submit"
                        class="cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 font-medium text-white hover:opacity-90">
                        Enviar información
                    </button>
                </form>
            </div>

        </section>

        @if(session('mostrarModal'))

        <div 
            id="modalBusqueda" 
            class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
            
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden relative flex flex-col max-h-[90vh]">
                
                <!-- Header -->
                <div class="bg-[#0047DC] p-5 text-white flex justify-between items-center shrink-0">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="m9 15 2 2 4-4"/></svg>
                        Consulta de Radicado
                    </h2>
                    <button id="cerrarModalIcon" class="text-white/80 hover:text-white transition cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 overflow-y-auto">
                    @php
                        $pqrs = session('resultadoBusqueda');
                    @endphp

                    @if($pqrs)
                        <!-- Estado Principal -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Número de Radicado</p>
                                <p class="text-2xl font-black text-gray-800">{{ $pqrs->codigo_radicado }}</p>
                            </div>
                            <div class="mt-3 sm:mt-0">
                                <span class="px-4 py-1.5 rounded-full text-sm font-bold shadow-sm inline-block
                                    {{ $pqrs->estado == 'Respondida' ? 'bg-green-100 text-green-800 border border-green-200' : 
                                    ($pqrs->estado == 'Cancelada' ? 'bg-red-100 text-red-800 border border-red-200' : 
                                    ($pqrs->estado == 'Asignada' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-amber-100 text-amber-800 border border-amber-200')) }}">
                                    {{ strtoupper($pqrs->estado) }}
                                </span>
                            </div>
                        </div>

                        <!-- Detalles de la Solicitud -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-3 border-b pb-2">Información de la Solicitud</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase">Tipo de Solicitud</p>
                                        <p class="text-sm text-gray-800 font-semibold mt-1">{{ $pqrs->tipo_pqrsf ?? 'No especificado' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase">Asunto</p>
                                        <p class="text-sm text-gray-800 font-semibold mt-1">{{ $pqrs->asunto }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase">Fecha de Radicación</p>
                                        <p class="text-sm text-gray-800 mt-1 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                            {{ $pqrs->created_at->format('d/m/Y h:i A') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-medium uppercase">Última Actualización</p>
                                        <p class="text-sm text-gray-800 mt-1 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 21v-5h5"/></svg>
                                            {{ $pqrs->updated_at->format('d/m/Y h:i A') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Trazabilidad / Estado actual -->
                            <div>
                                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-3 border-b pb-2">Gestión del Trámite</h3>
                                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                                    @if($pqrs->estado == 'Respondida')
                                        <p class="text-sm text-gray-700">
                                            <strong class="text-green-700">Trámite Finalizado.</strong> Esta solicitud ya cuenta con una respuesta formal emitida el {{ \Carbon\Carbon::parse($pqrs->fecha_respuesta)->format('d/m/Y') }}. Por favor revise el correo electrónico proporcionado o el medio físico seleccionado.
                                        </p>
                                    @elseif($pqrs->estado == 'Cancelada')
                                        <div class="flex flex-col gap-2">
                                            <p class="text-sm text-gray-700"><strong class="text-red-700">Trámite Cancelado.</strong></p>
                                            <p class="text-sm text-gray-600"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($pqrs->fecha_cancelacion)->format('d/m/Y h:i A') }}</p>
                                            <p class="text-sm text-gray-600"><strong>Motivo:</strong> {{ $pqrs->motivo_cancelacion }}</p>
                                        </div>
                                    @else
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div>
                                                <p class="text-xs text-gray-500">Área Responsable Actual:</p>
                                                <p class="text-sm font-semibold text-blue-800">{{ $pqrs->area->nombre ?? 'En validación central' }}</p>
                                            </div>
                                            @if($pqrs->fecha_limite_respuesta)
                                                <div>
                                                    <p class="text-xs text-gray-500">Fecha Límite Estimada:</p>
                                                    <p class="text-sm font-semibold text-gray-800">{{ \Carbon\Carbon::parse($pqrs->fecha_limite_respuesta)->format('d/m/Y') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @else
                        <!-- Estado No Encontrado -->
                        <div class="flex flex-col items-center justify-center text-center py-8">
                            <div class="bg-red-100 text-red-600 p-4 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
                            </div>
                            <h3 class="font-bold text-xl text-gray-800 mb-2">Código no encontrado</h3>
                            <p class="text-gray-500 max-w-sm">
                                No existe ninguna PQRSDF registrada con el código ingresado. Verifique el número de radicado e intente nuevamente.
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="border-t bg-gray-50 p-5 flex justify-end shrink-0">
                    <button 
                        id="cerrarModalBtn" 
                        class="cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-gray-800 px-6 py-2.5 font-semibold text-white hover:bg-gray-700 transition-colors shadow-sm">
                        Cerrar Consulta
                    </button>
                </div>
            </div>
        </div>

        @endif

        <!-- Opciones de discapacidad -->
        <script>
            function toggleTipoDiscapacidad() {
                const discapacidad = document.getElementById('discapacidad').value;
                const container = document.getElementById('tipo_discapacidad_container');
                const select = document.getElementById('tipo_discapacidad');

                if (discapacidad === '1') {
                    container.classList.remove('hidden');

                    select.disabled = false;
                    select.required = true;

                    toggleOtraDiscapacidad();

                } else {
                    container.classList.add('hidden');

                    select.disabled = true;
                    select.required = false;
                    select.value = '';

                    // Ocultar y limpiar "Otra discapacidad"
                    toggleOtraDiscapacidad();
                }
            }

            function toggleOtraDiscapacidad() {
                const tipo = document.getElementById('tipo_discapacidad').value;
                const container = document.getElementById('otra_discapacidad_container');
                const input = document.getElementById('otra_discapacidad');

                if (tipo === 'otra') {
                    container.classList.remove('hidden');

                    input.disabled = false;
                    input.required = true;

                } else {
                    container.classList.add('hidden');

                    input.disabled = true;
                    input.required = false;
                    input.value = '';
                }
            }
        </script>

        <!-- Opciones de Anonimo -->
        <script>

            function toggleFormulario() {
                const esIdentificado = document.getElementById('identificado').checked;

                const selectTipoRespuesta = document.getElementById('tipo_respuesta');

                // Forzar Cartelera Virtual cuando el usuario sea anónimo
                if (!esIdentificado) {
                    selectTipoRespuesta.value = 'Cartelera Virtual';
                    selectTipoRespuesta.disabled = true;
                } else {
                    selectTipoRespuesta.disabled = false;
                }

                const tipoRespuesta = selectTipoRespuesta.value;

                // Elementos
                const containerCorreoPrincipal = document.getElementById('correo_principal_container');
                const inputCorreoPrincipal = document.getElementById('correo_electronico');

                const containerCorreoMensajeria = document.getElementById('correo_mensajeria_container');
                const inputCorreoMensajeria = document.getElementById('correo_electronico_mensajeria');

                const containerDireccion = document.getElementById('direccion_mensajeria_container');
                const inputDireccion = document.getElementById('direccion_mensajeria');

                // 1. Manejo de Identificado vs Anónimo
                if (esIdentificado) {
                    containerCorreoPrincipal.classList.remove('hidden');
                    inputCorreoPrincipal.required = true;
                    inputCorreoPrincipal.disabled = false; // Habilitamos para envío
                } else {
                    containerCorreoPrincipal.classList.add('hidden');
                    inputCorreoPrincipal.required = false;
                    inputCorreoPrincipal.disabled = true; // Deshabilitamos para que no se envíe
                    inputCorreoPrincipal.value = ''; 
                }

                // 2. Manejo del Canal de Respuesta
                if (tipoRespuesta === 'Físico / Mensajería') {
                    // Mostrar dirección
                    if(containerDireccion && inputDireccion) {
                        containerDireccion.classList.remove('hidden');
                        inputDireccion.required = true;
                        inputDireccion.disabled = false;
                    }

                    // Ocultar correo secundario
                    containerCorreoMensajeria.classList.add('hidden');
                    inputCorreoMensajeria.required = false;
                    inputCorreoMensajeria.disabled = true;

                } else if (tipoRespuesta === 'Correo Electrónico') {
                    // Ocultar dirección
                    if(containerDireccion && inputDireccion) {
                        containerDireccion.classList.add('hidden');
                        inputDireccion.required = false;
                        inputDireccion.disabled = true;
                    }

                    // Mostrar correo secundario SOLO si el usuario es ANÓNIMO
                    if (!esIdentificado) {
                        containerCorreoMensajeria.classList.remove('hidden');
                        inputCorreoMensajeria.required = true;
                        inputCorreoMensajeria.disabled = false; // Habilitamos para envío
                    } else {
                        containerCorreoMensajeria.classList.add('hidden');
                        inputCorreoMensajeria.required = false;
                        inputCorreoMensajeria.disabled = true;
                    }

                } else {
                    // Sin selección de canal
                    if(containerDireccion && inputDireccion) {
                        containerDireccion.classList.add('hidden');
                        inputDireccion.required = false;
                        inputDireccion.disabled = true;
                    }

                    containerCorreoMensajeria.classList.add('hidden');
                    inputCorreoMensajeria.required = false;
                    inputCorreoMensajeria.disabled = true;
                }
            }

            // Ejecutar al cargar la página por si hay valores guardados
            document.addEventListener('DOMContentLoaded', toggleFormulario);
        </script>

        <!-- Opciones de identificación -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const radioIdentificado = document.getElementById('identificado');
                const radioAnonimo = document.getElementById('anonimo');

                const bloque = document.getElementById('datos-identificado');
                const infocartelera = document.getElementById('info-cartelera');

                const campos = bloque.querySelectorAll(
                    'input, select, textarea'
                );

                function actualizarFormulario() {

                    if (radioIdentificado.checked) {

                        bloque.classList.remove('hidden');
                        infocartelera.classList.add('hidden');

                        // Solo son obligatorios los campos visibles (un campo oculto obligatorio bloquea el envío)
                        campos.forEach(campo => {
                            campo.required = !campo.closest('.hidden');
                        });

                    } else {

                        bloque.classList.add('hidden');
                        infocartelera.classList.remove('hidden');

                        campos.forEach(campo => {
                            campo.required = false;
                            campo.value = '';
                        });

                    }

                }

                radioIdentificado.addEventListener('change', actualizarFormulario);
                radioAnonimo.addEventListener('change', actualizarFormulario);

                actualizarFormulario();

            });
            </script>

            <!-- Opciones de persona -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {

                const tipoSolicitante = document.getElementById('tipo_solicitante');
                const tipoIdentificacion = document.getElementById('tipo_identificacion');

                const razonSocial = document.getElementById('razon_social');
                const nombreUsuario = document.getElementById('nombre_usuario');
                const apellidoUsuario = document.getElementById('apellido_usuario');

                function actualizarTipoSolicitante() {

                    const esJuridica = tipoSolicitante.value === 'Persona Jurídica';

                    // Limpiar opciones
                    tipoIdentificacion.innerHTML = '';

                    if (esJuridica) {

                        tipoIdentificacion.innerHTML = `
                            <option value="">Seleccione una opción</option>
                            <option value="numero_identificacion_tributaria">
                                Número de identificación tributaria (NIT)
                            </option>
                        `;

                        razonSocial.classList.remove('hidden');
                        nombreUsuario.classList.add('hidden');
                        apellidoUsuario.classList.add('hidden');

                        razonSocial.querySelector('input').required = true;
                        nombreUsuario.querySelector('input').required = false;
                        apellidoUsuario.querySelector('input').required = false;

                        nombreUsuario.querySelector('input').value = '';
                        apellidoUsuario.querySelector('input').value = '';

                    } else {

                        tipoIdentificacion.innerHTML = `
                            <option value="">Seleccione una opción</option>
                            <option value="adulto">Adulto sin identificación</option>
                            <option value="carne">Carné diplomático</option>
                            <option value="cedula">Cédula de ciudadanía</option>
                            <option value="extrangeria">Cédula de extranjería</option>
                            <option value="nui">Número único de identificación</option>
                            <option value="pasaporte">Pasaporte</option>
                            <option value="tarjeta_identidad">Tarjeta de identidad</option>
                            <option value="tarjeta_profesional">Tarjeta profesional</option>
                        `;

                        razonSocial.classList.add('hidden');
                        nombreUsuario.classList.remove('hidden');
                        apellidoUsuario.classList.remove('hidden');

                        razonSocial.querySelector('input').required = false;
                        nombreUsuario.querySelector('input').required = true;
                        apellidoUsuario.querySelector('input').required = true;

                        razonSocial.querySelector('input').value = '';
                    }

                    tipoIdentificacion.selectedIndex = 0;
                }

                tipoSolicitante.addEventListener('change', actualizarTipoSolicitante);

                actualizarTipoSolicitante();

            });
            </script>

            <!-- Opciones de pais -->
            <script>
                const pais = document.getElementById('pais');

                const contenedorOtroPais = document.getElementById('contenedor_otro_pais');
                const contenedorDepartamento = document.getElementById('contenedor_departamento');
                const contenedorMunicipio = document.getElementById('contenedor_municipio');

                const otroPais = document.getElementById('otro_pais');
                const departamento = document.getElementById('departamento');
                const municipio = document.getElementById('municipio');

                function actualizarPais() {

                    if (pais.value === 'otro') {

                        contenedorOtroPais.classList.remove('hidden');

                        contenedorDepartamento.classList.add('hidden');
                        contenedorMunicipio.classList.add('hidden');

                        otroPais.required = true;
                        departamento.required = false;
                        municipio.required = false;

                        departamento.value = '';
                        municipio.value = '';

                    } else {

                        contenedorOtroPais.classList.add('hidden');

                        contenedorDepartamento.classList.remove('hidden');
                        contenedorMunicipio.classList.remove('hidden');

                        otroPais.required = false;
                        departamento.required = true;
                        municipio.required = true;

                        otroPais.value = '';
                    }
                }

                pais.addEventListener('change', actualizarPais);

                // Ejecutar al cargar la página
                actualizarPais();

                departamento.addEventListener('change', function () {

                    municipio.innerHTML =
                        '<option value="">Cargando municipios...</option>';

                    if (!this.value) {

                        municipio.innerHTML =
                            '<option value="">Seleccione un municipio</option>';

                        return;
                    }

                    fetch(`/municipios/${this.value}`)

                        .then(response => response.json())

                        .then(data => {

                            municipio.innerHTML =
                                '<option value="">Seleccione un municipio</option>';

                            data.forEach(item => {

                                municipio.innerHTML += `
                                    <option value="${item.id}">
                                        ${item.nombre}
                                    </option>
                                `;

                            });

                        })

                        .catch(error => {

                            console.error(error);

                            municipio.innerHTML =
                                '<option value="">Error al cargar municipios</option>';

                        });

                });
            </script>

            <!-- modal de busqueda -->
            <script>
                // Lógica para cerrar el modal usando ambos botones (icono y botón inferior)
                document.getElementById('cerrarModalIcon').addEventListener('click', function() {
                    document.getElementById('modalBusqueda').style.display = 'none';
                });
                document.getElementById('cerrarModalBtn').addEventListener('click', function() {
                    document.getElementById('modalBusqueda').style.display = 'none';
                });
            </script>

            <!-- SweetAlert2 para mostrar mensajes de éxito o error -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {

                    @if (session('success'))

                        const codigoRadicado = @json(session('codigo_radicado'));
                        const esAnonima = @json(
                            session('identificado_anonimo') === 'anonimo'
                        );

                        let mensaje = `
                            <p class="text-gray-700 mb-4">
                                Su PQRSDF ha sido radicada correctamente.
                            </p>

                            <div class="rounded-xl border border-blue-200 bg-blue-50 p-4 mb-4">
                                <p class="text-sm text-gray-600 mb-2">
                                    Su código único de seguimiento es:
                                </p>

                                <p class="text-2xl font-bold text-blue-700 tracking-wide">
                                    ${codigoRadicado}
                                </p>

                                <p class="text-sm text-gray-600 mt-2">
                                    Por favor, guarde este número para consultar
                                    el estado de su solicitud.
                                </p>
                            </div>
                        `;

                        if (esAnonima) {
                            mensaje += `
                                <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-left">
                                    <p class="font-semibold text-amber-800 mb-2">
                                        Importante:
                                    </p>

                                    <p class="text-sm text-amber-900">
                                        La respuesta a su petición se emitirá dentro de los tiempos legales según el tipo de solicitud. Una vez emitida, será publicada en nuestra <a href="{{ route('carteleravirtual') }}" class="text-blue-600 hover:text-blue-700 underline">Cartelera Virtual</a>
                                        donde estará visible al público por 5 días hábiles. Transcurrido este tiempo, el documento desaparecerá de la vista pública, pero usted podrá seguir consultando y descargando su respuesta en cualquier momento ingresando su código de seguimiento en nuestro buscador.
                                    </p>
                                </div>
                            `;
                        }

                        Swal.fire({
                            icon: 'success',
                            title: '¡Radicación exitosa!',
                            html: mensaje,
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: '#2563eb',
                            allowOutsideClick: false,
                            allowEscapeKey: true,
                            position: 'center-center',
                            showClass: {
                                popup: `
                                animate__animated
                                animate__fadeInUp
                                animate__faster
                                `
                            },
                            hideClass: {
                                popup: `
                                animate__animated
                                animate__fadeOutDown
                                animate__faster
                                `
                            }
                        });

                    @elseif (session('error'))

                        Swal.fire({
                            icon: 'error',
                            title: 'No fue posible radicar la solicitud',
                            text: @json(session('error')),
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: '#dc2626',
                            position: 'center-center',
                            showClass: {
                                popup: `
                                animate__animated
                                animate__fadeInUp
                                animate__faster
                                `
                            },
                            hideClass: {
                                popup: `
                                animate__animated
                                animate__fadeOutDown
                                animate__faster
                                `
                            }
                        });

                    @endif

                });
            </script>

            <!-- ==================== -->
            <!-- Seleccionar archivos -->
            <!-- ==================== -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {

                    const inputDocumentos = document.getElementById('documentos');
                    const listaDocumentos = document.getElementById('listaDocumentos');
                    const errorDocumentos = document.getElementById('errorDocumentos');

                    if (!inputDocumentos || !listaDocumentos || !errorDocumentos) {
                        return;
                    }

                    const MAX_ARCHIVOS = 5;
                    const MAX_TAMANO = 10 * 1024 * 1024; // 10 MB en bytes

                    const EXTENSIONES_PERMITIDAS = [
                        'pdf',
                        'jpg', 'jpeg', 'png', 'gif', 'webp',
                        'doc', 'docx',
                        'xls', 'xlsx',
                        'ppt', 'pptx'
                    ];

                    let archivosSeleccionados = new DataTransfer();

                    function mostrarError(mensaje) {
                        errorDocumentos.textContent = mensaje;
                        errorDocumentos.classList.remove('hidden');
                    }

                    function limpiarError() {
                        errorDocumentos.textContent = '';
                        errorDocumentos.classList.add('hidden');
                    }

                    function obtenerExtension(nombre) {
                        const posicion = nombre.lastIndexOf('.');

                        return posicion >= 0
                            ? nombre.substring(posicion + 1).toLowerCase()
                            : '';
                    }

                    function obtenerClave(archivo) {
                        return [
                            archivo.name,
                            archivo.size,
                            archivo.lastModified
                        ].join('|');
                    }

                    // Seleccionar archivos
                    inputDocumentos.addEventListener('change', function () {

                        limpiarError();

                        const nuevosArchivos = Array.from(this.files);
                        const clavesExistentes = new Set(
                            Array.from(archivosSeleccionados.files).map(obtenerClave)
                        );

                        const errores = [];

                        for (const archivo of nuevosArchivos) {

                            const extension = obtenerExtension(archivo.name);
                            const clave = obtenerClave(archivo);

                            // Evitar duplicados
                            if (clavesExistentes.has(clave)) {
                                continue;
                            }

                            // Validar extensión
                            if (!EXTENSIONES_PERMITIDAS.includes(extension)) {
                                errores.push(
                                    `${archivo.name}: formato no permitido.`
                                );
                                continue;
                            }

                            // Validar tamaño individual
                            if (archivo.size > MAX_TAMANO) {
                                errores.push(
                                    `${archivo.name}: supera el límite de 10 MB.`
                                );
                                continue;
                            }

                            // Validar cantidad máxima
                            if (archivosSeleccionados.files.length >= MAX_ARCHIVOS) {
                                errores.push(
                                    `Solo puedes adjuntar un máximo de ${MAX_ARCHIVOS} archivos.`
                                );
                                break;
                            }

                            archivosSeleccionados.items.add(archivo);
                            clavesExistentes.add(clave);
                        }

                        // Actualizar los archivos del formulario
                        inputDocumentos.files = archivosSeleccionados.files;

                        // Mostrar errores, si los hay
                        if (errores.length > 0) {
                            mostrarError(errores.join(' '));
                        }

                        mostrarDocumentos();
                    });

                    // Mostrar los archivos seleccionados
                    function mostrarDocumentos() {

                        listaDocumentos.replaceChildren();

                        Array.from(archivosSeleccionados.files).forEach(
                            function (archivo, index) {

                                const elemento = document.createElement('div');

                                elemento.className =
                                    'flex items-center justify-between gap-3 rounded-lg ' +
                                    'border border-gray-200 bg-gray-50 px-4 py-3';

                                const informacion = document.createElement('div');
                                informacion.className = 'min-w-0';

                                const nombre = document.createElement('p');
                                nombre.className =
                                    'truncate text-sm font-medium text-gray-700';
                                nombre.textContent = archivo.name;

                                const tamano = document.createElement('p');
                                tamano.className = 'text-xs text-gray-400';
                                tamano.textContent = formatearTamano(archivo.size);

                                informacion.append(nombre, tamano);

                                const boton = document.createElement('button');
                                boton.type = 'button';
                                boton.className =
                                    'shrink-0 rounded-lg px-3 py-2 text-sm text-red-600 ' +
                                    'hover:bg-red-100 hover:text-red-700 cursor-pointer';

                                boton.textContent = 'Eliminar';
                                boton.title = 'Eliminar ' + archivo.name;
                                boton.setAttribute(
                                    'aria-label',
                                    'Eliminar archivo ' + archivo.name
                                );

                                boton.addEventListener('click', function () {
                                    eliminarDocumento(index);
                                });

                                elemento.append(informacion, boton);
                                listaDocumentos.appendChild(elemento);
                            }
                        );
                    }

                    // Eliminar un archivo seleccionado
                    function eliminarDocumento(index) {

                        const nuevaLista = new DataTransfer();

                        Array.from(archivosSeleccionados.files).forEach(
                            function (archivo, i) {
                                if (i !== index) {
                                    nuevaLista.items.add(archivo);
                                }
                            }
                        );

                        archivosSeleccionados = nuevaLista;
                        inputDocumentos.files = archivosSeleccionados.files;

                        limpiarError();
                        mostrarDocumentos();
                    }

                    // Formatear tamaño legible
                    function formatearTamano(bytes) {

                        if (bytes === 0) {
                            return '0 Bytes';
                        }

                        const unidades = ['Bytes', 'KB', 'MB', 'GB'];

                        const indice = Math.floor(
                            Math.log(bytes) / Math.log(1024)
                        );

                        return (
                            (bytes / Math.pow(1024, indice)).toFixed(2) +
                            ' ' +
                            unidades[indice]
                        );
                    }

                });
                </script>


        @include('partials.footer')

    </body>
</html>
