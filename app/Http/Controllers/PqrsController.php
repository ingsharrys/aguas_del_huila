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

        $request->validate([

            'discapacidad'             => 'required|boolean',
            'tipo_discapacidad'        => 'nullable|string|max:150',
            'otra_discapacidad'        => 'nullable|string|max:255',

            'identificado_anonimo'     => 'required|in:identificado,anonimo',

            'tipo_solicitante'         => 'nullable|string|max:100',
            'tipo_identificacion'      => 'nullable|string|max:100',
            'numero_identificacion'    => 'nullable|string|max:50',

            'razon_social'             => 'nullable|string|max:255',
            'nombre_usuario'           => 'nullable|string|max:150',
            'apellido_usuario'         => 'nullable|string|max:150',

            'correo_electronico'       => 'nullable|email|max:200',

            'pais'                     => 'nullable|string|max:100',
            'otro_pais'                => 'nullable|string|max:100',

            'departamento_id'          => 'nullable|exists:departamentos_col,id',
            'municipio_id'             => 'nullable|exists:municipios_col,id',

            'direccion'                => 'nullable|string|max:255',

            'fijo'                     => 'nullable|string|max:30',
            'movil'                    => 'nullable|string|max:30',
            
            'tipo_pqrsf'               => 'required|string|max:255',
            'tipo_respuesta'           => 'required|string|max:255',
            'direccion_mensajeria'     => 'nullable|string',

            'asunto'                   => 'required|string|max:255',

            'descripcion'              => 'required|string',

            'autoriza'                 => 'accepted'

        ]);

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
