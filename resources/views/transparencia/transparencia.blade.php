<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Transparencia y Acceso a la Información Pública</title>
        <style>
            /* Estilos para numeración 4.1, 4.2 */
            .custom-counter {
                counter-reset: item;
                list-style: none;
                padding-left: 0;
            }
            
            .custom-counter li {
                counter-increment: item;
                margin-left: 3.5rem;
                position: relative;
            }
            
            .custom-counter li::before {
                content: attr(data-parent) "." counter(item) " ";
                position: absolute;
                left: -3.5rem;
                font-weight: bold;
            }
        </style>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-96 overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Transparencia y Acceso a la Información Pública</h2>
                <p class="text-lg">Inicio </span class="font-bold"> / Transparencia y Acceso a la Información Pública</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="prose max-w-none text-justify text-gray-900">
                De conformidad con lo establecido en la <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Ley_1712_Del_06_De_Marzo_De_2014.pdf" class="text-[#0047DC]" class="text-[#0047DC]">Ley 1712 de 2014</a>, el <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Decreto_103_Del_20_De_Enero_De_2015.pdf">Decreto 103 de 2015</a>&nbsp;compilado en el <a href="https://aguasdelhuila.gov.co/archivos/documentos/normatividad/decreto-1081-de-2015-sector-presidencia-de-la-republica" class="text-[#0047DC]">Decreto 1081 de 2015</a> y la <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Resolucion_3564_De_2015.pdf" class="text-[#0047DC]">Resolución 3564 de 2015</a> emitidos por MinTIC, se dispone para los interesados y el público en general la siguiente información:
            </div>

            <div class="px-2 lg:px-32 py-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Card 1 -->
                <a href="{{ route('encuesta.evaluacion') }}"
                    class="group bg-white rounded-3xl border border-gray-200 shadow-md
                        hover:bg-gray-200 hover:shadow-xl hover:-translate-y-2
                        transition-all duration-300 ease-in-out
                        flex flex-col items-center justify-center
                        text-center p-10">

                    <div class="w-28 h-28 rounded-full
                                flex items-center justify-center
                                transition-transform duration-300
                                group-hover:scale-110">
                        <img src="{{ asset('storage/img/icono-encuesta.webp') }}"
                            alt="Encuesta de evaluación"
                            class="w-14 h-14 object-contain">
                    </div>

                    <h3 class="mt-8 text-xl font-bold text-black leading-tight">
                        Encuesta de evaluación
                    </h3>

                </a>

                <!-- Card 2 -->
                <a href="https://aguasdelhuila.gov.co/documentos/certificado-de-accesibilidad-web"
                    class="group bg-white rounded-3xl border border-gray-200 shadow-md
                        hover:bg-gray-200 hover:shadow-xl hover:-translate-y-2
                        transition-all duration-300 ease-in-out
                        flex flex-col items-center justify-center
                        text-center p-10">

                    <div class="w-28 h-28 rounded-full
                                flex items-center justify-center
                                transition-transform duration-300
                                group-hover:scale-110">

                        <img src="{{ asset('storage/img/icono-accesibilidad-web.webp') }}"
                            alt="Accesibilidad Web"
                            class="w-14 h-14 object-contain">

                    </div>

                    <h3 class="mt-8 text-xl font-bold text-black leading-tight">
                        Anexo técnico<br>
                        accesibilidad web
                    </h3>

                </a>

                <!-- Card 3 -->
                <a href="https://aguasdelhuila.gov.co/documentos/condiciones-minimas-tecnicas-y-de-seguridad-digital"
                    class="group bg-white rounded-3xl border border-gray-200 shadow-md
                        hover:bg-gray-200 hover:shadow-xl hover:-translate-y-2
                        transition-all duration-300 ease-in-out
                        flex flex-col items-center justify-center
                        text-center p-10">

                    <div class="w-28 h-28 rounded-full
                                flex items-center justify-center
                                transition-transform duration-300
                                group-hover:scale-110">

                        <img src="{{ asset('storage/img/icono-seguridad-digital.webp') }}"
                            alt="Seguridad Digital"
                            class="w-14 h-14 object-contain">

                    </div>

                    <h3 class="mt-8 text-xl font-bold text-black leading-tight">
                        Condiciones mínimas<br>
                        técnicas y de seguridad<br>
                        digital
                    </h3>

                </a>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-4">
                
                <!-- Información de la Entidad -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(1)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">1. Información de la Entidad</span>
                        <span id="icon-1" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-1" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="1"><a href="{{ route('misionvision') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Misión y Visión</a></li>
                                <li class="accordion-item" data-parent="1">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Funciones y Deberes</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="1.2">
                                            <a href="https://aguasdelhuila.gov.co/institucional/funciones-generales" class="block hover:bg-blue-50 hover:text-[#0047DC]">
                                                Funciones de la entidad
                                            </a>
                                        </li>
                                        <li data-parent="1.2">
                                            <a href="https://aguasdelhuila.gov.co/archivos/documentos/manual-de-funciones/manual-de-funciones" class="block hover:bg-blue-50 hover:text-[#0047DC]">
                                                Funciones de los funcionarios
                                            </a>
                                        </li>
                                    </ol>
                                </li>
                                <li data-parent="1"><a href="{{ route('organigrama') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Estructura orgánica - Organigrama</a></li>
                                <li data-parent="1"><a href="{{ route('gestioncalidad') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Mapas y cartas descriptivas de los procesos</a></li>
                                <li class="accordion-item" data-parent="1">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Directorio Institucional</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="1.5">
                                            <a href="{{ url('/') }}#directorio-de-entidades" class="block hover:bg-blue-50 hover:text-[#0047DC]">
                                                Directorio de Entidades
                                            </a>
                                        </li>
                                        <li data-parent="1.5">
                                            <a href="{{ route('directorio') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">
                                                Directorio de lideres por oficina
                                            </a>
                                        </li>
                                        <li data-parent="1.5">
                                            <a href="#" class="block hover:bg-blue-50 hover:text-[#0047DC]">
                                                Directorio de servidores públicos
                                            </a>
                                        </li>
                                        <li data-parent="1.5">
                                            <a href="https://aguasdelhuila.gov.co/documentos/directorio-entidades-del-sector" class="block hover:bg-blue-50 hover:text-[#0047DC]">
                                                Directorio de agremiaciones o asociaciones en las que participe
                                            </a>
                                        </li>
                                    </ol>
                                </li>
                                
                                <li class="accordion-item" data-parent="1">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Servicio al público, normas, formularios y protocolos de atención</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="1.6"><a href="{{ route('posts.file', 'normatividad') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Servicio al público, normas, formularios y protocolos de atención</a></li>
                                        <li data-parent="1.6"><a href="https://aguasdelhuila.gov.co/documentos/sistema-de-normas" class="block hover:bg-blue-50 hover:text-[#0047DC]">Normas</a></li>
                                        <li data-parent="1.6"><a href="https://aguasdelhuila.gov.co/participa/pqr" class="block hover:bg-blue-50 hover:text-[#0047DC]">Formularios</a></li>
                                        <li data-parent="1.6"><a href="https://aguasdelhuila.gov.co/archivos/documentos/informes-pqr/procedimiento-pqrdsf-2026" class="block hover:bg-blue-50 hover:text-[#0047DC]">Protocolos de atención</a></li>
                                    </ol>
                                </li>
                                <li data-parent="1"><a href="https://aguasdelhuila.gov.co/gestion-calidad" class="block hover:bg-blue-50 hover:text-[#0047DC]">Procedimientos que se siguen para tomar decisiones en las diferentes áreas</a></li>
                                <li data-parent="1"><a href="https://aguasdelhuila.gov.co/participa/pqr" class="block hover:bg-blue-50 hover:text-[#0047DC]">Mecanismo de presentación directa de solicitudes, quejas y reclamos a disposición del público</a></li>
                                <li data-parent="1"><a href="{{ route('calendario') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Calendario de actividades y eventos</a></li>
                                <li data-parent="1"><a href="{{ route('noticias.blog') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Información sobre decisiones que puede afectar al público</a></li>
                                <li data-parent="1"><a href="{{ route('entescontrol') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Entes y autoridades que lo vigilan</a></li>
                                <li data-parent="1"><a href="https://www1.funcionpublica.gov.co/web/sigep2/directorio" class="block hover:bg-blue-50 hover:text-[#0047DC]">Publicación de hojas de vida</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Normatividad -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(2)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">2. Normatividad</span>
                        <span id="icon-2" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-2" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li class="accordion-item" data-parent="2">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Normativa de la Entidad o Autoridad</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="2.1"><a href="https://aguasdelhuila.gov.co/documentos/normatividad/leyes" class="block hover:bg-blue-50 hover:text-[#0047DC]">Leyes</a></li>
                                        <li data-parent="2.1"><a href="https://aguasdelhuila.gov.co/documentos/normatividad/decreto-unico-reglamentario" class="block hover:bg-blue-50 hover:text-[#0047DC]">Decreto único reglamento</a></li>
                                        <li data-parent="2.1"><a href="{{ route('posts.file', 'normatividad') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Normativa aplicable</a></li>
                                        <li data-parent="2.1"><a href="https://svrpubindc.imprenta.gov.co/diario/" class="block hover:bg-blue-50 hover:text-[#0047DC]">Vínculo al Diario o gaceta oficial</a></li>
                                        <li data-parent="2.1"><a href="{{ route('posts.file', 'politicas') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Políticas y lineamientos sectoriales</a></li>
                                        <li data-parent="2.1"><a href="https://aguasdelhuila.gov.co/gestion-calidad" class="block hover:bg-blue-50 hover:text-[#0047DC]">Manuales</a></li>
                                        <li data-parent="2.1"><a href="https://aguasdelhuila.gov.co/gestion-calidad" class="block hover:bg-blue-50 hover:text-[#0047DC]">Otros lineamientos y manuales que le aplique</a></li>
                                    </ol>
                                </li>
                                <li class="accordion-item" data-parent="2">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Búsqueda de Normas</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="2.2"><a href="https://suin-juriscol.gov.co/" class="block hover:bg-blue-50 hover:text-[#0047DC]">Sistema Único de Información Normativa - SUIN</a></li>
                                        <li data-parent="2.2"><a href="https://aguasdelhuila.gov.co/documentos/sistema-de-normas" class="block hover:bg-blue-50 hover:text-[#0047DC]">Sistema de búsquedas de normas, propio de la entidad</a></li>
                                    </ol>
                                </li>
                                <li class="accordion-item" data-parent="2">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Proyectos de normas para comentarios</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="2.3"><a href="https://aguasdelhuila.gov.co/documentos/participacion-en-formulacion-de-politicas-publicas" class="block hover:bg-blue-50 hover:text-[#0047DC]">Proyectos Normativos</a></li>
                                        <li data-parent="2.3"><a href="https://aguasdelhuila.gov.co/documentos/participacion-en-formulacion-de-politicas-publicas" class="block hover:bg-blue-50 hover:text-[#0047DC]">Comentarios y documento de respuesta a comentarios</a></li>
                                        <li data-parent="2.3"><a href="https://community.secop.gov.co/Public/App/AnnualPurchasingPlanManagementPublic/Index?currentLanguage=en&Page=login&Country=CO&SkinName=CCE" class="block hover:bg-blue-50 hover:text-[#0047DC]">Participación ciudadana en la expedición de normas através el SECOP</a></li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Contratación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(3)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">3. Contratación</span>
                        <span id="icon-3" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-3" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="3"><a href="{{ route('posts.file', 'plan-anual-de-adquisiciones') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Plan anual de adquisiciones</a></li>
                                <li data-parent="3"><a href="https://community.secop.gov.co/Public/Tendering/ContractNoticeManagement/Index?currentLanguage=es-CO&Page=login&Country=CO&SkinName=CCE" class="block hover:bg-blue-50 hover:text-[#0047DC]">Publicación de la información contractual</a></li>
                                <li data-parent="3"><a href="https://aguasdelhuila.gov.co/documentos/contratacion/ejecucion-de-los-contratos" class="block hover:bg-blue-50 hover:text-[#0047DC]">Publicación de la ejecución de los contratos</a></li>
                                <li data-parent="3"><a href="https://aguasdelhuila.gov.co/documentos/manual-de-contratacion" class="block hover:bg-blue-50 hover:text-[#0047DC]">Manual de contratación, adquisición y/o compras</a></li>
                                <li data-parent="3"><a href="https://aguasdelhuila.gov.co/documentos/contratacion/formatos-o-modelos-de-contratos" class="block hover:bg-blue-50 hover:text-[#0047DC]">Formatos o modelos de contratos o pliegos tipo</a></li>
                                <li data-parent="3"><a href="{{ route('contrato') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 1</a></li>
                                <li data-parent="3"><a href="{{ route('contratodos') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Procesos Contractuales Parte 2</a></li>
                                <li data-parent="3"><a href="https://procesos.aguasdelhuila.gov.co/login" class="block hover:bg-blue-50 hover:text-[#0047DC]">Acceso de Proponente</a></li>
                                <li data-parent="3"><a href="{{ route('posts.file', 'contratacion') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Histórico Contratación</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Planeación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(4)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">4. Planeación</span>
                        <span id="icon-4" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-4" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li class="accordion-item" data-parent="4">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Presupuesto general de ingresos, gastos e inversión</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="4.1"><a href="{{ route('posts.file', 'presupuesto') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Presupuesto anual</a></li>
                                        <li data-parent="4.1"><a href="https://aguasdelhuila.gov.co/documentos/estados-financieros" class="block hover:bg-blue-50 hover:text-[#0047DC]">Estados financieros</a></li>
                                    </ol>
                                </li>
                                <li data-parent="4"><a href="{{ route('posts.file', 'ejecucion-presupuestal') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Ejecución presupuestal</a></li>
                                <li class="accordion-item" data-parent="4">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Plan de acción</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="4.3"><a href="{{ route('posts.file', 'plan-de-accion') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Plan de acción</a></li>
                                        <li data-parent="4.3"><a href="https://aguasdelhuila.gov.co/documentos/presupuesto" class="block hover:bg-blue-50 hover:text-[#0047DC]">Presupuesto desagregado con modificaciones</a></li>
                                    </ol>
                                </li>
                                <li data-parent="4"><a href="https://aguasdelhuila.gov.co/documentos/proyectos-de-inversion" class="block hover:bg-blue-50 hover:text-[#0047DC]">Proyectos de inversión</a></li>
                                <li data-parent="4"><a href="https://aguasdelhuila.gov.co/documentos/informe-de-empalme" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes de empalme</a></li>
                                <li data-parent="4"><a href="https://aguasdelhuila.gov.co/documentos/informacion-publica-yo-relevante" class="block hover:bg-blue-50 hover:text-[#0047DC]">Información pública y/o relevante</a></li>
                                <li class="accordion-item" data-parent="4">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Informe de gestión, evaluación y auditoría</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="4.7"><a href="https://aguasdelhuila.gov.co/documentos/informes-de-gestion" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe de Gestión</a></li>
                                        <li data-parent="4.7"><a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe de rendición de cuentas</a></li>
                                        <li data-parent="4.7"><a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe de rendición de cuentas a la ciudadanía</a></li>
                                        <li data-parent="4.7"><a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes a organismos de inspección, vigilancia y control</a></li>
                                        <li data-parent="4.7"><a href="{{ route('posts.file', 'planes-de-mejoramiento-entes-externos') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Planes de mejoramiento</a></li>
                                    </ol>
                                </li>
                                <li class="accordion-item" data-parent="4">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Informes de la oficina de control interno</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="4.8"><a href="https://aguasdelhuila.gov.co/documentos/informe-pormenorizado" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe pormenorizado</a></li>
                                        <li data-parent="4.8"><a href="https://aguasdelhuila.gov.co/documentos/otros-informes-yo-consultas-a-base-de-datos-o-sistemas-de-informacion" class="block hover:bg-blue-50 hover:text-[#0047DC]">Otros informes y/o consultas a base de datos o sistemas de información</a></li>
                                    </ol>
                                </li>
                                <li class="accordion-item" data-parent="4">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Informes sobre Defensa pública y prevención del daño antijurídico</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="4.9"><a href="https://aguasdelhuila.gov.co/archivos/documentos/defensa-publica/certificado-ekogui-2026pdf" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes sobre Defensa pública y prevención del daño antijurídico</a></li>
                                    </ol>
                                </li>
                                <li data-parent="4"><a href="{{ route('posts.file', 'informes-pqr') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes trimestrales sobre acceso a información, quejas y reclamos</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Trámites -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(5)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">5. Trámites</span>
                        <span id="icon-5" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-5" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li class="accordion-item" data-parent="5">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Tramites y Servicios</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="5.1"><a href="https://www1.funcionpublica.gov.co/web/suit/buscadortramites" class="block hover:bg-blue-50 hover:text-[#0047DC]">SUIT</a></li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Participa -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(6)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">6. Participa</span>
                        <span id="icon-6" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-6" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="6"><a href="https://aguasdelhuila.gov.co/participa" class="block hover:bg-blue-50 hover:text-[#0047DC]">Participa</a></li>
                                <li data-parent="6"><a href="https://aguasdelhuila.gov.co/participa" class="block hover:bg-blue-50 hover:text-[#0047DC]">Diagnóstico de evidencias e identificación de problemas</a></li>
                                <li data-parent="6"><a href="https://aguasdelhuila.gov.co/participa" class="block hover:bg-blue-50 hover:text-[#0047DC]">Planeación y presupuesto participativo</a></li>
                                <li data-parent="6"><a href="https://aguasdelhuila.gov.co/participa" class="block hover:bg-blue-50 hover:text-[#0047DC]">Consulta ciudadana</a></li>
                                <li data-parent="6"><a href="https://aguasdelhuila.gov.co/participa" class="block hover:bg-blue-50 hover:text-[#0047DC]">Colaboración e innovación abierta</a></li>
                                <li data-parent="6"><a href="https://aguasdelhuila.gov.co/participa" class="block hover:bg-blue-50 hover:text-[#0047DC]">Rendición de cuentas</a></li>
                                <li data-parent="6"><a href="https://aguasdelhuila.gov.co/participa" class="block hover:bg-blue-50 hover:text-[#0047DC]">Control social</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Datos Abiertos -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(7)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">7. Datos Abiertos</span>
                        <span id="icon-7" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-7" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li class="accordion-item" data-parent="7">
                                    <button type="button" class="accordion-toggle flex justify-between items-center w-full cursor-pointer hover:bg-blue-50 hover:text-[#0047DC] text-left">
                                        <span>Instrumentos de gestión de la información</span>
                                        <span id="icon" class="icon text-slate-900 transition-transform duration-300 px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-down-icon lucide-circle-arrow-down"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="m8 12 4 4 4-4"/></svg>
                                        </span>
                                    </button>
                                
                                    <ol class="accordion-content custom-counter pl-6 max-h-0 overflow-hidden transition-all duration-300">
                                        <li data-parent="7.1"><a href="https://aguasdelhuila.gov.co/archivos/documentos/instrumentos-de-gestion-de-la-informacion/registros-de-activos-de-informacion" class="block hover:bg-blue-50 hover:text-[#0047DC]">Registros de activos de información</a></li>
                                        <li data-parent="7.1"><a href="https://aguasdelhuila.gov.co/archivos/documentos/instrumentos-de-gestion-de-la-informacion/indice-de-informacion-clasificada-y-reservada" class="block hover:bg-blue-50 hover:text-[#0047DC]">Índice de información clasificada y reservada</a></li>
                                        <li data-parent="7.1"><a href="https://aguasdelhuila.gov.co/archivos/documentos/instrumentos-de-gestion-de-la-informacion/esquema-de-publicacion-de-la-informacion" class="block hover:bg-blue-50 hover:text-[#0047DC]">Esquema de publicación de la información</a></li>                                        
                                    </ol>
                                </li>
                                <li data-parent="7"><a href="https://www.datos.gov.co/browse?q=aguas+del+huila+&sortBy=relevance&page=1&pageSize=20" class="block hover:bg-blue-50 hover:text-[#0047DC]">Sección de Datos Abiertos</a></li>
                                <li data-parent="7"><a href="{{ route('posts.file', 'gestion-documental') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Gestion Documental</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Información Especifica para Grupos de Interés -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(8)" class="w-full flex justify-between items-center text-left py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">8. Información Especifica para Grupos de Interés</span>
                        <span id="icon-8" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-8" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="8"><a href="{{ route('posts.file', 'buenas-practicas') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Información para Grupos Específicos</a></li>
                                <li data-parent="8"><a href="https://aguasdelhuila.gov.co/noticias/pintando-a-super-gota/561" class="block hover:bg-blue-50 hover:text-[#0047DC]">Información para niños, niñas y adolescentes</a></li>
                                <li data-parent="8"><a href="{{ route('posts.file', 'buenas-practicas') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Información para Mujeres</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Obligación de Reporte de Información -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(9)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">9. Obligación de Reporte de Información</span>
                        <span id="icon-9" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-9" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="9"><a href="https://aguasdelhuila.gov.co/documentos/normatividad" class="block hover:bg-blue-50 hover:text-[#0047DC]">Normatividad Especial</a></li>
                                <li data-parent="9"><a href="https://aguasdelhuila.gov.co/documentos/calidad-de-aguas" class="block hover:bg-blue-50 hover:text-[#0047DC]">Indicadores de Calidad Aguas</a></li>
                                <li data-parent="9"><a href="https://aguasdelhuila.gov.co/documentos/indicadores/calidad-de-aguas/resultado-ius" class="block hover:bg-blue-50 hover:text-[#0047DC]">Resultado IUS</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Información tributaria en entidades -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(10)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">10. Información tributaria en entidades</span>
                        <span id="icon-10" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-10" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="10"><a href="#" class="block hover:bg-blue-50 hover:text-[#0047DC]">Procesos de recaudo de rentas locales</a></li>
                                <li data-parent="10"><a href="#" class="block hover:bg-blue-50 hover:text-[#0047DC]">Tarifas de liquidación del Impuesto de Industria y Comercio (ICA)</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Servicio de la Ciudadanía -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(11)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">11. Menú "Atención al Servicio de la Ciudadanía"</span>
                        <span id="icon-11" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-11" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/atencion-y-servicios-a-la-ciudadania" class="block hover:bg-blue-50 hover:text-[#0047DC]">Trámites, Otros Procedimientos Administrativos y consultas de acceso a información pública</a></li>
                                <li data-parent="11"><a href="{{ route('encuesta.tramite') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Encuesta Servicios Recibidos por Trámites</a></li>
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/participa/pqr" class="block hover:bg-blue-50 hover:text-[#0047DC]">Canales de atención y Pida una cita</a></li>
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/participa/pqr" class="block hover:bg-blue-50 hover:text-[#0047DC]">PQRSDF</a></li>
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/institucional/directorio-aguas-del-huila" class="block hover:bg-blue-50 hover:text-[#0047DC]">Directorio de contactos</a></li>
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/participa/calendario" class="block hover:bg-blue-50 hover:text-[#0047DC]">Calendario de eventos</a></li>
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/storage/posts/archivos/2019/MIPG/PlanesInstitucionales/2.%20%20Plan%20de%20Participacin%20Ciudadana.pdf" class="block hover:bg-blue-50 hover:text-[#0047DC]">Plan de participación ciudadana</a></li>
                                <li data-parent="11"><a href="https://www.datos.gov.co/browse?q=aguas+del+huila+&sortBy=relevance&page=1&pageSize=20" class="block hover:bg-blue-50 hover:text-[#0047DC]">Datos Abiertos</a></li>
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/documentos/informes-de-gestion" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes de gestión</a></li>
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/documentos/actividades-de-participacion-ciudadana" class="block hover:bg-blue-50 hover:text-[#0047DC]">Actividades de Participación Ciudadana</a></li>
                                <li data-parent="11"><a href="mailto:notificacionesjudiciales@aguasdelhuila.gov.co" class="block hover:bg-blue-50 hover:text-[#0047DC]">Notificaciones Judiciales</a></li>
                                <li data-parent="11"><a href="https://aguasdelhuila.gov.co/participa/denuncias" class="block hover:bg-blue-50 hover:text-[#0047DC]">Denuncias</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Noticias -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(12)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">12. Sección de Noticias</span>
                        <span id="icon-12" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-12" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="12"><a href="{{ route('noticias.blog') }}" class="block hover:bg-blue-50 hover:text-[#0047DC]">Noticias</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de solicitudes anonimas -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(13)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">13. Solicitudes anónimas</span>
                        <span id="icon-13" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-13" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="13"><a href="#" class="block hover:bg-blue-50 hover:text-[#0047DC]"></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Noticias -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(14)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">14. Anexo técnico accesibilidad web</span>
                        <span id="icon-14" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-14" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li data-parent="14"><a href="https://aguasdelhuila.gov.co/documentos/certificado-de-accesibilidad-web" class="block hover:bg-blue-50 hover:text-[#0047DC]">Certificado de accesibilidad web</a></li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        @include('partials.footer')

        <script>
            function toggleAccordion(index) {
                const content = document.getElementById(`content-${index}`);
                const icon = document.getElementById(`icon-${index}`);
            
                // SVG for Minus icon
                const minusSVG = `
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-from-line-icon lucide-arrow-up-from-line text-[#00C81F]"><path d="m18 9-6-6-6 6"/><path d="M12 3v14"/><path d="M5 21h14"/></svg>
                `;
            
                // SVG for Plus icon
                const plusSVG = `
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                `;
            
                // Toggle the content's max-height for smooth opening and closing
                if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0';
                icon.innerHTML = plusSVG;
                } else {
                content.style.maxHeight = content.scrollHeight + '1px';
                icon.innerHTML = minusSVG;
                }
            }
            </script>
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.accordion-toggle').forEach(button => {
                        button.addEventListener('click', function () {
                            const content = this.nextElementSibling;
                            const icon = this.querySelector('.icon');
                
                            if (content.style.maxHeight) {
                                content.style.maxHeight = null;
                                icon.style.transform = 'rotate(0deg)';
                            } else {
                                content.style.maxHeight = content.scrollHeight + "px";
                                icon.style.transform = 'rotate(180deg)';
                            }
                        });
                    });
                });
            </script>

    </body>
</html>
