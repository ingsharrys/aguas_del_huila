<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Lógica del cuestionario CACSP definida en config/cuestionarios-cacsp.php:
 * visibilidad de preguntas (saltos "pase a"), reglas de validación y formato de almacenamiento.
 * El JavaScript del formulario replica la misma lógica a partir de reglasParaJs().
 */
class CuestionarioCacsp
{
    // Preguntas de datos generales que se guardan como columnas de cuestionarios_cacsp
    public const DATOS_GENERALES = [
        'b_municipio'  => ['municipio_id', null],
        'c_ubicacion'  => ['ubicacion', ['1' => 'URBANO', '2' => 'RURAL']],
        'd_estrato'    => ['estrato', null],
        'e_sector'     => ['sector', ['1' => 'RESIDENCIAL', '2' => 'COMERCIAL', '3' => 'INDUSTRIAL', '4' => 'OFICIAL']],
        'P1_nombre'    => ['nombre', null],
        'P2_edad'      => ['edad', null],
        'P3_sexo'      => ['sexo', ['1' => 'MASCULINO', '2' => 'FEMENINO', '3' => 'PREFIERO_NO_DECIR']],
        'P4_direccion' => ['direccion', null],
        'P5_barrio'    => ['barrio', null],
        'P6_telefono'  => ['telefono', null],
        'P44_fecha'    => ['fecha_encuesta', null],
    ];

    public const UNIDADES_TIEMPO = ['minutos' => 'Minutos', 'horas' => 'Horas', 'dias' => 'Días', 'semanas' => 'Semanas', 'meses' => 'Meses'];

    // Minutos por unidad (para promedios en los resultados)
    public const MINUTOS_POR_UNIDAD = ['minutos' => 1, 'horas' => 60, 'dias' => 1440, 'semanas' => 10080, 'meses' => 43200];

    private static ?array $preguntas = null;

    /**
     * Preguntas del config con las opciones de base de datos ya resueltas.
     */
    public static function preguntas(): array
    {
        if (static::$preguntas !== null) {
            return static::$preguntas;
        }

        $preguntas = config('cuestionarios-cacsp', []);

        foreach ($preguntas as $clave => $pregunta) {
            // Formato "db:tabla,columna_filtro,valor" (ej. municipios de un departamento)
            if (is_string($pregunta['opciones'] ?? null) && str_starts_with($pregunta['opciones'], 'db:')) {
                [$tabla, $columna, $valor] = array_pad(explode(',', substr($pregunta['opciones'], 3)), 3, null);

                $preguntas[$clave]['opciones'] = DB::table($tabla)
                    ->when($columna, fn ($q) => $q->where($columna, $valor))
                    ->when($tabla === 'municipios_col', fn ($q) => $q->where('estado', 1))
                    ->orderBy('nombre')
                    ->pluck('nombre', 'id')
                    ->mapWithKeys(fn ($nombre, $id) => [(string) $id => $nombre])
                    ->all();
            }

            // Limitar la lista a ciertos nombres (sin importar tildes ni mayúsculas)
            if (!empty($pregunta['solo']) && is_array($preguntas[$clave]['opciones'] ?? null)) {
                $permitidos = array_map([static::class, 'normalizarTexto'], $pregunta['solo']);
                $preguntas[$clave]['opciones'] = array_filter(
                    $preguntas[$clave]['opciones'],
                    fn ($nombre) => in_array(static::normalizarTexto($nombre), $permitidos, true)
                );
            }

            // Normalizar filas de matrices: [clave => ['texto' => ..., 'si' => [...]]]
            if (($pregunta['tipo'] ?? null) === 'matriz') {
                $preguntas[$clave]['filas'] = collect($pregunta['filas'])->map(fn ($fila) => is_array($fila)
                    ? ['texto' => $fila[0], 'si' => $fila[1] ?? []]
                    : ['texto' => $fila, 'si' => []])->all();
            }
        }

        // Resolver referencias "opcion:Nombre" en las condiciones al valor real de la opción
        foreach ($preguntas as $clave => $pregunta) {
            foreach (['si', 'si_alguno', 'finaliza_si'] as $tipoCondicion) {
                if (!empty($pregunta[$tipoCondicion])) {
                    $preguntas[$clave][$tipoCondicion] = static::resolverCondiciones($pregunta[$tipoCondicion], $preguntas);
                }
            }
            if (($pregunta['tipo'] ?? null) === 'matriz') {
                foreach ($pregunta['filas'] as $fila => $definicion) {
                    $preguntas[$clave]['filas'][$fila]['si'] = static::resolverCondiciones($definicion['si'], $preguntas);
                }
            }
        }

        return static::$preguntas = $preguntas;
    }

