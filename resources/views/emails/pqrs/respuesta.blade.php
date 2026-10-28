<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Radicado: {{ $respuesta->pqrsdf->codigo_radicado }} - {{ $respuesta->titulo_respuesta }}</title>

</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table
        width="100%"
        cellpadding="0"
        cellspacing="0"
        border="0"
        style="background-color:#f3f4f6; padding:30px 15px;"
    >

        <tr>

            <td align="center">

                <table
                    width="600"
                    cellpadding="0"
                    cellspacing="0"
                    border="0"
                    style="max-width:600px; width:100%; background:#ffffff; border-radius:10px; overflow:hidden;"
                >

                    <!-- Encabezado -->

                    <tr>

                        <td style="background:#16a34a; padding:25px; text-align:center;" >

                            <h1 style="margin:0; color:#ffffff; font-size:22px;" >Respuesta a su solicitud</h1>

                            <p style="margin:8px 0 0; color:#dcfce7; font-size:14px;" >Radicado: <strong>{{ $respuesta->pqrsdf->codigo_radicado }}</strong></p>

                        </td>

                    </tr>


                    <!-- Contenido -->

                    <tr>

                        <td style="padding:30px;">

                            <p style="margin-top:0; color:#374151; font-size:15px;" >Estimado(a): {{ $respuesta->pqrsdf->nombre_usuario }} {{ $respuesta->pqrsdf->apellido_usuario }}</p>


                            <p style="color:#374151; font-size:15px; line-height:1.6;" >En atención a su solicitud de <strong>PQRSDF</strong>, nos permitimos comunicarle la siguiente respuesta: </p>


                            <!-- Título -->

                            <h2 style="color:#111827; font-size:20px; margin-top:25px;" >{{ $respuesta->titulo_respuesta }} </h2>


                            <!-- Respuesta -->

                            <div style="color:#374151; font-size:15px; line-height:1.7;" >{!! \App\Support\HtmlSeguro::mostrar($respuesta->texto_respuesta) !!}</div>


                            <!-- Información -->

                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                style="margin-top:25px; background:#f9fafb; border-radius:8px;"
                            >

                                <tr>

                                    <td style="padding:15px;">

                                        <strong>
                                            Tipo de solicitud:
                                        </strong>

                                        {{ $respuesta->pqrsdf->tipo_pqrsf }}

                                    </td>

                                </tr>


                                <tr>

                                    <td style="padding:15px;">

                                        <strong>
                                            Fecha de respuesta:
                                        </strong>

                                        {{ $respuesta->created_at->format('d/m/Y H:i') }}

                                    </td>

                                </tr>

                            </table>


                            @if($respuesta->documentos->count() > 0)

                                <p style="margin-top:25px; color:#374151; font-size:14px;" > <strong>Documentos adjuntos: </strong>Se han adjuntado documentos relacionados con esta respuesta</p>

                                <ol style="color:#6b7280; font-size:13px;" >
                                    @foreach($respuesta->documentos as $documento)
                                        <li>{{ $documento->nombre_original }}</li>
                                    @endforeach
                                </ol>

                            @endif


                            <p
                                style="margin-top:30px; color:#374151; font-size:15px;"
                            >
                                Atentamente,
                            </p>


                            <p
                                style="margin-bottom:0; color:#111827; font-weight:bold;"
                            >
                                {{ $respuesta->usuario->name }}
                            </p>

                            <p
                                style="margin-top:5px; color:#6b7280; font-size:13px;"
                            >
                                {{ $respuesta->usuario->area->nombre ?? 'No asignada' }}
                            </p>

                        </td>

                    </tr>


                    <!-- Footer -->

                    <tr>
                        <td align="center"
                            style="background:#0b5ed7;color:#ffffff;padding:18px;font-size:13px;">

                            © {{ date('Y') }} Aguas del Huila S.A. E.S.P.<br>
                            Este es un mensaje automático, por favor no responder este correo.

                        </td>
                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>