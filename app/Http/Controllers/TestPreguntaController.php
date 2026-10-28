<?php

namespace App\Http\Controllers;

use App\Models\TestConocimiento;
use App\Models\TestPregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestPreguntaController extends Controller
{
    /**
     * Mostrar las preguntas asociadas a un test.
     */
    public function index(TestConocimiento $teste, Request $request)
    {

        $query = $teste->preguntas();

        // Filtro por nombre
        if ($request->filled('nombre')) {
            $query->where('pregunta', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }


        $preguntas = $query
            ->withCount('opciones')
            ->orderBy('orden')
            ->paginate(15);

        return view('testes.preguntas.index', compact(
            'teste',
            'preguntas'
        ));
    }


    /**
     * Mostrar formulario para crear una pregunta.
     */
    public function create(TestConocimiento $teste)
    {
        // Siguiente orden disponible
        $siguienteOrden = ($teste->preguntas()->max('orden') ?? 0) + 1;

        return view('testes.preguntas.create', compact(
            'teste',
            'siguienteOrden'
        ));
    }


    /**
     * Guardar una nueva pregunta con sus opciones.
     */
    public function store(Request $request, TestConocimiento $teste)
    {
        $validated = $request->validate([
            'pregunta' => [
                'required',
                'string',
            ],

            'orden' => [
                'required',
                'integer',
                'min:1',
            ],

            'estado' => [
                'required',
                'in:Activo,Inactivo',
            ],

            'opciones' => [
                'required',
                'array',
                'min:3',
                'max:4',
            ],

            'opciones.*.letra' => [
                'required',
                'string',
                'size:1',
                'in:A,B,C,D',
            ],

            'opciones.*.texto' => [
                'required',
                'string',
                'max:500',
            ],

            'respuesta_correcta' => [
                'required',
                'in:A,B,C,D',
            ],
        ], [
            'pregunta.required' => 'La pregunta es obligatoria.',

            'orden.required' => 'El orden es obligatorio.',
            'orden.integer' => 'El orden debe ser un número entero.',
            'orden.min' => 'El orden debe ser mayor o igual a 1.',

            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',

            'opciones.required' => 'Debe agregar las opciones de respuesta.',
            'opciones.min' => 'La pregunta debe tener al menos 3 opciones.',
            'opciones.max' => 'La pregunta puede tener máximo 4 opciones.',

            'opciones.*.letra.required' => 'La letra de la opción es obligatoria.',
            'opciones.*.texto.required' => 'El texto de todas las opciones es obligatorio.',
            'opciones.*.texto.max' => 'Una opción no puede superar los 500 caracteres.',

            'respuesta_correcta.required' => 'Debe seleccionar una respuesta correcta.',
            'respuesta_correcta.in' => 'La respuesta correcta no es válida.',
        ]);


        /*
         * Verificar que la respuesta correcta realmente
         * pertenezca a las opciones enviadas.
         */
        $letrasOpciones = collect($validated['opciones'])
            ->pluck('letra');

        if (!$letrasOpciones->contains($validated['respuesta_correcta'])) {
            return back()
                ->withInput()
                ->withErrors([
                    'respuesta_correcta' =>
                        'La respuesta correcta debe corresponder a una de las opciones.',
                ]);
        }


        /*
         * Verificar que no existan letras repetidas.
         */
        if ($letrasOpciones->unique()->count() !== $letrasOpciones->count()) {
            return back()
                ->withInput()
                ->withErrors([
                    'opciones' =>
                        'No puede haber opciones con la misma letra.',
                ]);
        }


        DB::transaction(function () use ($validated, $teste) {

            $pregunta = $teste->preguntas()->create([
                'pregunta' => $validated['pregunta'],
                'orden' => $validated['orden'],
                'estado' => $validated['estado'],
            ]);


            foreach ($validated['opciones'] as $index => $opcion) {

                $pregunta->opciones()->create([
                    'letra' => $opcion['letra'],
                    'texto' => $opcion['texto'],
                    'es_correcta' =>
                        $opcion['letra'] === $validated['respuesta_correcta'],
                    'orden' => $index + 1,
                ]);
            }
        });


        return redirect()
            ->route('testes.preguntas.index', $teste)
            ->with('success', 'La pregunta fue creada correctamente.');
    }


    /**
     * Mostrar formulario para editar una pregunta.
     */
    public function edit(
        TestConocimiento $teste,
        TestPregunta $pregunta
    ) {
        /*
         * Seguridad: verificar que la pregunta
         * realmente pertenezca al test.
         */
        abort_unless(
            $pregunta->test_id === $teste->id,
            404
        );

        $pregunta->load('opciones');

        return view('testes.preguntas.edit', compact(
            'teste',
            'pregunta'
        ));
    }


    /**
     * Actualizar una pregunta y sus opciones.
     */
    public function update(
        Request $request,
        TestConocimiento $teste,
        TestPregunta $pregunta
    ) {
        /*
         * Verificar que la pregunta pertenezca al test.
         */
        abort_unless(
            $pregunta->test_id === $teste->id,
            404
        );


        /*
         * Si la pregunta ya tiene respuestas históricas,
         * no permitimos modificarla.
         */
        if ($pregunta->respuestas()->exists()) {
            return redirect()
                ->route('testes.preguntas.index', $teste)
                ->with(
                    'error',
                    'No se puede modificar esta pregunta porque ya tiene respuestas registradas.'
                );
        }


        $validated = $request->validate([
            'pregunta' => [
                'required',
                'string',
            ],

            'orden' => [
                'required',
                'integer',
                'min:1',
            ],

            'estado' => [
                'required',
                'in:Activo,Inactivo',
            ],

            'opciones' => [
                'required',
                'array',
                'min:3',
                'max:4',
            ],

            'opciones.*.letra' => [
                'required',
                'string',
                'size:1',
                'in:A,B,C,D',
            ],

            'opciones.*.texto' => [
                'required',
                'string',
                'max:500',
            ],

            'respuesta_correcta' => [
                'required',
                'in:A,B,C,D',
            ],
        ], [
            'pregunta.required' => 'La pregunta es obligatoria.',

            'orden.required' => 'El orden es obligatorio.',
            'orden.integer' => 'El orden debe ser un número entero.',
            'orden.min' => 'El orden debe ser mayor o igual a 1.',

            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',

            'opciones.required' => 'Debe agregar las opciones de respuesta.',
            'opciones.min' => 'La pregunta debe tener al menos 3 opciones.',
            'opciones.max' => 'La pregunta puede tener máximo 4 opciones.',

            'opciones.*.letra.required' => 'La letra de la opción es obligatoria.',
            'opciones.*.texto.required' => 'El texto de todas las opciones es obligatorio.',
            'opciones.*.texto.max' => 'Una opción no puede superar los 500 caracteres.',

            'respuesta_correcta.required' => 'Debe seleccionar una respuesta correcta.',
            'respuesta_correcta.in' => 'La respuesta correcta no es válida.',
        ]);


        $letrasOpciones = collect($validated['opciones'])
            ->pluck('letra');


        if (!$letrasOpciones->contains($validated['respuesta_correcta'])) {
            return back()
                ->withInput()
                ->withErrors([
                    'respuesta_correcta' =>
                        'La respuesta correcta debe corresponder a una de las opciones.',
                ]);
        }


        if ($letrasOpciones->unique()->count() !== $letrasOpciones->count()) {
            return back()
                ->withInput()
                ->withErrors([
                    'opciones' =>
                        'No puede haber opciones con la misma letra.',
                ]);
        }


        DB::transaction(function () use (
            $validated,
            $pregunta
        ) {

            $pregunta->update([
                'pregunta' => $validated['pregunta'],
                'orden' => $validated['orden'],
                'estado' => $validated['estado'],
            ]);


            /*
             * Como no existen respuestas históricas,
             * podemos reemplazar las opciones.
             */
            $pregunta->opciones()->delete();


            foreach ($validated['opciones'] as $index => $opcion) {

                $pregunta->opciones()->create([
                    'letra' => $opcion['letra'],
                    'texto' => $opcion['texto'],
                    'es_correcta' =>
                        $opcion['letra'] === $validated['respuesta_correcta'],
                    'orden' => $index + 1,
                ]);
            }
        });


        return redirect()
            ->route('testes.preguntas.index', $teste)
            ->with('success', 'La pregunta fue actualizada correctamente.');
    }


    /**
     * Eliminar una pregunta.
     */
    public function destroy(
        TestConocimiento $teste,
        TestPregunta $pregunta
    ) {
        /*
         * Verificar que la pregunta pertenezca al test.
         */
        abort_unless(
            $pregunta->test_id === $teste->id,
            404
        );


        /*
         * No permitir eliminar preguntas
         * que ya tengan respuestas históricas.
         */
        if ($pregunta->respuestas()->exists()) {
            return redirect()
                ->route('testes.preguntas.index', $teste)
                ->with(
                    'error',
                    'No se puede eliminar esta pregunta porque ya tiene respuestas registradas.'
                );
        }


        $pregunta->delete();


        return redirect()
            ->route('testes.preguntas.index', $teste)
            ->with('success', 'La pregunta fue eliminada correctamente.');
    }
}