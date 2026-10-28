<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $estado = $request->input('estado');

        $areas = Area::query()
            ->when($buscar, fn($q) => $q->where('nombre', 'like', "%{$buscar}%"))
            ->when($estado !== null, fn($q) => $q->where('estado', $estado))
            ->with('parent') // Si tienes relación de sub-áreas
            ->orderBy('nombre', 'asc')
            ->paginate(10)
            ->appends($request->query());

        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        $areasPadre = Area::where('estado', 1)->orderBy('nombre')->get();
        return view('areas.create', compact('areasPadre'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:255|unique:areas,nombre',
            'parent_id' => 'nullable|exists:areas,id',
            'estado'    => 'required|boolean',
        ]);

        Area::create($data);

        return redirect()->route('areas.index')->with('success', 'Área creada correctamente.');
    }

    public function edit(Area $area)
    {
        $areasPadre = Area::where('estado', 1)->where('id', '!=', $area->id)->orderBy('nombre')->get();
        return view('areas.edit', compact('area', 'areasPadre'));
    }

    public function update(Request $request, Area $area)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:255|unique:areas,nombre,' . $area->id,
            'parent_id' => 'nullable|exists:areas,id',
            'estado'    => 'required|boolean',
        ]);

        $area->update($data);

        return redirect()->route('areas.index')->with('success', 'Área actualizada correctamente.');
    }

    public function destroy(Area $area)
    {
        // Opcional: Validar si tiene usuarios antes de eliminar
        if ($area->usuarios()->exists()) {
            return back()->with('error', 'No se puede eliminar el área porque tiene usuarios asignados.');
        }

        $area->delete();
        return redirect()->route('areas.index')->with('success', 'Área eliminada correctamente.');
    }
}
