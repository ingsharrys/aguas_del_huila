<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Entes de Control</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Entes de Control</h2>
                <p class="text-lg">Inicio / Transparencia y Acceso a la Información Pública</span class="font-bold"> / Entes de Control</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="prose max-w-none text-justify text-gray-900">
                Todas las personas en Colombia tienen derecho a verificar que los proyectos que ejecuten tengan en cuenta el interés de la comunidad y pueden ejercer acciones
                para lograr que los gobernantes reconozcan los derechos ciudadanos o cumplan las obligaciones que legalmente les corresponde. Este derecho y deber es lo que
                conocemos como Control ciudadano.
                </br>
                </br>
                De la misma manera a verificar que la administración pública y los particulares que representan servicios públicos cumplan su finalidad social y apliquen de manera transparente y eficiente los recursos públicos.
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-4">
                
                <!-- Contraloría General de la Nación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.contraloria.gov.co/" >Contraloría General de la Nación</a></h3>
                        <img src="{{ asset('storage/img/logo/logo-contraloria.png') }}" alt="Contraloría General de la Nación" title="Contraloría General de la Nación" class="justify-self-center my-2">
                        <p class="text-black">
                            La Contraloría General de la República (CGR) es el máximo órgano de control fiscal del Estado. Establece que el control financiero, de gestión y de resultados sobre las entidades que manejen fondos o bienes de la nación de acuerdo con lo especificado en el artículo 267 de la Constitución Política de Colombia de 1991.
                            </br>
                            </br>
                            Alguna de las áreas en las cuales puede efectuar auditorias son: Contratación, ejecución presupuestal, manejo contable y financiero, verificación de trámites internos, etc.
                            </br>
                            </br>
                            El control de la gestión fiscal comprende:
                            </br>
                            </br>
                            - Control de Gestión
                            </br>
                            - Control Financiero
                            </br>
                            - Control de Resultados
                            </br>
                            </br>
                            Es la institución encargada del control en la ejecución de los recursos del Estado; desarrolla la vigilancia de la gestión fiscal, con base en un procedimiento cuyas premisas son el control posterior y selectivo.
                            El control fiscal va dirigido a determinar la eficiencia, economía, equidad y valoración de los costos ambientales, con los cuales fueron ejecutados los recursos del Estado.
                        </p>
                    </div>
                </div>
                
                <!-- Contraloría Departamental del Huila -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.contraloriahuila.gov.co/" >Contraloría Departamental del Huila</a></h3>
                        <img src="{{ asset('storage/img/logo/logo-contraloria-huila.png') }}" alt="Contraloría Departamental del Huila" title="Contraloría Departamental del Huila" class="justify-self-center my-2">
                        <p class="text-black">
                            La vigilancia de la gestión fiscal del Estado se fundamenta en la eficiencia, la economía, le eficacia, la equidad y la valoración de los costos ambientales, de tal manera que permita determinar en la administración, en un período determinado, que la asignación de recursos sea la más conveniente para maximizar sus resultados, que en igualdad de condiciones de calidad los bienes y servicios se obtengan al menor costo; que sus resultados se logren de manera oportuna y guarden relación con sus objetivos y metas. Así mismo, que permita identificar los receptores de la acción, económica y analizar la distribución de costos y beneficios entre sectores económicos y sociales y entre entidades territoriales y cuantificar el impacto por el uso o deterioro de los recursos naturales y el medio ambiente y evaluar la gestión de protección, conservación, uso y explotación de los mismos.
                            </br>
                            </br>
                            La vigilancia de la gestión fiscal de los particulares se adelanta sobre el manejo de los recursos del Estado para verificar que estos cumplen con los objetivos previstos por la administración.
                        </p>
                    </div>
                </div>
                
                <!--  Procuraduría General de la Nación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.procuraduria.gov.co/Pages/Inicio.aspx" >Procuraduría General de la Nación</a></h3>
                        <img src="{{ asset('storage/img/logo/logo-procuraduria.png') }}" alt=" Procuraduría General de la Nación" title=" Procuraduría General de la Nación" class="justify-self-center my-2">
                        <p class="text-black">
                            Ejerce el control disciplinario del servidor público, adelantando las investigaciones y sancionando a los funcionarios que incurran en faltas disciplinarias en el desempeño de sus funciones; de igual manera adelanta las investigaciones cuando se presenten irregularidades en el manejo del patrimonio público, de conformidad con lo establecido en el Código Único Disciplinario ó Ley 734 de 2002.
                            </br>
                            </br>
                            Dentro de las funciones principales está vigilar la conducta de los funcionarios públicos, estableciendo las sanciones disciplinarias a que haya lugar cuando: violen la Constitución y las leyes, obtengan indebido provecho para sí de los recursos públicos, entorpezcan o sean negligentes en el desarrollo de investigaciones y no denuncien hechos delictivos de los cuales tengan conocimiento por el cargo que desempeñan.
                        </p>
                    </div>
                </div>
                
                <!--  Fiscalía General de la Nación -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.fiscalia.gov.co/colombia/" >Fiscalía General de la Nación</a></h3>
                        <img src="{{ asset('storage/img/logo/logo-fiscalia.png') }}" alt=" Fiscalía General de la Nación" title=" Fiscalía General de la Nación" class="justify-self-center my-2">
                        <p class="text-black">
                            Es una entidad de la rama judicial del poder público con plena autonomía administrativa y presupuestal, cuya función está orientada a brindar a los ciudadanos una cumplida y eficaz administración de justicia.
                            </br>
                            </br>
                            La Fiscalía General se encarga de investigar los delitos, calificar los procesos y acusar ante los jueces y tribunales competentes a los presuntos infractores de la ley penal, ya sea de oficio o por denuncia.
                            </br>
                            </br>
                            La investigación de oficio se realiza por iniciativa propia del Estado y la investigación por denuncia cuando existe un tercero es víctima de un delito e instaura la denuncia ante alguna de las autoridades competentes (Comisaría, Inspección de Policía o Unidad de Reacción Inmediata de la Fiscalía).
                        </p>
                    </div>
                </div>
                
                <!-- CAM -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.cam.gov.co/" >Corporacion Autonoma del Alto Magdalena - CAM  </a></h3>
                        <img src="{{ asset('storage/img/logo/cam-logo-2026.png') }}" alt="Corporacion Autonoma del Alto Magdalena - CAM " title="Corporacion Autonoma del Alto Magdalena - CAM " class="justify-self-center my-2">
                        <p class="text-black"><span class="text-[#00C81F]">Dirección: </span>Cra. 1 #60-79</p>
                        <p class="text-black"><span class="text-[#00C81F]">Teléfono: </span>(608) 8664454</p>
                        <p class="text-black"><span class="text-[#00C81F]">Correo: </span>radicacion@cam.gov.co</p>
                        <p class="text-black"><span class="text-[#00C81F]">Sitio Web: </span>https://www.cam.gov.co/</p>
                        <p class="text-black"><span class="text-[#00C81F]">Informar el tipo de control: </span>Seguimiento  de gestión </p>
                        <p class="text-black"><span class="text-[#00C81F]">Horarios de Atención: </span>Lunes a Jueves: 07:00 a.m. a 11:30 m. y 01:00 p.m. a 4:30 p.m. Viernes: 07:00 a.m. a 12:00 m. y 01:00 p.m. a 04:00 pm</p>
                    </div>
                </div>
                
                <!-- CRA -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.cra.gov.co/" >Comisión de Regulacion de Agua y Saneamiento Básico - CRA</a></h3>
                        <img src="{{ asset('storage/img/logo/logo-cra-2026.png') }}" alt="Comisión de Regulacion de Agua y Saneamiento Básico - CRA" title="Comisión de Regulacion de Agua y Saneamiento Básico - CRA" class="justify-self-center my-2">
                        <p class="text-black"><span class="text-[#00C81F]">Dirección: </span>Carrera 12 N° 97-80, Piso 2</p>
                        <p class="text-black"><span class="text-[#00C81F]">Teléfono: </span>01 8000 517565</p>
                        <p class="text-black"><span class="text-[#00C81F]">Correo: </span>correo@cra.gov.co</p>
                        <p class="text-black"><span class="text-[#00C81F]">Sitio Web: </span>https://www.cra.gov.co/</p>
                        <p class="text-black"><span class="text-[#00C81F]">Informar el tipo de control: </span>Regulatorio</p>
                        <p class="text-black"><span class="text-[#00C81F]">Horarios de Atención: </span>lunes a viernes de 8:00 am. a 4:00 pm.</p>
                    </div>
                </div>
                
                <!-- Departamento Administrativo de la Funcion Publica -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.funcionpublica.gov.co/" >Departamento Administrativo de la Funcion Publica</a></h3>
                        <img src="{{ asset('storage/img/logo/logo-funcion-publica.png') }}" alt="Departamento Administrativo de la Funcion Publica " title="Departamento Administrativo de la Funcion Publica " class="justify-self-center my-2">
                        <p class="text-black"><span class="text-[#00C81F]">Dirección: </span>Carrera 6 # 12-62 Bogotá D.C.2</p>
                        <p class="text-black"><span class="text-[#00C81F]">Teléfono: </span>601 7395656 </p>
                        <p class="text-black"><span class="text-[#00C81F]">Correo: </span>eva@funcionpublica.gov.co</p>
                        <p class="text-black"><span class="text-[#00C81F]">Sitio Web: </span>https://www.funcionpublica.gov.co/</p>
                        <p class="text-black"><span class="text-[#00C81F]">Informar el tipo de control: </span>Administrativo</p>
                        <p class="text-black"><span class="text-[#00C81F]">Horarios de Atención: </span>lunes a viernes en horario de 8:00 a.m. a 4:00 p.m</p>
                    </div>
                </div>
                
                <!-- Funcion Pública -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.funcionpublica.gov.co/" >Funcion Pública</a></h3>
                        <img src="{{ asset('storage/img/logo/logo-funcion-publica.png') }}" alt="Funcion Pública" title="Funcion Pública" class="justify-self-center my-2">
                        <p class="text-black"><span class="text-[#00C81F]">Dirección: </span>Carrera 6 No. 12-62, Bogotá D. C., Colombia</p>
                        <p class="text-black"><span class="text-[#00C81F]">Teléfono: </span>(+57) 601 5956600</p>
                        <p class="text-black"><span class="text-[#00C81F]">Correo: </span>eva@funcionpublica.gov.co</p>
                        <p class="text-black"><span class="text-[#00C81F]">Sitio Web: </span>https://www.funcionpublica.gov.co/</p>
                        <p class="text-black"><span class="text-[#00C81F]">Informar el tipo de control: </span>preventivo, orientador y evaluador</p>
                        <p class="text-black"><span class="text-[#00C81F]">Horarios de Atención: </span>lunes a viernes en horario de 8:00 a.m. a 4:00 p.m</p>
                    </div>
                </div>
                
                <!-- Superintendencia de Servicios Públicos Domiciliarios -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.superservicios.gov.co/" >Superintendencia de Servicios Públicos Domiciliarios  </a></h3>
                        <img src="{{ asset('storage/img/logo/logo-superservicios.png') }}" alt="Superintendencia de Servicios Públicos Domiciliarios " title="Superintendencia de Servicios Públicos Domiciliarios " class="justify-self-center my-2">
                        <p class="text-black"><span class="text-[#00C81F]">Dirección: </span>Carrera 18 No. 84-35</p>
                        <p class="text-black"><span class="text-[#00C81F]">Teléfono: </span>601-691-3005</p>
                        <p class="text-black"><span class="text-[#00C81F]">Correo: </span>sspd@superservicios.gov.co</p>
                        <p class="text-black"><span class="text-[#00C81F]">Sitio Web: </span>https://www.superservicios.gov.co/</p>
                        <p class="text-black"><span class="text-[#00C81F]">Informar el tipo de control: </span>Regulatorio</p>
                        <p class="text-black"><span class="text-[#00C81F]">Horarios de Atención: </span>Lunes a viernes de 7:00 a. m. a 4:00 p. m.</p>
                    </div>
                </div>

                      
                <!-- Veedurías Ciudadanas -->
                <div class="w-full h-auto rounded-lg shadow-md bg-white border-t-8 border-[#0047DC] justify-center content-start hover:bg-gray-100 px-4 py-2">
                    <div>
                        <h3 class="text-center text-[#0047DC] text-xl hover:text-[#00C81F]"><a href="https://www.huila.gov.co/" >Veedurías Ciudadanas</a></h3>
                        <img src="{{ asset('storage/img/logo/logo-gobernacion-huila.png') }}" alt="Veedurías Ciudadanas" title="Veedurías Ciudadanas" class="justify-self-center my-2">
                        <p class="text-black">
                            <span class="text-[#00C81F]">Ley 850 de 2003: </span>
                            Es la potestad y el deber que tienen todos los ciudadanos y asociaciones comunitarias de vigilar y controlar la gestión pública y sus resultados, con sujeción al servicio de los intereses generales y la observancia de los principios constitucionales.
                            </br>
                            </br>
                            Ejercen vigilancia preventiva y posterior al proceso de gestión administrativa, haciendo recomendaciones escritas y oportunas ante las entidades que ejecutan el programa, proyecto y contrato o ante los organismos de control del Estado para mejorar la eficiencia institucional y la actuación de los funcionarios públicos.
                            </br>
                            </br>
                            Funciones
                            </br>
                            </br>                            
                            - Vigilar los procesos de planeación, para que conforme a la Constitución y la ley se dé participación a la comunidad.
                            </br>
                            - Vigilar que en la asignación de los presupuestos se prevea prioritariamente la solución a necesidades básicas insatisfechas según criterios, de celeridad, equidad y eficacia.
                            </br>
                            - Vigilar porque el proceso de contratación se realice de a cuerdo con los criterios legales.
                            </br>
                            - Vigilar y fiscalizar la ejecución y calidad técnica de las obras, programas e inversiones en el correspondiente nivel territorial.
                            </br>
                            - Recibir los informes, observaciones y sugerencias que presenten los ciudadanos y sus organizaciones en relación con las obras o programas que son objeto de veeduría.
                            </br>
                            - Solicitar a interventores, supervisores, contratistas, ejecutores, autoridades contratantes y demás autoridades concernientes, los informes, presupuestos, fichas técnicas y demás documentos que permitan conocer el cumplimiento de los respectivos programas, contratos o proyectos.
                            </br>
                            - Comunicar a la ciudadanía, mediante asambleas generales o en reuniones, los avances de los procesos de control o vigilancia que estén desarrollando.
                            </br>
                            - Remitir a las autoridades correspondientes los informes que se desprendan de la función de control y vigilancia en relación con los asuntos que son objeto de la veeduría.
                            </br>
                            - Denunciar ante las autoridades competentes los hechos o actuaciones irregulares de los funcionarios públicos.
                        </p>
                    </div>
                </div>

            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
