<?php

/*
|--------------------------------------------------------------------------
| Cuestionario de Evaluación de Atención al Cliente - Servicios Públicos (CACSP)
|--------------------------------------------------------------------------
|
| Fiel al documento "Encuesta Atención al Cliente - AGUAS". La numeración (P1..P46)
| es la del documento. Cada pregunta define:
|
|  - titulo, tipo, obligatoria, opciones
|  - seccion: inicia una sección nueva (título que se muestra)
|  - si: condiciones para mostrarla (todas deben cumplirse). La clave es la pregunta
|        (o "pregunta.fila" en las matrices) y el valor la respuesta esperada (o lista).
|  - si_alguno: se muestra si se cumple al menos una de las condiciones.
|
| Tipos: text, number, tel, date, textarea, select, radio, checkbox, matriz, duracion.
|  - matriz: una escala por cada fila (filas => [clave => texto | [texto, si]]).
|  - alternativa: casilla que reemplaza la respuesta (ej. "No tiene teléfono" => 9999999).
|  - otro: valor de la opción "Otro" que habilita la pregunta "<clave>_otro".
|  - escala: true en preguntas de calificación (5 = mejor, 1 = peor, 9 = no sabe).
|  - solo: en opciones de base de datos, limita la lista a esos nombres (sin importar tildes).
|  - predeterminado: valor seleccionado de entrada.
|  - En condiciones, "opcion:Nombre" se refiere a una opción por su texto (ej. un municipio)
|    y ['distinto' => ...] se cumple cuando la respuesta NO es esa.
|
*/

$calificacion = ['5' => 'Muy bueno', '4' => 'Bueno', '3' => 'Regular', '2' => 'Malo', '1' => 'Muy malo', '9' => 'No sabe'];
$calidad      = ['5' => 'Muy buena', '4' => 'Buena', '3' => 'Regular', '2' => 'Mala', '1' => 'Muy mala', '9' => 'No sabe'];
$siNo         = ['1' => 'Sí', '2' => 'No'];
$motivos      = [
    '1' => 'Solicitar información',
    '2' => 'Presentar una queja o petición',
    '3' => 'Hacer seguimiento a un reclamo o petición',
    '4' => 'Solicitar un servicio',
    '5' => 'Otro motivo',
];
$atencion = [
    'horarios'   => 'Horarios de atención',
    'ubicacion'  => 'Ubicación de la oficina en su municipio',
    'comodidad'  => 'La comodidad de las oficinas',
    'tiempo'     => 'El tiempo que se demoraron en atenderlo en la sede de la empresa',
    'amabilidad' => 'La amabilidad en la atención',
    'respuesta'  => 'El tiempo que tardó la empresa en responder su queja o petición',
    'claridad'   => 'La claridad de los argumentos de la respuesta, independientemente de que sea a su favor o en contra',
];

$tieneAcueducto      = ['P7.acueducto' => '1'];
$tieneAlcantarillado = ['P7.alcantarillado' => '1'];
$tieneAseo           = ['P7.aseo' => '1'];
// En Santa María solo se evalúan acueducto y alcantarillado (no se pregunta por aseo)
$municipioConAseo    = ['b_municipio' => ['distinto' => 'opcion:Santa María']];
$tieneAcuOAlc        = ['P7.acueducto' => '1', 'P7.alcantarillado' => '1'];
$noSabe              = ['etiqueta' => 'No sabe / No responde', 'valor' => '99'];

