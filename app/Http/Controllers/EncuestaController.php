<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\EncuestaEvaluacion;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    /**
     * Mostrar formulario
     */
    public function index()
    {
        return view('encuestas.tramite');
    }

    /**
     * Guardar encuesta
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:200',
            'correo'       => 'required|email|max:200',
            'telefono'     => 'nullable|string|max:30',
            'tramite'      => 'required|string|max:255',
            'medio'        => 'required|string|max:255',
            'informacion'  => 'required|string|max:255',
            'facilidad'    => 'required|string|max:255',
            'grupo'        => 'required|string|max:255',
            'beneficio'    => 'required|string|max:255',
            'costos'       => 'nullable|string',
        ]);

        Encuesta::create([
            'nombre'       => $request->nombre,
            'correo'       => $request->correo,
            'telefono'     => $request->telefono,
            'tramite'      => $request->tramite,
            'medio'        => $request->medio,
            'informacion'  => $request->informacion,
            'facilidad'    => $request->facilidad,
            'grupo'        => $request->grupo,
            'beneficio'    => $request->beneficio,
            'costos'       => $request->costos,
        ]);

        return redirect()
            ->back()
            ->with('success', 'La encuesta fue enviada correctamente. ¡Gracias por su participación!');
    }

    /**
     * Mostrar formulario
     */
    public function formEvaluacion()
    {
        return view('encuestas.evaluacion');
    }

    /**
     * Guardar encuesta
     */
    public function storeEvaluacion(Request $request)
    {
        $request->validate([
            'actualizada'      => 'required|string|max:255',
            'informacion'  => 'required|string|max:255',
            'satisfaccion'        => 'required|string|max:255',
            'facilidad'    => 'required|string|max:255',
        ]);

        EncuestaEvaluacion::create([
            'actualizada'      => $request->actualizada,
            'informacion'  => $request->informacion,
            'satisfaccion'        => $request->satisfaccion,
            'facilidad'    => $request->facilidad,
        ]);

        return redirect()
            ->back()
            ->with('success', 'La encuesta fue enviada correctamente. ¡Gracias por su participación!');
    }
}