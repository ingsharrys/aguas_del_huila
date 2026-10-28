<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $estado = $request->input('estado');

        $cargos = Cargo::query()
            ->when($buscar, fn($q) => $q->where('nombre', 'like', "%{$buscar}%"))
            ->when($estado !== null, fn($q) => $q->where('estado', $estado))
            ->orderBy('nombre', 'asc')
            ->paginate(10)
            ->appends($request->query());

        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        return view('cargos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255|unique:cargos,nombre',
            'estado' => 'required|boolean',
        ]);

        Cargo::create($data);

        return redirect()->route('cargos.index')->with('success', 'Cargo creado correctamente.');
    }

    public function edit(Cargo $cargo)
    {
        return view('cargos.edit', compact('cargo'));
    }

    public function update(Request $request, Cargo $cargo)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255|unique:cargos,nombre,' . $cargo->id,
            'estado' => 'required|boolean',
        ]);

        $cargo->update($data);

        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado correctamente.');
    }

    public function destroy(Cargo $cargo)
    {
        if ($cargo->usuarios()->exists()) {
            return back()->with('error', 'No se puede eliminar el cargo porque tiene usuarios asignados.');
        }

        $cargo->delete();
        return redirect()->route('cargos.index')->with('success', 'Cargo eliminado correctamente.');
    }
}