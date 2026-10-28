<?php

namespace App\Http\Controllers;

use App\Models\TestConocimiento;
use App\Models\TestIntento;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Municipio;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestController extends Controller
{
    /**
     * Dashboard principal del módulo de tests.
     */
    public function test()
    {
        $estadisticas = [
            'total_tests' => TestConocimiento::count(),

            'tests_activos' => TestConocimiento::where('estado', 'Activo')
                ->count(),

            'total_intentos' => TestIntento::count(),

            'intentos_mes' => TestIntento::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),

            'promedio_calificacion' => TestIntento::avg('porcentaje') ?? 0,

            'aprobados' => TestIntento::where('porcentaje', '>=', 60)
                ->count(),

            'reprobados' => TestIntento::where('porcentaje', '<', 60)
                ->count(),

            'participantes_mes' => TestIntento::whereBetween(
                'created_at',
                [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]
            )->distinct('ip_address')->count('ip_address'),

        ];

        $tests = TestConocimiento::withCount([
            'preguntas',
            'intentos',
        ])
        ->withAvg('intentos', 'porcentaje')
        ->orderBy('nombre')
        ->get();

        $ranking = TestIntento::with([
            'test',
            'municipio',
        ])
        ->orderByDesc('porcentaje')
        ->orderBy('created_at')
        ->limit(10)
        ->get();

        return view('testes.test', compact(
            'estadisticas',
            'tests',
            'ranking'
        ));
    }

    /**
     * Listado de tests.
     */
    public function index(Request $request)
    {
        $query = TestConocimiento::query()
            ->withCount([
                'preguntas',
                'intentos',
            ])
            ->withAvg('intentos', 'porcentaje');

        // Filtro por nombre
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $tests = $query
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        return view('testes.index', compact('tests'));
    }

    /**
     * Formulario para crear un test.
     */
    public function create()
    {
        return view('testes.create');
    }

    /**
     * Guardar un nuevo test.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                'unique:test_conocimientos,nombre',
            ],
            'descripcion' => [
                'nullable',
                'string',
            ],
            'estado' => [
                'required',
                'in:Activo,Inactivo',
            ],
        ], [
            'nombre.required' => 'El nombre del test es obligatorio.',
            'nombre.unique' => 'Ya existe un test con este nombre.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',

            'slug.unique' => 'Este identificador ya está siendo utilizado.',
            'slug.max' => 'El identificador no puede superar los 255 caracteres.',

            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        // Si no se proporciona slug, lo generamos automáticamente
        $validated['slug'] = Str::slug($validated['nombre']);

        // Verificar nuevamente el slug generado
        $slugExiste = TestConocimiento::where('slug', $validated['slug'])->exists();

        if ($slugExiste) {
            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'El identificador generado ya existe. Por favor, utiliza otro.',
                ]);
        }

        $test = TestConocimiento::create($validated);

        return redirect()
            ->route('testes.index', $test)
            ->with('success', 'El test de conocimiento fue creado correctamente.');
    }

    /**
     * Mostrar un test.
     */
    public function show(string $slug)
    {
        $municipios = Municipio::where('departamento_id', '18') // Huila
            ->where('estado', 1)
            ->orderBy('nombre')
            ->get([
                'id',
                'nombre'
            ]);

        $test = TestConocimiento::where('slug', $slug)
            ->where('estado', 'Activo')
            ->with([
                'preguntas' => function ($query) {
                    $query->where('estado', 'Activo')
                        ->orderBy('orden')
                        ->with([
                            'opciones' => function ($query) {
                                $query->orderBy('orden');
                            }
                        ]);
                }
            ])
            ->firstOrFail();

        return view('testes.show',compact('test', 'municipios'));
    }

    /**
     * Formulario para editar un test.
     */
    public function edit(TestConocimiento $testis)
    {
        return view('testes.edit', compact('testis'));
    }

    /**
     * Actualizar un test.
     */
    public function update(Request $request, TestConocimiento $testis)
    {
        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('test_conocimientos', 'nombre')
                    ->ignore($testis->id),
            ],

            'descripcion' => [
                'nullable',
                'string',
            ],

            'estado' => [
                'required',
                'in:Activo,Inactivo',
            ],
        ], [
            'nombre.required' => 'El nombre del test es obligatorio.',
            'nombre.unique' => 'Ya existe otro test con este nombre.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',

            'slug.unique' => 'Ya existe otro test con este identificador.',
            'slug.max' => 'El identificador no puede superar los 255 caracteres.',

            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        /*
        * Si el slug está vacío, lo generamos a partir del nombre.
        */
        $validated['slug'] = Str::slug($validated['nombre']);

        /*
        * Verificar que el slug generado no pertenezca a otro test.
        */
        $slugExiste = TestConocimiento::where('slug', $validated['slug'])
            ->where('id', '!=', $testis->id)
            ->exists();

        if ($slugExiste) {
            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'El identificador generado ya existe. Por favor, utiliza otro.',
                ]);
        }

        $testis->update($validated);

        return redirect()
            ->route('testes.index')
            ->with('success', 'El test de conocimiento fue actualizado correctamente.');
    }

    /**
     * Eliminar un test.
     */
    public function destroy(TestConocimiento $testis)
    {
        /*
         * Si el test tiene intentos, no lo eliminamos.
         * Esto protege el histórico de resultados.
         */
        if ($testis->intentos()->exists()) {
            return redirect()
                ->route('testes.index')
                ->with('error', 'No se puede eliminar un test que ya tiene intentos registrados.');
        }

        $testis->delete();

        return redirect()
            ->route('testes.index')
            ->with('success', 'Test eliminado correctamente.');
    }

    /**
     * Procesar y guardar las respuestas del test.
     */
    public function resultados(Request $request, string $slug)
    {
        $municipios = Municipio::where('departamento_id', '18') // Huila
            ->where('estado', 1)
            ->orderBy('nombre')
            ->get([
                'id',
                'nombre'
            ]);

        /*
         * Primero obtenemos el test.
         */
        $test = TestConocimiento::where('slug', $slug)
            ->where('estado', 'Activo')
            ->with([
                'preguntas' => function ($query) {
                    $query->where('estado', 'Activo')
                        ->orderBy('orden')
                        ->with('opciones');
                }
            ])
            ->firstOrFail();

        $ipAddress = $request->ip();

        $ultimoIntento = TestIntento::where('test_id', $test->id)
            ->where('ip_address', $ipAddress)
            ->where('created_at', '>=', now()->subDays(30))
            ->latest('created_at')
            ->first();

        if ($ultimoIntento) {

            return view('testes.show', [
                'test' => $test,
                'municipios' => $municipios,
                'intento' => null,
                'errorTest' => 'Ya has presentado este test durante los últimos 30 días. Podrás volver a presentarlo después de que transcurra este período.',
            ]);
        }


        /*
         * Validación básica.
         */
        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'municipio_id' => [
                'required',
                'integer',
                'exists:municipios_col,id',
            ],

            'mensaje' => [
                'required',
                'string',
            ],

            'respuestas' => [
                'required',
                'array',
            ],

            'respuestas.*' => [
                'required',
                'integer',
            ],
        ], [
            'nombre.required' =>
                'El nombre completo es obligatorio.',

            'nombre.max' =>
                'El nombre no puede superar los 255 caracteres.',

            'municipio_id.required' =>
                'Debe seleccionar un municipio.',

            'municipio_id.exists' =>
                'El municipio seleccionado no es válido.',

            'mensaje.required' =>
                'Debe escribir una acción para ahorrar y proteger el agua.',

            'respuestas.required' =>
                'Debe responder las preguntas del test.',

            'respuestas.*.required' =>
                'Debe seleccionar una respuesta para cada pregunta.',

            'respuestas.*.integer' =>
                'La respuesta seleccionada no es válida.',
        ]);


        /*
         * Obtenemos únicamente las preguntas activas
         * que pertenecen al test.
         */
        $preguntas = $test->preguntas;


        /*
         * Verificar que se haya respondido cada pregunta.
         */
        foreach ($preguntas as $pregunta) {

            if (!isset($validated['respuestas'][$pregunta->id])) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'respuestas' =>
                            'Debe responder todas las preguntas del test.',
                    ]);
            }
        }


        /*
         * Calculamos las respuestas correctas.
         */
        $respuestasCorrectas = 0;

        $respuestasGuardar = [];


        foreach ($preguntas as $pregunta) {

            $opcionId = (int) $validated['respuestas'][$pregunta->id];


            /*
             * Buscar la opción seleccionada dentro de las opciones
             * que realmente pertenecen a esta pregunta.
             */
            $opcion = $pregunta->opciones
                ->firstWhere('id', $opcionId);


            /*
             * Si el usuario manipuló el formulario y envió
             * una opción que no pertenece a la pregunta,
             * rechazamos la solicitud.
             */
            if (!$opcion) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'respuestas' =>
                            'Se detectó una respuesta no válida.',
                    ]);
            }


            /*
             * Determinar si la respuesta es correcta.
             */
            $esCorrecta = (bool) $opcion->es_correcta;


            if ($esCorrecta) {
                $respuestasCorrectas++;
            }


            /*
             * Guardamos temporalmente la respuesta.
             */
            $respuestasGuardar[] = [
                'pregunta_id' => $pregunta->id,
                'opcion_id' => $opcion->id,
                'es_correcta' => $esCorrecta,
            ];
        }


        /*
         * Total de preguntas.
         */
        $totalPreguntas = $preguntas->count();


        /*
         * Calcular porcentaje.
         *
         * Ejemplo:
         *
         * 8 correctas de 10 = 80%
         */
        $porcentaje = $totalPreguntas > 0
            ? round(($respuestasCorrectas / $totalPreguntas) * 100, 2)
            : 0;


        /*
         * IP del usuario.
         */
        $ipAddress = $request->ip();


        /*
         * Guardamos el intento y sus respuestas
         * dentro de una misma transacción.
         */
        $intento = DB::transaction(function () use (
            $test,
            $validated,
            $ipAddress,
            $respuestasCorrectas,
            $totalPreguntas,
            $porcentaje,
            $respuestasGuardar
        ) {

            /*
             * Crear intento.
             */
            $intento = TestIntento::create([
                'test_id' => $test->id,
                'nombre' => $validated['nombre'],
                'municipio_id' => $validated['municipio_id'],
                'ip_address' => $ipAddress,
                'comentario' => $validated['mensaje'],
                'respuestas_correctas' => $respuestasCorrectas,
                'total_preguntas' => $totalPreguntas,
                'porcentaje' => $porcentaje,
            ]);


            /*
             * Crear respuestas.
             */
            foreach ($respuestasGuardar as $respuesta) {

                $intento->respuestas()->create([
                    'pregunta_id' => $respuesta['pregunta_id'],
                    'opcion_id' => $respuesta['opcion_id'],
                    'es_correcta' => $respuesta['es_correcta'],
                ]);
            }


            return $intento;
        });


        /*
         * Mostrar resultado.
         */
        return view(
            'testes.show',
            [
                'test' => $test,
                'intento' => $intento,
                'municipios' => $municipios,
                'mostrarResultado' => true,
            ]
        );
    }

    /**
     * Mostrar los formularios de información para niños, niñas y adolescentes.
     */
    public function infonino()
    {
        $tests = TestConocimiento::where('estado', 'Activo')
            ->withCount([
                'preguntas',
                'intentos',
            ])
            ->withAvg('intentos', 'porcentaje')
            ->orderBy('nombre')
            ->get();
        return view('transparencia.infonino', compact('tests'));
    }

    // Listado de participantes de un test
    public function participantes(Request $request, TestConocimiento $teste)
    {
        $request->validate([
            'nombre' => ['nullable', 'string', 'max:255'],
            'tests' => ['nullable', 'integer', 'exists:test_conocimientos,id'],
            'calificacion' => ['nullable', 'in:Aprobados,Desaprobados'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => [
                'nullable',
                'date',
                'after_or_equal:fecha_inicio',
            ],
        ]);

        $participantes = $teste->intentos()
            ->with('municipio')

            // Filtro por nombre del participante
            ->when($request->filled('nombre'), function ($query) use ($request) {
                $query->where(
                    'nombre',
                    'like',
                    '%' . $request->nombre . '%'
                );
            })

            // Filtro por test
            ->when($request->filled('tests'), function ($query) use ($request) {
                $query->where('test_id', $request->tests);
            })

            // Filtro por calificación
            ->when($request->filled('calificacion'), function ($query) use ($request) {
                if ($request->calificacion === 'Aprobados') {
                    $query->where('porcentaje', '>=', 60);
                }

                if ($request->calificacion === 'Desaprobados') {
                    $query->where('porcentaje', '<', 60);
                }
            })

            // Fecha inicial: incluye todo el día
            ->when($request->filled('fecha_inicio'), function ($query) use ($request) {
                $query->whereDate(
                    'created_at',
                    '>=',
                    $request->fecha_inicio
                );
            })

            // Fecha final: incluye todo el día
            ->when($request->filled('fecha_fin'), function ($query) use ($request) {
                $query->whereDate(
                    'created_at',
                    '<=',
                    $request->fecha_fin
                );
            })

            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view(
            'testes.participantes.index',
            compact('teste', 'participantes')
        );
    }

    // Eliminar un participante de un test
    public function participantesDestroy(TestConocimiento $teste,TestIntento $intento)
    {
        abort_unless(
            $intento->test_id === $teste->id,
            404
        );

        $intento->delete();

        return redirect()
            ->route('testes.participantes.index', $teste)
            ->with(
                'success',
                'El participante fue eliminado correctamente.'
            );
    }

}









