<?php

namespace App\Http\Controllers;

use App\Models\CuestionarioCacsp;
use App\Models\CuestionarioCacspRespuesta;
use App\Support\CuestionarioCacsp as Cuestionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CuestionarioController extends Controller
{
    /**
     * Muestra el formulario del cuestionario.
     */
    public function formCACSP()
    {
        $preguntas = Cuestionario::preguntas();
        $reglasJs = Cuestionario::reglasParaJs();

        return view('encuestas.cuestionario-cacsp', compact('preguntas', 'reglasJs'));
    }

    /**
     * Procesa y almacena los datos del cuestionario.
     */
    public function storeCACSP(Request $request)
    {
        $respuestas = (array) $request->input('respuestas', []);
        $alternativas = (array) $request->input('alternativas', []);

        [$reglas, $nombres] = Cuestionario::reglas($respuestas, $alternativas);

        $request->validate($reglas + [
            'autoriza' => ['accepted'],
        ], [
            'required'        => 'Esta pregunta es obligatoria.',
            'required_with'   => 'Seleccione la unidad de tiempo.',
            'in'              => 'Seleccione una opción válida.',
            'integer'         => 'Debe ser un número.',
            'min'             => 'El valor mínimo es :min.',
            'max'             => 'El valor es demasiado grande.',
            'regex'           => 'Escriba un número de teléfono válido.',
            'date'            => 'Escriba una fecha válida.',
            'before_or_equal' => 'La fecha no puede ser posterior a hoy.',
            'after'           => 'Escriba una fecha válida.',
            'accepted'        => 'Debe autorizar el tratamiento de datos personales.',
        ], $nombres);

        $datos = Cuestionario::normalizar($respuestas, $alternativas);

        try {
            DB::transaction(function () use ($datos) {
                // Datos generales como columnas
                $generales = [];
                foreach (Cuestionario::DATOS_GENERALES as $clave => [$columna, $equivalencias]) {
                    $valor = $datos[$clave] ?? null;
                    $generales[$columna] = $equivalencias ? ($equivalencias[$valor] ?? null) : $valor;
                }
                $generales['fecha_encuesta'] ??= now()->toDateString();

                $cuestionario = CuestionarioCacsp::create($generales);

                // Resto de respuestas como filas (pregunta_key, valor)
                $ahora = now();
                $filas = collect($datos)
                    ->except(array_keys(Cuestionario::DATOS_GENERALES))
                    ->map(fn ($valor, $clave) => [
                        'cuestionario_id' => $cuestionario->id,
                        'pregunta_key'    => $clave,
                        'valor'           => $valor,
                        'created_at'      => $ahora,
                        'updated_at'      => $ahora,
                    ])->values()->all();

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
            ->with('success', 'Muchas gracias por su colaboración en nombre de Aguas del Huila S.A. E.S.P. Sus respuestas ayudarán a mejorar los servicios que recibe.');
    }
}
