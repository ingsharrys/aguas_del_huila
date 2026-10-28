<?php

namespace App\Services;

use App\Models\ConfiguracionSmtp;
use App\Models\RemitenteCorreo;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

/**
 * Envío de correos usando el SMTP y los remitentes configurados en el panel
 * (Configuración > Correo). Si no hay SMTP activo en el panel, usa el .env.
 */
class CorreoService
{
    // Mailer dinámico creado a partir de la configuración del panel
    private const MAILER_PANEL = 'smtp_panel';

    // Tipos de correo que envía el sitio, agrupados por formulario
    public const ENVIOS = [
        'pqrsdf_radicacion_interna' => [
            'formulario'    => 'PQRSDF',
            'nombre'        => 'Aviso interno de nueva PQRSDF',
            'descripcion'   => 'Se envía al equipo de atención cuando un ciudadano radica una PQRSDF.',
            'destinatarios' => true,
        ],
        'pqrsdf_radicacion_ciudadano' => [
            'formulario'    => 'PQRSDF',
            'nombre'        => 'Constancia de radicado al ciudadano',
            'descripcion'   => 'Confirma al ciudadano el número de radicado.',
            'destinatarios' => false,
        ],
        'pqrsdf_asignacion' => [
            'formulario'    => 'PQRSDF',
            'nombre'        => 'Asignación a funcionario',
            'descripcion'   => 'Avisa al funcionario que se le asignó una PQRSDF.',
            'destinatarios' => false,
        ],
        'pqrsdf_respuesta' => [
            'formulario'    => 'PQRSDF',
            'nombre'        => 'Respuesta al ciudadano',
            'descripcion'   => 'Respuesta oficial aprobada, con documentos adjuntos.',
            'destinatarios' => false,
        ],
        'pqrsdf_vencimiento' => [
            'formulario'    => 'PQRSDF',
            'nombre'        => 'Alertas de vencimiento',
            'descripcion'   => 'Alertas diarias a responsables de PQRSDF próximas a vencer o vencidas.',
            'destinatarios' => false,
        ],
    ];

    /**
     * Envía un correo del tipo indicado. Lanza excepción si falla, igual que Mail::send().
     */
    public static function enviar(string $clave, string|array $para, Mailable $correo): void
    {
        $remitente = static::remitente($clave);
        $mailer = static::mailer(); // define también el remitente por defecto

        if ($remitente?->remitente_correo) {
            $correo->from($remitente->remitente_correo, $remitente->remitente_nombre ?: config('mail.from.name'));
        }

        if ($remitente?->responder_a) {
            $correo->replyTo($remitente->responder_a);
        }

        $para = collect((array) $para)->map(fn ($c) => trim($c))->filter()->all();

        $mailer->to($para)->send($correo);
    }

    /**
     * Destinatarios internos configurados para un tipo de correo, o los indicados por defecto.
     */
    public static function destinatarios(string $clave, array $porDefecto = []): array
    {
        $configurados = static::remitente($clave)?->listaDestinatarios() ?? [];

        return $configurados ?: $porDefecto;
    }

    /**
     * Mailer a usar: el SMTP del panel si está activo, o el configurado en el .env.
     */
    public static function mailer(?ConfiguracionSmtp $smtp = null): Mailer
    {
        $smtp ??= static::tablasListas() ? ConfiguracionSmtp::actual() : null;

        if (!$smtp || !$smtp->activo) {
            return Mail::mailer();
        }

        config([
            'mail.mailers.' . self::MAILER_PANEL => [
                'transport'    => 'smtp',
                // ssl = conexión cifrada desde el inicio (465); tls/ninguno = STARTTLS si el servidor lo ofrece
                'scheme'       => $smtp->cifrado === 'ssl' ? 'smtps' : 'smtp',
                'host'         => $smtp->host,
                'port'         => $smtp->puerto,
                'username'     => $smtp->usuario,
                'password'     => $smtp->password,
                'timeout'      => $smtp->timeout,
                'local_domain' => parse_url((string) config('app.url'), PHP_URL_HOST),
            ],
            'mail.from' => [
                'address' => $smtp->remitente_correo,
                'name'    => $smtp->remitente_nombre,
            ],
        ]);

        // Descartar el mailer en memoria para que tome la configuración actual
        Mail::purge(self::MAILER_PANEL);

        return Mail::mailer(self::MAILER_PANEL);
    }

    private static function remitente(string $clave): ?RemitenteCorreo
    {
        if (!static::tablasListas()) {
            return null;
        }

        return RemitenteCorreo::where('clave', $clave)->first();
    }

    // Evita errores si aún no se ha ejecutado la migración
    private static function tablasListas(): bool
    {
        static $listas = null;

        return $listas ??= Schema::hasTable('configuracion_smtp') && Schema::hasTable('remitentes_correo');
    }
}
