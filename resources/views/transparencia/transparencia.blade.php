<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Transparencia y Acceso a la Información Pública</title>
        <style>
            /* Estilos para numeración 4.1, 4.2 */
            ol.custom-counter {
            counter-reset: item;
            }
            ol.custom-counter > li {
            counter-increment: item;
            }
            ol.custom-counter > li::marker {
            content: counters(item, ".") ". ";
            }
        </style>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Transparencia y Acceso a la Información Pública</h2>
                <p class="text-lg">Inicio </span class="font-bold"> / Transparencia y Acceso a la Información Pública</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="prose max-w-none text-justify text-gray-900">
                De conformidad con lo establecido en la <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Ley_1712_Del_06_De_Marzo_De_2014.pdf" target="_blank" class="text-[#0047DC]" class="text-[#0047DC]">Ley 1712 de 2014</a>, el <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Decreto_103_Del_20_De_Enero_De_2015.pdf">Decreto 103 de 2015</a>&nbsp;compilado en el <a href="http://es.presidencia.gov.co/normativa/normativa/Decreto-1081-2015.pdf" target="_blank" class="text-[#0047DC]">Decreto 1081 de 2015</a> y la <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Resolucion_3564_De_2015.pdf" target="_blank" class="text-[#0047DC]">Resolución 3564 de 2015</a> emitidos por MinTIC, se dispone para los interesados y el público en general la siguiente información:
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-4">
                
                <!-- Información de la Entidad -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(1)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Información de la Entidad</span>
                        <span id="icon-1" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-1" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li><a href="{{ route('historia') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Misión y Visión</a></li>
                                <li><a href="{{ route('historia') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Organigrama</a></li>
                                <li><a href="{{ route('gestioncalidad') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Mapa de Procesos</a></li>
                                <li>Directorio
                                    <ol class="custom-counter pl-6">
                                        <li><a href="{{ route('posts.file', 'directorio-entidades-del-sector') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Entidades</a></li>
                                        <li><a href="{{ route('directorio') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Funcionarios</a></li>
                                    </ol>
                                </li>
                                <li>PQRSF
                                    <ol class="custom-counter pl-6">
                                        <li><a href="{{ route('pqr') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">PQRS</a></li>
                                    </ol>
                                </li>
                                <li><a href="{{ route('calendario') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Calendario de Actividades</a></li>
                                <li><a href="{{ route('noticias.blog') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Noticias</a></li>
                                <li><a href="{{ route('entescontrol') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Entidades que nos Vigilan</a></li>
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Publicaciones de Hojas de Vida (pendiente)</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Normatividad -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(2)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Normatividad</span>
                        <span id="icon-2" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-2" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li><a href="{{ route('posts.file', 'normatividad') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Normatividad de la Entidad</a></li>
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Decreto Único Reglametno (pendiente)</a></li>
                                <li><a href="{{ route('posts.file', 'politicas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Politicas, Lineamientos y Manuales</a></li>
                                <li>Busqueda de Normas
                                    <ol class="custom-counter pl-6">
                                        <li><a href="https://suin-juriscol.gov.co/" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Sistema Único de Información Normativa - SUIN</a></li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Contratación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(3)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Contratación</span>
                        <span id="icon-3" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-3" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li>Plan Anual de Adquisiciones
                                    <ol class="custom-counter pl-6">
                                        <li><a href="/storage/posts/archivos/2023/Adquisiciones%20aguas%20huila%20sa%20esp%202023.pdf" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">PAA</a></li>
                                        <li><a href="https://community.secop.gov.co/Public/App/AnnualPurchasingPlanManagementPublic/Index?currentLanguage=en&Page=login&Country=CO&SkinName=CCE" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Anlace del PAA Publicado en el SECOP</a></li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Planeación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(4)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Planeación</span>
                        <span id="icon-4" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-4" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li><a href="http://localhost:8000/storage/posts/archivos/2022/PUBLICADAS%202022.xlsx" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Presupuesto</a></li>
                                <li><a href="{{ route('posts.file', 'ejecucion-presupuestal') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Ejecución Presupuestal Historica Anual</a></li>
                                <li>Plan de Desarrollo
                                    <ol class="custom-counter pl-6">
                                        <li><a href="{{ route('posts.show') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">PDA</a></li>
                                        <li><a href="{{ route('posts.file', 'plan-de-desarrollo-institucional') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">PDI</a></li>
                                    </ol>
                                </li>
                                <li><a href="{{ route('posts.file', 'planes-insitucionales') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Planes de Acción</a></li>
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Proyectos de Inversión y Programas en Ejecución (pendiente)</a></li>
                                <li>Informes de Gestión, Evaluación y Auditoria
                                    <ol class="custom-counter pl-6">
                                        <li><a href="{{ route('posts.file', 'presentacion-rendicion-de-cuentas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe Enviado a la Asamblea</a></li>
                                        <li><a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe de Rendición de la Cuenta Fiscal a los Organismos de Control Territorial</a></li>
                                        <li><a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe de Rendición de Cuentas a los Ciudadanos</a></li>
                                        <li><a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes a Organismos de Inspección, Vigilancia y Control</a></li>
                                        <li><a href="{{ route('posts.file', 'informes-de-gestion') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Boletines Informativos de Control Interno</a></li>
                                        <li><a href="{{ route('posts.file', 'anyo-2023') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes de Auditoria de Control Interno</a></li>
                                        <li><a href="{{ route('posts.file', 'plan-anticorrupcion-y-atencion-al-ciudadano') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes de Seguimiento Plan Anticorrupción y de Atención al Ciudadano</a></li>
                                        <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes de Gestión de Control Interno (Pendiente)</a></li>
                                        <li><a href="{{ route('posts.file', 'informes-pqr') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe PQRSDF</a></li>
                                        <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Actas de Comité Institucional de Coordinación de Control Interno (pendiente)</a></li>
                                        <li><a href="{{ route('posts.file', 'anyo-2023') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informes de Seguimiento de Control Interno</a></li>
                                        <li><a href="/storage/posts/archivos/2024/Plan-auditorias-seguimientos-vigencia-2023-version-1.pdf" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Plan Anual de Auditoria</a></li>
                                        <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Delitos Contra la Administración Pública (pendiente)</a></li>
                                        <li><a href="/storage/posts/archivos/2022/POLITICA%20CONTROL%20INTERNO.pdf" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Política de Control Interno</a></li>
                                        <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Actas de Reunión del Comité Departamental de Auditoria (pendiente)</a></li>
                                    </ol>
                                </li>
                                <li>MIPG
                                    <ol class="custom-counter pl-6">
                                        <li><a href="{{ route('posts.file', 'autodiagnosticos-2023') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Modelo Integrado de Planeación y Gestión</a></li>
                                        <li><a href="/storage/posts/archivos/2023/CertificadoDiligenciamientoRDM11_5992533395169176651.pdf" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Certificado de Diligenciamiento a través del Aplicativo FURAG</a></li>
                                    </ol>
                                </li>
                                <li><a href="{{ route('posts.file', 'defensa-judicial') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Defensa Judicial</a></li>
                                <li><a href="{{ route('posts.file', 'reportes-pqr-electronicas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Informe PQRSDF</a></li>
                                <li>Planes de Mejoramineto
                                    <ol class="custom-counter pl-6">
                                        <li><a href="{{ route('posts.file', 'planes-de-mejoramiento-entes-externos') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Planes de Mejoramiento Vigentes Exigidos por Entes de Control Internos o Externos</a></li>
                                        <li><a href="{{ route('entescontrol') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Enlace al Sitio Web del Organismo de Control</a></li>
                                        <li><a href="{{ route('posts.file', 'informes-auditorias-internas-y-externas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Seguimiento Planes de Mejoramiento Auditorias Internas y Externas</a></li>
                                    </ol>
                                </li>
                                <li><a href="{{ route('posts.file', 'planes-de-desarrollo-departamental') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Plan de Desarrollo</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Trámites -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(5)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Trámites</span>
                        <span id="icon-5" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-5" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li>Tramites y Servicios
                                    <ol class="custom-counter pl-6">
                                        <li><a href="https://www1.funcionpublica.gov.co/web/suit/buscadortramites" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">SUIT</a></li>
                                    </ol>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Participa -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(6)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Participa</span>
                        <span id="icon-6" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-6" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Estructura y Secciones (pendiente)</a></li>
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Participación para la Identificación de Problemas y Diagnóstico de Necesidades (pendiente)</a></li>
                                <li><a href="{{ route('posts.file', 'actividades-de-participacion-ciudadana') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Planeación y/o Presupuesto Participativo</a></li>
                                <li><a href="/storage/posts/archivos/2019/MIPG/PlanesInstitucionales/2.%20%20Plan%20de%20Participacin%20Ciudadana.pdf" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Participación y Consulta Ciudadana de Proyectos, Normas, Políticas o Programas</a></li>
                                <li><a href="{{ route('foro') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Colaboración e Innovación Abierta - Foros</a></li>
                                <li><a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Plan de Rendición de Cuentas</a></li>
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Control Ciudadano y Denuncias (pendiente)</a></li>
                                <li><a href="/storage/posts/archivos/2023/12.PETI%202023.pdf" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Plan de Seguimiento del PETI</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Datos Abiertos -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(7)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Datos Abiertos</span>
                        <span id="icon-7" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-7" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li>Instrumentos de Gestión de la Información
                                    <ol class="custom-counter pl-6">
                                        <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Registros de Activos de Información (pendiente)</a></li>
                                        <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Índice de Información Clasificada y Reservada (pendiente)</a></li>
                                        <li><a href="/storage/posts/archivos/2019/InstrumentosArchivisticos/Esquema%20de%20publicacion%20Web%20AH.xlsx" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Esquema de Publicación de la Información</a></li>
                                        <li><a href="{{ route('posts.file', 'gestion-documental') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Programa de Gestión Documental</a></li>
                                        <li><a href="{{ route('posts.file', 'trd') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Tablas de Retención Documental</a></li>
                                    </ol>
                                </li>
                                <li><a href="https://www.datos.gov.co/browse?q=aguas+del+huila+&sortBy=relevance&page=1&pageSize=20" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Sección de Datos Abiertos</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Información Especifica para Grupos de Interés -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(8)" class="w-full flex justify-between items-center text-left py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Información Especifica para Grupos de Interés</span>
                        <span id="icon-8" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-8" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li><a href="{{ route('posts.file', 'buenas-practicas') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Información para Mujeres</a></li>
                                <li><a href="/storage/posts/archivos/2023/CARACTERIZACION%202022.pdf" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Caracterización Grupos de Valor </a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Obligación de Reporte de Información -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(9)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Obligación de Reporte de Información</span>
                        <span id="icon-9" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-9" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Normatividad Especial (pendiente)</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Noticias -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-start hover:bg-gray-100">
                    <button onclick="toggleAccordion(10)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Sección de Noticias</span>
                        <span id="icon-10" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-10" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg text-left">
                        <div class="pb-5 text-sm text-slate-900">
                            <ol class="custom-counter list-decimal pl-4 py-2">
                                <li><a href="{{ route('noticias.blog') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Noticias</a></li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <section class="px-2 lg:px-32 py-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 my-4">
                
                <!-- Información de la Entidad -->
                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-person-standing-icon lucide-person-standing"><circle cx="12" cy="5" r="1"/><path d="m9 20 3-6 3 6"/><path d="m6 8 6 2 6-2"/><path d="M12 10v4"/></svg>
                    Mecanismos para la atención al ciudadano</h2>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Dirección</h3>
                    <p class="text-sm text-black">Calle 21 No. 1C - 17 Neiva (Huila) - Colombia</p>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Código postal</h3>
                    <p class="text-sm text-black">410010</p>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Teléfono de contacto</h3>
                    <p class="text-sm text-black">(+57) 8 8753181</p>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Línea Gratuita</h3>
                    <p class="text-sm text-black">01 8000 952858 </p>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Correo electrónico</h3>
                    <a href="mailto:info@aguasdelhuila.gov.co" class="text-sm text-black hover:text-[#0047DC]">info@aguasdelhuila.gov.co</a></br>
                    <a href="{{ route('pqr') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Radicación de Correspondecia y PQR en la web</a>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Sede Principal </h3>
                    <p class="text-sm text-black">Calle 21 No. 1C - 17</p>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Horarios de Atención</h3>
                    <p class="text-sm text-black">Lunes a Jueves: Mañana: 7AM a 12M - Tarde: 2PM a 6PM</p>
                    <p class="text-sm text-black">Viernes: Mañana: 7AM a 12M - Tarde: 2PM a 5PM</p>
                    <a href="{{ route('oficinas') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Oficinas de Aguas del Huila</a>
                    </br>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Correo electrónico para notificaciones judiciales</h3>
                    <a href="mailto:notificacionesjudiciales@aguasdelhuila.gov.co" class="text-sm text-black hover:text-[#0047DC]">notificacionesjudiciales@aguasdelhuila.gov.co</a></br>
                    <a href="{{ route('posts.file', 'servicio-ciudadano') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Servicio Ciudadano</a>
                    </br>
                    </br>
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-icon lucide-book-open"><path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/></svg>
                        Información de interés</h2>
                    </br>
                    <a href="https://www.datos.gov.co/browse?q=aguas+del+huila+&sortBy=relevance&page=1&pageSize=20" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Datos abiertos</a></br>   
                    <a href="{{ route('glosario') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Glosario</a></br>   
                    </br>   
                    <h3 class="text-md font-bold text-[#0047DC]">Estudios e investigaciones</h3>
                    <a href="{{ route('nacederos') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Nacederos y fuentes hídiricas del departamento del Huila</a></br>   
                    <a href="{{ route('convocatoria') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Convocatorias</a></br>
                    </br>   
                    <h3 class="text-md font-bold text-[#0047DC]">Para niños y niñas</h3>
                    <a href="{{ route('posts.file', 'buenas-practicas') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Buenas prácticas</a></br>
                    <a href="{{ route('noticias.blog') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Noticias</a></br>
                    </br>   

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-panel-top-icon lucide-layout-panel-top"><rect width="18" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/></svg>
                    Estructura orgánica y talento humano</h2>
                    </br>
                    <a href="{{ route('historia') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Misión y Visión</a></br>   
                    <a href="{{ route('historia') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Funciones deberes</a></br>
                    <a href="{{ route('posts.file', 'manual-de-funciones') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Manual de Funciones</a></br>
                    <a href="/storage/posts/archivos/2022/REGLAMENTO%20INTERNO%20DE%20TRABAJO.pdf" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Reglamento Interno de Trabajo</a></br>
                    <a href="/storage/posts/archivos/MANUAL%20DE%20CALIDAD%20ISO%209001-2015.pdf" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Manual de Calidad</a></br>
                    <a href="https://extranet.aguasdelhuila.gov.co/site.aspx?Codigo=07DA00A4-CD98-435F-BF5E-97CAE8D8C520" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Procesos y Documentos</a></br>
                    <a href="{{ route('historia') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Organigrama</a></br>
                    <a href="{{ route('directorio') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Directorio de información de servidores públicos, empleados y contratistas SIGEP</a></br>
                    <a href="{{ route('posts.file', 'directorio-entidades-del-sector') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Directorio de entidades</a></br>
                    <a href="{{ route('posts.file', 'talento-humano') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Informes de Talento Humano</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-text-icon lucide-notebook-text"><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9.5 8h5"/><path d="M9.5 12H16"/><path d="M9.5 16H14"/></svg>
                    Normatividad</h2>
                    </br>
                    <a href="{{ route('posts.file', 'normatividad') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Normatividad Aguas del Huila</a></br>   
                    <a href="https://www.huila.gov.co/publicaciones/7158/gaceta-departamental/" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Gaceta Departamental</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
                    Presupuesto</h2>
                    </br>
                    <a href="{{ route('posts.file', 'presupuesto') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Presupuesto</a></br>   
                    <a href="{{ route('posts.file', 'ejecucion-presupuestal') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Ejecución Presupuestal</a></br>   
                    <a href="{{ route('posts.file', 'estados-financieros') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Estados financieros</a></br>   
                    <a href="/storage/posts/archivos/2016/ACUERDO%20%20007%20DE%202016-%20MANUAL%20DE%20CONTRATACION.pdf" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Manual de Contratación</a></br>
                    </br>   
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-traffic-cone-icon lucide-traffic-cone"><path d="M16.05 10.966a5 2.5 0 0 1-8.1 0"/><path d="m16.923 14.049 4.48 2.04a1 1 0 0 1 .001 1.831l-8.574 3.9a2 2 0 0 1-1.66 0l-8.574-3.91a1 1 0 0 1 0-1.83l4.484-2.04"/><path d="M16.949 14.14a5 2.5 0 1 1-9.9 0L10.063 3.5a2 2 0 0 1 3.874 0z"/><path d="M9.194 6.57a5 2.5 0 0 0 5.61 0"/></svg>
                    Transparencia Pasiva</h2>
                    </br>
                    <a href="{{ route('pqr') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Consultar estado de PQR</a></br>   
                    </br>   

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined"><path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/></svg>
                    Planeación</h2>
                    </br>
                    <a href="{{ route('posts.file', 'autodiagnosticos') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Autodiagnóstico</a></br>   
                    <a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Presentación Rendición de Cuentas</a></br>
                    <a href="{{ route('posts.file', 'codigo-de-integridad') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Código de Integridad del Servidor Público</a></br>
                    <a href="{{ route('posts.file', 'plan-de-desarrollo-institucional') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Plan de Desarrollo Institucional</a></br>
                    <a href="{{ route('posts.show') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Plan Departamental de Aguas - PDA</a></br>
                    <a href="{{ route('posts.file', 'planes-de-desarrollo-departamental') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Plan de Desarrollo Departamental</a></br>
                    <a href="{{ route('posts.file', 'planes-de-accion') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Planes de Acción</a></br>
                    <a href="{{ route('posts.file', 'planes-insitucionales') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Planes Institucionales</a></br>
                    <a href="{{ route('posts.file', 'politicas') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Políticas</a></br>
                    <a href="{{ route('posts.file', 'plan-anual-de-adquisiciones') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones</a></br>
                    <a href="{{ route('posts.file', 'riesgos') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Matriz de Riesgo</a></br>
                    <a href="{{ route('posts.file', 'informes-de-gestion') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Informe de gestión</a></br>
                    <a href="{{ route('posts.file', 'mipg') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Modelo Integrado de Planeación y Gestión – MIPG</a></br>
                    <a href="{{ route('posts.file', 'planes-de-accion-mipg') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Planes de Acción MIPG</a></br>
                    <a href="{{ route('posts.file', 'gobierno-digital') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Gobierno Digital</a></br>
                    <a href="{{ route('posts.file', 'matriz-de-veedurias') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Matriz de Veedurías</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scan-search-icon lucide-scan-search"><path d="M3 7V5a2 2 0 0 1 2-2h2"/><path d="M17 3h2a2 2 0 0 1 2 2v2"/><path d="M21 17v2a2 2 0 0 1-2 2h-2"/><path d="M7 21H5a2 2 0 0 1-2-2v-2"/><circle cx="12" cy="12" r="3"/><path d="m16 16-1.9-1.9"/></svg>
                    Control</h2>
                    </br>
                    <a href="/storage/posts/archivos/2021/certificado%20cargue%20sui%20calidad%20agua%201%20y%202%20bimestre%202021.pdf" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Calidad del Agua 1 y 2 Bimenstre de 2021</a></br>   
                    <a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Información de Rendición de Cuentas</a></br>
                    <a href="{{ route('posts.file', 'informes-de-gestion') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Informe de Gestión</a></br>
                    <a href="{{ route('posts.file', 'control-interno') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Reportes Control Interno</a></br>
                    <a href="{{ route('posts.file', 'informe-pormenorizado') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Informes pormenorizados del estado de Control Interno</a></br>
                    <a href="{{ route('posts.file', 'plan-anticorrupcion-y-atencion-al-ciudadano') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Plan Anticorrupción y Atención al Ciudadano</a></br>
                    <a href="{{ route('posts.file', 'indicadores') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Informe de indicadores</a></br>
                    <a href="{{ route('posts.file', 'ejecucion-presupuestal') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Informes de ejecución presupuestal</a></br>
                    <a href="{{ route('entescontrol') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Entes de control</a></br>
                    <a href="{{ route('posts.file', 'defensa-judicial') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Defensa Judicial</a></br>
                    <a href="{{ route('posts.file', 'informes-auditorias-internas-y-externas') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Informes Auditorias Internas y Externas</a></br>
                    <a href="{{ route('posts.file', 'planes-de-mejoramiento-entes-externos') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Planes de Mejoramiento Entes Externos</a></br>
                    <a href="{{ route('posts.file', 'reportes-pqr-electronicas') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Reportes PQR Electrónicas</a></br>
                    </br>

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/></svg>
                    Contratación</h2>
                    </br>
                    <a href="https://www.contratos.gov.co/consultas/inicioConsulta.do" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Información Contratación SECOP</a></br>   
                    <a href="https://procesos.aguasdelhuila.gov.co/login" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Procesos de contratación</a></br>
                    <a href="{{ route('posts.file', 'contratacion') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Relación de contratos</a></br>
                    <a href="https://extranet.aguasdelhuila.gov.co/login.aspx?returnurl=%2f%3fcomponente%3deyt.gestiondocumental_procesosdocumentos_consulta##IDT4" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Proceso de Gestión de Bienes y Servicios</a></br>
                    <a href="{{ route('posts.file', 'plan-anual-de-adquisiciones') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones</a></br>
                    <a href="https://www.contratos.gov.co/consultas/consultarArchivosPAA2020.do" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones SECOP</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-left-icon lucide-arrow-right-left"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>
                    Trámites y Servicios</h2>
                    </br>
                    <a href="https://www.gov.co/" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Portal Gov.co</a></br>   
                    <a href="https://www1.funcionpublica.gov.co/web/suit/buscadortramites" target="_blank" class="text-sm text-black hover:text-[#0047DC]">SUIT</a></br>
                    <a href="https://extranet.aguasdelhuila.gov.co/site.aspx?Codigo=07DA00A4-CD98-435F-BF5E-97CAE8D8C520" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Procesos y Documentos</a></br>
                    </br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wrench-icon lucide-wrench"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.106-3.105c.32-.322.863-.22.983.218a6 6 0 0 1-8.259 7.057l-7.91 7.91a1 1 0 0 1-2.999-3l7.91-7.91a6 6 0 0 1 7.057-8.259c.438.12.54.662.219.984z"/></svg>
                    Instrumentos de gestión de información pública</h2>
                    </br>  
                    <a href="/storage/posts/archivos/2019/GobiernoDigital/Esquema%20de%20publicacion%20de%20informacion.xlsx" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Esquema de publicación de información</a></br>
                    <a href="{{ route('posts.file', 'contratacion') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Gestión Documental</a></br>
                    <a href="{{ route('posts.file', 'gestion-documental') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Programa de Gestión Documental</a></br>
                    <a href="{{ route('posts.file', 'trd') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Tablas de Retención Documental - TRD</a></br>
                    <a href="{{ route('posts.file', 'gestion-documental') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">PINAR</a></br>
                    <a href="{{ route('posts.file', 'gestion-documental') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">SIC</a></br>
                    <a href="{{ route('pqr') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Radicación de Correspondecia y PQR en la web</a></br>
                    <a href="{{ route('posts.file', 'informes-pqr') }}" target="_blank" class="text-sm text-black hover:text-[#0047DC]">Informes PQR</a></br>
                    </br>

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
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.innerHTML = minusSVG;
                }
            }
            </script>

    </body>
</html>
