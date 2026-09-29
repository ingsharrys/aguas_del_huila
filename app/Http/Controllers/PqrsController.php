<?php

namespace App\Http\Controllers;

use App\Mail\PqrsAdminMail;
use App\Mail\PqrsUsuarioMail;
use App\Models\DepartamentoCol;
use App\Models\EncuestaPqrsdf;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class PqrsController extends Controller
{
    // Canales por los que el ciudadano puede recibir la respuesta
    public const CANAL_CORREO      = 'Correo Electrónico';
    public const CANAL_CERTIFICADO = 'Correo Certificado';
    public const CANAL_WHATSAPP    = 'WhatsApp';

    public const CANALES = [
        self::CANAL_CORREO,
        self::CANAL_CERTIFICADO,
        self::CANAL_WHATSAPP,
    ];

    public function index()
    {
        $departamentos = DepartamentoCol::orderBy('id')->get();
        
        return view('participacion.pqr', compact('departamentos'));
    }

    public function municipios($departamento)
    {
        $municipios = Municipio::where('departamento_id', $departamento)
            ->where('estado', 1)
            ->orderBy('nombre')
            ->get([
                'id',
                'nombre'
            ]);

        return response()->json($municipios);
    }

    public function store(Request $request)
    {
        $clientIp = $request->ip();

        // 1. Verificar si la IP ya envió una PQR hoy
        $yaEnvioHoy = EncuestaPqrsdf::where('ip_address', $clientIp)
            ->whereDate('created_at', now()->today())
            ->exists();

        if ($yaEnvioHoy) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Ya has enviado una solicitud el día de hoy. Por favor, intenta de nuevo mañana.'
                );
                
        }

        $esIdentificado = $request->input('identificado_anonimo') === 'identificado';
        $canal          = $request->input('tipo_respuesta');
        $esJuridica     = $request->input('tipo_solicitante') === 'Persona Jurídica';
        $esColombia     = $request->input('pais') === 'Colombia';

        // Obligatorio solo si es identificado
        $siIdentificado = $esIdentificado ? 'required' : 'nullable';

        $request->validate([

            'discapacidad'             => 'required|boolean',
            'tipo_discapacidad'        => 'required_if:discapacidad,1|nullable|string|max:150',
            'otra_discapacidad'        => 'required_if:tipo_discapacidad,otra|nullable|string|max:255',

            'identificado_anonimo'     => 'required|in:identificado,anonimo',

            'tipo_solicitante'         => [$siIdentificado, 'string', 'max:100'],
            'tipo_identificacion'      => [$siIdentificado, 'string', 'max:100'],
            'numero_identificacion'    => [$siIdentificado, 'string', 'max:50'],

            'razon_social'             => [$esIdentificado && $esJuridica ? 'required' : 'nullable', 'string', 'max:255'],
            'nombre_usuario'           => [$esIdentificado && !$esJuridica ? 'required' : 'nullable', 'string', 'max:150'],
            'apellido_usuario'         => [$esIdentificado && !$esJuridica ? 'required' : 'nullable', 'string', 'max:150'],

            // Correo: siempre si es identificado, o si el anónimo eligió respuesta por correo
            'correo_electronico'       => [
                $esIdentificado || $canal === self::CANAL_CORREO ? 'required' : 'nullable',
                'email',
                'max:200',
            ],

            'pais'                     => [$siIdentificado, 'in:Colombia,Otro'],
            'otro_pais'                => [$esIdentificado && !$esColombia ? 'required' : 'nullable', 'string', 'max:100'],

            'departamento_id'          => [$esIdentificado && $esColombia ? 'required' : 'nullable', 'exists:departamentos_col,id'],
            'municipio_id'             => [$esIdentificado && $esColombia ? 'required' : 'nullable', 'exists:municipios_col,id'],

            'direccion'                => [$siIdentificado, 'string', 'max:255'],

            'fijo'                     => 'nullable|string|max:30',
            'movil'                    => [$siIdentificado, 'string', 'max:30'],

            // WhatsApp del anónimo (el identificado usa su teléfono móvil)
            'numero_whatsapp'          => [!$esIdentificado && $canal === self::CANAL_WHATSAPP ? 'required' : 'nullable', 'string', 'max:30'],

            'tipo_pqrsf'               => 'required|string|max:255',
            'tipo_respuesta'           => 'required|in:' . implode(',', self::CANALES),
            'direccion_mensajeria'     => [$canal === self::CANAL_CERTIFICADO ? 'required' : 'nullable', 'string', 'max:500'],

            'asunto'                   => 'required|string|max:255',

            'descripcion'              => 'required|string',

            'autoriza'                 => 'accepted'

        ], [
            'required'                    => 'El campo :attribute es obligatorio.',
            'required_if'                 => 'El campo :attribute es obligatorio.',
            'email'                       => 'El :attribute no es válido.',
            'in'                          => 'El valor de :attribute no es válido.',
            'exists'                      => 'El valor de :attribute no es válido.',
            'accepted'                    => 'Debe autorizar el tratamiento de datos personales.',
        ], [
            'discapacidad'                => 'condición de discapacidad',
            'tipo_discapacidad'           => 'tipo de discapacidad',
            'otra_discapacidad'           => 'otra discapacidad',
            'identificado_anonimo'        => 'identificado o anónimo',
            'tipo_solicitante'            => 'tipo de solicitante',
            'tipo_identificacion'         => 'tipo de identificación',
            'numero_identificacion'       => 'número de identificación',
            'razon_social'                => 'razón social',
            'nombre_usuario'              => 'nombre',
            'apellido_usuario'            => 'apellido',
            'correo_electronico'          => 'correo electrónico',
            'pais'                        => 'país',
            'otro_pais'                   => 'nombre del país',
            'departamento_id'             => 'departamento',
            'municipio_id'                => 'municipio',
            'direccion'                   => 'dirección',
            'movil'                       => 'teléfono móvil',
            'numero_whatsapp'             => 'número de WhatsApp',
            'tipo_pqrsf'                  => 'tipo de PQRSF',
            'tipo_respuesta'              => 'canal de respuesta',
            'direccion_mensajeria'        => 'dirección para el correo certificado',
            'asunto'                      => 'asunto',
            'descripcion'                 => 'descripción',
        ]);

        // Si es anónimo no se guardan datos personales; solo el contacto del canal elegido
        if (!$esIdentificado) {
            $request->merge([
                'tipo_solicitante'      => null,
                'tipo_identificacion'   => null,
                'numero_identificacion' => null,
                'razon_social'          => null,
                'nombre_usuario'        => null,
                'apellido_usuario'      => null,
                'pais'                  => null,
                'otro_pais'             => null,
                'departamento_id'       => null,
                'municipio_id'          => null,
                'direccion'             => null,
                'fijo'                  => null,
                'movil'                 => $canal === self::CANAL_WHATSAPP ? $request->numero_whatsapp : null,
                'correo_electronico'    => $canal === self::CANAL_CORREO ? $request->correo_electronico : null,
            ]);
        }

        if ($canal !== self::CANAL_CERTIFICADO) {
            $request->merge(['direccion_mensajeria' => null]);
        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Generar código de radicado
            |--------------------------------------------------------------------------
            */

            $anio = now()->year;

            $ultimoCodigo = EncuestaPqrsdf::where('codigo_radicado','like',"PQRSDF{$anio}%")->orderByDesc('codigo_radicado')->value('codigo_radicado');

            if ($ultimoCodigo) {

                $ultimoNumero = (int) substr($ultimoCodigo, -6);

                $consecutivo = $ultimoNumero + 1;

            } else {

                $consecutivo = 1;
            }

            $codigo = 'PQRSDF' . $anio . str_pad($consecutivo, 6, '0', STR_PAD_LEFT);

            $pqrs = EncuestaPqrsdf::create([

                'ip_address'            => $clientIp,
                'discapacidad'          => $request->discapacidad,
                'tipo_discapacidad'     => $request->tipo_discapacidad,
                'otra_discapacidad'     => $request->otra_discapacidad,

                'identificado_anonimo'  => $request->identificado_anonimo,

                'tipo_solicitante'      => $request->tipo_solicitante,
                'tipo_identificacion'   => $request->tipo_identificacion,
                'numero_identificacion' => $request->numero_identificacion,

                'razon_social'          => $request->razon_social,
                'nombre_usuario'        => $request->nombre_usuario,
                'apellido_usuario'      => $request->apellido_usuario,

                'correo_electronico'    => $request->correo_electronico,

                'pais'                  => $request->pais,
                'otro_pais'             => $request->otro_pais,

                'departamento_id'       => $request->departamento_id,
                'municipio_id'          => $request->municipio_id,

                'direccion'             => $request->direccion,

                'fijo'                  => $request->fijo,
                'movil'                 => $request->movil,

                'tipo_pqrsf'            => $request->tipo_pqrsf,
                'tipo_respuesta'        => $request->tipo_respuesta,
                'direccion_mensajeria'  => $request->direccion_mensajeria,

                'asunto'                => $request->asunto,
                'descripcion'           => $request->descripcion,

                'codigo_radicado'       => $codigo,

                'estado'                => 'Radicada',

                'fecha_respuesta'       => null,

                'autoriza'              => $request->has('autoriza')

            ]);

            DB::commit();

            // Correo al administrador
            // Log::info('Enviando correo al administrador');
            Mail::to('info@aguasdelhuila.gov.co')->send(new PqrsAdminMail($pqrs));
            //Mail::to('sabicriollo@gmail.com')->send(new PqrsAdminMail($pqrs));

            // Correo al ciudadano (si ingresó correo)
            if (!empty($pqrs->correo_electronico)) {

                Mail::to($pqrs->correo_electronico)->send(new PqrsUsuarioMail($pqrs));

            }

            return redirect()
                ->back()
                ->with(
                    'success',
                    "Su solicitud fue registrada correctamente. Código de radicado: {$codigo}"
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ocurrió un error al registrar la PQRSDF.'
                );
        }
    }

    public function searchCode(Request $request)
    {
        $request->validate([
            'pqrsdf_code' => 'required|string'
        ]);

        $pqrs = EncuestaPqrsdf::where(
            'codigo_radicado',
            $request->pqrsdf_code
        )->first();

        return redirect()
            ->route('pqr')
            ->with([
                'mostrarModal' => true,
                'resultadoBusqueda' => $pqrs
            ]);
    }


}