    private static function resolverCondiciones(array $condiciones, array $preguntas): array
    {
        foreach ($condiciones as $ruta => $esperado) {
            $opciones = $preguntas[strtok($ruta, '.')]['opciones'] ?? [];

            $resolver = function ($valor) use ($opciones) {
                if (!is_string($valor) || !str_starts_with($valor, 'opcion:')) {
                    return $valor;
                }
                $buscado = static::normalizarTexto(substr($valor, 7));
                foreach ((array) $opciones as $clave => $etiqueta) {
                    if (static::normalizarTexto($etiqueta) === $buscado) {
                        return (string) $clave;
                    }
                }

                return '__sin_coincidencia__';
            };

            $condiciones[$ruta] = is_array($esperado)
                ? array_map(fn ($v) => is_array($v) ? array_map($resolver, $v) : $resolver($v), $esperado)
                : $resolver($esperado);
        }

        return $condiciones;
    }

    public static function normalizarTexto(string $texto): string
    {
        return Str::lower(trim(Str::ascii($texto)));
    }

    /**
     * Valor de una respuesta. Acepta "P7.acueducto" para filas de matrices.
     */
    public static function valor(array $respuestas, string $ruta): mixed
    {
        return data_get($respuestas, $ruta);
    }

    /**
     * Mapa [clave => visible] y [clave => [fila => visible]] según las respuestas.
     */
    public static function visibilidad(array $respuestas): array
    {
        $preguntas = static::preguntas();
        $visibles = [];
        $filas = [];
        $finalizado = false;

        foreach ($preguntas as $clave => $pregunta) {
            $visible = (!$finalizado || !empty($pregunta['siempre']))
                && static::cumple($pregunta, $respuestas, $visibles);

            // Lo que no se ve no cuenta para las condiciones siguientes (aunque llegue en la petición)
            if (!$visible) {
                unset($respuestas[$clave]);
            }

            $visibles[$clave] = $visible;

            if ($visible && ($pregunta['tipo'] ?? null) === 'matriz') {
                foreach ($pregunta['filas'] as $fila => $definicion) {
                    $filas[$clave][$fila] = static::condiciones($definicion['si'], $respuestas, $visibles, false);
                    if (!$filas[$clave][$fila] && is_array($respuestas[$clave] ?? null)) {
                        unset($respuestas[$clave][$fila]);
                    }
                }
                // Una matriz sin filas visibles se oculta
                if (!in_array(true, $filas[$clave] ?? [], true)) {
                    $visibles[$clave] = false;
                }
            }

            if ($visible && !empty($pregunta['finaliza_si']) && static::condiciones($pregunta['finaliza_si'], $respuestas, $visibles, false)) {
                $finalizado = true;
            }
        }

        return [$visibles, $filas];
    }

    private static function cumple(array $pregunta, array $respuestas, array $visibles): bool
    {
        if (!empty($pregunta['si']) && !static::condiciones($pregunta['si'], $respuestas, $visibles, false)) {
            return false;
        }

        if (!empty($pregunta['si_alguno']) && !static::condiciones($pregunta['si_alguno'], $respuestas, $visibles, true)) {
            return false;
        }

        return true;
    }

    private static function condiciones(array $condiciones, array $respuestas, array $visibles, bool $alguno): bool
    {
        if (!$condiciones) {
            return true;
        }

        foreach ($condiciones as $ruta => $esperado) {
            $base = strtok($ruta, '.');
            // Si la pregunta de la que depende está oculta, la condición no se cumple
            $ok = ($visibles[$base] ?? true) && static::coincide(static::valor($respuestas, $ruta), $esperado);

            if ($alguno && $ok) {
                return true;
            }
            if (!$alguno && !$ok) {
                return false;
            }
        }

        return !$alguno;
    }

    private static function coincide(mixed $valor, mixed $esperado): bool
    {
        if (is_array($esperado) && array_key_exists('distinto', $esperado)) {
            return !static::coincide($valor, $esperado['distinto']);
        }

        if ($esperado === '*') {
            return !blank($valor);
        }

        $valores = array_map('strval', is_array($valor) ? $valor : (blank($valor) ? [] : [$valor]));

        return count(array_intersect($valores, array_map('strval', (array) $esperado))) > 0;
    }

