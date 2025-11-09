<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila | Blogs</title>
        <!-- Styles -->
        <style>
            
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
        </style>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Últimas Noticias</h2>
                <p class="text-lg">Inicio </span class="font-bold">/ Blog de noticias</span></p>
            </div>
        </div>


        <!-- noticias -->
        <section class="px-2 lg:px-32 py-8">

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 pt-8 text-[#0047DC] font-bold text-center">

                @foreach($noticias as $noticia)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Imagen de portada -->
                        <img src="{{ asset('storage/' . $noticia->imagen_portada) }}" 
                            alt="{{ $noticia->titulo }}" 
                            class="w-full h-48 object-cover">

                        <!-- Contenido -->
                        <div class="p-4 text-[#0047DC] text-left">
                            <!-- Título -->
                            <h3 class="text-lg font-bold mb-2 hover:text-[#00C81F] transition-colors">
                                <a href="{{ route('noticias.article', [$noticia->slug, $noticia->id]) }}">
                                    {{ Str::limit($noticia->titulo, 70) }}
                                </a>
                            </h3>

                            <!-- Fecha y usuario -->
                            <div class="text-sm text-gray-500 flex justify-between items-center">
                                <span>{{ $noticia->created_at->format('d M Y') }}</span>
                                <span class="font-semibold">{{ $noticia->autor->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Si no hay noticias -->
            @if($noticias->isEmpty())
                <div class="text-center text-white mt-8">
                    <p>No hay noticias disponibles por el momento.</p>
                </div>
            @endif

        </section>

        <!-- Indicadores -->
        <section class="px-2 lg:px-32 py-8">

            <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                <h2 class="text-4xl">Indicadores</h2>
            </div>

            <img 
                src="{{ asset('storage/img/inversiones.webp') }}" 
                alt="Indicadores" 
                class="w-full h-full object-cover"
                >

        </section>

        <!-- inversiones -->
        <section class="px-2 lg:px-32 py-8">

            <div class="w-full pt-8 text-gray-900 text-center">

                <div class="w-full text-center pb-8 text-[#0047DC] font-bold">
                    <h2 class="text-4xl">Otras Inversiones</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="border-collapse">
                        <tbody>
                            <tr class="font-bold">
                                <td   rowspan="2">
                                    MUNICIPIOS INTEVENIDOS</td>
                                <td rowspan="2"   >
                                    PROYECTO</td>
                                <td rowspan="2"  >
                                    AVANCE FISICO</td>
                                <td rowspan="2"  >
                                    POBLACION BENEFICIADA</td>
                                <td rowspan="2"  >
                                    VALOR TOTAL </td>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <td rowspan="4">
                                    ACEVEDO</td>
                                <td   >
                                    Elaboración De Estudios  Y Diseños  Del Acueducto Vereda El Mirador </td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    180</td>
                                <td  >
                                    $73.445.610</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Acueducto Regional Siberia, Berlín, La Esperanza, Centro Poblado San Adolfo</td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    1194</td>
                                <td  >
                                    $1.478.279.270</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción Alcantarillado  Sanitario Centro Poblado  San Marcos  Acevedo   Fase  I  </td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    1000</td>
                                <td  >
                                    $654.269.165</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción Y Optimización del Alcantarillado Sanitario de la Vereda Pueblo Viejo -regalias</td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    320</td>
                                <td  >
                                    $1.050.108.155</td>
                            </tr>
                            <tr  >
                                <td   rowspan="2"  >
                                    AGRADO</td>
                                <td   >
                                    Construcción  Unidades Sanitarias  Con Sistema De Tratamiento   En Zona Rural Y Zona  Urbana (50)</td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    200</td>
                                <td  >
                                    $415.553.476</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción pozo profundo vereda la cañada - OCAD 2015</td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    220</td>
                                <td  >
                                    $ 800.000.000</td>
                            </tr>
                            <tr  >
                                <td   rowspan="2"  >
                                    ALTAMIRA</td>
                                <td   >
                                    Ampliación Redes de Acueducto, Vereda Llano de la Virgen</td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    636</td>
                                <td  >
                                    $419.073.809</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción Plan Maestro de Acueducto Fase I</td>
                                <td  >
                                    50%</td>
                                <td  >
                                    3012</td>
                                <td  >
                                    $3.350.916.532</td>
                            </tr>
                            <tr  >
                                <td   rowspan="2"  >
                                    ALGECIRAS</td>
                                <td   >
                                    Construcción Alcantarillado Barrio Nuevo Horizonte del Municipio de Algeciras, Departamento del Huila</td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    350</td>
                                <td  >
                                    $506.212.637</td>
                            </tr>
                            <tr  >
                                <td    >
                                    OPTIMIZACION DEL ALCANTARILLADO SANITARIO EN EL CENTRO POBLADO LA ARCADIA  DEL MUNICIPIO DE ALGECIRAS DEPARTAMENTO DEL HUILA.      </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    537</td>
                                <td  >
                                    $1.419.864.239</td>
                            </tr>
                            <tr  >
                                <td    >
                                    BARAYA</td>
                                <td   >
                                    Construcción De Sistemas De Tratamiento Y Mejoramientos De Baterías Sanitaria En Zona Rural</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    225</td>
                                <td  >
                                    $389.924.930</td>
                            </tr>
                            <tr  >
                                <td   rowspan="2"  >
                                    CAMPOALEGRE</td>
                                <td   >
                                    Estudios  Y Diseños  Acueducto De  Las   Veredas  Rio Negro Y Tinajitas  </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    245</td>
                                <td  >
                                    $42.000.000</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Rehabilitación bocatoma Acueducto casco Urbano</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    26.424</td>
                                <td  >
                                    $930.000.000</td>
                            </tr>
                            <tr  >
                                <td   rowspan="3"  >
                                    COLOMBIA</td>
                                <td   >
                                    Construcción Acueducto  Rural  En La Vereda  El Valle</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    130</td>
                                <td  >
                                    $79.582.746</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Estudios Y Diseños Ptar Colombia</td>
                                <td  >
                                    85%</td>
                                <td>
                                    2.582</td>
                                <td  >
                                    $22.461.440</td>
                            </tr>
                            <tr  >
                                <td    >
                                    OPTIMIZACIÓN SISTEMA DE ACUEDUCTO DEL ÁREA URBANA DEL MUNICIPIO DE COLOMBIA HUILA</td>
                                <td>
                                    79%</td>
                                <td>
                                    3.336</td>
                                <td  >
                                    $460.005.772</td>
                            </tr>
                            <tr  >
                                <td    >
                                    DEPARTAMENTO</td>
                                <td   >
                                    Construcción 765 unidades sanitarias en el sector rural del Departamento, - OCAD 2015</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    3.825</td>
                                <td  >
                                    $5.657.066.881</td>
                            </tr>
                            <tr height="102">
                                <td   rowspan="2"  >
                                    ELIAS</td>
                                <td   >
                                    Construcción  Del Colector  De Aguas Residuales  De  La Urbanización  Oritoguaz, En La Vereda  Oritoguaz </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    175</td>
                                <td  >
                                    $63.384.606</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción Plan maestro de acueducto urbano Fase I</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    1.282</td>
                                <td  >
                                    $8.821.666.927</td>
                            </tr>
                            <tr  >
                                <td   rowspan="3"  >
                                    GARZON</td>
                                <td   >
                                    Ampliación Acueducto  De Zuluaga  Hacia  La Vereda  El Encanto  Del Municipio De Garzón </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    400</td>
                                <td  >
                                    $15.960.770</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción Alcantarillado La Independencia</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    1.200</td>
                                <td  >
                                    $774.891.215</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Acueducto Y Alcantarillado Ciudadela El Oasis</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    1.000</td>
                                <td  >
                                    $149.987.684</td>
                            </tr>
                            <tr  >
                                <td   rowspan="4"  >
                                    GIGANTE</td>
                                <td   >
                                    Optimización  Sistema De Acueducto  Veredas Algarrobo,  Cascajal, Agua Blanca,  Primavera,  Libertador, Centro  Poblado  Tres Esquinas Y Centro Poblado Silvania</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    1400</td>
                                <td  >
                                    $1.806.247.055</td>
                            </tr>
                            <tr  >
                                <td    >
                                    REPOSICION DE LOS SISTEMAS DE ALCANTARILLADO SANITARIO EN LOS CENTROS POBLADOS: PUEBLO NUEVO, RIO LORO Y REPOSICION ALCANTARILLADO SANITARIO Y CONSTRUCCION  RED DE AGUAS LLUVIAS EN EL CENTRO POBLADO POTRERILLOS GIGANTE - HUILA</td>
                                <td>
                                    10%</td>
                                <td>
                                    5.396</td>
                                <td  >
                                    $536.224.177</td>
                            </tr>
                            <tr  >
                                <td    >
                                    AMPLIACION DE ACUEDUCTO Y ALCANTARILLADO PARA EL BARRIO SAN JUAN EUDES DEL CENTRO POBLADO RIO LORO MUNICIPIO DE GIGANTE.</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    168</td>
                                <td  >
                                    $327.183.401</td>
                            </tr>
                            <tr  >
                                <td    >
                                    AMPLIACION DEL ACUEDUCTO Y ALCANTARILLADO SANITARIO PARA EL BARRIO BRISAS DEL PALMAR MUNICIPIO DE GIGANTE. DEPARTAMENTO DEL HUILA.</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    172</td>
                                <td  >
                                    $184.355.092</td>
                            </tr>
                            <tr  >
                                <td   rowspan="2"  >
                                    LA ARGENTINA</td>
                                <td   >
                                    CONSTRUCCIÓN DE UNIDADES SANITARIAS CON SISTEMA DE TRATAMIENTO EN LA ZONA RURAL DEL MUNICIPIO DE LA ARGENTINA DEPARTAMENTO DEL HUILA.</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    400</td>
                                <td  >
                                    $873.411.969</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción Alcantarillado Sanitario Barrio El Jardín</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    800</td>
                                <td  >
                                    $511.273.161</td>
                            </tr>
                            <tr  >
                                <td   rowspan="2"  >
                                    NATAGA</td>
                                <td   >
                                    Reposición Del Sistema De Alcantarillado Sanitario De Diferentes Sectores Del Casco Urbano</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    2.242</td>
                                <td  >
                                    $463.618.472</td>
                            </tr>
                            <tr  >
                                <td    >
                                    CONSTRUCCION Y OPTIMIZACION SISTEMA DE ALCANTARILLADO DEL MUNICIPIO DE NATAGA</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    3.508</td>
                                <td  >
                                    $418.021.147</td>
                            </tr>
                            <tr  >
                                <td   rowspan="5"  >
                                    NEIVA</td>
                                <td   >
                                    Optimización De La Red De Acueducto En La  Carrera 7  Entre Avenida Circulvalar  Y Calle  21 En Las Comunas  3 Y 4 De La Ciudad De Neiva  </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    896</td>
                                <td  >
                                    $1.975.236.326</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Estudios  Y Diseños   Zona Rural   - Acueducto  Y Alcantarillado </td>
                                <td  >
                                    90%</td>
                                <td>
                                    </td>
                                <td  >
                                    $413.895.280</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción   De  Obras  Para El Control   Del Cauce  Y Mitigacion  De Amanaza  Por  Inundación  Del Rio Las Ceibas En La Zona Urbana</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    4.650</td>
                                <td  >
                                    $8.514.421.089</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Mejoramiento Y  optimización   De La Red De Alcantarillado Sanitario  En Varios Sectores De La Ciuda De  Neiva </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    1.392</td>
                                <td  >
                                    $2.654.197.446</td>
                            </tr>
                            <tr  >
                                <td    >
                                    OPTIMIZACION DE LA RED DE ALCANTARILLADO SANITARIO PARA EL CORREGIMIENTO DE AIPECITO MUNICIPIO DE NEIVA DEPARTAMENTO DEL HUILA</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    461</td>
                                <td  >
                                    $1.136.323.936</td>
                            </tr>
                            <tr  >
                                <td   rowspan="3"  >
                                    PAICOL</td>
                                <td   >
                                    Mejoramiento   Y Construcción   De Baterías  Sanitarias  Fase  II  En El Sector  Rural  </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    200</td>
                                <td  >
                                    $409.455.000</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Para  Mejoramiento  Y Construcción De  Baterias Sanitarias  En El Sector   Rural  Del Municipio De  Paicol  </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    200</td>
                                <td  >
                                    $400.000.000</td>
                            </tr>
                            <tr  >
                                <td    >
                                    CONSTRUCCIÓN DE UNA PLANTA DE TRATAMIENTO DE AGUAS RESIDUALES VEREDA LA LAJITA DEL MUNICIPIO DE PAICOL HUILA</td>
                                <td>
                                    0%</td>
                                <td>
                                    118</td>
                                <td  >
                                    $239.864.101</td>
                            </tr>
                            <tr  >
                                <td    >
                                    PAICOL-TESALIA</td>
                                <td   >
                                    Construcción Sistemas De Ac. Alc.  Municipio Descertificado</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    7.964</td>
                                <td  >
                                    $97.050.279</td>
                            </tr>
                            <tr  >
                                <td    >
                                    PALERMO</td>
                                <td   >
                                    Ampliación Acueducto Centro Poblado El Juncal</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    2.826</td>
                                <td  >
                                    $163.313.711</td>
                            </tr>
                            <tr  >
                                <td    >
                                    PALESTINA</td>
                                <td   >
                                    Construcción Sistema De Alcantarillado Sanitario  Vereda  Santa Barbara  (Sector Alto  Santa Barbara ) Palestina </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    230</td>
                                <td  >
                                    $ 486.457.214</td>
                            </tr>
                            <tr  >
                                <td    >
                                    PITAL-AGRADO</td>
                                <td   >
                                    Optimización Red de aducción urbano</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    5.220</td>
                                <td  >
                                    $411.843.906</td>
                            </tr>
                            <tr  >
                                <td   rowspan="5"  >
                                    PITALITO </td>
                                <td   >
                                    Adecuación  Y Optimización Del Sistema  De Acueducto De La Vereda  El Tigre, Corregimiento  De Guacallo, Municipio De Pitalito  Departamento Del  Huila .</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    1.000</td>
                                <td  >
                                    $68.000.000</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción Cubierta Metálica En La Zona De Recibo Y Distribución De Residuos Sólidos En La Planta De Tratamiento De Biorganicos Del Sur Huila</td>
                                <td  >
                                    TERMINADO</td>
                                <td  >
                                    8 Mpios(SAN AGUSTIN , ISNOS, PALESTINA, SALADOBLANCO, ACEVEDO, ELIAS, PITALITO Y OPORAPA)</td>
                                <td  >
                                    $ 222.829.314</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción Y Optimización Alcantarillado Sanitario Barrio Madelena</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    1.725</td>
                                <td  >
                                    $1.559.670.823</td>
                            </tr>
                            <tr  >
                                <td    >
                                    Construcción  Del Alcantarillado   Sanitario De La Urbanización   Villas Del Tesoro</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    313</td>
                                <td  >
                                    $1.160.167.431</td>
                            </tr>
                            <tr  >
                                <td    >
                                    OPTIMIZACION ACUEDUCTO REGIONAL SAN FRANCISCO </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    1.517</td>
                                <td  >
                                    $ 220.062.576</td>
                            </tr>
                            <tr  >
                                <td    >
                                    RIVERA</td>
                                <td   >
                                    Rehabilitación Provisional Acueducto Urbano Rivera</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    10.973</td>
                                <td  >
                                    $301.328.026</td>
                            </tr>
                            <tr  >
                                <td   rowspan="2"  >
                                    SALADOBLANCO</td>
                                <td   >
                                    Construcción De  Unidades Sanitarias  Con Sistema De Tratamiento  En Zona Rural </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    115</td>
                                <td  >
                                    $196.498.899</td>
                            </tr>
                            <tr  >
                                <td    >
                                    CONSTRUCCIÓN SISTEMA DE ACUEDUCTO VEREDA EL DIAMANTE </td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    255</td>
                                <td  >
                                    $903.157.895</td>
                            </tr>
                            <tr  >
                                <td   >
                                    SAN AGUSTIN</td>
                                <td   >
                                    Rehabilitación   Del Alcantarillado Sanitario  Del Centro  Poblado  El Palmar - Sector  Anillo  Turistico</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    385</td>
                                <td  >
                                    $147.304.166</td>
                            </tr>
                            <tr  >
                                <td   >
                                    SUAZA</td>
                                <td   >
                                    CONSTRUCCION DEL SISTEMA DE ACUEDUCTO REGIONAL PARA LAS VEREDAS SAN CALIXTO Y HATO VIEJO MUNICIPIO DE SUAZA </td>
                                <td>
                                    24%</td>
                                <td>
                                    429</td>
                                <td  >
                                    $602.053.947</td>
                            </tr>
                            <tr  >
                                <td   rowspan="3"  >
                                    TARQUI </td>
                                <td   >
                                    Restitución Alcantarillado Sanitario Barrio Minuto De Dios</td>
                                <td  >
                                    TERMINADO</td>
                                <td>
                                    325</td>
                                <td  >
                                    $163.007.821</td>
                            </tr>
                            <tr  >
                                <td   rowspan="2"  >
                                    CONSTRUCCION SISTEMA  DE ALCANTARILLADO  SANITARIO  EN LA VERDA  LA   ESMERALDA</td>
                                <td rowspan="2">
                                    TERMINADO</td>
                                <td rowspan="2">
                                    400</td>
                                <td rowspan="2"  >
                                    $1.626.311.555</td>
                            </tr>
                            <tr  >
                            </tr>
                            <tr  >
                                <td   rowspan="3"  >
                                    TERUEL</td>
                                <td rowspan="2"   >
                                    Estudios Y Diseños Ptar Teruel</td>
                                <td rowspan="2">
                                    TERMINADO</td>
                                <td rowspan="2">
                                    4.428</td>
                                <td rowspan="2"  >
                                    $22.461.440</td>
                            </tr>
                            <tr  >
                            </tr>
                            <tr  >
                                <td   >
                                    Construcción Cerramiento Y Mejoramiento De La Ptap Del Municipio De Teruel</td>
                                <td>
                                    TERMINADO </td>
                                <td>
                                    4.428</td>
                                <td  >
                                    $175.778.371</td>
                            </tr>
                            <tr  >
                                <td   rowspan="4" >
                                    TIMANA  </td>
                                <td rowspan="2"   >
                                    Construcción Sistema De Alcantarillado  Sanitario Centro  Poblado  Cosanza   </td>
                                <td rowspan="2">
                                    TERMINADO </td>
                                <td rowspan="2">
                                    1.000</td>
                                <td rowspan="2"  >
                                    $         1.098.498.148</td>
                            </tr>
                            <tr  >
                            </tr>
                            <tr >
                                <td  >
                                    Construcción Alcantarillado San Marcos  Municipo de Timana, Departamento del Huila</td>
                                <td  >
                                    TERMINADO </td>
                                <td>
                                    324</td>
                                <td  >
                                    $         1.748.787.865</td>
                            </tr>
                            <tr  >
                                <td   >
                                    Construcción Alcantarillado San Antonio Municipo de Timana, Departamento del Huila</td>
                                <td  >
                                    TERMINADO </td>
                                <td>
                                    517</td>
                                <td  >
                                    $         1.393.318.381</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
