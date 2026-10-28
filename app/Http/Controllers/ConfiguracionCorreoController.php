<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionSmtp;
use App\Models\RemitenteCorreo;
use App\Services\CorreoService;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ConfiguracionCorreoController extends Controller
{
    public function edit()
    {
        $smtp = ConfiguracionSmtp::actual();
        $remitentes = RemitenteCorreo::all()->keyBy('clave');
        $envios = CorreoService::ENVIOS;

        return view('configuracion.correo', compact('smtp', 'remitentes', 'envios'));
    }

    public function updateSmtp(Request $request)
    {
        $smtp = ConfiguracionSmtp::actual() ?? new ConfiguracionSmtp();

        $data = $this->validarSmtp($request, $smtp);

        // Si no se escribe contraseña, se conserva la guardada
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $smtp->fill($data)->save();

        Log::channel('emails')->info('Configuración SMTP actualizada', [
            'usuario' => $request->user()->id,
            'host'    => $smtp->host,
            'activo'  => $smtp->activo,
        ]);

        return redirect()->route('configuracion.correo')->with('success', 'Configuración SMTP guardada correctamente.');
    }

    public function updateRemitentes(Request $request)
    {
        $claves = array_keys(CorreoService::ENVIOS);

        $data = $request->validate([
            'remitentes'                        => ['required', 'array'],
            'remitentes.*.remitente_correo'     => ['nullable', 'email', 'max:255'],
            'remitentes.*.remitente_nombre'     => ['nullable', 'string', 'max:255'],
            'remitentes.*.responder_a'          => ['nullable', 'email', 'max:255'],
            'remitentes.*.destinatarios'        => ['nullable', 'string', 'max:2000'],
        ], [], [
            'remitentes.*.remitente_correo' => 'correo del remitente',
            'remitentes.*.remitente_nombre' => 'nombre del remitente',
            'remitentes.*.responder_a'      => 'responder a',
            'remitentes.*.destinatarios'    => 'destinatarios',
        ]);

        foreach ($data['remitentes'] as $clave => $valores) {
            if (!in_array($clave, $claves, true)) {
                continue;
            }

            // Validar cada correo de la lista de destinatarios
            $invalidos = collect(preg_split('/[\s,;]+/', (string) ($valores['destinatarios'] ?? '')))
                ->filter()
                ->reject(fn ($correo) => filter_var($correo, FILTER_VALIDATE_EMAIL));

            if ($invalidos->isNotEmpty()) {
                return back()->withInput()->withErrors([
                    "remitentes.$clave.destinatarios" => 'Correos no válidos en "' . CorreoService::ENVIOS[$clave]['nombre'] . '": ' . $invalidos->implode(', '),
                ]);
            }

            RemitenteCorreo::updateOrCreate(['clave' => $clave], [
                'remitente_correo' => $valores['remitente_correo'] ?? null,
                'remitente_nombre' => $valores['remitente_nombre'] ?? null,
                'responder_a'      => $valores['responder_a'] ?? null,
                'destinatarios'    => CorreoService::ENVIOS[$clave]['destinatarios'] ? ($valores['destinatarios'] ?? null) : null,
            ]);
        }

        return redirect()->route('configuracion.correo')->with('success', 'Remitentes guardados correctamente.');
    }

    /**
     * Envía un correo de prueba con los datos escritos en el formulario (sin guardarlos).
     */
    public function probar(Request $request)
    {
        $guardada = ConfiguracionSmtp::actual();
        $data = $this->validarSmtp($request, $guardada ?? new ConfiguracionSmtp());
        $request->validate(['correo_prueba' => ['required', 'email', 'max:255']], [], ['correo_prueba' => 'correo de prueba']);

        $smtp = new ConfiguracionSmtp($data);
        $smtp->activo = true;

        if (blank($data['password'] ?? null)) {
            $smtp->password = $guardada?->password;
        }

        try {
            CorreoService::mailer($smtp)->raw(
                "Este es un correo de prueba enviado desde el panel de administración de " . config('app.name') . ".\n\n"
                . "Servidor: {$smtp->host}:{$smtp->puerto} (" . ($smtp->cifrado ?: 'sin cifrado') . ")\n"
                . 'Fecha: ' . now()->format('Y-m-d H:i:s'),
                fn (Message $mensaje) => $mensaje
                    ->to($request->correo_prueba)
                    ->subject('Prueba de configuración SMTP')
            );
        } catch (\Throwable $e) {
            Log::channel('emails')->error('Error en correo de prueba SMTP', [
                'host'  => $smtp->host,
                'error' => $e->getMessage(),
            ]);

            return back()->withInput()->with('error', 'No se pudo enviar el correo de prueba: ' . $e->getMessage());
        }

        return back()->withInput()->with('success', "Correo de prueba enviado a {$request->correo_prueba}. Si llegó, guarde la configuración.");
    }

    private function validarSmtp(Request $request, ConfiguracionSmtp $smtp): array
    {
        return $request->validate([
            'activo'            => ['boolean'],
            'host'              => ['required', 'string', 'max:255'],
            'puerto'            => ['required', 'integer', 'between:1,65535'],
            'cifrado'           => ['nullable', Rule::in(['tls', 'ssl'])],
            'usuario'           => ['nullable', 'string', 'max:255'],
            // Obligatoria solo la primera vez si hay usuario
            'password'          => [$smtp->exists && $smtp->password ? 'nullable' : 'required_with:usuario', 'nullable', 'string', 'max:255'],
            'timeout'           => ['required', 'integer', 'between:5,120'],
            'remitente_correo'  => ['required', 'email', 'max:255'],
            'remitente_nombre'  => ['required', 'string', 'max:255'],
        ], [], [
            'host'             => 'servidor SMTP',
            'puerto'           => 'puerto',
            'cifrado'          => 'cifrado',
            'usuario'          => 'usuario',
            'password'         => 'contraseña',
            'timeout'          => 'tiempo de espera',
            'remitente_correo' => 'correo del remitente por defecto',
            'remitente_nombre' => 'nombre del remitente por defecto',
        ]) + ['activo' => $request->boolean('activo')];
    }
}
