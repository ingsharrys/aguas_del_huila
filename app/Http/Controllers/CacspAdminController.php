<?php

namespace App\Http\Controllers;

use App\Models\CuestionarioCacsp;
use App\Support\CuestionarioCacsp as Cuestionario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Resultados del Cuestionario de Atención al Cliente de Servicios Públicos (CACSP).
 */
class CacspAdminController extends Controller
{
    private const PERIODOS = ['30' => '30 días', '90' => '90 días', '365' => '12 meses', 'todo' => 'Todo'];

    private const CONTROL = ['a_id_muestra', 'P45_encuestador', 'P45_encuestador_cc', 'P46_supervisor', 'P46_supervisor_cc'];

    public function resultados(Request $request)
    {
        [$consulta, $periodo, $municipio] = $this->filtrar($request);

        $ids = (clone $consulta)->pluck('id');
        $total = $ids->count();
        $preguntas = Cuestionario::preguntas();

        // Conteos de respuestas por pregunta y valor (una sola consulta)
        $conteos = [];
        foreach ($ids->chunk(2000) as $lote) {
            DB::table('cuestionarios_cacsp_respuestas')
                ->whereIn('cuestionario_id', $lote)
                ->select('pregunta_key', 'valor', DB::raw('COUNT(*) as total'))
                ->groupBy('pregunta_key', 'valor')
                ->get()
                ->each(function ($fila) use (&$conteos) {
                    $conteos[$fila->pregunta_key][$fila->valor] = ($conteos[$fila->pregunta_key][$fila->valor] ?? 0) + $fila->total;
                });
        }

        $resultados = [];
        foreach ($preguntas as $clave => $pregunta) {
            // Datos generales y de control (id, encuestador, supervisor) no se grafican
            if (array_key_exists($clave, Cuestionario::DATOS_GENERALES) || in_array($clave, self::CONTROL, true)) {
                continue;
            }

            $resultados[$clave] = match ($pregunta['tipo']) {
                'radio', 'select' => $this->distribucion($pregunta['opciones'], $conteos[$clave] ?? []),
                'matriz'          => collect($pregunta['filas'])->map(fn ($fila, $f) => [
                    'texto' => $fila['texto'],
                    'datos' => $this->distribucion($pregunta['opciones'], $conteos["$clave.$f"] ?? []),
                ])->all(),
                'checkbox'        => $this->multiple($pregunta['opciones'], $conteos[$clave] ?? []),
                'duracion'        => $this->duraciones($conteos[$clave] ?? []),
                default           => $this->textos($ids, $clave, $pregunta),
            };
        }

        // Datos generales (columnas)
        $generales = [
            'municipio' => (clone $consulta)->leftJoin('municipios_col', 'municipios_col.id', '=', 'cuestionarios_cacsp.municipio_id')
                ->select(DB::raw("COALESCE(municipios_col.nombre, 'Sin municipio') as municipio_nombre"), DB::raw('COUNT(*) as total'))
                ->groupBy('municipio_nombre')->orderByDesc('total')->limit(10)->pluck('total', 'municipio_nombre')->all(),
            'ubicacion' => $this->columna($consulta, 'ubicacion', ['URBANO' => 'Urbano', 'RURAL' => 'Rural']),
            'estrato'   => $this->columna($consulta, 'estrato', array_combine(range(1, 6), array_map(fn ($e) => "Estrato $e", range(1, 6)))),
            'sector'    => $this->columna($consulta, 'sector', ['RESIDENCIAL' => 'Residencial', 'COMERCIAL' => 'Comercial', 'INDUSTRIAL' => 'Industrial', 'OFICIAL' => 'Oficial']),
            'sexo'      => $this->columna($consulta, 'sexo', ['MASCULINO' => 'Masculino', 'FEMENINO' => 'Femenino', 'PREFIERO_NO_DECIR' => 'Prefiere no responder']),
        ];

        // Indicadores: % de calificaciones Muy buena/Buena sobre quienes opinaron (sin "No sabe")
        $kpis = [
            'Calidad del Acueducto'      => $this->satisfaccion($resultados['P8'] ?? []),
            'Calidad del Alcantarillado' => $this->satisfaccion($resultados['P12'] ?? []),
            'Calidad del Aseo'           => $this->satisfaccion($resultados['P25'] ?? []),
            'Punto de atención'          => $this->satisfaccion($resultados['P19'] ?? []),
        ];

        $municipios = DB::table('municipios_col')->where('departamento_id', 18)->orderBy('nombre')->pluck('nombre', 'id');
        $periodos = self::PERIODOS;

        return view('encuestas.cacsp.resultados', compact('preguntas', 'resultados', 'generales', 'kpis', 'total', 'periodo', 'periodos', 'municipio', 'municipios'));
    }