    /**
     * Reglas de validación según el tipo de cada pregunta y si está visible.
     */
    public static function reglas(array $respuestas, array $alternativas): array
    {
        [$visibles, $filas] = static::visibilidad($respuestas);
        $reglas = ['respuestas' => ['required', 'array']];
        $nombres = [];

        foreach (static::preguntas() as $clave => $pregunta) {
            $campo = "respuestas.$clave";
            $nombres[$campo] = static::nombreCorto($pregunta['titulo']);

            if (!$visibles[$clave]) {
                continue; // las respuestas de preguntas ocultas se descartan
            }

            // "No tiene teléfono" / "No sabe" reemplazan la respuesta
            if (!empty($pregunta['alternativa']) && !empty($alternativas[$clave])) {
                continue;
            }

            $requerido = !empty($pregunta['obligatoria']) ? 'required' : 'nullable';
            $opciones = is_array($pregunta['opciones'] ?? null) ? array_map('strval', array_keys($pregunta['opciones'])) : null;

            switch ($pregunta['tipo']) {
                case 'radio':
                case 'select':
                    $reglas[$campo] = [$requerido, Rule::in($opciones ?? [])];
                    break;
                case 'checkbox':
                    $reglas[$campo] = [$requerido, 'array', $requerido === 'required' ? 'min:1' : 'nullable'];
                    $reglas["$campo.*"] = [Rule::in($opciones ?? [])];
                    break;
                case 'matriz':
                    foreach ($filas[$clave] ?? [] as $fila => $visible) {
                        if ($visible) {
                            $reglas["$campo.$fila"] = [$requerido, Rule::in($opciones ?? [])];
                            $nombres["$campo.$fila"] = static::nombreCorto($pregunta['filas'][$fila]['texto']);
                        }
                    }
                    break;
                case 'duracion':
                    $reglas["$campo.cantidad"] = [$requerido, 'nullable', 'integer', 'min:0', 'max:100000'];
                    $reglas["$campo.unidad"] = ["required_with:$campo.cantidad", 'nullable', Rule::in(array_keys(self::UNIDADES_TIEMPO))];
                    $nombres["$campo.cantidad"] = $nombres[$campo];
                    $nombres["$campo.unidad"] = 'unidad de tiempo';
                    break;
                case 'number':
                    $reglas[$campo] = [$requerido, 'nullable', 'integer', 'min:' . ($pregunta['atributos']['min'] ?? 0), 'max:' . ($pregunta['atributos']['max'] ?? 9999999999)];
                    break;
                case 'tel':
                    $reglas[$campo] = [$requerido, 'nullable', 'regex:/^[0-9+\s()-]{7,20}$/'];
                    break;
                case 'cedula':
                    $reglas[$campo] = [$requerido, 'nullable', 'regex:/^[0-9]{5,12}$/'];
                    break;
                case 'date':
                    $reglas[$campo] = [$requerido, 'nullable', 'date', 'before_or_equal:today', 'after:2020-01-01'];
                    break;
                case 'textarea':
                    $reglas[$campo] = [$requerido, 'nullable', 'string', 'max:2000'];
                    break;
                default:
                    $reglas[$campo] = [$requerido, 'nullable', 'string', 'max:255'];
            }
        }

        return [$reglas, $nombres];
    }

    /**
     * Respuestas listas para guardar: [pregunta_key => valor] solo de lo visible.
     * Las filas de matrices se guardan como "P9.continuidad"; las selecciones múltiples como JSON;
     * las duraciones como "15 minutos".
     */
    public static function normalizar(array $respuestas, array $alternativas): array
    {
        [$visibles, $filas] = static::visibilidad($respuestas);
        $salida = [];

        foreach (static::preguntas() as $clave => $pregunta) {
            if (!$visibles[$clave]) {
                continue;
            }

            if (!empty($pregunta['alternativa']) && !empty($alternativas[$clave])) {
                $salida[$clave] = $pregunta['alternativa']['valor'];
                continue;
            }

            $valor = $respuestas[$clave] ?? null;

            switch ($pregunta['tipo']) {
                case 'matriz':
                    foreach ($filas[$clave] ?? [] as $fila => $visible) {
                        if ($visible && !blank($valor[$fila] ?? null)) {
                            $salida["$clave.$fila"] = (string) $valor[$fila];
                        }
                    }
                    break;
                case 'checkbox':
                    if (!empty($valor)) {
                        $salida[$clave] = json_encode(array_values(array_map('strval', (array) $valor)));
                    }
                    break;
                case 'duracion':
                    if (!blank($valor['cantidad'] ?? null) && !blank($valor['unidad'] ?? null)) {
                        $salida[$clave] = ((int) $valor['cantidad']) . ' ' . $valor['unidad'];
                    }
                    break;
                default:
                    if (!blank($valor)) {
                        $salida[$clave] = is_string($valor) ? trim($valor) : (string) $valor;
                    }
            }
        }

        return $salida;
    }

    /**
     * Condiciones de cada pregunta para el JavaScript del formulario.
     */
    public static function reglasParaJs(): array
    {
        return collect(static::preguntas())->map(fn ($p) => array_filter([
            'tipo'        => $p['tipo'],
            'si'          => $p['si'] ?? null,
            'si_alguno'   => $p['si_alguno'] ?? null,
            'siempre'     => !empty($p['siempre']) ?: null,
            'finaliza_si' => $p['finaliza_si'] ?? null,
            'filas'       => ($p['tipo'] === 'matriz') ? collect($p['filas'])->map(fn ($f) => $f['si'] ?: (object) [])->all() : null,
        ], fn ($v) => $v !== null))->all();
    }

    /**
     * Minutos de una duración guardada como "15 minutos".
     */
    public static function minutos(?string $duracion): ?int
    {
        if (!$duracion || !preg_match('/^(\d+)\s+(\w+)$/u', $duracion, $m)) {
            return null;
        }

        return isset(self::MINUTOS_POR_UNIDAD[$m[2]]) ? (int) $m[1] * self::MINUTOS_POR_UNIDAD[$m[2]] : null;
    }

    public static function nombreCorto(string $titulo): string
    {
        // Quita la numeración "12. " del documento para los mensajes de error
        return mb_strtolower(preg_replace('/^\d+\.\s*/', '', $titulo));
    }
}