return [

    /* ----------------------------------------------------------------- Identificación */
    'a_codigo_suscriptor' => [
        'seccion' => 'Identificación de la encuesta',
        'titulo' => 'Código suscriptor',
        'tipo' => 'text',
        'obligatoria' => true,
        'ayuda' => 'Aparece en la factura del servicio.',
    ],
    'b_municipio' => [
        'titulo' => 'Municipio',
        'tipo' => 'select',
        'obligatoria' => true,
        'opciones' => 'db:municipios_col,departamento_id,18',
        'solo' => ['Natagá', 'Paicol', 'Santa María', 'Tarqui'],
    ],
    'c_ubicacion' => [
        'titulo' => 'Ubicación',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => ['1' => 'Urbano'],
        'predeterminado' => '1',
    ],
    'd_estrato' => [
        'titulo' => 'Estrato',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'],
    ],
    'e_sector' => [
        'titulo' => 'Sector',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => ['1' => 'Residencial', '2' => 'Comercial', '3' => 'Industrial', '4' => 'Oficial'],
    ],

    /* ----------------------------------------------------------------- Datos generales */
    'P1_nombre' => [
        'seccion' => 'Datos generales del usuario',
        'titulo' => 'Nombre',
        'tipo' => 'text',
        'obligatoria' => true,
    ],
    'P1_cedula' => [
        'titulo' => 'Número de cédula',
        'tipo' => 'cedula',
        'obligatoria' => true,
    ],
    'P2_edad' => [
        'titulo' => 'Edad',
        'tipo' => 'number',
        'obligatoria' => true,
        'atributos' => ['min' => 18, 'max' => 110],
        'ayuda' => 'El informante debe ser mayor de 18 años.',
    ],
    'P3_sexo' => [
        'titulo' => 'Sexo',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => ['1' => 'Masculino', '2' => 'Femenino', '3' => 'Prefiero no responder'],
    ],
    'P4_direccion' => [
        'titulo' => 'Dirección',
        'tipo' => 'text',
        'obligatoria' => true,
    ],
    'P5_barrio' => [
        'titulo' => 'Barrio',
        'tipo' => 'text',
        'obligatoria' => true,
    ],
    'P6_telefono' => [
        'titulo' => 'Teléfono',
        'tipo' => 'tel',
        'obligatoria' => true,
        'alternativa' => ['etiqueta' => 'No tiene teléfono', 'valor' => '9999999'],
    ],

    /* ----------------------------------------------------------------- Cobertura */
    'P7' => [
        'seccion' => 'Cobertura de servicios',
        'titulo' => '7. ¿Cuáles de los siguientes servicios públicos posee su hogar?',
        'tipo' => 'matriz',
        'obligatoria' => true,
        'opciones' => $siNo,
        'filas' => [
            'acueducto' => 'Servicio de Acueducto',
            'alcantarillado' => 'Servicio de Alcantarillado',
            'aseo' => ['Servicio de Aseo', $municipioConAseo],
        ],
        // Según el documento: si NO tiene acueducto, la encuesta termina
        'finaliza_si' => ['P7.acueducto' => '2'],
        'ayuda' => 'Si el hogar no tiene servicio de acueducto, la encuesta termina aquí.',
    ],

    /* ----------------------------------------------------------------- Acueducto */
    'P8' => [
        'seccion' => 'Acueducto',
        'introduccion' => 'En los siguientes capítulos vamos a evaluar la calidad de los servicios públicos que posee en su hogar. Tenga en cuenta los aspectos del servicio en sí y otros relacionados con su prestación, como la atención que recibe y la facturación.',
        'titulo' => '8. En términos generales, ¿cómo califica la calidad del servicio de Acueducto?',
        'tipo' => 'radio',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calidad,
        'si' => $tieneAcueducto,
    ],
    'P9' => [
        'titulo' => '9. ¿Cómo calificaría los siguientes aspectos del servicio de Acueducto?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => [
            'continuidad' => 'La continuidad en el suministro de agua',
            'presion' => 'El caudal o presión con que llega el agua a su domicilio',
            'calidad_agua' => 'La calidad del agua o pureza del agua que recibe',
        ],
        'si' => $tieneAcueducto,
    ],
    'P10' => [
        'titulo' => '10. ¿En el último mes hubo interrupciones en el servicio de Acueducto?',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => $siNo,
        'si' => $tieneAcueducto,
    ],
    'P11' => [
        'titulo' => '11. ¿Cuántas interrupciones hubo en el último mes?',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => [
            '2' => 'Menos de 2 al mes',
            '3' => 'Entre 3 y 5 veces al mes',
            '4' => 'Entre 6 y 8 veces al mes',
            '5' => 'Más de 8 veces al mes',
        ],
        'si' => ['P10' => '1'],
    ],

    /* ----------------------------------------------------------------- Alcantarillado */
    'P12' => [
        'seccion' => 'Alcantarillado',
        'titulo' => '12. En términos generales, ¿cómo califica la calidad del servicio de Alcantarillado?',
        'tipo' => 'radio',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calidad,
        'si' => $tieneAlcantarillado,
    ],
    'P13' => [
        'titulo' => '13. ¿Cómo calificaría los siguientes aspectos del servicio de Alcantarillado?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => [
            'olores' => 'La ausencia de olores molestos originados en las alcantarillas',
            'funcionamiento' => 'El funcionamiento de las alcantarillas (que no se rebosen ni se taponen)',
        ],
        'si' => $tieneAlcantarillado,
    ],

    /* ----------------------------------------------------------------- Procesos */
    'P14' => [
        'seccion' => 'Procesos de Acueducto y Alcantarillado',
        'titulo' => '14. Pensando en los procesos asociados al servicio de Acueducto y Alcantarillado, ¿cómo calificaría…?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => [
            'aviso_suspension' => 'La oportunidad en el aviso de suspensión del servicio de acueducto, excepto en caso de no pago',
            'factura_entender' => 'La facilidad para entender la factura de acueducto y alcantarillado',
            'exactitud_cobros' => 'La exactitud de los cobros en relación con lo que se consume',
            'tiempo_pago' => 'El tiempo entre la entrega de la factura y la fecha límite de pago',
        ],
        'si_alguno' => $tieneAcuOAlc,
    ],
    'P15' => [
        'titulo' => '15. Pensando en la forma de pago del servicio de Acueducto y Alcantarillado, ¿cómo calificaría…?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => [
            'formas_pago' => 'La variedad de opciones de formas de pago (teléfono, internet, etc.)',
            'puntos_pago' => 'La variedad de opciones de puntos o sitios de pago',
        ],
        'si_alguno' => $tieneAcuOAlc,
    ],
    'P16' => [
        'titulo' => '16. ¿Le han suspendido el servicio de Acueducto en el último año por falta de pago?',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => $siNo,
        'si' => $tieneAcueducto,
    ],
    'P17' => [
        'titulo' => '17. ¿Cómo califica el tiempo que tomó la empresa para reconectar el servicio después de que usted canceló la deuda?',
        'tipo' => 'radio',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'si' => ['P16' => '1'],
    ],

    /* ----------------------------------------------------------------- Atención acueducto */
    'P18' => [
        'seccion' => 'Atención al cliente · Acueducto y Alcantarillado',
        'titulo' => '18. ¿En el último año ha visitado algún punto de atención de la empresa de Acueducto y Alcantarillado?',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => $siNo,
        'si_alguno' => $tieneAcuOAlc,
    ],
    'P19' => [
        'titulo' => '19. En general, ¿cómo califica el punto de atención de la empresa de Acueducto y Alcantarillado?',
        'tipo' => 'radio',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'si' => ['P18' => '1'],
    ],
    'P20' => [
        'titulo' => '20. ¿Cómo califica la atención que recibió en el punto de atención en los siguientes aspectos?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => $atencion,
        'si' => ['P18' => '1'],
    ],
    'P21' => [
        'titulo' => '21. ¿Cuánto tiempo se demoraron en atenderlo en el punto de atención?',
        'tipo' => 'duracion',
        'obligatoria' => true,
        'si' => ['P18' => '1'],
    ],
    'P22' => [
        'titulo' => '22. ¿Cuánto tiempo tardó la empresa en responder su queja o petición?',
        'tipo' => 'duracion',
        'obligatoria' => false,
        'ayuda' => 'Déjelo vacío si no presentó queja o petición.',
        'si' => ['P18' => '1'],
    ],
    'P23' => [
        'titulo' => '23. ¿Cuál fue el motivo de su última visita al punto de atención?',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => $motivos,
        'si' => ['P18' => '1'],
    ],

    /* ----------------------------------------------------------------- Aseo */
    'P24' => [
        'seccion' => 'Aseo',
        'titulo' => '24. ¿Me podría decir el nombre de la empresa de Aseo que suministra el servicio a su hogar?',
        'tipo' => 'text',
        'obligatoria' => true,
        'si' => $tieneAseo,
    ],
    'P25' => [
        'titulo' => '25. En términos generales, ¿cómo califica la calidad del servicio de Aseo?',
        'tipo' => 'radio',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calidad,
        'si' => $tieneAseo,
    ],
    'P26' => [
        'titulo' => '26. ¿Cómo califica el siguiente aspecto del servicio de Aseo?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => ['cumplimiento' => 'El cumplimiento del día y hora a la que debe pasar el carro'],
        'si' => $tieneAseo,
    ],
    'P27' => [
        'titulo' => '27. Pensando en los procesos asociados al servicio, ¿cómo calificaría…?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => [
            'factura_entender' => 'La facilidad para entender la factura',
            'tiempo_pago' => 'El tiempo entre la entrega de la factura y la fecha límite de pago',
        ],
        'si' => $tieneAseo,
    ],
    'P28' => [
        'titulo' => '28. Pensando en la forma de pago del servicio de Aseo, ¿cómo calificaría…?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => [
            'formas_pago' => 'La variedad de opciones de formas de pago (teléfono, internet, etc.)',
            'puntos_pago' => 'La variedad de opciones de puntos o sitios de pago',
        ],
        'si' => $tieneAseo,
    ],

    /* ----------------------------------------------------------------- Atención aseo */
    'P29' => [
        'seccion' => 'Atención al cliente · Aseo',
        'titulo' => '29. ¿En el último año ha visitado el punto de atención de la empresa de Aseo?',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => $siNo,
        'si' => $tieneAseo,
    ],
    'P30' => [
        'titulo' => '30. En general, ¿cómo califica el punto de atención de la empresa de Aseo?',
        'tipo' => 'radio',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'si' => ['P29' => '1'],
    ],
    'P31' => [
        'titulo' => '31. ¿Cómo califica la atención que recibió en el punto de atención de la empresa de Aseo en los siguientes aspectos?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => $atencion,
        'si' => ['P29' => '1'],
    ],
    'P32' => [
        'titulo' => '32. ¿Cuánto tiempo se demoraron en atenderlo en el punto de atención de la empresa de Aseo?',
        'tipo' => 'duracion',
        'obligatoria' => true,
        'si' => ['P29' => '1'],
    ],
    'P33' => [
        'titulo' => '33. ¿Cuánto tiempo tardó la empresa de Aseo en responder su queja o petición?',
        'tipo' => 'duracion',
        'obligatoria' => false,
        'ayuda' => 'Déjelo vacío si no presentó queja o petición.',
        'si' => ['P29' => '1'],
    ],
    'P34' => [
        'titulo' => '34. ¿Cuál fue el motivo de su última visita a las oficinas de la empresa de Aseo?',
        'tipo' => 'radio',
        'obligatoria' => true,
        'opciones' => $motivos,
        'si' => ['P29' => '1'],
    ],

    /* ----------------------------------------------------------------- Otras de aseo */
    'P35' => [
        'seccion' => 'Programa "Huila sin basuras"',
        'introduccion' => 'Aguas del Huila S.A. E.S.P. desarrolló el programa "Huila sin basuras", cuyo objetivo era efectuar desde la vivienda la separación de los residuos orgánicos de los inorgánicos.',
        'titulo' => '35. Responda Sí o No a cada aspecto',
        'tipo' => 'matriz',
        'obligatoria' => true,
        'opciones' => $siNo,
        'filas' => [
            'participo' => 'Usted o algún miembro de su familia participó en las actividades de sensibilización y capacitación',
            'separa' => 'Efectúa en su vivienda la separación de los residuos orgánicos e inorgánicos',
            'canecas' => 'Utiliza las canecas que fueron entregadas para este propósito',
            'dias_organicos' => 'Saca los residuos orgánicos en los días definidos para su recolección',
            'conoce_dias' => 'Conoce los días en los que debe sacar los residuos orgánicos y los inservibles',
            'continuar' => 'Considera que la empresa debe continuar con el proceso de separación en la fuente',
        ],
        'si' => $tieneAseo,
    ],
    'P36' => [
        'titulo' => '36. Pensando en otros aspectos del aseo de su municipio, ¿cómo calificaría…?',
        'tipo' => 'matriz',
        'escala' => true,
        'obligatoria' => true,
        'opciones' => $calificacion,
        'filas' => [
            'parques' => 'El aseo de parques y avenidas de su ciudad o municipio',
            'barrido' => 'La limpieza del andén y la calle frente a su casa, o la calidad del barrido',
        ],
        'si' => $tieneAseo,
    ],
    'P37' => [
        'titulo' => '37. Espontáneamente, ¿cuáles servicios cree que incluye el valor que paga por el servicio de Aseo?',
        'tipo' => 'checkbox',
        'obligatoria' => true,
        'opciones' => [
            '1' => 'Recolección de basuras en domicilios',
            '2' => 'Aseo de parques y avenidas',
            '3' => 'Barrido de calles y andenes del municipio',
            '4' => 'Transporte de las basuras',
            '5' => 'Disposición final de las basuras',
            '6' => 'Otro',
        ],
        'otro' => '6',
        'si' => $tieneAseo,
    ],
    'P37_otro' => [
        'titulo' => '¿Cuál otro servicio?',
        'tipo' => 'text',
        'obligatoria' => true,
        'si' => ['P37' => '6'],
    ],

    /* ----------------------------------------------------------------- Percepciones */
    'P38' => [
        'seccion' => 'Percepciones generales',
        'titulo' => '38. ¿Cómo califica el precio de cada servicio comparado con el servicio que recibe a cambio?',
        'tipo' => 'matriz',
        'obligatoria' => true,
        'opciones' => ['5' => 'Muy bajo', '4' => 'Bajo', '3' => 'Justo', '2' => 'Alto', '1' => 'Muy alto', '9' => 'No sabe'],
        'filas' => [
            'acueducto' => ['Acueducto', $tieneAcueducto],
            'alcantarillado' => ['Alcantarillado', $tieneAlcantarillado],
            'aseo' => ['Aseo', $tieneAseo],
        ],
    ],
    'P39' => [
        'titulo' => '39. ¿En cuál de los siguientes servicios cambiaría de empresa si pudiera?',
        'tipo' => 'matriz',
        'obligatoria' => true,
        'opciones' => $siNo,
        'filas' => [
            'acueducto' => ['Acueducto', $tieneAcueducto],
            'alcantarillado' => ['Alcantarillado', $tieneAlcantarillado],
            'aseo' => ['Aseo', $tieneAseo],
        ],
    ],
    'P40' => [
        'titulo' => '40. ¿Sabe si en cada servicio recibe subsidio, paga aporte solidario o ninguno de los dos?',
        'tipo' => 'matriz',
        'obligatoria' => true,
        'opciones' => ['1' => 'Subsidio', '2' => 'Aporte solidario', '3' => 'Ninguno', '9' => 'No sabe'],
        'filas' => [
            'acueducto' => ['Acueducto', $tieneAcueducto],
            'alcantarillado' => ['Alcantarillado', $tieneAlcantarillado],
            'aseo' => ['Aseo', $tieneAseo],
        ],
    ],
    'P41' => [
        'titulo' => '41. Señale el aspecto que considera más importante en la prestación del servicio de ACUEDUCTO',
        'tipo' => 'textarea',
        'obligatoria' => true,
        'alternativa' => $noSabe,
        'si' => $tieneAcueducto,
    ],
    'P42' => [
        'titulo' => '42. Señale el aspecto que considera más importante en la prestación del servicio de ALCANTARILLADO',
        'tipo' => 'textarea',
        'obligatoria' => true,
        'alternativa' => $noSabe,
        'si' => $tieneAlcantarillado,
    ],
    'P43' => [
        'titulo' => '43. Señale el aspecto que considera más importante en la prestación del servicio de RECOLECCIÓN DE BASURA Y BARRIDO',
        'tipo' => 'textarea',
        'obligatoria' => true,
        'alternativa' => $noSabe,
        'si' => $tieneAseo,
    ],

    /* ----------------------------------------------------------------- Fecha */
    'P44_fecha' => [
        'seccion' => 'Fecha de diligenciamiento',
        'titulo' => 'Fecha de diligenciamiento de la encuesta',
        'tipo' => 'date',
        'obligatoria' => true,
        'siempre' => true,
    ],
];
