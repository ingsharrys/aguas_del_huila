<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva PQRSDF recibida</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:40px 0;">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,.08);">

                    <!-- Encabezado -->
                    <tr>
                        <td align="center" style="background:#0b5ed7;padding:30px;">

                            <h1 style="color:white;">
                                Aguas del Huila S.A. E.S.P.
                            </h1>

                        </td>
                    </tr>

                    <!-- Contenido -->
                    <tr>
                        <td style="padding:40px;">

                            <h2 style="margin-top:0;color:#0b5ed7;">
                                Nueva PQRSDF recibida
                            </h2>

                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="border:1px solid #e5e5e5;border-collapse:collapse;margin:30px 0;">

                                <tr style="background:#f8f9fa;">
                                    <td width="35%"><strong>Código de Radicado</strong></td>
                                    <td>{{ $pqrs->codigo_radicado }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Fecha</strong></td>
                                    <td>{{ $pqrs->created_at }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Estado</strong></td>
                                    <td>{{ $pqrs->estado }}</td>
                                </tr>

                                <tr style="background:#f8f9fa;">
                                    <td><strong>Tipo de PQRSDF</strong></td>
                                    <td>{{ $pqrs->tipo_pqrsf }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Asunto</strong></td>
                                    <td>{{ $pqrs->asunto }}</td>
                                </tr>

                                <tr style="background:#f8f9fa;">
                                    <td><strong>Descripción</strong></td>
                                    <td>
                                        {!! nl2br(e($pqrs->descripcion)) !!}
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong>Medio de respuesta</strong></td>
                                    <td>
                                        {{ $pqrs->tipo_respuesta }}
                                        @if($pqrs->tipo_respuesta == 'WhatsApp' && $pqrs->movil)
                                            ({{ $pqrs->movil }})
                                        @elseif(in_array($pqrs->tipo_respuesta, ['Correo Certificado', 'Físico / Mensajería']) && $pqrs->direccion_mensajeria)
                                            ({{ $pqrs->direccion_mensajeria }})
                                        @endif
                                    </td>
                                </tr>

                            </table>

                            <div style="background:#e8f4ff;border-left:5px solid #0b5ed7;padding:15px;border-radius:5px;">

                                <strong>Información importante</strong>

                                <p style="margin-bottom:0;color:#555;line-height:1.7;">
                                    Ingrese al administrador de PQRSDF para gestionar la solicitud y dar respuesta al ciudadano.
                                </p>

                            </div>

                            <p style="margin-top:40px;">
                                Atentamente,
                            </p>

                            <strong style="color:#0b5ed7;font-size:16px;">
                                Aguas del Huila S.A. E.S.P.
                            </strong>

                        </td>
                    </tr>

                    <!-- Pie -->
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
```
