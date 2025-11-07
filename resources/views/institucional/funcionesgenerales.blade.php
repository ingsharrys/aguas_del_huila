<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Funciones Generales</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-2">Funciones Generales</h2>
                <p class="text-lg">Inicio / Institucional </span class="font-bold"> / Funciones Generales</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="grid grid-cols-1 gap-8">
                <div class="w-full mx-auto">

                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Objeto Social:</h3>

                    <div class="prose max-w-none text-justify text-gray-900">
                        Aguas del Huila, es una empresa que tiene por objeto la explotación, prestación, operación, admiración, distribución, generación y comercialización de los servicios públicos de acueducto , alcantarillado, aseo , gas combustible y mejoramiento de infraestructura vial y sus actividades complementarias y conexas , incluyendo la gestión ambiental , propias de todos y cada uno de los servicios que se indica en este objeto y de acuerdo al marco legal regulatorio.
                    </div>

                    </br>
                    </br>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-gray-900">
                        <ol class="list-decimal pl-4">
                            <li>Administrar, operar y mantener servicios públicos domiciliarios de acueducto, alcantarillado, aseo, recolección de residuos orgánicos, inorgánicos y peligrosos, energía eléctrica, al igual que el servicio de alumbrado público y gas combustible y las actividades complementarias a cada uno de dichos servicios, que se reciban mediante convenios y/o contratos de operación en el territorio nacional con sujeción a las normas legales vigentes.</li>
                            <li>Construir obras de infraestructura para los servicios de Acueducto, Alcantarillado, Aseo, energía eléctrica, alumbrado público, y gas combustible.</li>
                            <li>Ofrecer asistencia, asesoría y capacitación a los municipios, departamentos, empresas y comunidades en general en aspectos como administración, operación, mantenimiento y construcción de los sistemas para la prestación de los servicios de Acueducto, Alcantarillado, Aseo, Energía eléctrica y gas combustible.</li>
                            <li>Coordinar, asesorar y realizar estudios y proyectos de infraestructura, para la prestación de los servicios de agua potable, saneamiento básico, generación y distribución de energía eléctrica, de alumbrado público y distribución de gas combustible.</li>
                            <li>Brindar asesoría en el cumplimiento de las normas técnicas y ambientales sobre diseño, construcción, operación y mantenimiento de los servicios de agua potable, saneamiento básico, generación y distribución de energía eléctrica, de alumbrado público y de gas combustible.</li>
                            <li>Asistir a los Municipios en la elaboración de la planeación física, la determinación de los costos de los proyectos y la obtención de los recursos financieros para su ejecución.    </li>
                            <li>Asesorar a las entidades y unidades administradoras de los servicios en el componente tarifario, de gestión empresarial y fortalecimiento institucional para la eficiente prestación de los servicios de acueducto, alcantarillado, aseo, energía eléctrica, alumbrado público y gas combustible.</li>
                            <li>Promover y ejecutar los programas sectoriales de agua potable y saneamiento básico rural y urbano, con mecanismos de participación comunitaria y administración directa de los servicios de acuerdo con los planes y programas de la política pública sectorial definida por el gobierno nacional y de acuerdo a los objetivos del Gobierno Departamental y de los Gobiernos Municipales.</li>
                            <li>Comercializar bienes y productos que se requieran para la adecuada operación y funcionamiento de los sistemas tales como, insumos químicos, materiales, accesorios, herramientas, equipos, etc, la sociedad realizara contratos o convenios con los entes responsables de los servicios para adelantar las obras y prestar los servicios especializados, de acuerdo a su objeto social, en los cuales se establecerán las condiciones contractuales que reglamenta la junta directiva de la entidad.</li>
                            <li>Ejercer la interventoría de las obras y proyectos de infraestructura, para los servicios de acueducto, alcantarillado, aseo, alumbrado público y gas combustible, que adelante la Nación y los entes territoriales, así como las empresas que desarrollen proyectos afines, para lo cual podrá celebrar convenios o contratos.</li>
                            <li>Promover y prestar la asesoría para la creación por parte de los Municipios, de organizaciones administrativas adecuadas al tamaño de los mismos y complejidad de los sistemas, para la mejor prestación de los servicios, a través de juntas administradoras o empresas con participación de la comunidad en sus órganos de gestión.</li>
                            <li>Gerenciar los planes, programas, proyectos y obras de acueducto, Alcantarillado, Aseo incluyendo disposición final de residuos sólidos, Energía Eléctrica, Alumbrado Público y Gas Combustible, financiado con recursos de la Nación, los entes territoriales, entidades no gubernamentales y la comunidad, a través de convenios o contratos.</li>
                            <li>Desarrollar y/o gestar las políticas que adoptan las entidades territoriales en las áreas de planeación, asistencia técnica, capacitación y planes de gestión según las directrices, planes y programas que adopte la autoridad competente.</li>
                        </ol>

                        <ol class="list-decimal pl-4" start="14">
                            <li>Para la prestación de los servicios públicos domiciliarios y otros servicios, podrá realizar todas las actividades previstas en la ley 142 y 143 de 1994 y sus normas complementarias. (En los demás aspectos este literal queda igual).</li>
                            <li>Prestar servicios medioambientales relacionados con el sector de agua potable y saneamiento básico tales como: Reforestación, protección de micro-cuencas, descontaminación de cuerpos de agua, planes de manejo integraI de cuencas, tratamiento y disposición final de residuos sólidos, entre otros. (Literal nuevo).</li>
                            <li>Ejecutar recursos y vender bienes y servicios mediante el esquema de asociación Publico Privada. (Literal nuevo).</li>
                            <li>En desarrollo de la prestación del servicio de Aseo se incluye además el servicio de recolección Municipal de residuos sólidos; el barrido y limpieza de vías, áreas públicas; el transporte y disposición final de los mismos, incluyendo las demás actividades afines al servicio domiciliario de aseo (literal nuevo).</li>
                            <li>Realizar: Asesoría, Consultoría (en cualquiera de sus modalidades), Obras, Intermediación, Importación, Exportación, Comercialización y Venta de toda clase de bienes o servicios, Recaudo, Facturación, Toma de lecturas, Reparto de facturas, Construcción de infraestructura, Prestación de toda clase de servicios técnicos, De administración, Operación o Mantenimiento de cualquier bien; siempre que tenga relación directa con la prestación de servicios públicos. (Literal nuevo).</li>
                            <li>La construcción, operación, mantenimiento o modificación, en forma directa o a través de contratistas de gasoductos, redes de distribución, transporte, comercialización o suministro, ramales, estaciones de regulación, compresión o almacenamiento, acometidas domiciliarias, y, en general cualquier otra clase de obras necesarias para el manejo de gas natural.</li>
                            <li>La de  ejecución, directa o indirectamente, a través de contratistas y/o subcontratistas, de la labor de inspección y/o interventoría y certificación de gasoductos, estaciones de regulación, medición o compresión, redes de distribución e instalaciones internas de los clientes residenciales, comerciales e industriales, acorde con la normativa vigente.</li>
                            <li>Prestación de servicio de telefonía móvil, telefonía conmutada y sus actividades conexas.</li>
                            <li>Gestionar y ejecutar proyectos de tecnologías de la información y la comunicación (TIC).</li>
                            <li>Servicios de asesoría y consultoría para desarrollar proyectos relacionados con las TIC</li>
                            <li>La construcción de infraestructura, redes y obras civiles  para proyectos relacionados con las tic.</li>
                            <li>La operación, logística y mantenimiento de maquinaria y equipos para el mantenimiento de vías en general y actividades complementarias a cada uno de dichos servicios que se reciban mediante convenios o contratos de operación  en el territorio nacional con sujeción a las normas legales vigentes; construir y mantener la infraestructura necesaria para la administración, operación, logística y mantenimiento de maquinaria y equipos para el mantenimiento de vías en general; prestar los servicios de transporte de carga, alquiler de maquinaria pesada al público, mantener la infraestructura necesaria para prestar los servicios a su cargo para la administración y mantenimiento de maquinaria y otros equipos, asociarse, aportar o suscribir acciones en sociedad que tenga por objeto la prestación de los servicios de administración, operación, logística y mantenimiento de maquinaria y equipos ara el mantenimiento de vías en general; mantenimiento rutinario en vías, construcción de obras tales como muros, gaviones, pontones, andenes y todo tipo de obras de arte o la realización de actividades conexas o complementarias, Operación de maquinaria para mejoramiento de sub rasante, instalación de bases y sub bases para consorciales o formar uniones temporales con otras entidades y personas naturales o jurídicas; comercialización de bienes y productos que se requieran para el desarrollo del objeto contractual</li>
                        </ol>
                    </div>

                </div>

            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
