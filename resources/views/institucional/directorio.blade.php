<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Directorio Aguas del Huila</title>
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
        <div class="w-full h-[200px] sm:h-[150px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl md:text-5xl font-bold mb-2">Directorio Aguas del Huila</h2>
                <p class="text-lg">Inicio / Institucional </span class="font-bold"> / Directorio Aguas del Huila</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8">

            <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Directorio Aguas del HuilaS.A. E.S.P.</h3>
            <h3 class="text-xl text-black">NIT 800100553-2</h3>
            <h3 class="text-xl text-black">Dirección: Calle 21 N° 1C - 17, Neiva - Huila </h3>
            <h3 class="text-xl text-black">Teléfonos: 8753181 - 018000952858</h3>
            <h3 class="text-xl text-black">Correo Electrónico: 
                <a href="mailto:info@aguasdelhuila.gov.co" target="_blank" class="flex items-center gap-1 hover:underline text-gray-900">
                    info@aguasdelhuila.gov.co
                </a></h3>
            <h3 class="text-xl text-black">Web: <a href="https://aguasdelhuila.gov.co/" target="_blank" class="flex items-center gap-1 hover:underline text-gray-900">www.aguasdelhuila.gov.co</a></h3>
            <h3 class="text-xl text-black">Sedes: Tarqui - Nátaga - Paicol - Santa María</h3>

            <h3 class="text-2xl font-bold text-[#0047DC] mb-4">Directorio de funcionarios</h3>
            <h3 class="text-2xl font-bold text-[#0047DC] my-4">Neiva</h3>

            <div class="overflow-x-auto">
                <table class="border-collapse">
                    <tbody class="text-black">
                        <tr>
                            <td>
                                NOMBRE</td>
                            <td >
                                CARGO</td>
                            <td >
                                DEPENDENCIA</td>
                            <td >
                                TELEFONO</td>
                            <td >
                                FORMACION ACADEMICA&nbsp;</td>
                            <td >
                                EXPERIENCIA LABORAL Y PROFECIONAL</td>
                            <td >
                                CORREO ELECTRONICO INSTITUCIONAL&nbsp;</td>
                        </tr>
                        <tr >
                            <td  >
                                GENARO LOZADA MENDIETA</td>
                            <td>
                                GERENTE</td>
                            <td>
                                GERENCIA</td>
                            <td>
                                8753181&nbsp; Ext 102</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                26 AÑOS</td>
                            <td>
                                gerencia@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                FABIO FERNANDO RAMIREZ NIETO</td>
                            <td >
                                SUBGERENTE ADMINISTRATIVO Y FINANCIERO</td>
                            <td>
                                SUBGERENCIA ADMINISTRATIVA Y FINANCIERA</td>
                            <td>
                                8753181&nbsp; Ext 118</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                20 AÑOS</td>
                            <td>
                                subgerencia@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                ESPERANZA ORTIZ MARTÍNEZ</td>
                            <td>
                                SUBGERENTE TECNICA Y OPERATIVA</td>
                            <td>
                                SUBGERENCIA TECNICA Y OPERATIVA&nbsp;</td>
                            <td>
                                8753181&nbsp; Ext 110</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                32 AÑOS</td>
                            <td>
                                subgerenciatecnica@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                DIEGO NELSON TAVAREZ LOZANO</td>
                            <td>
                                ASESOR JURIDICO Y CONTRATACION&nbsp;</td>
                            <td>
                                JURIDICA Y CONTRATACION</td>
                            <td>
                                8753181&nbsp; Ext 103</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                25 AÑOS</td>
                            <td>
                                oficinajuridica@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                ANA MERCEDES ARIAS LASSO</td>
                            <td>
                                PROFESIONAL ESPECIALIZADO&nbsp;</td>
                            <td>
                                JURIDICA Y CONTRATACION</td>
                            <td>
                                8753181&nbsp; Ext 111</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                24&nbsp; AÑOS</td>
                            <td>
                                juridica@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                MARCO WILLIAM FONSECA DÍAZ</td>
                            <td>
                                PROFESIONAL ESPECIALIZADO&nbsp;</td>
                            <td>
                                CONTROL INTERNO</td>
                            <td>
                                8753181&nbsp; Ext 117</td>
                            <td>
                                MAESTRIA</td>
                            <td>
                                34 AÑOS&nbsp;</td>
                            <td>
                                controlinterno@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                SANDRA PATRICIA CAICEDO SALAS</td>
                            <td>
                                PROFESIONAL UNIVERSITARIO&nbsp;</td>
                            <td>
                                PRESUPUESTO</td>
                            <td>
                                8753181&nbsp; Ext 112</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                18 AÑOS</td>
                            <td>
                                sandra.presupuesto@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                ÁNGELA LUCIA NARVÁEZ TOVAR</td>
                            <td>
                                PROFESIONAL UNIVERSITARIO&nbsp;</td>
                            <td>
                                CONTABILIDAD</td>
                            <td>
                                8753181&nbsp; Ext 119</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                26 AÑOS</td>
                            <td>
                                angela.contabilidad@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                YANETH TORO LÓPEZ</td>
                            <td>
                                PROFESIONAL ESPECIALIZADO&nbsp;</td>
                            <td>
                                TESORERIA</td>
                            <td>
                                8753181&nbsp; Ext 105</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                27 AÑOS</td>
                            <td>
                                tesoreria@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                JAIME AUGUSTO MUÑOZ ORDOÑEZ</td>
                            <td>
                                PROFESIONAL ESPECIALIZADO&nbsp;</td>
                            <td>
                                TECNICA Y OPERATIVA</td>
                            <td>
                                8753181&nbsp; Ext 107</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                26 AÑOS</td>
                            <td>
                                augustotecnica@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                ANA LUCIA MUÑOZ CASTELBLANCO (Permiso Especial)&nbsp;</td>
                            <td>
                                PROFESIONAL ESPECIALIZADO&nbsp;</td>
                            <td>
                                CAPACITACION Y PLANEACION</td>
                            <td>
                                8753181&nbsp; Ext 114</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                15 AÑOS</td>
                            <td>
                                ----------------------------------------------------</td>
                        </tr>
                        <tr >
                            <td  >
                                NORMA CONSTANZA SALAS</td>
                            <td>
                                PROFESIONAL ESPECIALIZADO&nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS</td>
                            <td>
                                8753181&nbsp; Ext 108</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                24 AÑOS</td>
                            <td>
                                norma@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                PAOLA ANDREA GARCIA CHARRY</td>
                            <td>
                                PROFESIONAL UNIVERSITARIO&nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS</td>
                            <td>
                                8753181&nbsp; Ext 108</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                13 Años</td>
                            <td>
                                paola.serviciospublicos@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                GLORIA ISABEL ORTIZ</td>
                            <td>
                                PROFESIONAL UNIVERSITARIO&nbsp;</td>
                            <td>
                                TESORERIA</td>
                            <td>
                                8753181&nbsp; Ext 105</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                30 AÑOS</td>
                            <td>
                                auxiliartesoreria@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                MARYERLY RODRÍGUEZ</td>
                            <td>
                                PROFESIONAL UNIVERSITARIO&nbsp;</td>
                            <td>
                                CARTERA</td>
                            <td>
                                8753181&nbsp; Ext 109</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                20 AÑOS</td>
                            <td>
                                maryely.cartera@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                YESID ROJAS PEÑA</td>
                            <td>
                                PROFESIONAL UNIVERSITARIO&nbsp;</td>
                            <td>
                                TECNICA Y OPERATIVA</td>
                            <td>
                                8753181&nbsp; Ext 107</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                35 AÑOS</td>
                            <td>
                                yesid.ingetecnica@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                DIEGO ARMANDO CARDOSO QUINTERO</td>
                            <td>
                                PROFESIONAL UNIVERSITARIO&nbsp;</td>
                            <td>
                                TECNICA Y OPERATIVA</td>
                            <td>
                                8753181&nbsp; Ext 108</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                12 AÑOS</td>
                            <td>
                                Diego.Cardozo@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                ANDRES ALBERTO CHARRY GONZÁLEZ</td>
                            <td>
                                PROFESIONAL UNIVERSITARIO&nbsp;</td>
                            <td>
                                LABORATORIO</td>
                            <td>
                                8753181&nbsp; Ext 115</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                16 AÑOS</td>
                            <td>
                                andres.quimico@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                MARIA ISABEL ROJAS CUELLAR</td>
                            <td>
                                TECNICO III</td>
                            <td>
                                ALMACEN Y COMERCIALIZACIÓN&nbsp;</td>
                            <td>
                                8753181&nbsp; Ext 106</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                15 AÑOS</td>
                            <td>
                                comercializacion@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                SERGIO LEONARDO PASTRANA TRUJILLO</td>
                            <td>
                                TECNICO III</td>
                            <td>
                                SUBGERENCIA ADMINISTRATIVA Y FINANCIERA</td>
                            <td>
                                8753181&nbsp; Ext 118</td>
                            <td>
                                ESPECIALIZADO</td>
                            <td>
                                4 AÑOS</td>
                            <td>
                                sergio.subadministrativa@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                WILLIAM REYES MUÑOZ</td>
                            <td>
                                TECNICO III</td>
                            <td>
                                TIC</td>
                            <td>
                                8753181&nbsp; Ext 115</td>
                            <td>
                                TECNICO</td>
                            <td>
                                10 AÑOS</td>
                            <td>
                                william.tics@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                LUZ MIRYAM OSORIO HERRERA</td>
                            <td>
                                TECNICO II&nbsp;</td>
                            <td>
                                JURIDICA Y CONTRATACION</td>
                            <td>
                                8753181&nbsp; Ext 111</td>
                            <td>
                                TECNICO</td>
                            <td>
                                35 AÑOS</td>
                            <td>
                                luzmiryam.contratacion@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                LUIS ENRIQUE GALLEGO SÁNCHEZ</td>
                            <td>
                                TECNICO III</td>
                            <td>
                                TECNICA Y OPERATIVA</td>
                            <td>
                                8753181&nbsp; Ext 107</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                30 AÑOS</td>
                            <td>
                                luisenrique.tecnico@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                PATRICIA BARREIRO LUNA</td>
                            <td>
                                TECNICO II</td>
                            <td>
                                SECRETARIA GERENCIA&nbsp;</td>
                            <td>
                                8753181&nbsp; Ext 101</td>
                            <td>
                                TECNICO</td>
                            <td>
                                26 AÑOS</td>
                            <td>
                                --------------------------------</td>
                        </tr>
                        <tr >
                            <td  >
                                JUAN CARLOS BERJAN BAHAMON</td>
                            <td>
                                AUXILIAR ADMINISTRATIVO II</td>
                            <td>
                                CALIDAD Y COMERCIALIZACION</td>
                            <td>
                                8753181&nbsp; Ext 113</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                23 AÑOS</td>
                            <td>
                                juan.hseqrse@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                YOBANY ENRIQUE LINARES BELTRÁN</td>
                            <td>
                                AUXILIAR ADMINISTRATIVO I</td>
                            <td>
                                CORRESPONDENCIA</td>
                            <td>
                                8753181&nbsp; Ext 122</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                20 AÑOS&nbsp;</td>
                            <td>
                                info@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                NANCY TRUJILLO MONJE</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                CAPACITACION Y PLANEACION</td>
                            <td>
                                8753181&nbsp; Ext 114</td>
                            <td>
                                PROFESIONAL</td>
                            <td>
                                32 AÑOS</td>
                            <td >
                                pdahuila@aguasdelhuila.gov.co, gestorhuila@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                MICHAEL DANIEL ORDÓÑEZ PALOMAR&nbsp;</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                CAPACITACION Y PLANEACION</td>
                            <td>
                                8753181&nbsp; Ext 114</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                3 AÑOS</td>
                            <td>
                                --------------------------</td>
                        </tr>
                        <tr >
                            <td  >
                                MIGUEL ANTONIO MOTTA ARTUNDUAGA</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                CAPACITACION Y PLANEACION</td>
                            <td>
                                8753181&nbsp; Ext 114</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                6 AÑOS</td>
                            <td>
                                ----------------------------</td>
                        </tr>
                        <tr >
                            <td  >
                                JUAN MANUEL SÁNCHEZ MONTAÑA</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                SISTEMAS</td>
                            <td>
                                8753181&nbsp; Ext 121</td>
                            <td>
                                TECNOLOGO</td>
                            <td>
                                10 AÑOS</td>
                            <td>
                                sistemas@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                EDNA ROCÍO PERDOMO SERRATO</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                TECNICA Y OPERATIVA</td>
                            <td>
                                8753181&nbsp; Ext 107</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                12 AÑOS</td>
                            <td>
                                -------------------------</td>
                        </tr>
                        <tr >
                            <td  >
                                MARÍA DE LOS ÁNGELES CELIS ESPAÑA</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                TECNICA Y OPERATIVA</td>
                            <td>
                                8753181&nbsp; Ext 107</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                14 años</td>
                            <td>
                                ingtecnica@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                MONICA MARIA GONZALEZ RESTREPO</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                TECNICA Y OPERATIVA</td>
                            <td>
                                8753181&nbsp; Ext 107</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                8 AÑOS</td>
                            <td>
                                secretaria.subtecnica@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                CLARA MIREYA RICAUTE</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                TECNICA Y OPERATIVA</td>
                            <td>
                                8753181&nbsp; Ext 107</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                25 AÑOS</td>
                            <td>
                                apoyosubtecnica@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                CATALINA OSSA OSSA&nbsp;</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                CONTABILIDAD&nbsp;</td>
                            <td>
                                8753181&nbsp; Ext 120</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                20 AÑOS&nbsp;</td>
                            <td>
                                auxiliar.contable@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                MILER YONATAN PASTRANA PANTEVEZ</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                JURIDICA Y CONTRATACION</td>
                            <td>
                                8753181&nbsp; Ext 111</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                8 AÑOS</td>
                            <td>
                                ----------------------------------------------</td>
                        </tr>
                        <tr >
                            <td  >
                                JUAN PABLO BRARRAGAN ARISTIZABAL</td>
                            <td>
                                CONTRATISTA</td>
                            <td>
                                JURIDICA Y CONTRATACION</td>
                            <td>
                                8753181&nbsp; Ext 111</td>
                            <td>
                                PROFESIONAL&nbsp;</td>
                            <td>
                                5 AÑOS</td>
                            <td>
                                ----------------------------------------------</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3 class="text-2xl font-bold text-[#0047DC] my-4">Paicol</h3>

            <div class="overflow-x-auto">
                <table class="border-collapse">
                    <tbody class="text-black">
                        <tr >
                            <td  >
                                NOMBRE</td>
                            <td >
                                CARGO</td>
                            <td >
                                DEPENDENCIA</td>
                            <td >
                                TELEFONO</td>
                            <td >
                                FORMACION ACADEMICA&nbsp;</td>
                            <td >
                                EXPERIENCIA LABORAL Y PROFECIONAL</td>
                            <td >
                                CORREO ELECTRONICO INSTITUCIONAL&nbsp;</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                COORDINADOR OFC. PAICOL</td>
                            <td>
                                SERVICIOS PUBLICOS - PAICOL</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                paicol@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - PAICOL</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                paicol@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - PAICOL</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                paicol@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - PAICOL</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                paicol@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - PAICOL</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                paicol@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - PAICOL</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                paicol@aguasdelhuila.gov.co</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3 class="text-2xl font-bold text-[#0047DC] my-4">Nataga</h3>

            <div class="overflow-x-auto">
                <table class="border-collapse">

                    <tbody class="text-black">
                        <tr >
                            <td  >
                                NOMBRE</td>
                            <td >
                                CARGO</td>
                            <td >
                                DEPENDENCIA</td>
                            <td >
                                TELEFONO</td>
                            <td >
                                FORMACION ACADEMICA&nbsp;</td>
                            <td >
                                EXPERIENCIA LABORAL Y PROFECIONAL</td>
                            <td >
                                CORREO ELECTRONICO INSTITUCIONAL&nbsp;</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                COORDINADOR OFC. NATAGA</td>
                            <td>
                                SERVICIOS PUBLICOS - NATAGA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinanataga@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - NATAGA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinanataga@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - NATAGA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinanataga@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - NATAGA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinanataga@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - NATAGA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinanataga@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - NATAGA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinanataga@aguasdelhuila.gov.co</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h3 class="text-2xl font-bold text-[#0047DC] my-4">Santa María</h3>

            <div class="overflow-x-auto">
                <table class="border-collapse">

                    <tbody class="text-black">
                        <tr >
                            <td  >
                                NOMBRE</td>
                            <td >
                                CARGO</td>
                            <td >
                                DEPENDENCIA</td>
                            <td >
                                TELEFONO</td>
                            <td >
                                FORMACION ACADEMICA&nbsp;</td>
                            <td >
                                EXPERIENCIA LABORAL Y PROFECIONAL</td>
                            <td >
                                CORREO ELECTRONICO INSTITUCIONAL&nbsp;</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                COORDINADOR OFC. SANTA MARIA</td>
                            <td>
                                SERVICIOS PUBLICOS - SANTA MARIA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                santamaria@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - SANTA MARIA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                santamaria@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - SANTA MARIA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                santamaria@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - SANTA MARIA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                santamaria@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - SANTA MARIA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                santamaria@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - SANTA MARIA</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                santamaria@aguasdelhuila.gov.co</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <h3 class="text-2xl font-bold text-[#0047DC] my-4">Tarqui</h3>
            <div class="overflow-x-auto">
                <table class="border-collapse">
                    <tbody class="text-black">
                        <tr >
                            <td  >
                                NOMBRE</td>
                            <td >
                                CARGO</td>
                            <td >
                                DEPENDENCIA</td>
                            <td >
                                TELEFONO</td>
                            <td >
                                FORMACION ACADEMICA&nbsp;</td>
                            <td >
                                EXPERIENCIA LABORAL Y PROFECIONAL</td>
                            <td >
                                CORREO ELECTRONICO INSTITUCIONAL&nbsp;</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                COORDINADOR OFC. TARQUI</td>
                            <td>
                                SERVICIOS PUBLICOS - TARQUI</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinatarqui@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - TARQUI</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinatarqui@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - TARQUI</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinatarqui@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - TARQUI</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinatarqui@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - TARQUI</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinatarqui@aguasdelhuila.gov.co</td>
                        </tr>
                        <tr >
                            <td  >
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                SERVICIOS PUBLICOS - TARQUI</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                &nbsp;</td>
                            <td>
                                oficinatarqui@aguasdelhuila.gov.co</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>

        @include('partials.footer')

    </body>
</html>