    public function listado(Request $request)
    {
        [$consulta, $periodo, $municipio] = $this->filtrar($request);

        $buscar = trim((string) $request->query('buscar'));

        $cuestionarios = $consulta
            ->leftJoin('municipios_col', 'municipios_col.id', '=', 'cuestionarios_cacsp.municipio_id')
            ->select('cuestionarios_cacsp.*', 'municipios_col.nombre as municipio_nombre')
            ->when($buscar !== '', fn ($q) => $q->where(fn ($w) => $w->where('cuestionarios_cacsp.nombre', 'like', "%$buscar%")
                ->orWhere('cuestionarios_cacsp.barrio', 'like', "%$buscar%")
                ->orWhere('cuestionarios_cacsp.direccion', 'like', "%$buscar%")))
            ->orderByDesc('cuestionarios_cacsp.fecha_encuesta')->orderByDesc('cuestionarios_cacsp.id')
            ->paginate(20)->withQueryString();

        $municipios = DB::table('municipios_col')->where('departamento_id', 18)->orderBy('nombre')->pluck('nombre', 'id');
        $periodos = self::PERIODOS;

        return view('encuestas.cacsp.listado', compact('cuestionarios', 'periodo', 'periodos', 'municipio', 'municipios', 'buscar'));
    }

    public function ver(CuestionarioCacsp $cuestionario)
    {
        $respuestas = DB::table('cuestionarios_cacsp_respuestas')->where('cuestionario_id', $cuestionario->id)->pluck('valor', 'pregunta_key');
        $municipio = DB::table('municipios_col')->where('id', $cuestionario->municipio_id)->value('nombre');
        $preguntas = Cuestionario::preguntas();

        return view('encuestas.cacsp.ver', compact('cuestionario', 'respuestas', 'municipio', 'preguntas'));
    }

    public function eliminar(CuestionarioCacsp $cuestionario)
    {
        abort_unless(auth()->user()->hasAnyRole(['Administrador', 'Editor']), 403);

        DB::transaction(function () use ($cuestionario) {
            DB::table('cuestionarios_cacsp_respuestas')->where('cuestionario_id', $cuestionario->id)->delete();
            $cuestionario->delete();
        });

        return redirect()->route('dashboard.encuestas.cacsp.listado')->with('success', 'Cuestionario eliminado.');
    }

    /**
     * Exporta todas las respuestas del filtro actual a CSV (una fila por cuestionario, una columna por pregunta).
     */
    public function exportar(Request $request)
    {
        [$consulta] = $this->filtrar($request);
        $preguntas = Cuestionario::preguntas();

        // Columnas: datos generales + cada pregunta (las matrices, una columna por fila)
        $columnas = ['id' => 'ID', 'fecha_encuesta' => 'Fecha', 'municipio' => 'Municipio', 'ubicacion' => 'Ubicación', 'estrato' => 'Estrato',
            'sector' => 'Sector', 'nombre' => 'Nombre', 'edad' => 'Edad', 'sexo' => 'Sexo', 'direccion' => 'Dirección', 'barrio' => 'Barrio', 'telefono' => 'Teléfono'];
        foreach ($preguntas as $clave => $pregunta) {
            if (array_key_exists($clave, Cuestionario::DATOS_GENERALES)) {
                continue;
            }
            if ($pregunta['tipo'] === 'matriz') {
                foreach ($pregunta['filas'] as $f => $fila) {
                    $columnas["$clave.$f"] = strtok($pregunta['titulo'], '.') . ' · ' . $fila['texto'];
                }
            } else {
                $columnas[$clave] = $pregunta['titulo'];
            }
        }

        $municipios = DB::table('municipios_col')->pluck('nombre', 'id');
        $nombreArchivo = 'cuestionario-cacsp-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($consulta, $columnas, $preguntas, $municipios) {
            $salida = fopen('php://output', 'w');
            fwrite($salida, "\xEF\xBB\xBF"); // BOM para que Excel lea las tildes
            fputcsv($salida, array_values($columnas), ';');

            (clone $consulta)->orderBy('cuestionarios_cacsp.id')->chunk(500, function ($lote) use ($salida, $columnas, $preguntas, $municipios) {
                $respuestas = DB::table('cuestionarios_cacsp_respuestas')->whereIn('cuestionario_id', $lote->pluck('id'))
                    ->get()->groupBy('cuestionario_id');

                foreach ($lote as $c) {
                    $r = collect($respuestas[$c->id] ?? [])->pluck('valor', 'pregunta_key');
                    $fila = [];
                    foreach ($columnas as $clave => $titulo) {
                        $fila[] = match (true) {
                            $clave === 'municipio' => $municipios[$c->municipio_id] ?? '',
                            $clave === 'fecha_encuesta' => optional($c->fecha_encuesta)->format('Y-m-d'),
                            in_array($clave, ['id', 'ubicacion', 'estrato', 'sector', 'nombre', 'edad', 'sexo', 'direccion', 'barrio', 'telefono'], true) => $c->{$clave},
                            default => $this->etiqueta($preguntas, $clave, $r[$clave] ?? null),
                        };
                    }
                    fputcsv($salida, $fila, ';');
                }
            });

            fclose($salida);
        }, $nombreArchivo, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * Texto legible de una respuesta guardada (código → etiqueta).
     */
    public static function etiqueta(array $preguntas, string $clave, ?string $valor): string
    {
        if ($valor === null || $valor === '') {
            return '';
        }

        [$base] = explode('.', $clave);
        $pregunta = $preguntas[$base] ?? null;
        $opciones = is_array($pregunta['opciones'] ?? null) ? $pregunta['opciones'] : [];

        if ($valor === ($pregunta['alternativa']['valor'] ?? null)) {
            return $pregunta['alternativa']['etiqueta'];
        }

        return match ($pregunta['tipo'] ?? null) {
            'checkbox' => collect(json_decode($valor, true) ?: [])->map(fn ($v) => $opciones[$v] ?? $v)->implode(', '),
            'duracion' => preg_replace_callback('/^(\d+) (\w+)$/', fn ($m) => $m[1] . ' ' . mb_strtolower(Cuestionario::UNIDADES_TIEMPO[$m[2]] ?? $m[2]), $valor),
            default    => (string) ($opciones[$valor] ?? $valor),
        };
    }

