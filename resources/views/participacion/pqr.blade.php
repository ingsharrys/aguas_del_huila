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
                <p class="text-lg">Inicio / Participa <span class="font-bold"> / PQRSDF</span></p>
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
                            
                            <button
                                type="submit"
                                class="cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 font-medium text-white hover:opacity-90"
                            >
                                Buscar PQRSDF
                            </button>
                        </form>
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <h2 class="text-2xl font-bold text-[#0047DC]">Radicación</h2>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Apreciado Usuario:</span> Para nosotros es muy importante contar con usted. A través de esta herramienta usted podrá registrar sus solicitudes, quejas, reclamos y/o sugerencias sobre temas de nuestra competencia y de igual forma, consultar información relacionada con nuestra gestión institucional.</p>
                        <p class="mt-2 text-gray-600">Asimismo, en aras de garantizar y brindarle un mejor servicio y teniendo en cuenta el derecho al que todas las personas tienen de presentar peticiones, quejas, reclamos, sugerencias, etc, de manera respetuosa a las autoridades por motivos de interés general o particular y a obtener pronta respuesta, consideramos pertinente definir algunos conceptos de interés, que los ayudaran a orientarlos de acuerdo a lo que requiere presentar ante nuestra entidad.</p>
                        <p class="mt-2 text-gray-600"><span class="font-bold">Tenga en cuenta:</span></p>
                        <ul class="mt-2 text-gray-600">
                            <li>Usted puede radicar sus solicitudes, Derechos de Petición, Quejas, Reclamos, etc., ya sea de forma ANÓNIMA y/o identificarse.</li>
                            <li>Los documentos radicados deben ser de competencia de la Gobernación del Huila.</li>
                            <li>Éste servicio no tiene costo.</li>
                            <li>Al radicar su solicitud se le asigna Código Único de Seguimiento, para consultar el estado de su solicitud, ingrese éste código en el buscador.</li>
                        </ul>
                        <p class="mt-2 text-gray-600"><span class="font-bold">En caso de ser requerido consulte la normativa aplicable:</span></p>
                        <ul class="mt-2 text-gray-600">
                            <li>Decreto 19 de 2012 "Por el cual se dictan normas para suprimir o reformar regulaciones, procedimientos y trámites innecesarios existentes en la Administración Pública".</li>
                            <li>Ley 962 de 2005 "Por la cual se dictan disposiciones sobre racionalización de trámites y procedimientos administrativos de los organismos y entidades del Estado y de los particulares que ejercen funciones públicas o prestan servicios públicos".</li>
                        </ul>
                        <p class="mt-2 text-gray-600"><span class="font-bold">AL ENVIAR ESTE FORMULARIO ESTA ACEPTANDO LA POLITICA DE TRATAMIENTO DE DATOS PERSONALES CONTENIDA EN EL SIGUIENTE LINK: </span> <a href="https://aguasdelhuila.gov.co/archivos/documentos/politicas/politica-de-privacidad-y-tratamiento-de-datos-personales-2026" target="_blank" class="text-[#0047DC] hover:text-blue-700 underline">Política de privacidad y tratamiento de datos personales - 2026</a></p>
                    </div>
                </div>

                @if(session('success'))
                    <div
                        class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800"
                        role="alert"
                    >
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check"><circle cx="12" cy="12" r="10"/><path d="m16 9-5.5 5.5L8 12"/></svg>

                            <span class="font-semibold">
                                {{ session('success') }}
                            </span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800"
                        role="alert"
                    >
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>

                            <span class="font-semibold">
                                {{ session('error') }}
                            </span>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div
                        id="errores-formulario"
                        class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800"
                        role="alert"
                    >
                        <p class="font-semibold mb-2">No se pudo radicar la solicitud. Revise lo siguiente:</p>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach($errors->all() as $mensaje)
                                <li>{{ $mensaje }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pqr.store') }}"
                      id="form-pqrsdf"
                      method="POST"
                      class="space-y-6">

                      @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                        <!-- Pregunta 1 -->
                        <div>
                            <label for="discapacidad" class="block text-sm font-semibold text-gray-800 mb-3">
                                1. ¿Se reconoce como persona en condición de discapacidad?
                            </label>
                            <select
                                id="discapacidad"
                                name="discapacidad"
                                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4"
                                onchange="toggleTipoDiscapacidad()"
                                required
                            >
                                <option value="">Seleccione una opción</option>
                                <option value="1" @selected(old('discapacidad') == '1')>Sí</option>
                                <option value="0" @selected(old('discapacidad') == '0')>No</option>
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
                                <option value="visual" @selected(old('tipo_discapacidad') == 'visual')>Visual</option>
                                <option value="auditiva" @selected(old('tipo_discapacidad') == 'auditiva')>Auditiva</option>
                                <option value="fisica_motora" @selected(old('tipo_discapacidad') == 'fisica_motora')>Física o motora</option>
                                <option value="cognitiva" @selected(old('tipo_discapacidad') == 'cognitiva')>Cognitiva</option>
                                <option value="otra" @selected(old('tipo_discapacidad') == 'otra')>Otra</option>
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
                                    value="{{ old('otra_discapacidad') }}"
                                disabled
                                class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                placeholder="Ingrese el tipo de discapacidad"
                            >
                        </div>
                    
                        <!-- Identificado/anonimo -->
                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                ¿Desea ser identificado o anónimo?
                            </label>

                            <div class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900">
                                <input type="radio" id="identificado" name="identificado_anonimo" value="identificado" @checked(old('identificado_anonimo', 'identificado') === 'identificado') onchange="toggleFormulario()"/>
                                <label for="identificado">Identificado</label>
                                <input type="radio" id="anonimo" name="identificado_anonimo" value="anonimo" @checked(old('identificado_anonimo') === 'anonimo') onchange="toggleFormulario()"/>
                                <label for="anonimo">Anónimo</label>
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
                                    <option value="Persona Natural" @selected(old('tipo_solicitante') == 'Persona Natural')>Persona Natural</option>
                                    <option value="Persona Jurídica" @selected(old('tipo_solicitante') == 'Persona Jurídica')>Persona Jurídica</option>
                                    <option value="Niños, Niñas y Adolescentes" @selected(old('tipo_solicitante') == 'Niños, Niñas y Adolescentes')>Niños, Niñas y Adolescentes</option>
                                    <option value="Apoderado" @selected(old('tipo_solicitante') == 'Apoderado')>Apoderado</option>
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
                                    <option value="Adulto sin identificación" @selected(old('tipo_identificacion') == 'Adulto sin identificación')>Adulto sin identificación</option>
                                    <option value="Carné diplomatico" @selected(old('tipo_identificacion') == 'Carné diplomatico')>Carné diplomatico</option>
                                    <option value="Cédula de ciudadanía" @selected(old('tipo_identificacion') == 'Cédula de ciudadanía')>Cédula de ciudadanía</option>
                                    <option value="Cédula de extrangería" @selected(old('tipo_identificacion') == 'Cédula de extrangería')>Cédula de extrangería</option>
                                    <option value="NUI" @selected(old('tipo_identificacion') == 'NUI')>Número único de identificación</option>
                                    <option value="Pasaporte" @selected(old('tipo_identificacion') == 'Pasaporte')>Pasaporte</option>
                                    <option value="Tarjeta de identidad" @selected(old('tipo_identificacion') == 'Tarjeta de identidad')>Tarjeta de identidad</option>
                                    <option value="Tarjeta profesional" @selected(old('tipo_identificacion') == 'Tarjeta profesional')>Tarjeta profesional</option>
                                    <option value="Número de identificación tributaría" @selected(old('tipo_identificacion') == 'Número de identificación tributaría')>Número de identificación tributaría</option>
                                </select>
                            </div>

                            <!-- numero de identificación / nit -->
                            <div id="numero_identificacion_container">
                                <label for="numero_identificacion" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Número de identificación / NIT <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="numero_identificacion"
                                    name="numero_identificacion"
                                    value="{{ old('numero_identificacion') }}"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el número de identificación / NIT"
                                >
                            </div>

                            <!-- razon social -->
                            <div id="razon_social_container">
                                <label for="razon_social" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Razón Social <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="razon_social"
                                    name="razon_social"
                                    value="{{ old('razon_social') }}"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese la razón social"
                                >
                            </div>

                            <!-- nombre usuario -->
                            <div id="nombre_usuario_container">
                                <label for="nombre_usuario" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Nombre Usuario <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="nombre_usuario"
                                    name="nombre_usuario"
                                    value="{{ old('nombre_usuario') }}"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el nombre del usuario"
                                >
                            </div>

                            <!-- apellido usuario -->
                            <div id="apellido_usuario_container">
                                <label for="apellido_usuario" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Apellido Usuario <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="apellido_usuario"
                                    name="apellido_usuario"
                                    value="{{ old('apellido_usuario') }}"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el apellido del usuario"
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
                                    <option value="Colombia" @selected(old('pais') == 'Colombia')>Colombia</option>
                                    <option value="Otro" @selected(old('pais') == 'Otro')>Otro</option>
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
                                    value="{{ old('otro_pais') }}"
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

                                        <option value="{{ $departamento->id }}" @selected(old('departamento_id') == $departamento->id)>

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
                                    value="{{ old('direccion') }}"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese la dirección"
                                >
                            </div>

                            <!-- telefono fijo -->
                            <div>
                                <label for="fijo" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Teléfono Fijo <span class="text-gray-500 font-normal">(opcional)</span>
                                </label>

                                <input
                                    type="number"
                                    id="fijo"
                                    name="fijo"
                                    value="{{ old('fijo') }}"
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
                                    value="{{ old('movil') }}"
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
                                        <option value="Fallos" @selected(old('tipo_pqrsf') == 'Fallos')>Fallos</option>
                                        <option value="Avisos" @selected(old('tipo_pqrsf') == 'Avisos')>Avisos</option>
                                        <option value="Sentencias" @selected(old('tipo_pqrsf') == 'Sentencias')>Sentencias</option>
                                        <option value="PDA" @selected(old('tipo_pqrsf') == 'PDA')>PDA</option>
                                        <option value="Edictos" @selected(old('tipo_pqrsf') == 'Edictos')>Edictos</option>
                                    </optgroup>

                                    <optgroup label="Peticiones">
                                        <option value="Solicitud disponibilidad de servicios" @selected(old('tipo_pqrsf') == 'Solicitud disponibilidad de servicios')>Solicitud disponibilidad de servicios</option>
                                        <option value="Denuncia" @selected(old('tipo_pqrsf') == 'Denuncia')>Denuncia</option>
                                        <option value="Solicitud de permiso laboral" @selected(old('tipo_pqrsf') == 'Solicitud de permiso laboral')>Solicitud de permiso laboral</option>
                                        <option value="Derechos de petición" @selected(old('tipo_pqrsf') == 'Derechos de petición')>Derechos de petición</option>
                                        <option value="Memorandos" @selected(old('tipo_pqrsf') == 'Memorandos')>Memorandos</option>
                                        <option value="Cobros" @selected(old('tipo_pqrsf') == 'Cobros')>Cobros</option>
                                        <option value="Solicitud de certificado" @selected(old('tipo_pqrsf') == 'Solicitud de certificado')>Solicitud de certificado</option>
                                        <option value="Acciones populares" @selected(old('tipo_pqrsf') == 'Acciones populares')>Acciones populares</option>
                                        <option value="Acciones de tutelas" @selected(old('tipo_pqrsf') == 'Acciones de tutelas')>Acciones de tutelas</option>
                                        <option value="Solicitud certificado laboral" @selected(old('tipo_pqrsf') == 'Solicitud certificado laboral')>Solicitud certificado laboral</option>
                                        <option value="Solicitud visita técnica" @selected(old('tipo_pqrsf') == 'Solicitud visita técnica')>Solicitud visita técnica</option>
                                    </optgroup>

                                    <optgroup label="Quejas">
                                        <option value="Prestación de servicios" @selected(old('tipo_pqrsf') == 'Prestación de servicios')>Prestación de servicios</option>
                                        <option value="Daños causados por obras" @selected(old('tipo_pqrsf') == 'Daños causados por obras')>Daños causados por obras</option>
                                    </optgroup>

                                    <optgroup label="Reclamos">
                                        <option value="Facturación" @selected(old('tipo_pqrsf') == 'Facturación')>Facturación</option>
                                        <option value="Solicitud de información" @selected(old('tipo_pqrsf') == 'Solicitud de información')>Solicitud de información</option>
                                    </optgroup>

                                    <optgroup label="Sugerencias">
                                        <option value="Citaciones - Invitaciones" @selected(old('tipo_pqrsf') == 'Citaciones - Invitaciones')>Citaciones - Invitaciones</option>
                                        <option value="Propuesta" @selected(old('tipo_pqrsf') == 'Propuesta')>Propuesta</option>
                                    </optgroup>
                                </select>
                            </div>

                            <!-- Pregunta -->
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
                                    <option value="Correo Electrónico" @selected(old('tipo_respuesta') === 'Correo Electrónico')>Correo electrónico</option>
                                    <option value="Correo Certificado" @selected(old('tipo_respuesta') === 'Correo Certificado')>Correo certificado (físico)</option>
                                    <option value="WhatsApp" @selected(old('tipo_respuesta') === 'WhatsApp')>WhatsApp</option>
                                </select>
                            </div>

                            <!-- correo electronico (único campo de correo del formulario) -->
                            <div id="correo_container" class="hidden">
                                <label for="correo_electronico" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Correo Electrónico <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="correo_electronico"
                                    name="correo_electronico"
                                    value="{{ old('correo_electronico') }}"
                                    maxlength="200"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el correo electrónico"
                                >
                            </div>

                            <!-- whatsapp (solo anónimo; el identificado usa su teléfono móvil) -->
                            <div id="whatsapp_container" class="hidden">
                                <label for="numero_whatsapp" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Número de WhatsApp <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="tel"
                                    id="numero_whatsapp"
                                    name="numero_whatsapp"
                                    value="{{ old('numero_whatsapp') }}"
                                    maxlength="30"
                                    inputmode="tel"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="EJ: 3001234567"
                                >
                            </div>

                            <!-- dirección correo certificado -->
                            <div id="direccion_mensajeria_container" class="hidden">
                                <label for="direccion_mensajeria" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Dirección para el correo certificado <span class="font-bold text-red-800">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="direccion_mensajeria"
                                    name="direccion_mensajeria"
                                    value="{{ old('direccion_mensajeria') }}"
                                    maxlength="500"
                                    class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="EJ: Calle 1 # 1-1, Barrio Centro, Neiva, Huila"
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
                                    value="{{ old('asunto') }}"
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
                                >{{ old('descripcion') }}</textarea>
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
                                @checked(old('autoriza'))
                                required
                                class="mt-1 rounded border-gray-300 text-[#0047DC] focus:ring-[#0047DC]"
                            >
                            <label for="autoriza" class="text-sm text-gray-700 leading-relaxed">
                                Autorizo el tratamiento de mis datos personales de conformidad con la normativa vigente sobre protección de datos personales.
                            </label>
                        </div>
                    </div>
                
                    <button
                        type="submit"
                        class="cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 font-medium text-white hover:opacity-90"
                    >
                        Enviar información
                    </button>
                </form>
            </div>

        </section>

        @if(session('mostrarModal'))

        <div
            id="modalBusqueda"
            class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center">

            <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6">

                <h2 class="text-xl font-bold text-[#0047DC] mb-5">
                    Resultado de la búsqueda
                </h2>

                @php
                    $pqrs = session('resultadoBusqueda');
                @endphp

                @if($pqrs)

                    <div class="space-y-3 text-black">
                        <p><strong>Radicado:</strong> {{ $pqrs->codigo_radicado }}</p>
                        <p><strong>Estado:</strong> {{ $pqrs->estado }}</p>
                        <p><strong>Asunto:</strong> {{ $pqrs->asunto }}</p>
                        <p><strong>Fecha de Creación:</strong> {{ $pqrs->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Fecha de Actualización:</strong> {{ $pqrs->updated_at->format('d/m/Y H:i') }}</p>
                        @if($pqrs->estado == 'Cancelada')
                        <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-lg border">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Fecha de Cancelación: {{ \Carbon\Carbon::parse($pqrs->fecha_cancelacion)->format('d/m/Y h:i A') }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    Motivo: {{ $pqrs->motivo_cancelacion }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>

                @else

                    <div class="rounded-lg bg-red-50 border border-red-200 p-4">

                        <h3 class="font-semibold text-red-700">
                            Código no encontrado
                        </h3>

                        <p class="mt-2 text-red-600">
                            No existe ninguna PQRSDF registrada con el código ingresado.
                        </p>

                    </div>

                @endif

                <div class="mt-6 text-right">

                    <button
                        id="cerrarModal"
                        class="cursor-pointer inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 font-medium text-white hover:opacity-90">

                        Cerrar

                    </button>

                </div>

            </div>

        </div>

        @endif

        <!-- Lógica del formulario PQRSDF: campos visibles y obligatorios según identificado/anónimo y canal -->
        <script>
            const CANAL_CORREO = 'Correo Electrónico';
            const CANAL_CERTIFICADO = 'Correo Certificado';
            const CANAL_WHATSAPP = 'WhatsApp';

            const OPCIONES_IDENTIFICACION_NATURAL = [
                'Adulto sin identificación',
                'Carné diplomatico',
                'Cédula de ciudadanía',
                'Cédula de extrangería',
                'NUI',
                'Pasaporte',
                'Tarjeta de identidad',
                'Tarjeta profesional',
            ];
            const OPCIONES_IDENTIFICACION_JURIDICA = ['Número de identificación tributaría'];

            const municipioAnterior = @json(old('municipio_id'));

            const el = (id) => document.getElementById(id);

            // Muestra u oculta un contenedor y marca como obligatorios sus campos
            function mostrar(contenedor, visible, campos = []) {
                contenedor.classList.toggle('hidden', !visible);
                campos.forEach(campo => {
                    campo.required = visible;
                    if (!visible) campo.value = '';
                });
            }

            function actualizarTipoIdentificacion() {
                const select = el('tipo_identificacion');
                const esJuridica = el('tipo_solicitante').value === 'Persona Jurídica';
                const opciones = esJuridica ? OPCIONES_IDENTIFICACION_JURIDICA : OPCIONES_IDENTIFICACION_NATURAL;
                const valorActual = select.value;

                select.innerHTML = '<option value="">Seleccione una opción</option>';
                opciones.forEach(valor => select.add(new Option(valor === 'NUI' ? 'Número único de identificación' : valor, valor)));
                if (opciones.includes(valorActual)) select.value = valorActual;
            }

            function toggleFormulario() {
                const esIdentificado = el('identificado').checked;
                const canal = el('tipo_respuesta').value;
                const bloque = el('datos-identificado');

                // Datos personales: solo para identificado
                bloque.classList.toggle('hidden', !esIdentificado);
                if (!esIdentificado) {
                    bloque.querySelectorAll('input, select, textarea').forEach(campo => {
                        campo.required = false;
                        campo.value = '';
                    });
                } else {
                    ['tipo_solicitante', 'tipo_identificacion', 'numero_identificacion', 'pais', 'direccion', 'movil']
                        .forEach(id => el(id).required = true);

                    const esJuridica = el('tipo_solicitante').value === 'Persona Jurídica';
                    mostrar(el('razon_social_container'), esJuridica, [el('razon_social')]);
                    mostrar(el('nombre_usuario_container'), !esJuridica, [el('nombre_usuario')]);
                    mostrar(el('apellido_usuario_container'), !esJuridica, [el('apellido_usuario')]);

                    const esOtroPais = el('pais').value === 'Otro';
                    mostrar(el('contenedor_otro_pais'), esOtroPais, [el('otro_pais')]);
                    mostrar(el('contenedor_departamento'), !esOtroPais, [el('departamento')]);
                    mostrar(el('contenedor_municipio'), !esOtroPais, [el('municipio')]);
                }

                // Correo: siempre si es identificado; si es anónimo, solo cuando elige respuesta por correo
                mostrar(el('correo_container'), esIdentificado || canal === CANAL_CORREO, [el('correo_electronico')]);

                // WhatsApp: el anónimo debe dar el número (el identificado usa su teléfono móvil)
                mostrar(el('whatsapp_container'), !esIdentificado && canal === CANAL_WHATSAPP, [el('numero_whatsapp')]);

                // Correo certificado: dirección de envío
                mostrar(el('direccion_mensajeria_container'), canal === CANAL_CERTIFICADO, [el('direccion_mensajeria')]);
            }

            function toggleTipoDiscapacidad() {
                const tieneDiscapacidad = el('discapacidad').value === '1';
                const select = el('tipo_discapacidad');

                el('tipo_discapacidad_container').classList.toggle('hidden', !tieneDiscapacidad);
                select.disabled = !tieneDiscapacidad;
                select.required = tieneDiscapacidad;
                if (!tieneDiscapacidad) select.value = '';

                toggleOtraDiscapacidad();
            }

            function toggleOtraDiscapacidad() {
                const esOtra = el('tipo_discapacidad').value === 'otra';
                const input = el('otra_discapacidad');

                el('otra_discapacidad_container').classList.toggle('hidden', !esOtra);
                input.disabled = !esOtra;
                input.required = esOtra;
                if (!esOtra) input.value = '';
            }

            function cargarMunicipios(departamentoId, seleccionar = null) {
                const municipio = el('municipio');

                if (!departamentoId) {
                    municipio.innerHTML = '<option value="">Seleccione un municipio</option>';
                    return;
                }

                municipio.innerHTML = '<option value="">Cargando municipios...</option>';

                fetch(`/municipios/${departamentoId}`)
                    .then(response => response.json())
                    .then(data => {
                        municipio.innerHTML = '<option value="">Seleccione un municipio</option>';
                        data.forEach(item => municipio.add(new Option(item.nombre, item.id)));
                        if (seleccionar) municipio.value = seleccionar;
                    })
                    .catch(error => {
                        console.error(error);
                        municipio.innerHTML = '<option value="">Error al cargar municipios</option>';
                    });
            }

            document.addEventListener('DOMContentLoaded', () => {
                el('tipo_solicitante').addEventListener('change', () => {
                    actualizarTipoIdentificacion();
                    toggleFormulario();
                });
                el('pais').addEventListener('change', toggleFormulario);
                el('departamento').addEventListener('change', function () {
                    cargarMunicipios(this.value);
                });

                // Evitar doble envío
                el('form-pqrsdf').addEventListener('submit', function () {
                    const boton = this.querySelector('button[type="submit"]');
                    if (boton) {
                        boton.disabled = true;
                        boton.classList.add('opacity-60');
                    }
                });

                // Estado inicial (incluye valores devueltos si hubo errores de validación)
                actualizarTipoIdentificacion();
                toggleTipoDiscapacidad();
                toggleFormulario();
                cargarMunicipios(el('departamento').value, municipioAnterior);

                const errores = el('errores-formulario');
                if (errores) errores.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        </script>

            <!-- modal de busqueda -->
            <script>
                document.addEventListener('DOMContentLoaded', () => {

                    const modal = document.getElementById('modalBusqueda');

                    if (!modal) return;

                    document
                        .getElementById('cerrarModal')
                        .addEventListener('click', () => {

                            modal.remove();

                        });

                    modal.addEventListener('click', (e) => {

                        if (e.target === modal) {

                            modal.remove();

                        }

                    });

                });
            </script>

        @include('partials.footer')

    </body>
</html>
