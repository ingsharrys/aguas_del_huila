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
                <p class="text-lg">Inicio / Institucional </span class="font-bold"> / Transparencia y Acceso a la Información Pública</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="prose max-w-none text-justify text-gray-900">
                De conformidad con lo establecido en la <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Ley_1712_Del_06_De_Marzo_De_2014.pdf" target="_blank" class="text-[#0047DC]" class="text-[#0047DC]">Ley 1712 de 2014</a>, el <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Decreto_103_Del_20_De_Enero_De_2015.pdf">Decreto 103 de 2015</a>&nbsp;compilado en el <a href="http://es.presidencia.gov.co/normativa/normativa/Decreto-1081-2015.pdf" target="_blank" class="text-[#0047DC]">Decreto 1081 de 2015</a> y la <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Resolucion_3564_De_2015.pdf" target="_blank" class="text-[#0047DC]">Resolución 3564 de 2015</a> emitidos por MinTIC, se dispone para los interesados y el público en general la siguiente información:
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-4">
                
                <!-- Información de la Entidad -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
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
                                        <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Entidades</a></li>
                                        <li><a href="{{ route('directorio') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Directorio de Funcionarios</a></li>
                                    </ol>
                                </li>
                                <li>PQRSF
                                    <ol class="custom-counter pl-6">
                                        <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">PQRS</a></li>
                                    </ol>
                                </li>
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Calendario de Actividades</a></li>
                                <li><a href="{{ route('noticias.blog') }}" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Noticias</a></li>
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Entidades que nos Vigilan</a></li>
                                <li><a href="#" target="_blank" class="block hover:bg-blue-50 hover:text-[#0047DC]">Publicaciones de Hojas de Vida (pendiente)</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Normatividad -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(2)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Normatividad</span>
                        <span id="icon-2" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-2" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
                        </div>
                    </div>
                </div>
                
                <!-- Contratación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(3)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Contratación</span>
                        <span id="icon-3" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-3" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
                        </div>
                    </div>
                </div>
                
                <!-- Planeación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(4)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Planeación</span>
                        <span id="icon-4" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-4" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
                        </div>
                    </div>
                </div>
                
                <!-- Trámites -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(5)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Trámites</span>
                        <span id="icon-5" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-5" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
                        </div>
                    </div>
                </div>
                
                <!-- Participa -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(6)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Participa</span>
                        <span id="icon-6" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-6" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
                        </div>
                    </div>
                </div>
                
                <!-- Datos Abiertos -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(7)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Datos Abiertos</span>
                        <span id="icon-7" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-7" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
                        </div>
                    </div>
                </div>
                
                <!-- Información Especifica para Grupos de Interés -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(8)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Información Especifica para Grupos de Interés</span>
                        <span id="icon-8" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-8" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
                        </div>
                    </div>
                </div>
                
                <!-- Obligación de Reporte de Información -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(9)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Obligación de Reporte de Información</span>
                        <span id="icon-9" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-9" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
                        </div>
                    </div>
                </div>
                
                <!-- Sección de Noticias -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white text-[#0047DC] border-t-8 border-[#0047DC] text-center justify-center content-center hover:bg-gray-100">
                    <button onclick="toggleAccordion(10)" class="w-full flex justify-between items-center py-5 text-slate-900 cursor-pointer">
                        <span class="px-4">Sección de Noticias</span>
                        <span id="icon-10" class="text-slate-900 transition-transform duration-300 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-to-line-icon lucide-arrow-up-to-line"><path d="M5 3h14"/><path d="m18 13-6-6-6 6"/><path d="M12 7v14"/></svg>
                        </span>
                    </button>
                    <div id="content-10" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-white px-4 rounded-lg">
                        <div class="pb-5 text-sm text-slate-900">
                            Material
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
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Radicación de Correspondecia y PQR en la web</a>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Sede Principal </h3>
                    <p class="text-sm text-black">Calle 21 No. 1C - 17</p>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Horarios de Atención</h3>
                    <p class="text-sm text-black">Lunes a Jueves: Mañana: 7AM a 12M - Tarde: 2PM a 6PM</p>
                    <p class="text-sm text-black">Viernes: Mañana: 7AM a 12M - Tarde: 2PM a 5PM</p>
                    <p class="text-sm text-black">Sedes</p>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Correo electrónico para notificaciones judiciales</h3>
                    <a href="mailto:notificacionesjudiciales@aguasdelhuila.gov.co" class="text-sm text-black hover:text-[#0047DC]">notificacionesjudiciales@aguasdelhuila.gov.co</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Servicio Ciudadano</a>
                    </br>
                    </br>
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-icon lucide-book-open"><path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/></svg>
                        Información de interés</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Datos abiertos</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Glosario</a></br>   
                    </br>   
                    <h3 class="text-md font-bold text-[#0047DC]">Estudios e investigaciones</h3>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Nacederos y fuentes hídiricas del departamento del Huila</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Convocatorias</a></br>
                    </br>   
                    <h3 class="text-md font-bold text-[#0047DC]">Para niños y niñas</h3>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Revista Súper Gota</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Buenas prácticas</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Noticias</a></br>
                    </br>   

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-panel-top-icon lucide-layout-panel-top"><rect width="18" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/></svg>
                    Estructura orgánica y talento humano</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Misión y Visión</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Funciones deberes</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Manual de Funciones</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Reglamento Interno de Trabajo</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Manual de Calidad</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Procesos y Documentos</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Organigrama</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Directorio de información de servidores públicos, empleados y contratistas SIGEP</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Directorio de entidades</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Informes de Talento Humano</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-text-icon lucide-notebook-text"><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9.5 8h5"/><path d="M9.5 12H16"/><path d="M9.5 16H14"/></svg>
                    Normatividad</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Normatividad Aguas del Huila</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Gaceta Departamental</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
                    Presupuesto</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Presupuesto</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Ejecución Presupuestal</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Estados financieros</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Manual de Contratación</a></br>
                    </br>   

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined"><path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/></svg>
                    Planeación</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Autodiagnóstico</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Presentación Rendición de Cuentas</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Código de Integridad del Servidor Público</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Plan de Desarrollo Institucional</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Plan Departamental de Aguas - PDA</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Plan de Desarrollo Departamental</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Planes de Acción</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Planes Institucionales</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Políticas</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Matriz de Riesgo</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Informe de gestión</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Modelo Integrado de Planeación y Gestión – MIPG</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Planes de Acción MIPG</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Gobierno Digital</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Matriz de Veedurías</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scan-search-icon lucide-scan-search"><path d="M3 7V5a2 2 0 0 1 2-2h2"/><path d="M17 3h2a2 2 0 0 1 2 2v2"/><path d="M21 17v2a2 2 0 0 1-2 2h-2"/><path d="M7 21H5a2 2 0 0 1-2-2v-2"/><circle cx="12" cy="12" r="3"/><path d="m16 16-1.9-1.9"/></svg>
                    Control</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Calidad del Agua 1 y 2 Bimenstre de 2021</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Información de Rendición de Cuentas</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Informe de Gestión</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Reportes Control Interno</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Informes pormenorizados del estado de Control Interno</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Plan Anticorrupción y Atención al Ciudadano</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Informe de indicadores</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Informes de ejecución presupuestal</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Entes de control</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Defensa Judicial</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Informes Auditorias Internas y Externas</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Planes de Mejoramiento Entes Externos</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Reportes PQR Electrónicas</a></br>
                    </br>

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/></svg>
                    Contratación</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Información Contratación SECOP</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Procesos de contratación</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Relación de contratos</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Proceso de Gestión de Bienes y Servicios</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones SECOP</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-left-icon lucide-arrow-right-left"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>
                    Trámites y Servicios</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Portal Gov.co</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">SUIT</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Procesos y Documentos</a></br>
                    </br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-left-icon lucide-arrow-right-left"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>
                    Instrumentos de gestión de información pública</h2>
                    </br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Información mínima requerida</a></br>   
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Esquema de publicación de información</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Gestión Documental</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Programa de Gestión Documental</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Tablas de Retención Documental - TRD</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">PINAR</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">SIC</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Procesos</a></br>
                    <a href="#" class="text-sm text-black hover:text-[#0047DC]">Procesos</a></br>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-from-line-icon lucide-arrow-up-from-line"><path d="m18 9-6-6-6 6"/><path d="M12 3v14"/><path d="M5 21h14"/></svg>
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