    private function filtrar(Request $request): array
    {
        $periodo = array_key_exists((string) $request->query('periodo'), self::PERIODOS) ? (string) $request->query('periodo') : 'todo';
        $municipio = $request->integer('municipio') ?: null;

        $consulta = CuestionarioCacsp::query()
            ->when($periodo !== 'todo', fn ($q) => $q->where('cuestionarios_cacsp.fecha_encuesta', '>=', now()->subDays((int) $periodo - 1)->toDateString()))
            ->when($municipio, fn ($q) => $q->where('cuestionarios_cacsp.municipio_id', $municipio));

        return [$consulta, $periodo, $municipio];
    }

    private function distribucion(array $opciones, array $conteos): array
    {
        return collect($opciones)->mapWithKeys(fn ($etiqueta, $valor) => [$etiqueta => (int) ($conteos[(string) $valor] ?? 0)])->all();
    }

    private function multiple(array $opciones, array $conteos): array
    {
        $resultado = array_fill_keys(array_values($opciones), 0);
        foreach ($conteos as $json => $cantidad) {
            foreach ((array) json_decode($json, true) as $valor) {
                if (isset($opciones[$valor])) {
                    $resultado[$opciones[$valor]] += $cantidad;
                }
            }
        }

        return $resultado;
    }

    private function duraciones(array $conteos): array
    {
        $minutos = [];
        foreach ($conteos as $valor => $cantidad) {
            $m = Cuestionario::minutos($valor);
            if ($m !== null) {
                array_push($minutos, ...array_fill(0, $cantidad, $m));
            }
        }
        sort($minutos);
        $n = count($minutos);

        $rangos = ['Menos de 15 min' => 0, '15 a 30 min' => 0, '30 min a 1 hora' => 0, '1 a 24 horas' => 0, 'Más de 1 día' => 0];
        foreach ($minutos as $m) {
            $rangos[match (true) { $m < 15 => 'Menos de 15 min', $m <= 30 => '15 a 30 min', $m <= 60 => '30 min a 1 hora', $m <= 1440 => '1 a 24 horas', default => 'Más de 1 día' }]++;
        }

        return [
            'total'   => $n,
            'mediana' => $n ? ($n % 2 ? $minutos[intdiv($n, 2)] : intdiv($minutos[$n / 2 - 1] + $minutos[$n / 2], 2)) : null,
            'rangos'  => $rangos,
        ];
    }

    private function textos($ids, string $clave, array $pregunta): array
    {
        $consulta = DB::table('cuestionarios_cacsp_respuestas')->whereIn('cuestionario_id', $ids->take(5000))->where('pregunta_key', $clave);
        $noSabe = $pregunta['alternativa']['valor'] ?? null;

        return [
            'total'   => (clone $consulta)->count(),
            'no_sabe' => $noSabe ? (clone $consulta)->where('valor', $noSabe)->count() : 0,
            'ultimas' => (clone $consulta)->when($noSabe, fn ($q) => $q->where('valor', '!=', $noSabe))->orderByDesc('id')->limit(8)->pluck('valor')->all(),
        ];
    }

    private function columna($consulta, string $columna, array $etiquetas): array
    {
        $conteos = (clone $consulta)->select($columna, DB::raw('COUNT(*) as total'))->groupBy($columna)->pluck('total', $columna);

        return collect($etiquetas)->mapWithKeys(fn ($etiqueta, $valor) => [$etiqueta => (int) ($conteos[$valor] ?? 0)])->all();
    }

    private function satisfaccion(array $distribucion): ?int
    {
        $valoradas = array_diff_key($distribucion, array_flip(['No sabe']));
        $total = array_sum($valoradas);
        $favorables = array_sum(array_slice($valoradas, 0, 2)); // Muy buena + Buena

        return $total ? (int) round($favorables / $total * 100) : null;
    }
}
