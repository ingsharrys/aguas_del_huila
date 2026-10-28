<?php

namespace App\Http\Controllers;

use App\Support\ArchivoSeguro;
use App\Support\HtmlSeguro;
use App\Mail\PqrsAdminMail;
use App\Mail\PqrsUsuarioMail;
use App\Models\DepartamentoCol;
use App\Models\EncuestaPqrsdf;
use App\Models\PqrsdfArchivos;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Services\CorreoService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class PqrsController extends Controller
{
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

        $request->merge([
            'tipo_respuesta' => $request->input('identificado_anonimo') === 'anonimo'
                ? 'Cartelera Virtual'
                : $request->input('tipo_respuesta'),
        ]);

        $esIdentificado = $request->input('identificado_anonimo') === 'identificado';
        $esJuridica     = $request->input('tipo_solicitante') === 'Persona Jurídica';
        $esOtroPais     = strtolower((string) $request->input('pais')) === 'otro';

        // Obligatorio solo si el ciudadano se identifica
        $siIdentificado = $esIdentificado ? 'required' : 'nullable';

        $request->validate([

            'discapacidad'             => 'required|boolean',
            'tipo_discapacidad'        => 'required_if:discapacidad,1|nullable|string|max:150',
            'otra_discapacidad'        => 'required_if:tipo_discapacidad,otra|nullable|string|max:255',

            'identificado_anonimo'     => 'required|in:identificado,anonimo',

            'tipo_solicitante'         => [$siIdentificado, 'nullable', 'string', 'max:100'],
            'tipo_identificacion'      => [$siIdentificado, 'nullable', 'string', 'max:100'],
            'numero_identificacion'    => [$siIdentificado, 'nullable', 'string', 'max:50'],

            'razon_social'             => [$esIdentificado && $esJuridica ? 'required' : 'nullable', 'string', 'max:255'],
            'nombre_usuario'           => [$esIdentificado && !$esJuridica ? 'required' : 'nullable', 'string', 'max:150'],
            'apellido_usuario'         => [$esIdentificado && !$esJuridica ? 'required' : 'nullable', 'string', 'max:150'],

            // El correo es obligatorio para todo ciudadano identificado
            'correo_electronico'       => [$siIdentificado, 'nullable', 'email', 'max:200'],

            'pais'                     => [$siIdentificado, 'nullable', 'string', 'max:100'],
            'otro_pais'                => [$esIdentificado && $esOtroPais ? 'required' : 'nullable', 'string', 'max:100'],

            'departamento_id'          => [$esIdentificado && !$esOtroPais ? 'required' : 'nullable', 'exists:departamentos_col,id'],
            'municipio_id'             => [$esIdentificado && !$esOtroPais ? 'required' : 'nullable', 'exists:municipios_col,id'],

            'direccion'                => [$siIdentificado, 'nullable', 'string', 'max:255'],

            'fijo'                     => 'nullable|string|max:30',
            'movil'                    => [$siIdentificado, 'nullable', 'string', 'max:30'],

            'tipo_pqrsf'               => 'required|string|max:255',
            // La Cartelera Virtual es solo para solicitudes anónimas
            'tipo_respuesta'           => ['required', $esIdentificado
                ? Rule::in(['Correo Electrónico', 'Físico / Mensajería'])
                : Rule::in(['Cartelera Virtual'])],
            'direccion_mensajeria'     => ['required_if:tipo_respuesta,Físico / Mensajería', 'nullable', 'string', 'max:500'],

            'asunto'                   => 'required|string|max:255',

            'descripcion'              => 'required|string',

            'documentos'               => ['nullable','array','max:5',],

            'documentos.*'             => ['bail','file','max:10240','mimes:pdf,jpg,jpeg,png,gif,webp,doc,docx,xls,xlsx,ppt,pptx','extensions:pdf,jpg,jpeg,png,gif,webp,doc,docx,xls,xlsx,ppt,pptx',],

            'autoriza'                 => 'accepted'

        ], [
            'required'    => 'El campo :attribute es obligatorio.',
            'required_if' => 'El campo :attribute es obligatorio.',
            'email'       => 'El :attribute no es válido.',
            'in'          => 'El valor de :attribute no es válido.',
            'exists'      => 'El valor de :attribute no es válido.',
            'accepted'    => 'Debe autorizar el tratamiento de datos personales.',
        ], [
            'tipo_discapacidad'     => 'tipo de discapacidad',
            'otra_discapacidad'     => 'otra discapacidad',
            'tipo_solicitante'      => 'tipo de solicitante',
            'tipo_identificacion'   => 'tipo de identificación',
            'numero_identificacion' => 'número de identificación',
            'razon_social'          => 'razón social',
            'nombre_usuario'        => 'nombre',
            'apellido_usuario'      => 'apellido',
            'correo_electronico'    => 'correo electrónico',
            'pais'                  => 'país',
            'otro_pais'             => 'nombre del país',
            'departamento_id'       => 'departamento',
            'municipio_id'          => 'municipio',
            'direccion'             => 'dirección',
            'movil'                 => 'teléfono móvil',
            'tipo_pqrsf'            => 'tipo de PQRSF',
            'tipo_respuesta'        => 'canal de respuesta',
            'direccion_mensajeria'  => 'dirección de mensajería',
            'documentos.*'          => 'documento adjunto',
        ]);

        // Verificar el formato real de los adjuntos antes de guardar (el error se muestra en el formulario)
        foreach ($request->file('documentos', []) as $i => $documento) {
            ArchivoSeguro::extension($documento, ArchivoSeguro::DOCUMENTOS, "documentos.$i");
        }

        // Una solicitud anónima no guarda datos personales aunque lleguen en la petición
        if (!$esIdentificado) {
            $request->merge(array_fill_keys([
                'tipo_solicitante', 'tipo_identificacion', 'numero_identificacion', 'razon_social',
                'nombre_usuario', 'apellido_usuario', 'correo_electronico', 'pais', 'otro_pais',
                'departamento_id', 'municipio_id', 'direccion', 'fijo', 'movil', 'direccion_mensajeria',
            ], null));
        }

        DB::beginTransaction();

        $rutasGuardadas = [];

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

            
            /*
            |--------------------------------------------------------------------------
            | Guardar archivos adjuntos de la PQR
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('documentos')) {

                foreach ($request->file('documentos') as $documento) {

                    // Nombre original suministrado por el ciudadano (solo se guarda como dato).
                    $nombreOriginal = $documento->getClientOriginalName();

                    // Extensión de la lista permitida y nombre aleatorio, en el disco privado
                    $extension = ArchivoSeguro::extension($documento, ArchivoSeguro::DOCUMENTOS);
                    $filename = Str::uuid() . '.' . $extension;

                    $ruta = $documento->storeAs('pqrsdf/radicados', $filename, 'local');

                    if ($ruta === false) {
                        throw new \RuntimeException(
                            'No fue posible almacenar uno de los archivos adjuntos.'
                        );
                    }

                    // Guardar la ruta para eliminar el archivo si ocurre un error.
                    $rutasGuardadas[] = $ruta;

                    // Registrar los metadatos y asociarlos a la PQR.
                    $pqrs->archivos()->create([
                        'nombre_original' => $nombreOriginal,
                        'nombre_archivo'  => $filename,
                        'ruta'            => $ruta,
                        'extension'       => $extension,
                        'mime_type'       => $documento->getMimeType(),
                        'tamano'          => $documento->getSize(),
                    ]);
                }
            }

            DB::commit();

            // 1. Correo al administrador
            try {
                $destinatariosInternos = CorreoService::destinatarios('pqrsdf_radicacion_interna', ['info@aguasdelhuila.gov.co']);
                CorreoService::enviar('pqrsdf_radicacion_interna', $destinatariosInternos, new PqrsAdminMail($pqrs));

                Log::channel('emails')->info("Correo ADMIN enviado con éxito", [
                    'pqrs_id' => $pqrs->id ?? null,
                    'radicado' => $pqrs->codigo_radicado ?? null,
                    'destino' => implode(', ', $destinatariosInternos ?? []),
                    'fecha'   => now()->toDateTimeString(),
                ]);
            } catch (\Throwable $e) {
                Log::channel('emails')->error("Error enviando correo ADMIN", [
                    'pqrs_id' => $pqrs->id ?? null,
                    'radicado' => $pqrs->codigo_radicado ?? null,
                    'destino' => implode(', ', $destinatariosInternos ?? []),
                    'excepcion' => get_class($e),
                    'error'   => $e->getMessage(),
                    'fecha'   => now()->toDateTimeString(),
                ]);
            }

            // 2. Correo al ciudadano (si ingresó correo)
            if (!empty($pqrs->correo_electronico)) {
                try {
                    CorreoService::enviar('pqrsdf_radicacion_ciudadano', $pqrs->correo_electronico, new PqrsUsuarioMail($pqrs));

                    Log::channel('emails')->info("Correo CIUDADANO enviado con éxito", [
                        'pqrs_id' => $pqrs->id ?? null,
                        'radicado' => $pqrs->codigo_radicado ?? null,
                        'destino' => $pqrs->correo_electronico,
                        'fecha'   => now()->toDateTimeString(),
                    ]);
                } catch (\Throwable $e) {
                    Log::channel('emails')->error("Error enviando correo CIUDADANO", [
                        'pqrs_id' => $pqrs->id ?? null,
                        'radicado' => $pqrs->codigo_radicado ?? null,
                        'destino' => $pqrs->correo_electronico,
                        'excepcion' => get_class($e),
                        'error'   => $e->getMessage(),
                        'fecha'   => now()->toDateTimeString(),
                    ]);
                }
            }

            return redirect()
                ->back()
                ->with('success', true)
                ->with('codigo_radicado', $codigo)
                ->with('identificado_anonimo', $pqrs->identificado_anonimo);

        } catch (\Throwable $e) {

            DB::rollBack();

            // Eliminar archivos físicos si la operación falló.
            foreach ($rutasGuardadas as $ruta) {
                try {
                    Storage::disk('local')->delete($ruta); // adjuntos en disco privado
                } catch (\Throwable $errorArchivo) {
                    report($errorArchivo);
                }
            }

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

    // PQRSDF Cartelera Virtual
    public function carteleravirtual(Request $request)
    {
        $hoy = Carbon::today();
        $codigo = trim($request->input('codigo_radicado', ''));

        $pqrs = EncuestaPqrsdf::where('identificado_anonimo', 'anonimo')
            ->where('tipo_respuesta', 'Cartelera Virtual')
            ->where(function ($query) use ($hoy) {
                $query->where('estado', '!=', 'Respondida')
                    ->orWhereNull('estado')
                    ->orWhere(function ($subquery) use ($hoy) {
                        $subquery->where('estado', 'Respondida')
                            ->whereNotNull('fecha_respuesta')
                            ->whereRaw(
                                'fecha_respuesta >= ?',
                                [
                                    $hoy->copy()
                                        ->subWeekdays(5)
                                        ->toDateString()
                                ]
                            );
                    });
            })
            ->when($codigo !== '', function ($query) use ($codigo) {
                $query->where('codigo_radicado', 'LIKE', '%' . $codigo . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('participacion.carteleravirtual', compact('pqrs', 'codigo'));
    }

    // Consulta de respuesta en la Cartelera Virtual - Modal
    public function consultarRespuestaCartelera($codigo)
    {
        $pqr = EncuestaPqrsdf::where('codigo_radicado', $codigo)
            ->where('identificado_anonimo', 'anonimo')
            ->where('tipo_respuesta', 'Cartelera Virtual')
            ->first();

        if (!$pqr) {
            return response()->json([
                'message' => 'No se encontró una PQR disponible en la Cartelera Virtual.'
            ], 404);
        }

        $estados = [
            'Respondida' => 'La respuesta a su solicitud está disponible.',
            'Radicada'   => 'Su solicitud ha sido radicada y está pendiente de gestión.',
            'Asignada'   => 'Su solicitud ha sido asignada al área responsable.',
            'Revisión'   => 'Su solicitud se encuentra en revisión.',
            'Corregir'   => 'Su solicitud se encuentra en revisión.',
            'Cancelada'  => 'Su solicitud ha sido cancelada.',
        ];

        if ($pqr->estado !== 'Respondida') {
            return response()->json([
                'codigo_radicado' => $pqr->codigo_radicado,
                'estado' => $pqr->estado,
                'mensaje' => $estados[$pqr->estado] ?? 'Su solicitud se encuentra pendiente de gestión.',
                'disponible' => false,
            ]);
        }

        $respuesta = DB::table('pqrsdf_respuestas')
            ->where('pqrsdf_id', $pqr->id)
            ->where('tipo_respuesta', 'Cartelera Virtual')
            ->where('estado', 2)
            ->first();

        if (!$respuesta) {
            return response()->json([
                'codigo_radicado' => $pqr->codigo_radicado,
                'estado' => 'Respondida',
                'mensaje' => 'La solicitud figura como respondida, pero su respuesta aún no está disponible para consulta pública.',
                'disponible' => false,
            ]);
        }

        $documentos = DB::table('pqrsdf_documentos')
            ->where('respuesta_id', $respuesta->id)
            ->select('nombre_original', 'ruta')
            ->get();

        return response()->json([
            'codigo_radicado' => $pqr->codigo_radicado,
            'estado' => $pqr->estado,
            'disponible' => true,
            'titulo' => $respuesta->titulo_respuesta,
            'texto' => HtmlSeguro::mostrar($respuesta->texto_respuesta),
            'documentos' => $documentos,
        ]);
    }


}
