<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuestionarioCacsp;
use App\Models\CuestionarioCacspRespuesta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CuestionarioController extends Controller
{
    /**
     * Muestra el formulario del cuestionario.
     */
    public function formCACSP()
    {
        // Cargar la estructura de preguntas desde el archivo config/cuestionarios-cacsp.php
        $preguntas = config('cuestionarios-cacsp');
        
        // Retornar la vista (ajusta 'frontend.cuestionario-cacsp' a la ruta real de tu vista Blade)
        return view('encuestas.cuestionario-cacsp', compact('preguntas'));
    }

    /**
     * Procesa y almacena los datos del cuestionario.
     */
    public function storeCACSP(Request $request)
    {
        // 1. Validar los Datos Generales y el arreglo de respuestas
        $validated = $request->validate([
            'municipio_id' => 'required|integer',
            'ubicacion'    => 'required|in:URBANO,RURAL',
            'estrato'      => 'required|integer|min:1|max:6',
            'sector'       => 'required|in:RESIDENCIAL,COMERCIAL,INDUSTRIAL,OFICIAL',
            'nombre'       => 'required|string|max:150',
            'edad'         => 'required|integer|min:18',
            'sexo'         => 'required|in:MASCULINO,FEMENINO,PREFIERO_NO_DECIR',
            'direccion'    => 'required|string|max:255',
            'barrio'       => 'required|string|max:150',
            'telefono'     => 'nullable|string|max:30',
            
            // Validar que respuestas sea un array
            'respuestas'   => 'required|array',
        ]);

        try {
            // 2. Ejecutar la transacción
            DB::transaction(function () use ($validated) {
                
                // Guardar los datos generales en cuestionarios_cacsp
                $cuestionario = CuestionarioCacsp::create([
                    'municipio_id'   => $validated['municipio_id'],
                    'ubicacion'      => $validated['ubicacion'],
                    'estrato'        => $validated['estrato'],
                    'sector'         => $validated['sector'],
                    'nombre'         => $validated['nombre'],
                    'edad'           => $validated['edad'],
                    'sexo'           => $validated['sexo'],
                    'direccion'      => $validated['direccion'],
                    'barrio'         => $validated['barrio'],
                    'telefono'       => $validated['telefono'] ?? null,
                    'fecha_encuesta' => now()->toDateString(), // Guarda la fecha actual
                ]);

                // Preparar el array para inserción masiva de respuestas
                $respuestasInsert = [];
                $timestamp = now();

                foreach ($validated['respuestas'] as $key => $valor) {
                    if (!is_null($valor)) {
                        $respuestasInsert[] = [
                            'cuestionario_id' => $cuestionario->id,
                            'pregunta_key'    => $key,
                            // Convertir arreglos (como la P7 de selección múltiple) a JSON
                            'valor'           => is_array($valor) ? json_encode($valor) : $valor,
                            'created_at'      => $timestamp,
                            'updated_at'      => $timestamp,
                        ];
                    }
                }

                // Inserción masiva en cuestionarios_cacsp_respuestas (1 sola consulta SQL)
                if (!empty($respuestasInsert)) {
                    CuestionarioCacspRespuesta::insert($respuestasInsert);
                }
            });

            // Redireccionar con mensaje de éxito
            return redirect()->route('cuestionario.cacsp')
                             ->with('success', 'El cuestionario se ha guardado exitosamente.');

        } catch (\Exception $e) {
            // Registrar el error para depuración
            Log::error('Error guardando cuestionario CACSP: ' . $e->getMessage());

            // Retornar a la vista con el error y los datos ingresados previamente
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Ocurrió un error al procesar los datos. Por favor intente nuevamente.');
        }
    }
}