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

                <form action="{{ route('pqr.store') }}"
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
                    
                        <!-- Identificado/anonimo -->
                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                ¿Desea ser identificado o anónimo?
                            </label>

                            <div class="w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900">
                                <input type="radio" id="identificado" name="identificado_anonimo" value="identificado" checked onchange="toggleFormulario()"/>
                                <label for="identificado">Identificado</label>
                                <input type="radio" id="anonimo" name="identificado_anonimo" value="anonimo" onchange="toggleFormulario()"/>
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
                                    <option value="Otro">Otro</option>
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
                                    <option value="Correo Electrónico">Correo electrónico</option>
                                    <option value="Físico / Mensajería">Físico / Mensajería</option>
                                </select>
                            </div>

                            <!-- correo electronico -->
                            <div id="correo_mensajeria_container" class="hidden">
                                <label for="correo_electronico" class="block text-sm font-semibold text-gray-800 mb-2">
                                    Correo Electrónico <span class="font-bold text-red-800">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="correo_electronico_mensajeria"
                                    name="correo_electronico"
                                    class="campo-identificado w-full border-gray-300 rounded-lg bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                                    placeholder="Ingrese el correo electrónico"
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
                const tipoRespuesta = document.getElementById('tipo_respuesta').value;

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
                } else {
                    containerCorreoPrincipal.classList.add('hidden');
                    inputCorreoPrincipal.required = false;
                    inputCorreoPrincipal.value = ''; // Limpia el valor si cambia a anónimo
                }

                // 2. Manejo del Canal de Respuesta
                if (tipoRespuesta === 'Físico / Mensajería') {
                    // Mostrar dirección
                    containerDireccion.classList.remove('hidden');
                    inputDireccion.required = true;

                    // Ocultar correo secundario
                    containerCorreoMensajeria.classList.add('hidden');
                    inputCorreoMensajeria.required = false;

                } else if (tipoRespuesta === 'Correo Electrónico') {
                    // Ocultar dirección
                    containerDireccion.classList.add('hidden');
                    inputDireccion.required = false;

                    // Mostrar correo secundario SOLO si el usuario es ANÓNIMO
                    if (!esIdentificado) {
                        containerCorreoMensajeria.classList.remove('hidden');
                        inputCorreoMensajeria.required = true;
                    } else {
                        // Si es IDENTIFICADO y eligió 'Correo Electrónico', se usa el correo principal
                        containerCorreoMensajeria.classList.add('hidden');
                        inputCorreoMensajeria.required = false;
                    }

                } else {
                    // Sin selección de canal
                    containerDireccion.classList.add('hidden');
                    inputDireccion.required = false;

                    containerCorreoMensajeria.classList.add('hidden');
                    inputCorreoMensajeria.required = false;
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

                const campos = bloque.querySelectorAll(
                    'input, select, textarea'
                );

                function actualizarFormulario() {

                    if (radioIdentificado.checked) {

                        bloque.classList.remove('hidden');

                        campos.forEach(campo => {
                            campo.required = true;
                        });

                    } else {

                        bloque.classList.add('hidden');

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

                    const esJuridica = tipoSolicitante.value === 'persona_juridica';

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

            <!-- Opciones de tipo de respuesta -->
            <script>
                function toggleTipoRespuesta() {
                    const tipoRespuesta = document.getElementById('tipo_respuesta').value;
                    const direccionMensajeria = document.getElementById('direccion_mensajeria');
                    const container = document.getElementById('direccion_mensajeria_container');
                    const correoMensajeria = document.getElementById('correo_electronico_mensajeria');
                    const containerCorreo = document.getElementById('correo_mensajeria_container');
                
                    if (tipoRespuesta === 'Físico / Mensajería') {
                        container.classList.remove('hidden');
                        direccionMensajeria.classList.remove('hidden');
                        direccionMensajeria.required = true;
                        // Correo oculto
                        containerCorreo.classList.add('hidden');
                        correoMensajeria.classList.add('hidden');
                        correoMensajeria.required = false;
                    } else {
                        container.classList.add('hidden');
                        direccionMensajeria.classList.add('hidden');
                        direccionMensajeria.required = false;
                        // correo activo
                        containerCorreo.classList.remove('hidden');
                        correoMensajeria.classList.remove('hidden');
                        correoMensajeria.required = true;
                    }
                }

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
