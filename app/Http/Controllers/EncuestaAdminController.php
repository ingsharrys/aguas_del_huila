<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Encuesta;
use App\Models\EncuestaEvaluacion;
use App\Models\EncuestaPqrsdf;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Models\PqrsdfRespuesta;
use App\Models\PqrsdfDocumento;
use Illuminate\Support\Facades\Mail;
use App\Mail\PqrsRespuestaMail;
use App\Exports\PqrsdfExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class EncuestaAdminController extends Controller
{
    public function index()
    {

        $estadisticas = [

            'tramites' => [

                'total' => Encuesta::count(),

                'medio' => Encuesta::select(
                        'medio',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('medio')
                    ->pluck('total', 'medio'),

                'informacion' => Encuesta::select(
                        'informacion',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('informacion')
                    ->pluck('total', 'informacion'),

                'facilidad' => Encuesta::select(
                        'facilidad',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('facilidad')
                    ->pluck('total', 'facilidad'),

                'grupo' => Encuesta::select(
                        'grupo',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('grupo')
                    ->pluck('total', 'grupo'),

                'beneficio' => Encuesta::select(
                        'beneficio',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('beneficio')
                    ->pluck('total', 'beneficio'),

            ],

            'evaluacion' => [

                'total' => EncuestaEvaluacion::count(),

                'actualizada' => EncuestaEvaluacion::select(
                        'actualizada',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('actualizada')
                    ->pluck('total', 'actualizada'),

                'informacion' => EncuestaEvaluacion::select(
                        'informacion',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('informacion')
                    ->pluck('total', 'informacion'),

                'satisfaccion' => EncuestaEvaluacion::select(
                        'satisfaccion',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('satisfaccion')
                    ->pluck('total', 'satisfaccion'),

                'facilidad' => EncuestaEvaluacion::select(
                        'facilidad',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('facilidad')
                    ->pluck('total', 'facilidad'),

            ]

        ];

        return view('encuestas.index',compact('estadisticas'));
    }

    public function evaluacion(Request $request)
    {
        $query = EncuestaEvaluacion::query();

        // Filtro por rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        } elseif ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        } elseif ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        $evaluaciones = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('encuestas.evaluacionAdmin', compact('evaluaciones'));
    }

    public function destroy(EncuestaEvaluacion $evaluacion)
    {

        // Eliminar la evaluación de la base de datos
        $evaluacion->delete();

        // Redirigir con mensaje de éxito
        session()->flash('success', 'Evaluación eliminada correctamente');
        return redirect()->route('dashboard.encuestas.evaluacion');
    }

    public function tramites(Request $request)
    {
        $query = Encuesta::query();

        // Filtro por rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        } elseif ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        } elseif ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        $tramites = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('encuestas.tramiteAdmin', compact('tramites'));
    }

    public function destroyTramite(Encuesta $tramite)
    {

        // Eliminar el trámite de la base de datos
        $tramite->delete();

        // Redirigir con mensaje de éxito
        session()->flash('success', 'Trámite eliminado correctamente');
        return redirect()->route('dashboard.encuestas.tramites');
    }

    public function comunicaciones()
    {

        // 1. Validar si el usuario tiene el rol 'Extranet'
        if (auth()->user()->hasRole('Extranet')) {
            return redirect()->route('dashboard.comunicaciones.pqrsdf');
        }

        // 2. Si es Admin o Editor, continúa con la carga normal
        $hoy = Carbon::today();

        $proximosDias = $hoy->copy()->addDays(3);

        $total = EncuestaPqrsdf::count();

        $respondidas = EncuestaPqrsdf::where(
            'estado',
            'Respondida'
        )->count();

        $estadisticas = [

            'pqrsdf' => [

                // Total
                'total' => EncuestaPqrsdf::count(),

                'pct_respondidas' => $total > 0
                    ? round(($respondidas / $total) * 100, 2)
                    : 0,

                // Sin asignar
                'sin_asignar' => EncuestaPqrsdf::where(
                    'estado',
                    'Radicada'
                )->count(),

                // Asignadas pero todavía sin responder
                'asignadas' => EncuestaPqrsdf::where(
                    'estado',
                    'Asignada'
                )->count(),

                // Asignadas pero todavía sin responder
                'revision' => EncuestaPqrsdf::where(
                    'estado',
                    'Revsión'
                )->count(),

                // Asignadas y próximas a vencer
                'proximas_vencer' => EncuestaPqrsdf::where(
                        'estado',
                        'Asignada'
                    )
                    ->whereDate('fecha_limite_respuesta', '>=', $hoy)
                    ->whereDate('fecha_limite_respuesta', '<=', $proximosDias)
                    ->count(),

                // Asignadas y ya vencidas
                'vencidas' => EncuestaPqrsdf::where(
                        'estado',
                        'Asignada'
                    )
                    ->whereDate('fecha_limite_respuesta', '<', $hoy)
                    ->count(),

                // Respondidas
                'respondidas' => EncuestaPqrsdf::where(
                    'estado',
                    'Respondida'
                )->count(),
                
                // Corregir
                'corregir' => EncuestaPqrsdf::where(
                    'estado',
                    'Corregir'
                )->count(),

                // Total que todavía requiere respuesta
                'por_responder' => EncuestaPqrsdf::whereIn(
                    'estado',
                    ['Radicada', 'Asignada']
                )->count(),

                'respondidasEnPlazo' => EncuestaPqrsdf::where(
                    'estado',
                    'Respondida'
                )
                ->whereColumn(
                    'fecha_respuesta',
                    '<=',
                    'fecha_limite_respuesta'
                )
                ->count(),

                'respondidasFueraDePlazo' => EncuestaPqrsdf::where(
                    'estado',
                    'Respondida'
                )
                ->whereColumn(
                    'fecha_respuesta',
                    '>',
                    'fecha_limite_respuesta'
                )
                ->count(),

                'canceladas' => EncuestaPqrsdf::where(
                    'estado',
                    'Cancelada'
                )
                ->count(),

                'por_area' => EncuestaPqrsdf::select(
                    'area_id',
                    DB::raw('COUNT(*) as total')
                )
                ->with('area')
                ->groupBy('area_id')
                ->orderByDesc('total')
                ->get(),

                'por_usuario' => EncuestaPqrsdf::select(
                    'user_id',
                    DB::raw('COUNT(*) as total')
                )
                ->with('usuario')
                ->whereNotNull('user_id')
                ->groupBy('user_id')
                ->orderByDesc('total')
                ->get(),

            ]

        ];

        // Usuarios con asignaciones
        $asignadores = DB::table('pqrsdf_asignaciones')
            ->select('asignado_por_id', DB::raw('COUNT(*) as total'))
            ->groupBy('asignado_por_id')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) {
                $item->usuario = User::with('area')->find($item->asignado_por_id);
                return $item;
            });

        // Usuarios con mas cancelaciones
        $canceladores = EncuestaPqrsdf::select('cancelado_id', DB::raw('COUNT(*) as total'))
            ->whereNotNull('cancelado_id')
            ->with('usuarioCancelado.area')
            ->groupBy('cancelado_id')
            ->orderByDesc('total')
            ->get();

        return view('encuestas.comunicaciones',compact('estadisticas', 'asignadores', 'canceladores'));
    }

    // Seccion de reportes
    public function reportes(Request $request)
    {
        // Cargar opciones para los selects
        $editores = User::role('Editor')->get();
        $dependencias = Area::whereNull('parent_id')->get();
        $grupos = Area::whereNotNull('parent_id')->get();

        // Obtener quien generó el reporte
        $radicador = $request->radicador_id;

        // Consultar PQRSDF filtradas si hay búsqueda
        $query = EncuestaPqrsdf::with(['area', 'usuario']);

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        if ($request->filled('dependencia_id')) {
            $query->where('area_id', $request->dependencia_id);
        }

        if ($request->filled('grupo_id')) {
            $query->where('area_id', $request->grupo_id);
        }

        // Agrupar los resultados por área para la vista previa por secciones
        $reportes = $request->has('filtrar') ? $query->get()->groupBy('area.nombre') : collect();

        return view('encuestas.reportes', compact('editores', 'dependencias', 'grupos', 'reportes', 'radicador'));
    }

    public function pqrsdf(Request $request)
    {
        $query = EncuestaPqrsdf::query();

        $usuario = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Permisos de visualización
        |--------------------------------------------------------------------------
        |
        | Administrador y TIC:
        | Pueden visualizar todas las PQR.
        |
        | Los demás usuarios:
        | Solamente pueden visualizar las PQR asignadas
        | directamente a su usuario mediante user_id.
        |
        */

        if ($usuario->hasRole('Extranet')) {
            
            if ($usuario?->es_jefe == 0) {
                // Regla 1: Extranet y NO es jefe -> Solo ve las PQR asignadas directamente a él
                $query->where('user_id', $usuario->id);
                
            } else {
                // Regla 2: Extranet y SÍ es jefe -> Ve las asignadas a él (user_id) O las de su área (area_id)
                $query->where(function($q) use ($usuario) {
                    $q->where('user_id', $usuario->id)
                    ->orWhere('area_id', $usuario->area_id);
                });
            }

        } else {
            // Regla 3: Otros roles (Administradores, etc.) -> Ven todo y pueden usar el filtro de área
            if ($request->filled('area')) {
                $query->where('area_id', $request->area);
            }
        }

        // Estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Código de radicado
        if ($request->filled('codigo_radicado')) {
            $query->where(
                'codigo_radicado',
                'like',
                '%' . $request->codigo_radicado . '%'
            );
        }

        // Fechas (Fecha de Ingreso / Radicación)
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        } elseif ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        } elseif ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        // Filtro de Vencimiento (Próximas a vencer en 7 días o menos)
        if ($request->filled('vencimiento')) {
            if ($request->vencimiento === 'proximas') {
                $query->whereIn('estado', ['Radicada', 'Asignada'])
                    ->whereNotNull('fecha_limite_respuesta')
                    ->whereDate('fecha_limite_respuesta', '>=', now()->toDateString())
                    ->whereDate('fecha_limite_respuesta', '<=', now()->addDays(7)->toDateString());
            } elseif ($request->vencimiento === 'vencidas') {
                // Opcional: También es muy útil filtrar las que ya se vencieron
                $query->whereIn('estado', ['Radicada', 'Asignada'])
                    ->whereNotNull('fecha_limite_respuesta')
                    ->whereDate('fecha_limite_respuesta', '<', now()->toDateString());
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Estadísticos
        |--------------------------------------------------------------------------
        */

        $hoy = Carbon::today();

        $proximosDias = $hoy->copy()->addDays(3);


        /*
        |--------------------------------------------------------------------------
        | Estadísticos generales
        |--------------------------------------------------------------------------
        */

        $estadisticas = [

            'total' => (clone $query)->count(),

            'sin_asignar' => (clone $query)
                ->whereNull('user_id')
                ->where('estado', 'Radicada')
                ->count(),

            'asignadas' => (clone $query)
                ->where('estado', 'Asignada')
                ->whereNotNull('user_id')
                ->count(),

            'proximas_vencer' => (clone $query)
                ->whereIn('estado', ['Radicada', 'Asignada'])
                ->whereDate(
                    'fecha_limite_respuesta',
                    '>=',
                    $hoy
                )
                ->whereDate(
                    'fecha_limite_respuesta',
                    '<=',
                    $proximosDias
                )
                ->count(),

            'vencidas' => (clone $query)
                ->whereIn('estado', ['Radicada', 'Asignada'])
                ->whereDate(
                    'fecha_limite_respuesta',
                    '<',
                    $hoy
                )
                ->count(),

            'respondidas' => (clone $query)
                ->where('estado', 'Respondida')
                ->count(),

            'revision' => (clone $query)
                ->where('estado', 'Revisión')
                ->count(),

            'canceladas' => (clone $query)
                ->where('estado', 'Cancelada')
                ->count(),

            'corregir' => (clone $query)
                ->where('estado', 'Corregir')
                ->count(),

            'por_responder' => (clone $query)
                ->whereIn(
                    'estado',
                    ['Radicada', 'Asignada']
                )
                ->count(),

            'respondidasEnPlazo' => (clone $query)
                ->where('estado', 'Respondida')
                ->whereColumn(
                    'fecha_respuesta',
                    '<=',
                    'fecha_limite_respuesta'
                )
                ->count(),

            'respondidasFueraDePlazo' => (clone $query)
                ->where('estado', 'Respondida')
                ->whereColumn(
                    'fecha_respuesta',
                    '>',
                    'fecha_limite_respuesta'
                )
                ->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | Porcentaje de respuesta
        |--------------------------------------------------------------------------
        */

        $estadisticas['porcentaje_respuesta'] =
            $estadisticas['total'] > 0
                ? round(
                    (
                        $estadisticas['respondidas'] /
                        $estadisticas['total']
                    ) * 100,
                    2
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | PQRSDF por usuario
        |--------------------------------------------------------------------------
        |
        | Solo se muestran usuarios que tienen PQRSDF asignadas.
        |
        */

        $estadisticas['por_usuario'] = (clone $query)
            ->select(
                'user_id',
                DB::raw('COUNT(*) as total'),

                DB::raw("
                    SUM(
                        CASE
                            WHEN estado IN ('Radicada', 'Asignada')
                            THEN 1
                            ELSE 0
                        END
                    ) as pendientes
                "),

                DB::raw("
                    SUM(
                        CASE
                            WHEN estado = 'Respondida'
                            THEN 1
                            ELSE 0
                        END
                    ) as respondidas
                "),

                DB::raw("
                    SUM(
                        CASE
                            WHEN estado = 'Asignada'
                            AND fecha_limite_respuesta >= CURDATE()
                            AND fecha_limite_respuesta <= DATE_ADD(CURDATE(), INTERVAL 3 DAY)
                            THEN 1
                            ELSE 0
                        END
                    ) as proximas_vencer
                "),

                DB::raw("
                    SUM(
                        CASE
                            WHEN estado = 'Asignada'
                            AND fecha_limite_respuesta < CURDATE()
                            THEN 1
                            ELSE 0
                        END
                    ) as vencidas
                ")
            )
            ->with('usuario.area')
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->orderByDesc('pendientes')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Resultado
        |--------------------------------------------------------------------------
        */

        $pqrsdf = $query
            ->with([
                'area',
                'usuario'
            ])
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Áreas disponibles
        |--------------------------------------------------------------------------
        */

        $areas = Area::where('estado', 1)
            ->orderBy('nombre')
            ->get();


        return view(
            'encuestas.pqrsdfAdmin',
            compact(
                'pqrsdf',
                'areas',
                'estadisticas'
            )
        );
    }

    public function destroyPqrsdf(EncuestaPqrsdf $pqrsdf)
    {

        // Eliminar el PQRSDF de la base de datos
        $pqrsdf->delete();

        // Redirigir con mensaje de éxito
        session()->flash('success', 'PQRSDF eliminado correctamente');
        return redirect()->route('dashboard.comunicaciones.pqrsdf');
    }

    public function exportarPqrsdf(Request $request)
    {
        $usuario = auth()->user();

        return Excel::download(
            new PqrsdfExport($request, $usuario),
            'pqrsdf_' . now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    public function showPqrsdf($id)
    {
        $pqrs = EncuestaPqrsdf::with([
                'departamento',
                'municipio',
            ])->findOrFail($id);

        $areas = Area::with([
            'usuarios' => function ($query) {
                // Filtrar solo los usuarios que estén Activados
                $query->where('estado', 'Activado')
                    ->orderBy('name');
            }
        ])
        ->where('estado', 1)
        ->orderBy('nombre')
        ->get();

        return view('encuestas.showPqrsdf',compact('pqrs', 'areas'));
    }

    /*
    |--------------------------------------------------------------------------
    | Asignar área y usuario a una PQRSDF con fecha límite de respuesta
    |--------------------------------------------------------------------------
    */
    
    public function asignarArea(Request $request, $id)
    {
        // 1. Validar la solicitud agregando el campo motivo
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'dias'    => 'required|integer|in:1,2,3,5,10,15,20,30',
            'motivo'  => 'nullable|string|max:1000',
        ]);

        $pqrs = EncuestaPqrsdf::findOrFail($id);
        $usuario = User::with('area')->findOrFail($request->user_id);

        // Verificar que el usuario tenga un área asignada
        if (!$usuario->area_id || !$usuario->area) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    "El usuario {$usuario->name} no tiene un área asignada."
                );
        }

        $dias = (int) $request->dias;
        $fechaLimite = now()->addDays($dias)->toDateString();
        $asignadoPorId = auth()->id(); // ID del usuario autenticado que realiza la asignación/reasignación

        DB::transaction(function () use ($pqrs, $usuario, $dias, $fechaLimite, $asignadoPorId, $request) {

            // 2. Actualizar la PQRSDF principal
            $datos = [
                'area_id'                => $usuario->area_id,
                'user_id'                => $usuario->id,
                'fecha_limite_respuesta' => $fechaLimite,
            ];

            // Cambiar su estado a "Asignada" si aún no está respondida
            if ($pqrs->estado !== 'Respondida') {
                $datos['estado'] = 'Asignada';
            }

            $pqrs->update($datos);

            // 3. Crear el registro en el historial de trazabilidad con el motivo
            $pqrs->asignaciones()->create([
                'area_id'         => $usuario->area_id,
                'user_id'         => $usuario->id,
                'asignado_por_id' => $asignadoPorId,
                'dias'            => $dias,
                'fecha_limite'    => $fechaLimite,
                'motivo'          => $request->motivo, // Guardar el motivo de reasignación
            ]);
        });

        return redirect()
            ->route(
                'dashboard.comunicaciones.pqrsdf.show',
                $pqrs->id
            )
            ->with(
                'success',
                "La PQRSDF fue asignada correctamente a {$usuario->name} del área {$usuario->area->nombre} con un plazo de {$request->dias} días para responder."
            );
    }

    public function respuesta(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validación
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'pqrsdf_id' => [
                'required',
                'exists:encuesta_pqrsdf,id'
            ],

            'correo' => [
                'nullable',
                'email',
                'max:255'
            ],

            'direccion' => [
                'nullable',
                'string',
                'max:500'
            ],

            'empresa_encomienda' => [
                'nullable',
                'string',
                'max:150'
            ],

            'numero_guia' => [
                'nullable',
                'string',
                'max:150'
            ],

            'titulo_respuesta' => [
                'required',
                'string',
                'max:255'
            ],

            'texto_respuesta' => [
                'required',
                'string'
            ],

            'documentos' => [
                'nullable',
                'array'
            ],

            'documentos.*' => [
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
                'max:10240'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Obtener PQR
        |--------------------------------------------------------------------------
        */

        $pqrsdf = EncuestaPqrsdf::findOrFail(
            $request->pqrsdf_id
        );


        /*
        |--------------------------------------------------------------------------
        | Usuario autenticado
        |--------------------------------------------------------------------------
        */

        $usuario = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | Transacción
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Crear respuesta
            |--------------------------------------------------------------------------
            */

            $respuesta = PqrsdfRespuesta::create([

                'pqrsdf_id' => $pqrsdf->id,

                'usuario_id' => $usuario->id,

                'tipo_respuesta' => $pqrsdf->tipo_respuesta,

                'correo' => $request->correo,

                'direccion' => $request->direccion,

                'empresa_encomienda' => $request->empresa_encomienda,

                'numero_guia' => $request->numero_guia,

                'titulo_respuesta' => $request->titulo_respuesta,

                'texto_respuesta' => $request->texto_respuesta,

                'estado' => 1,

            ]);


            /*
            |--------------------------------------------------------------------------
            | Guardar documentos
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('documentos')) {

                foreach ($request->file('documentos') as $documento) {

                    /*
                    |--------------------------------------------------------------------------
                    | Nombre original
                    |--------------------------------------------------------------------------
                    */

                    $nombreOriginal = $documento->getClientOriginalName();

                    /*
                    |--------------------------------------------------------------------------
                    | Obtener nombre sin extensión
                    |--------------------------------------------------------------------------
                    */

                    $nombre = pathinfo(
                        $nombreOriginal,
                        PATHINFO_FILENAME
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Crear slug
                    |--------------------------------------------------------------------------
                    */

                    $slug = Str::slug($nombre);

                    /*
                    |--------------------------------------------------------------------------
                    | Extensión
                    |--------------------------------------------------------------------------
                    */

                    $extension = strtolower(
                        $documento->getClientOriginalExtension()
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Crear nombre final
                    |--------------------------------------------------------------------------
                    */

                    $filename = $slug . '.' . $extension;

                    /*
                    |--------------------------------------------------------------------------
                    | Evitar archivos con el mismo nombre
                    |--------------------------------------------------------------------------
                    */

                    if (
                        PqrsdfDocumento::where(
                            'nombre_archivo',
                            $filename
                        )->exists()
                    ) {

                        $slug .= '-' . uniqid();

                        $filename = $slug . '.' . $extension;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Guardar archivo
                    |--------------------------------------------------------------------------
                    */

                    $ruta = $documento->storeAs(
                        'posts/pqrsdf',
                        $filename,
                        'public'
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Guardar información en BD
                    |--------------------------------------------------------------------------
                    */

                    $respuesta->documentos()->create([

                        'nombre_original' => $nombreOriginal,

                        'nombre_archivo' => $filename,

                        'ruta' => $ruta,

                        'extension' => $extension,

                        'mime_type' => $documento->getMimeType(),

                        'tamano' => $documento->getSize(),

                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Actualizar estado de la PQR
            |--------------------------------------------------------------------------
            |
            | Aquí debes colocar el valor que corresponda
            | al estado "respondida" en tu sistema.
            |
            */

            $pqrsdf->update([
                'estado' => 'Revisión',
                'updated_at' => now(),
                // 'fecha_respuesta' => now(),
            ]);


            /*
            |--------------------------------------------------------------------------
            | Confirmar
            |--------------------------------------------------------------------------
            */

            DB::commit();

            $respuesta->load(['pqrsdf','usuario.area','documentos']);
/*
            if (!empty($pqrsdf->correo_electronico)) {

                Mail::to($pqrsdf->correo_electronico)->send(new PqrsRespuestaMail($respuesta));

            }
*/

            return redirect()
                ->back()
                ->with(
                    'success',
                    'La respuesta fue registrada correctamente.'
                );

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Revertir BD
            |--------------------------------------------------------------------------
            */

            DB::rollBack();


            /*
            |--------------------------------------------------------------------------
            | Si se subieron archivos y posteriormente falló algo,
            | eliminarlos del almacenamiento.
            |--------------------------------------------------------------------------
            */

            if (isset($respuesta)) {

                foreach ($respuesta->documentos as $documento) {

                    if (
                        $documento->ruta &&
                        Storage::disk('public')->exists(
                            $documento->ruta
                        )
                    ) {

                        Storage::disk('public')->delete(
                            $documento->ruta
                        );

                    }

                }

            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'No fue posible registrar la respuesta.'
                );
        }
    }

    public function listaRespuestas($id)
    {
        $pqrsdf = EncuestaPqrsdf::with([
            'respuestas.usuario.area',
            'respuestas.documentos',
        ])->findOrFail($id);

        return view(
            'encuestas.pqrsdfRespuestas',
            compact('pqrsdf')
        );
    }

    public function aprobarRespuesta(Request $request, $id)
    {
        $respuesta = PqrsdfRespuesta::findOrFail($id);
        // Cambiamos a $pqrsdf para mantener consistencia con el uso posterior
        $pqrsdf = EncuestaPqrsdf::findOrFail($respuesta->pqrsdf_id);

        // 1. Actualizar la respuesta como aprobada
        $respuesta->update([
            'estado'         => 2, // 2 = Aprobada
            'revisado_id'    => auth()->id(),
            'fecha_revision' => now(),
        ]);

        // 2. Cambiar el estado de la PQR a 'Respondida'
        $pqrsdf->update([
            'estado'          => 'Respondida',
            'fecha_respuesta' => now(), 
        ]);

        // 3. Enviar correo a la persona (si existe el correo)
        $respuesta->load(['pqrsdf', 'usuario.area', 'documentos']);
        
        // Usamos $pqrsdf que ya tenemos cargado
        if (!empty($pqrsdf->correo_electronico)) {
            Mail::to($pqrsdf->correo_electronico)->send(new PqrsRespuestaMail($respuesta));
        }

        return back()->with('success', 'La respuesta ha sido aprobada y la PQRSDF pasó a estado Respondida.');
    }

    public function devolverRespuesta(Request $request, $id)
    {
        $request->validate([
            'observaciones_revision' => 'required|string|min:10|max:1000',
        ]);

        $respuesta = PqrsdfRespuesta::findOrFail($id);
        $pqrs = EncuestaPqrsdf::findOrFail($respuesta->pqrsdf_id);

        // 1. Actualizar la respuesta con las correcciones (estado 0 = Devuelta)
        $respuesta->update([
            'estado'         => 0, 
            'observaciones'  => $request->observaciones_revision,
            'revisado_id'    => auth()->id(),
            'fecha_revision' => now(),
        ]);

        // 2. Devolver la PQR al estado 'Asignada' para que el funcionario la corrija
        $pqrs->update([
            'estado' => 'Corregir',
        ]);

        return back()->with('success', 'La respuesta fue devuelta al funcionario para sus respectivas correcciones.');
    }

    public function cancelarPqrsdf(Request $request, $id)
    {
        $request->validate([
            'motivo_cancelacion' => 'required|string|min:10|max:1000',
        ]);

        $pqrs = EncuestaPqrsdf::findOrFail($id);

        $pqrs->update([
            'estado' => 'Cancelada',
            'motivo_cancelacion' => $request->motivo_cancelacion,
            'cancelado_id' => auth()->id(),
            'fecha_cancelacion' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'La PQR ha sido cancelada correctamente.');
    }

}
