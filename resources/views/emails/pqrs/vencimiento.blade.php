<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta de vencimiento de PQRSDF</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:40px 0;">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,.08);">

                    <!-- Encabezado -->
                    <tr>
                        <td align="center"
                            style="background-color:#0b5ed7;padding:25px 20px;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;line-height:1.4;">
                                Aguas del Huila S.A. E.S.P.
                            </h1>
                        </td>
                    </tr>

                    <!-- Contenido -->
                    <tr>
                        <td style="padding:30px 24px;">

                            <h2 style="margin:0 0 24px;color:#0b5ed7;font-size:22px;line-height:1.4;">
                                Alerta de vencimiento de PQRSDF
                            </h2>

                            <p style="margin:0 0 16px;font-size:15px;line-height:1.7;">
                                Estimado(a) {{ $destinatario->name }},
                            </p>

                            <p style="margin:0 0 20px;font-size:15px;line-height:1.7;">
                                Se informa que la siguiente solicitud de PQRSDF tiene como fecha límite de respuesta
                                el <strong>{{ \Carbon\Carbon::parse($pqrs->fecha_limite_respuesta)->format('d/m/Y') }}</strong>.
                                De acuerdo con la programación de alertas, restan dos días calendario para el vencimiento.
                                Se solicita adelantar las gestiones necesarias para responder dentro del plazo establecido.
                            </p>

                            <!-- Datos de la solicitud -->
                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="border:1px solid #e5e5e5;border-collapse:collapse;margin:30px 0;">

                                <tr>
                                    <td width="38%" valign="top"
                                        style="border:1px solid #dfe3e8;background-color:#f8f9fa;">
                                        <strong>Código de radicado</strong>
                                    </td>
                                    <td valign="top" style="border:1px solid #dfe3e8;">
                                        {{ $pqrs->codigo_radicado }}
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top"
                                        style="border:1px solid #dfe3e8;background-color:#f8f9fa;">
                                        <strong>Estado</strong>
                                    </td>
                                    <td valign="top" style="border:1px solid #dfe3e8;">
                                        {{ $pqrs->estado }}
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top"
                                        style="border:1px solid #dfe3e8;background-color:#f8f9fa;">
                                        <strong>Fecha límite de respuesta</strong>
                                    </td>
                                    <td valign="top" style="border:1px solid #dfe3e8;">
                                        {{ \Carbon\Carbon::parse($pqrs->fecha_limite_respuesta)->format('d/m/Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top"
                                        style="border:1px solid #dfe3e8;background-color:#f8f9fa;">
                                        <strong>Observación</strong>
                                    </td>
                                    <td valign="top" style="border:1px solid #dfe3e8;">
                                        @if ($tipo === 'vencimiento_revision')
                                            La solicitud se encuentra en revisión. Se solicita verificar su gestión para evitar el vencimiento del plazo.
                                        @elseif ($tipo === 'vencimiento_corregir')
                                            La solicitud requiere correcciones. Se solicita gestionar los ajustes correspondientes dentro del plazo establecido.
                                        @else
                                            Se solicita gestionar la solicitud y emitir la respuesta al ciudadano dentro del plazo establecido.
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top"
                                        style="border:1px solid #dfe3e8;background-color:#f8f9fa;">
                                        <strong>Asunto</strong>
                                    </td>
                                    <td valign="top" style="border:1px solid #dfe3e8;">
                                        {{ $pqrs->asunto ?? 'No especificado' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td valign="top"
                                        style="border:1px solid #dfe3e8;background-color:#f8f9fa;">
                                        <strong>Medio de respuesta</strong>
                                    </td>
                                    <td valign="top" style="border:1px solid #dfe3e8;">
                                        {{ $pqrs->tipo_respuesta ?? 'No especificado' }}
                                    </td>
                                </tr>

                            </table>

                            <!-- Acción requerida -->
                            <div style="background:#e8f4ff;border-left:5px solid #0b5ed7;padding:15px;border-radius:5px;">

                                <strong>Información importante</strong>

                                <p style="margin-bottom:0;color:#555;line-height:1.7;">
                                    Ingrese al administrador de PQRSDF para consultar la solicitud, adelantar
                                    las acciones correspondientes y emitir la respuesta dentro del término legal.
                                </p>

                                <a href="https://aguasdelhuila.gov.co/dashboard/comunicaciones/pqrsdf" style="display:inline-block;margin-top:10px;padding:10px 20px;background:#0b5ed7;color:white;text-decoration:none;border-radius:5px;">Ir al administrador de PQRSDF</a>

                            </div>

                            <p style="margin:30px 0 12px;font-size:15px;line-height:1.6;">
                                Atentamente,
                            </p>

                            <p style="margin:0;color:#0b5ed7;font-size:16px;font-weight:bold;line-height:1.5;">
                                Aguas del Huila S.A. E.S.P.
                            </p>

                        </td>
                    </tr>

                    <!-- Pie -->
                    <tr>
                        <td align="center"
                            style="background-color:#0b5ed7;color:#ffffff;padding:18px 15px;font-size:12px;line-height:1.7;">
                            &copy; {{ date('Y') }} Aguas del Huila S.A. E.S.P.<br>
                            Este es un mensaje automático. Por favor, no responda a este correo.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>