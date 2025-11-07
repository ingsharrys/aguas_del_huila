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
        <div class="w-full h-[200px] sm:h-[150px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-2">Transparencia y Acceso a la Información Pública</h2>
                <p class="text-lg">Inicio / Institucional </span class="font-bold"> / Transparencia y Acceso a la Información Pública</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="prose max-w-none text-justify text-gray-900">
                De conformidad con lo establecido en la <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Ley_1712_Del_06_De_Marzo_De_2014.pdf" target="_blank" class="text-[#0047DC]" class="text-[#0047DC]">Ley 1712 de 2014</a>, el <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Decreto_103_Del_20_De_Enero_De_2015.pdf">Decreto 103 de 2015</a>&nbsp;compilado en el <a href="http://es.presidencia.gov.co/normativa/normativa/Decreto-1081-2015.pdf" target="_blank" class="text-[#0047DC]">Decreto 1081 de 2015</a> y la <a href="https://www.archivogeneral.gov.co/sites/default/files/Estructura_Web/3_Transparencia/Resolucion_3564_De_2015.pdf" target="_blank" class="text-[#0047DC]">Resolución 3564 de 2015</a> emitidos por MinTIC, se dispone para los interesados y el público en general la siguiente información:
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 my-4">
                
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
