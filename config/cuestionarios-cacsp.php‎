<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 1. Datos de Control y Generales
    |--------------------------------------------------------------------------
    */
    'a_id_muestra' => [
        'titulo' => 'Id de muestra', //
        'tipo' => 'hidden', //[cite: 1]
        'obligatoria' => false, //[cite: 1]
    ],
    'b_municipio' => [
        'titulo' => 'Municipio', //[cite: 1]
        'tipo' => 'select', //[cite: 1]
        'obligatoria' => true, //[cite: 1]
        'opciones' => 'db:municipios_col,departamento_id,18', //[cite: 1]
    ],
    'c_ubicacion' => [
        'titulo' => 'Ubicación', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['1' => 'Urbano', '2' => 'Rural'], //[cite: 1]
    ],
    'd_estrato' => [
        'titulo' => 'Estrato', //[cite: 1]
        'tipo' => 'select',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['1', '2', '3', '4', '5', '6'], //[cite: 1]
    ],
    'e_sector' => [
        'titulo' => 'Sector', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['1' => 'Residencial', '2' => 'Comercial', '3' => 'Industrial', '4' => 'Oficial'], //[cite: 1]
    ],
    'P1_nombre' => [
        'titulo' => 'Nombre del Usuario', //[cite: 1]
        'tipo' => 'text', //[cite: 1]
        'obligatoria' => true, //[cite: 1]
    ],
    'P2_edad' => [
        'titulo' => 'Edad', //[cite: 1]
        'tipo' => 'number', //[cite: 1]
        'obligatoria' => true, //[cite: 1]
        'atributos' => ['min' => 18], // Permitir solo números iguales o mayores que 18[cite: 1]
    ],
    'P3_sexo' => [
        'titulo' => 'Sexo', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['1' => 'Masculino', '2' => 'Femenino', '3' => 'Prefiero no Responder'], //[cite: 1]
    ],
    'P4_direccion' => [
        'titulo' => 'Dirección', //[cite: 1]
        'tipo' => 'text', //[cite: 1]
        'obligatoria' => true, //[cite: 1]
    ],
    'P5_barrio' => [
        'titulo' => 'Barrio', //[cite: 1]
        'tipo' => 'text', //[cite: 1]
        'obligatoria' => true, //[cite: 1]
    ],
    'P6_telefono' => [
        'titulo' => 'Teléfono', //[cite: 1]
        'tipo' => 'number', //[cite: 1]
        'obligatoria' => false, //[cite: 1]
    ],

    /*
    |--------------------------------------------------------------------------
    | 2. Cobertura de Servicios (Filtro Principal)[cite: 1]
    |--------------------------------------------------------------------------
    */
    'P7' => [
        'titulo' => '¿Cuáles de los siguientes servicios públicos posee su hogar?', //[cite: 1]
        'tipo' => 'checkbox', // selección múltiple[cite: 1]
        'obligatoria' => true, //[cite: 1]
        'opciones' => [
            '1' => 'Servicio de Acueducto', //[cite: 1]
            '2' => 'Servicio de Alcantarillado', //[cite: 1]
            '3' => 'Servicio de Aseo', //[cite: 1]
            '4' => 'Ninguno' // Determina fin de encuesta[cite: 1]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 3. Capítulo I: Acueducto y Alcantarillado[cite: 1]
    |--------------------------------------------------------------------------
    */
    // 3.1 Servicio de Acueducto
    'P8' => [
        'titulo' => 'Calidad general del servicio de Acueducto', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['5' => 'Muy Buena', '4' => 'Buena', '3' => 'Regular', '2' => 'Mala', '1' => 'Muy Mala', '9' => 'No sabe'], //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'in_array', 'valor' => '1'], // Visible si tiene Acueducto[cite: 1]
    ],
    'P9_1' => [
        'titulo' => 'La continuidad en el suministro de agua', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['5' => 'Muy Buena', '4' => 'Buena', '3' => 'Regular', '2' => 'Mala', '1' => 'Muy Mala', '9' => 'No sabe'], //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'in_array', 'valor' => '1'], //[cite: 1]
    ],
    'P9_2' => [
        'titulo' => 'El caudal o presión con que llega el agua', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['5' => 'Muy Buena', '4' => 'Buena', '3' => 'Regular', '2' => 'Mala', '1' => 'Muy Mala', '9' => 'No sabe'], //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'in_array', 'valor' => '1'], //[cite: 1]
    ],
    'P10' => [
        'titulo' => '¿En el último mes hubo interrupciones en el servicio de ACUEDUCTO?', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['1' => 'Si', '2' => 'No'], //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'in_array', 'valor' => '1'], //[cite: 1]
    ],
    'P11' => [
        'titulo' => '¿Cuántas interrupciones hubo en el último mes?', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => [
            '2' => 'Menos de 2 al mes', //[cite: 1]
            '3' => 'Entre 3 y 5 veces al mes', //[cite: 1]
            '4' => 'Entre 6 y 8 veces al mes', //[cite: 1]
            '5' => 'Más de 8 veces al mes' //[cite: 1]
        ],
        'condicion' => ['campo' => 'P10', 'operador' => '==', 'valor' => '1'], // Solo se muestra si P10 = 1[cite: 1]
    ],

    // 3.4 Atención al Cliente (Acueducto y Alcantarillado)
    'P18' => [
        'titulo' => '¿En el último año ha visitado algún punto de atención de la empresa?', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['1' => 'Si', '2' => 'No'], //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'intersect', 'valor' => ['1', '2']], // Visible si tiene Acueducto/Alcantarillado[cite: 1]
    ],
    'P19' => [
        'titulo' => 'Calificación general del punto de atención', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['5' => 'Muy Buena', '4' => 'Buena', '3' => 'Regular', '2' => 'Mala', '1' => 'Muy Mala', '9' => 'No sabe'], //[cite: 1]
        'condicion' => ['campo' => 'P18', 'operador' => '==', 'valor' => '1'], // Solo se muestra si P18 = 1[cite: 1]
    ],
    'P21' => [
        'titulo' => '¿Cuánto tiempo se demoraron en atenderlo en el punto de atención?', //[cite: 1]
        'tipo' => 'text', // Selección Número y unidad de tiempo[cite: 1]
        'obligatoria' => true, //[cite: 1]
        'condicion' => ['campo' => 'P18', 'operador' => '==', 'valor' => '1'], //[cite: 1]
    ],

    /*
    |--------------------------------------------------------------------------
    | 4. Capítulo II: Servicio de Aseo[cite: 1]
    |--------------------------------------------------------------------------
    */
    'P24' => [
        'titulo' => 'Nombre de la empresa de Aseo', //[cite: 1]
        'tipo' => 'text', //[cite: 1]
        'obligatoria' => true, //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'in_array', 'valor' => '3'], // Visible si tiene Aseo[cite: 1]
    ],
    'P35_1' => [
        'titulo' => 'Participó en actividades de capacitación (Programa Huila sin basuras)', //[cite: 1]
        'tipo' => 'radio',
        'obligatoria' => true, //[cite: 1]
        'opciones' => ['SI' => 'Sí', 'NO' => 'No'], //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'in_array', 'valor' => '3'], //[cite: 1]
    ],

    /*
    |--------------------------------------------------------------------------
    | 5. Percepciones Generales[cite: 1]
    |--------------------------------------------------------------------------
    */
    'P41' => [
        'titulo' => 'Aspecto más importante en ACUEDUCTO', //[cite: 1]
        'tipo' => 'textarea', // Texto abierto[cite: 1]
        'obligatoria' => true, //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'in_array', 'valor' => '1'], // Visible si tiene Acueducto[cite: 1]
    ],
    'P42' => [
        'titulo' => 'Aspecto más importante en ALCANTARILLADO', //[cite: 1]
        'tipo' => 'textarea', // Texto abierto[cite: 1]
        'obligatoria' => false, //[cite: 1]
        'condicion' => ['campo' => 'P7', 'operador' => 'in_array', 'valor' => '2'], // Visible si tiene Alcantarillado[cite: 1]
    ],
];