<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuestionarioCacsp;
use App\Models\CuestionarioCacspRespuesta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CuestionarioController extends Controller
{
    /**
     * Preguntas de datos generales que se guardan como columnas de cuestionarios_cacsp
     * (clave del config => [columna, equivalencias de valor]).
     */
    private const DATOS_GENERALES = [
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
    ];

    // Opción de la P7 que indica que el hogar no tiene servicios (termina la encuesta)
    private const P7_NINGUNO = '4';

    /**
     * Muestra el formulario del cuestionario.
     */
    public function formCACSP()
    {
        $preguntas = $this->preguntas();

        return view('encuestas.cuestionario-cacsp', compact('preguntas'));
    }

    /**
     * Procesa y almacena los datos del cuestionario.
     */
    public function storeCACSP(Request $request)
    {
        $preguntas = $this->preguntas();
        $respuestas = (array) $request->input('respuestas', []);

        // "Ninguno" no se puede combinar con otros servicios
        $p7 = array_map('strval', (array) ($respuestas['P7'] ?? []));
        if (in_array(self::P7_NINGUNO, $p7, true) && count($p7) > 1) {
            return back()->withInput()->withErrors(['respuestas.P7' => 'Si selecciona "Ninguno" no puede seleccionar otros servicios.']);
        }

        [$reglas, $nombres] = $this->reglas($preguntas, $respuestas);

        $request->validate($reglas + [
            'autoriza' => ['accepted'],
        ], [
            'required'  => 'Esta pregunta es obligatoria.',
            'in'        => 'Seleccione una opción válida.',
            'integer'   => 'Debe ser un número.',
            'min'       => 'El valor mínimo es :min.',
            'max'       => 'El texto es demasiado largo (máximo :max caracteres).',
            'accepted'  => 'Debe autorizar el tratamiento de datos personales.',
        ], $nombres);

        // Solo se guardan las respuestas de preguntas visibles según las condiciones
        $visibles = collect($preguntas)->filter(fn ($p, $clave) => $this->esVisible($p, $respuestas))->keys();

        try {
            DB::transaction(function () use ($respuestas, $visibles) {
                $generales = ['fecha_encuesta' => now()->toDateString()];

                foreach (self::DATOS_GENERALES as $clave => [$columna, $equivalencias]) {
                    $valor = $respuestas[$clave] ?? null;
                    $generales[$columna] = $equivalencias ? ($equivalencias[$valor] ?? null) : ($valor === '' ? null : $valor);
                }

                $cuestionario = CuestionarioCacsp::create($generales);

                $timestamp = now();
                $filas = [];

                foreach ($visibles as $clave) {
                    if (array_key_exists($clave, self::DATOS_GENERALES)) {
                        continue; // ya guardado como columna
                    }

                    $valor = $respuestas[$clave] ?? null;

                    if ($valor === null || $valor === '' || $valor === []) {
                        continue;
                    }

                    $filas[] = [
                        'cuestionario_id' => $cuestionario->id,
                        'pregunta_key'    => $clave,
                        // Selección múltiple (P7) se guarda como JSON
                        'valor'           => is_array($valor) ? json_encode(array_values($valor)) : $valor,
                        'created_at'      => $timestamp,
                        'updated_at'      => $timestamp,
                    ];
                }

                if ($filas) {
                    CuestionarioCacspRespuesta::insert($filas);
                }
            });
        } catch (\Throwable $e) {
            Log::error('Error guardando cuestionario CACSP: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Ocurrió un error al procesar los datos. Por favor intente nuevamente.');
        }

        return redirect()->route('cuestionario.cacsp')
            ->with('success', '¡Gracias! Su cuestionario se ha guardado exitosamente.');
    }

    /**
     * Preguntas del config con las opciones de base de datos ya resueltas.
     */
    private function preguntas(): array
    {
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
                    ->all();
            }
        }

        return $preguntas;
    }

    /**
     * Reglas de validación según el tipo de cada pregunta y si está visible.
     */
    private function reglas(array $preguntas, array $respuestas): array
    {
        $reglas = ['respuestas' => ['required', 'array']];
        $nombres = [];

        foreach ($preguntas as $clave => $pregunta) {
            $campo = "respuestas.$clave";
            $nombres[$campo] = mb_strtolower($pregunta['titulo'] ?? $clave);

            $visible = $this->esVisible($pregunta, $respuestas);
            $obligatoria = $visible && !empty($pregunta['obligatoria']) && $pregunta['tipo'] !== 'hidden';
            $base = [$obligatoria ? 'required' : 'nullable'];
            $opciones = is_array($pregunta['opciones'] ?? null) ? $this->clavesOpciones($pregunta['opciones']) : null;

            switch ($pregunta['tipo']) {
                case 'radio':
                case 'select':
                    $reglas[$campo] = array_merge($base, $opciones !== null ? [Rule::in($opciones)] : []);
                    break;
                case 'checkbox':
                    $reglas[$campo] = array_merge($base, ['array', $obligatoria ? 'min:1' : 'nullable']);
                    $reglas["$campo.*"] = $opciones !== null ? [Rule::in($opciones)] : ['string'];
                    break;
                case 'number':
                    $reglas[$campo] = array_merge($base, ['integer', 'min:' . ($pregunta['atributos']['min'] ?? 0), 'max:' . ($pregunta['atributos']['max'] ?? 9999999999)]);
                    break;
                case 'textarea':
                    $reglas[$campo] = array_merge($base, ['string', 'max:2000']);
                    break;
                default: // text, hidden
                    $reglas[$campo] = array_merge($base, ['string', 'max:255']);
            }
        }

        return [$reglas, $nombres];
    }

    /**
     * Claves de las opciones (en listas simples como el estrato, el valor es la propia opción).
     */
    private function clavesOpciones(array $opciones): array
    {
        return array_is_list($opciones)
            ? array_map('strval', $opciones)
            : array_map('strval', array_keys($opciones));
    }

    /**
     * Evalúa la condición de una pregunta (misma lógica que el JavaScript de la vista).
     */
    private function esVisible(array $pregunta, array $respuestas): bool
    {
        if (empty($pregunta['condicion'])) {
            return true;
        }

        ['campo' => $campo, 'operador' => $operador, 'valor' => $requerido] = $pregunta['condicion'];

        $valor = $respuestas[$campo] ?? null;
        $seleccion = array_map('strval', is_array($valor) ? $valor : ($valor === null || $valor === '' ? [] : [$valor]));

        // Si la pregunta de la que depende está oculta, esta también
        $preguntas = config('cuestionarios-cacsp', []);
        if (isset($preguntas[$campo]) && !$this->esVisible($preguntas[$campo], $respuestas)) {
            return false;
        }

        return match ($operador) {
            '==', 'in_array' => in_array((string) $requerido, $seleccion, true),
            'intersect'      => count(array_intersect(array_map('strval', (array) $requerido), $seleccion)) > 0,
            default          => true,
        };
    }
}
