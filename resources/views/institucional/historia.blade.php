<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Historia</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-2">Historia</h2>
                <p class="text-lg">Inicio / Institucional </span class="font-bold"> / Historia</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <div class="grid grid-cols-1 lg:grid-cols-[70%_30%] gap-8">
                <div class="w-full mx-auto">

                    <div class="prose max-w-none text-justify text-gray-900">
                        La creación de la empresa AGUAS DEL HUILA se ubica dentro del proceso descentralizador iniciado al final de la década de los ochenta por el Estado Colombiano, mediante el cual se traslado de la Nación numerosas competencias y funciones administrativas a los Municipios y a los Departamentos como entidades territoriales. Lo anterior condujo a la liquidación y fusión de diversas entidades del orden nacional y a la creación de otras del nivel regional, como los EMPOS, o Empresa de Obras Sanitarias. En el Huila se creó EMPOHUILA, quien administró los servicios de acueducto y alcantarillado en varios municipios del Departamento.
                        </br>
                        </br>
                        En el contexto antes mencionado, al finalizar la década de los ochenta, el Instituto Nacional de Salud sufrió una serie de reformas, una de ellas consistió en la supresión de las Seccionales de la División de Saneamiento Básico Rural. En el caso del Departamento del Huila ello ocurrió en el año de 1989, y a partir de esa fecha las funciones desarrolladas por esos organismos en virtud de la desconcentración administrativa, fueron trasladadas al Instituto de Desarrollo Municipal del Huila, IDEHUILA, es tablec imiento públ i co del orden departamental.
                        </br>
                        </br>
                        Así las cosas, mediante la Escritura Pública No. 568 del 28 de febrero de 1990, protocolizada en la Notaría Primera del Círculo de Neiva, en desarrollo de la autorización contenida en la Ordenanza No. 038 surgió la Empresa, AGUAS DEL HUILA S.A. creada como una entidad descentralizada indirecta del orden departamental, sometida a las normas propias de las Empresas Industriales y Comerciales del Estado, Adoptando la forma de una Sociedad por Acciones.
                        </br>
                        </br>
                        La empresa se crea en concurrencia armónica del Departamento y sus municipios integrando la sociedad como una entidad especializada dentro del sector de agua y saneamiento,siendo gobernador el Dr. Félix Trujillo, quien actúa en nombre y representación del departamento como socio mayoritario con 42.900 acciones.
                        </br>
                        </br>
                        En su inicio, la sociedad quedo integrada por todos los funcionarios que hacían parte de la Seccional del Instituto Nacional de Salud, siendo su primer gerente, el ingeniero auxiliar de este organismo adscrito, Henry Castro Gerardino, durante los cuatro primeros años, contó para su funcionamiento con recursos de la Nación, como estaba contemplado en la ley, disminuyendo estos recursos gradualmente hasta su independencia total.
                        </br>
                        </br>
                        En Noviembre de 2005 la Sociedad se Transforma en una Empresa administradora y operadora de Servicios Públicos Domiciliarios de Acueducto, Alcantarillado y Aseo, sometida al Régimen de los Servicios Públicos Domiciliarios de nuestro País – Ley 142 de 1994. En la actualidad se presta servicios públicos en 05 Municipios del Huila a través de Convenios Interadministrativos.
                        </br>
                        </br>
                        Su mercado objetivo esta constituido prioritariamente por los municipios del Departamento del Huila, pero su proyección es de carácter Nacional, como lo evidencia su presencia en el Departamento del Tolima y en San Andrés y Providencia.
                        </br>
                        </br>
                        El objeto social de la entidad en la actualidad, es la explotación y prestación de servicios públicos de acueducto, Alcantarillado y Aseo y en desarrollo del mismo, diseñar, construir, administrar, operar, mantener, sistemas de acueducto, alcantarillado y aseo, comercializar bienes, servicios y prestar asesoría en las actividades relacionadas con su objeto.
                    </div>

                </div>

                <div class="w-full mx-auto">
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">¿Quiénes Somos?</h3>
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">NUESTRA MISIÓN</h3>
                    <p class="text-gray-900 mb-4">AGUAS DEL HUILA S.A E.S.P., es una empresa prestadora de servicios integrales con proyección nacional que genera bienestar social y responsabilidad sociombiental.</p>
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">NUESTRA VISIÓN</h3>
                    <p class="text-gray-900 mb-4">En el 2031, Aguas del Huila será el oprador especilizado surcolombiano de servicios públicos domiciliarios y servicios integrales. "Llevamos más que agua"</p>
                    <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Organigrama</h3>
                    <img src="{{ asset('storage/img/organigramafinal.jpg') }}" alt="Organigrama" title="Organigrama" class="w-full h-auto object-cover rounded-lg">
                </div>
            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
