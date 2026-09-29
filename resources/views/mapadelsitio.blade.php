<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Mapa del Sitio</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Mapa del Sitio</h2>
                <p class="text-lg">Inicio </span class="font-bold"> / Mapa del Sitio</span></p>
            </div>
        </div>

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
                    <a href="{{ route('pqr') }}" class="text-sm text-black hover:text-[#0047DC]">Radicación de Correspondecia y PQRSDF en la web</a>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Sede Principal </h3>
                    <p class="text-sm text-black">Calle 21 No. 1C - 17</p>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Horarios de Atención</h3>
                    <p class="text-sm text-black">Lunes a Jueves: Mañana: 7AM a 12M - Tarde: 2PM a 6PM</p>
                    <p class="text-sm text-black">Viernes: Mañana: 7AM a 12M - Tarde: 2PM a 5PM</p>
                    <a href="{{ route('oficinas') }}" class="text-sm text-black hover:text-[#0047DC]">Oficinas de Aguas del Huila</a>
                    </br>
                    </br>
                    <h3 class="text-md font-bold text-[#0047DC]">Correo electrónico para notificaciones judiciales</h3>
                    <a href="mailto:notificacionesjudiciales@aguasdelhuila.gov.co" class="text-sm text-black hover:text-[#0047DC]">notificacionesjudiciales@aguasdelhuila.gov.co</a></br>
                    <a href="{{ route('posts.file', 'servicio-ciudadano') }}" class="text-sm text-black hover:text-[#0047DC]">Servicio Ciudadano</a>
                    </br>
                    </br>
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-icon lucide-book-open"><path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/></svg>
                        Información de interés</h2>
                    </br>
                    <a href="https://www.datos.gov.co/browse?q=aguas+del+huila+&sortBy=relevance&page=1&pageSize=20" class="text-sm text-black hover:text-[#0047DC]">Datos abiertos</a></br>   
                    <a href="{{ route('glosario') }}" class="text-sm text-black hover:text-[#0047DC]">Glosario</a></br>   
                    </br>   
                    <h3 class="text-md font-bold text-[#0047DC]">Estudios e investigaciones</h3>
                    <a href="{{ route('nacederos') }}" class="text-sm text-black hover:text-[#0047DC]">Nacederos y fuentes hídiricas del departamento del Huila</a></br>   
                    <a href="{{ route('convocatoria') }}" class="text-sm text-black hover:text-[#0047DC]">Convocatorias</a></br>
                    </br>   
                    <h3 class="text-md font-bold text-[#0047DC]">Para niños y niñas</h3>
                    <a href="{{ route('posts.file', 'buenas-practicas') }}" class="text-sm text-black hover:text-[#0047DC]">Buenas prácticas</a></br>
                    <a href="{{ route('noticias.blog') }}" class="text-sm text-black hover:text-[#0047DC]">Noticias</a></br>
                    </br>   

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-panel-top-icon lucide-layout-panel-top"><rect width="18" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/></svg>
                    Estructura orgánica y talento humano</h2>
                    </br>
                    <a href="{{ route('historia') }}" class="text-sm text-black hover:text-[#0047DC]">Misión y Visión</a></br>   
                    <a href="https://aguasdelhuila.gov.co/institucional/funciones-generales" class="text-sm text-black hover:text-[#0047DC]">Funciones deberes</a></br>
                    <a href="{{ route('posts.file', 'manual-de-funciones') }}" class="text-sm text-black hover:text-[#0047DC]">Manual de Funciones</a></br>
                    <a href="/storage/posts/archivos/2022/REGLAMENTO%20INTERNO%20DE%20TRABAJO.pdf" class="text-sm text-black hover:text-[#0047DC]">Reglamento Interno de Trabajo</a></br>
                    <a href="/storage/posts/archivos/MANUAL%20DE%20CALIDAD%20ISO%209001-2015.pdf" class="text-sm text-black hover:text-[#0047DC]">Manual de Calidad</a></br>
                    <a href="{{ route('posts.download') }}" class="text-sm text-black hover:text-[#0047DC]">Documentos</a></br>
                    <a href="{{ route('organigrama') }}" class="text-sm text-black hover:text-[#0047DC]">Organigrama</a></br>
                    <a href="{{ route('directorio') }}" class="text-sm text-black hover:text-[#0047DC]">Directorio de información de servidores públicos, empleados y contratistas SIGEP</a></br>
                    <a href="{{ url('/') }}#directorio-de-entidades" class="text-sm text-black hover:text-[#0047DC]">Directorio de entidades</a></br>
                    <a href="{{ route('posts.file', 'talento-humano') }}" class="text-sm text-black hover:text-[#0047DC]">Informes de Talento Humano</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-text-icon lucide-notebook-text"><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9.5 8h5"/><path d="M9.5 12H16"/><path d="M9.5 16H14"/></svg>
                    Normatividad</h2>
                    </br>
                    <a href="{{ route('posts.file', 'normatividad') }}" class="text-sm text-black hover:text-[#0047DC]">Normatividad Aguas del Huila</a></br>   
                    <a href="https://www.huila.gov.co/publicaciones/7158/gaceta-departamental/" class="text-sm text-black hover:text-[#0047DC]">Gaceta Departamental</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
                    Presupuesto</h2>
                    </br>
                    <a href="{{ route('posts.file', 'presupuesto') }}" class="text-sm text-black hover:text-[#0047DC]">Presupuesto</a></br>   
                    <a href="{{ route('posts.file', 'ejecucion-presupuestal') }}" class="text-sm text-black hover:text-[#0047DC]">Ejecución Presupuestal</a></br>   
                    <a href="{{ route('posts.file', 'estados-financieros') }}" class="text-sm text-black hover:text-[#0047DC]">Estados financieros</a></br>   
                    <a href="/storage/posts/archivos/2016/ACUERDO%20%20007%20DE%202016-%20MANUAL%20DE%20CONTRATACION.pdf" class="text-sm text-black hover:text-[#0047DC]">Manual de Contratación</a></br>
                    </br>   
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-traffic-cone-icon lucide-traffic-cone"><path d="M16.05 10.966a5 2.5 0 0 1-8.1 0"/><path d="m16.923 14.049 4.48 2.04a1 1 0 0 1 .001 1.831l-8.574 3.9a2 2 0 0 1-1.66 0l-8.574-3.91a1 1 0 0 1 0-1.83l4.484-2.04"/><path d="M16.949 14.14a5 2.5 0 1 1-9.9 0L10.063 3.5a2 2 0 0 1 3.874 0z"/><path d="M9.194 6.57a5 2.5 0 0 0 5.61 0"/></svg>
                    Transparencia Pasiva</h2>
                    </br>
                    <a href="{{ route('pqr') }}" class="text-sm text-black hover:text-[#0047DC]">Consultar estado de PQRSDF</a></br>   
                    </br>   

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined"><path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/></svg>
                    Planeación</h2>
                    </br>
                    <a href="{{ route('posts.file', 'autodiagnosticos') }}" class="text-sm text-black hover:text-[#0047DC]">Autodiagnóstico</a></br>   
                    <a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" class="text-sm text-black hover:text-[#0047DC]">Presentación Rendición de Cuentas</a></br>
                    <a href="{{ route('posts.file', 'codigo-de-integridad') }}" class="text-sm text-black hover:text-[#0047DC]">Código de Integridad del Servidor Público</a></br>
                    <a href="{{ route('posts.file', 'plan-de-desarrollo-institucional') }}" class="text-sm text-black hover:text-[#0047DC]">Plan de Desarrollo Institucional</a></br>
                    <a href="{{ route('posts.show') }}" class="text-sm text-black hover:text-[#0047DC]">Plan Departamental de Aguas - PDA</a></br>
                    <a href="{{ route('posts.file', 'planes-de-desarrollo-departamental') }}" class="text-sm text-black hover:text-[#0047DC]">Plan de Desarrollo Departamental</a></br>
                    <a href="{{ route('posts.file', 'planes-de-accion') }}" class="text-sm text-black hover:text-[#0047DC]">Planes de Acción</a></br>
                    <a href="{{ route('posts.file', 'planes-institucionales') }}" class="text-sm text-black hover:text-[#0047DC]">Planes Institucionales</a></br>
                    <a href="{{ route('posts.file', 'politicas') }}" class="text-sm text-black hover:text-[#0047DC]">Políticas</a></br>
                    <a href="{{ route('posts.file', 'plan-anual-de-adquisiciones') }}" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones</a></br>
                    <a href="{{ route('posts.file', 'riesgos') }}" class="text-sm text-black hover:text-[#0047DC]">Matriz de Riesgo</a></br>
                    <a href="{{ route('posts.file', 'informes-de-gestion') }}" class="text-sm text-black hover:text-[#0047DC]">Informe de gestión</a></br>
                    <a href="{{ route('posts.file', 'mipg') }}" class="text-sm text-black hover:text-[#0047DC]">Modelo Integrado de Planeación y Gestión – MIPG</a></br>
                    <a href="{{ route('posts.file', 'planes-de-accion-mipg') }}" class="text-sm text-black hover:text-[#0047DC]">Planes de Acción MIPG</a></br>
                    <a href="{{ route('posts.file', 'gobierno-digital') }}" class="text-sm text-black hover:text-[#0047DC]">Gobierno Digital</a></br>
                    <a href="{{ route('posts.file', 'matriz-de-veedurias') }}" class="text-sm text-black hover:text-[#0047DC]">Matriz de Veedurías</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scan-search-icon lucide-scan-search"><path d="M3 7V5a2 2 0 0 1 2-2h2"/><path d="M17 3h2a2 2 0 0 1 2 2v2"/><path d="M21 17v2a2 2 0 0 1-2 2h-2"/><path d="M7 21H5a2 2 0 0 1-2-2v-2"/><circle cx="12" cy="12" r="3"/><path d="m16 16-1.9-1.9"/></svg>
                    Control</h2>
                    </br>
                    <a href="/storage/posts/archivos/2021/certificado%20cargue%20sui%20calidad%20agua%201%20y%202%20bimestre%202021.pdf" class="text-sm text-black hover:text-[#0047DC]">Calidad del Agua 1 y 2 Bimenstre de 2021</a></br>   
                    <a href="{{ route('posts.file', 'rendicion-de-cuentas') }}" class="text-sm text-black hover:text-[#0047DC]">Información de Rendición de Cuentas</a></br>
                    <a href="{{ route('posts.file', 'informes-de-gestion') }}" class="text-sm text-black hover:text-[#0047DC]">Informe de Gestión</a></br>
                    <a href="{{ route('posts.file', 'control-interno') }}" class="text-sm text-black hover:text-[#0047DC]">Reportes Control Interno</a></br>
                    <a href="{{ route('posts.file', 'informe-pormenorizado') }}" class="text-sm text-black hover:text-[#0047DC]">Informes pormenorizados del estado de Control Interno</a></br>
                    <a href="{{ route('posts.file', 'plan-anticorrupcion-y-atencion-al-ciudadano') }}" class="text-sm text-black hover:text-[#0047DC]">Plan Anticorrupción y Atención al Ciudadano</a></br>
                    <a href="{{ route('posts.file', 'indicadores') }}" class="text-sm text-black hover:text-[#0047DC]">Informe de indicadores</a></br>
                    <a href="{{ route('posts.file', 'ejecucion-presupuestal') }}" class="text-sm text-black hover:text-[#0047DC]">Informes de ejecución presupuestal</a></br>
                    <a href="{{ route('entescontrol') }}" class="text-sm text-black hover:text-[#0047DC]">Entes de control</a></br>
                    <a href="{{ route('posts.file', 'defensa-judicial') }}" class="text-sm text-black hover:text-[#0047DC]">Defensa Judicial</a></br>
                    <a href="{{ route('posts.file', 'informes-auditorias-internas-y-externas') }}" class="text-sm text-black hover:text-[#0047DC]">Informes Auditorias Internas y Externas</a></br>
                    <a href="{{ route('posts.file', 'planes-de-mejoramiento-entes-externos') }}" class="text-sm text-black hover:text-[#0047DC]">Planes de Mejoramiento Entes Externos</a></br>
                    <a href="{{ route('posts.file', 'reportes-pqr-electronicas') }}" class="text-sm text-black hover:text-[#0047DC]">Reportes PQR Electrónicas</a></br>
                    </br>

                </div>

                <div class="w-full">

                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/></svg>
                    Contratación</h2>
                    </br>
                    <a href="https://www.contratos.gov.co/consultas/inicioConsulta.do" class="text-sm text-black hover:text-[#0047DC]">Información Contratación SECOP</a></br>   
                    <a href="https://procesos.aguasdelhuila.gov.co/login" class="text-sm text-black hover:text-[#0047DC]">Procesos de contratación</a></br>
                    <a href="{{ route('posts.file', 'contratacion') }}" class="text-sm text-black hover:text-[#0047DC]">Relación de contratos</a></br>
                    <a href="https://extranet.aguasdelhuila.gov.co/login.aspx?returnurl=%2f%3fcomponente%3deyt.gestiondocumental_procesosdocumentos_consulta##IDT4" class="text-sm text-black hover:text-[#0047DC]">Proceso de Gestión de Bienes y Servicios</a></br>
                    <a href="{{ route('posts.file', 'plan-anual-de-adquisiciones') }}" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones</a></br>
                    <a href="https://www.contratos.gov.co/consultas/consultarArchivosPAA2020.do" class="text-sm text-black hover:text-[#0047DC]">Plan anual de adquisiciones SECOP</a></br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-left-icon lucide-arrow-right-left"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>
                    Trámites y Servicios</h2>
                    </br>
                    <a href="{{ route('pagos') }}" class="text-sm text-black hover:text-[#0047DC]">Pagos en Línea</a></br>   
                    <a href="https://www.gov.co/" class="text-sm text-black hover:text-[#0047DC]">Portal Gov.co</a></br>   
                    <a href="https://www1.funcionpublica.gov.co/web/suit/buscadortramites" class="text-sm text-black hover:text-[#0047DC]">SUIT</a></br>
                    <a href="https://extranet.aguasdelhuila.gov.co/site.aspx?Codigo=07DA00A4-CD98-435F-BF5E-97CAE8D8C520" class="text-sm text-black hover:text-[#0047DC]">Procesos y Documentos</a></br>
                    </br>
                    </br>   
                    <h2 class="flex gap-4 text-xl font-bold text-[#0047DC]"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wrench-icon lucide-wrench"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.106-3.105c.32-.322.863-.22.983.218a6 6 0 0 1-8.259 7.057l-7.91 7.91a1 1 0 0 1-2.999-3l7.91-7.91a6 6 0 0 1 7.057-8.259c.438.12.54.662.219.984z"/></svg>
                    Instrumentos de gestión de información pública</h2>
                    </br>  
                    <a href="/storage/posts/archivos/2019/GobiernoDigital/Esquema%20de%20publicacion%20de%20informacion.xlsx" class="text-sm text-black hover:text-[#0047DC]">Esquema de publicación de información</a></br>
                    <a href="{{ route('posts.file', 'contratacion') }}" class="text-sm text-black hover:text-[#0047DC]">Gestión Documental</a></br>
                    <a href="{{ route('posts.file', 'gestion-documental') }}" class="text-sm text-black hover:text-[#0047DC]">Programa de Gestión Documental</a></br>
                    <a href="{{ route('posts.file', 'trd') }}" class="text-sm text-black hover:text-[#0047DC]">Tablas de Retención Documental - TRD</a></br>
                    <a href="{{ route('posts.file', 'gestion-documental') }}" class="text-sm text-black hover:text-[#0047DC]">PINAR</a></br>
                    <a href="{{ route('posts.file', 'gestion-documental') }}" class="text-sm text-black hover:text-[#0047DC]">SIC</a></br>
                    <a href="{{ route('pqr') }}" class="text-sm text-black hover:text-[#0047DC]">Radicación de Correspondecia y PQRSDF en la web</a></br>
                    <a href="{{ route('posts.file', 'informes-pqr') }}" class="text-sm text-black hover:text-[#0047DC]">Informes PQRSDF</a></br>
                    </br>

                </div>

            </div>

        </section>


        @include('partials.footer')

    </body>
</html>
