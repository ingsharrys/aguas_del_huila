<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Participa</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Participa</h2>
                <p class="text-lg">Inicio </span class="font-bold"> / Participa</span></p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
                <!-- ¿Qué es el menú Participa? -->
                <div class="bg-white shadow rounded-lg p-6 border-t-8 border-[#0047DC]">
                    <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                        ¿Qué es el menú Participa?
                    </h2>
        
                    <p class="space-y-2 text-black">El menú participa se trata de los espacios, mecanismos y acciones que permiten la participación ciudadana en el ciclo de la gestión pública, con el propósito de dinamizar la vinculación de la ciudadanía en las decisiones y acciones públicas, durante el diagnóstico, formulación, implementación, evaluación y seguimiento a la gestión institucional.</p>
                </div>
                
                <div class="bg-white shadow rounded-lg p-6 border-t-8 border-[#0047DC]">
                    <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                        ¿Cómo se puede Participar?
                    </h2>
        
                    <p class="space-y-2 text-black">Con el fin de facilitar el ejercicio de control social a la gestión pública, dando a conocer la oferta institucional donde podrá participar la ciudadanía para apoyar la construcción de políticas, planes, programas y proyectos de Aguas Del Huila S.A. E.S.P.</p>
                </div>
        
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8" x-data="{ tab: 'general' }">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Columna izquierda: Tabs -->
                <div class="border-r pr-4">
                    <ul class="space-y-2">

                        <li>
                            <button
                                @click="tab = 'general'"
                                :class="tab === 'general'
                                    ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                Descripción general del menú "PARTICIPA"
                            </button>
                        </li>

                        <li>
                            <button
                                @click="tab = 'diagnostico'"
                                :class="tab === 'diagnostico'
                                    ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                Diagnóstico de evidencias e identificación de problemas
                            </button>
                        </li>

                        <li>
                            <button
                                @click="tab = 'planeacion'"
                                :class="tab === 'planeacion'
                                    ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                Planeación y presupuesto participativo
                            </button>
                        </li>

                        <li>
                            <button
                                @click="tab = 'consulta'"
                                :class="tab === 'consulta'
                                    ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                Consulta ciudadana
                            </button>
                        </li>

                        <li>
                            <button
                                @click="tab = 'innovacion'"
                                :class="tab === 'innovacion'
                                    ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                Colaboración e innovación abierta
                            </button>
                        </li>

                        <li>
                            <button
                                @click="tab = 'rendicion'"
                                :class="tab === 'rendicion'
                                    ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                Rendición de cuentas
                            </button>
                        </li>

                        <li>
                            <button
                                @click="tab = 'control'"
                                :class="tab === 'control'
                                    ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                Control social
                            </button>
                        </li>

                    </ul>
                </div>

                <!-- Columna derecha: Contenido -->
                <div class="lg:col-span-2">

                    <div x-show="tab === 'general'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                            Descripción general del menú "PARTICIPA"
                        </h2>

                        <div class="text-gray-900 leading-relaxed text-justify">
                            Aquí encontrará información sobre los espacios, mecanismos y acciones
                            que el DNP implementa en cumplimiento de la política de participación
                            ciudadana en la gestión pública, con el propósito de fortalecer la
                            vinculación de la ciudadanía, grupos de interés y de valor, en las
                            decisiones y acciones públicas durante las fases del ciclo de la gestión
                            pública (diagnóstico, formulación, implementación, evaluación y
                            seguimiento), conforme a la Ley 1757 de 2015, Ley 1712 de 2014, Ley 489
                            de 1998, Decreto 1499 de 2017 y la Resolución 1519 de 2020.
                        </div>
                        
                        <p class="text-gray-900 leading-relaxed text-justify mt-4">
                            Aguas del Huila S.A. E.S.P. le invita a participar en la encuesta de satisfacción del cliente, con el fin de conocer su opinión sobre los servicios prestados y mejorar continuamente la calidad de atención.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
    
                            <a href="https://aguasdelhuila.gov.co/documentos/actividades-de-participacion-ciudadana/resultados-de-la-encuesta-de-satisfaccion-del-cliente" aria-label="Resultados de la encuesta de satisfacción del cliente" class="text-white px-4 py-2 rounded-full bg-[#008A14] hover:bg-green-800 transition">
                                Resultados de la encuesta de satisfacción del cliente
                            </a>
    
                            <a href="https://aguasdelhuila.gov.co/documentos/actividades-de-participacion-ciudadana/estrategia-de-participacion-ciudadana" aria-label="Control Social" class="text-white px-4 py-2 rounded-full bg-[#008A14] hover:bg-green-800 transition">
                                Estrategía de participación ciudadana
                            </a>
    
                            <a href="https://aguasdelhuila.gov.co/archivos/documentos/planes-institucionales-2026/3-programa-de-transparencia-y-etica-publica-2026" aria-label="Programa de Transparencia y Etica Publica 2026" class="text-white px-4 py-2 rounded-full bg-[#008A14] hover:bg-green-800 transition">
                                Programa de Transparencia y Etica Publica 2026
                            </a>
                            
                        </div>
                    </div>

                    <div x-show="tab === 'diagnostico'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                            Diagnóstico de evidencias e identificación de problemas
                        </h2>

                        <div class="text-gray-900 leading-relaxed text-justify">
                            El diagnóstico de necesidades y la identificación de problemas implican
                            involucrar a los ciudadanos en la recopilación y análisis de información,
                            con el fin de reconocer y comprender los asuntos que los afectan directa
                            o indirectamente. Este proceso permite identificar las dificultades y
                            requerimientos de los grupos de interés de la organización.
                        </div>

                        </br> 

                        <a href="https://aguasdelhuila.gov.co/documentos/diagnostico-de-evidencias-e-identificacion-de-problemas" aria-label="Diagnóstico de evidencias e identificación de problemas" class="text-white px-4 py-2 rounded-full bg-[#008A14] hover:bg-green-800 transition">
                            Documentación
                        </a>
                    </div>

                    <div x-show="tab === 'planeacion'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                            Planeación y presupuesto participativo
                        </h2>

                        <div class="text-gray-900 leading-relaxed text-justify">
                            El presupuesto participativo es el proceso mediante el cual la ciudadanía
                            asigna recursos a programas y proyectos prioritarios. No obstante, de
                            acuerdo con los artículos 89, 90 y 91 de la Ley 1757 de 2015, Aguas del
                            Huila S.A. E.S.P. no se encuentra obligada a implementar presupuesto
                            participativo.
                        </div>
                    </div>

                    <div x-show="tab === 'consulta'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                            Consulta ciudadana
                        </h2>

                        <div class="text-gray-900 leading-relaxed text-justify">
                            Es un mecanismo participativo que busca obtener ideas, recomendaciones,
                            comentarios y propuestas de los ciudadanos frente a proyectos, políticas,
                            programas o procesos adelantados por la entidad antes de que se adopten
                            decisiones definitivas.
                        </div>
                    </div>

                    <div x-show="tab === 'innovacion'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                            Colaboración e innovación abierta
                        </h2>

                        <div class="text-gray-900 leading-relaxed text-justify">
                            Fomenta la colaboración y el intercambio de ideas para promover la
                            innovación en la solución de problemas y el desarrollo de proyectos que
                            beneficien a la comunidad.
                        </div>

                        <div style="display: flex; align-items: center; justify-content: center; gap: 20px;">
                            <a style="justify-items: center;" href="https://experience.arcgis.com/experience/9699ecc434ae491698a2f4688b1a351e" target="_blank" rel="noopener">
                                <img src="https://aguasdelhuila.gov.co/storage/img/icono_aguas_location.png" alt="Diagnostico Sanitario Rural 2025">Geovisor Diagn&oacute;stico Rural Sanitario 2025
                            </a>
                            
                            <a style="justify-items: center;" href="https://aguasdelhuila.gov.co/nacederos" rel="noopener">
                                <img src="https://aguasdelhuila.gov.co/storage/img/plan-departamental.png" alt="Nacederos">Nacederos
                            </a>
                        </div>
                    </div>

                    <div x-show="tab === 'rendicion'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                            Rendición de cuentas
                        </h2>

                        <div class="text-gray-900 leading-relaxed text-justify">
                            Conoce y evalúa los informes de rendición de cuentas para asegurar que
                            las acciones y resultados estén alineados con los compromisos adquiridos,
                            fortaleciendo la transparencia y la responsabilidad institucional.
                        </div>

                        </br> 

                        <a href="https://aguasdelhuila.gov.co/documentos/rendicion-de-cuentas" aria-label="Rendición de Cuentas" class="text-white px-4 py-2 rounded-full bg-[#008A14] hover:bg-green-800 transition">
                            Documentación
                        </a>
                    </div>

                    <div x-show="tab === 'control'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">
                            Control social
                        </h2>

                        <div class="text-gray-900 leading-relaxed text-justify">
                            Promueve la participación activa de la ciudadanía en el seguimiento y
                            vigilancia de programas, proyectos y contratos, contribuyendo a
                            garantizar la transparencia, la legalidad y la eficiencia en la gestión
                            pública.
                        </div>

                        </br> 

                        <a href="https://aguasdelhuila.gov.co/documentos/control-social" aria-label="Control Social" class="text-white px-4 py-2 rounded-full bg-[#008A14] hover:bg-green-800 transition">
                            Documentación
                        </a>
                    </div>


                </div>
            </div>
        </section>


        @include('partials.footer')

    </body>
</html>
