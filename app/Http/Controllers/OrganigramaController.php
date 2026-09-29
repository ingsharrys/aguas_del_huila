<?php

namespace App\Http\Controllers;

use App\Models\Organigrama;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganigramaController extends Controller
{
    public function index(Request $request)
    {
        $query = Organigrama::with('parent');

        if($request->filled('buscar')){
            $query->where('nombre','like','%'.$request->buscar.'%');
        }

        $bloques = $query
            ->orderBy('orden')
            ->paginate(20);

        return view(
            'organigrama.index',
            compact('bloques')
        );
    }

    public function create()
    {
        $padres = Organigrama::orderBy('nombre')->get();

        return view(
            'organigrama.create',
            compact('padres')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'nombre'=>'required|max:200',

            'parent_id'=>'nullable|exists:organigrama_bloques,id',

            'orden'=>'nullable|integer|min:1'

        ]);

        Organigrama::create([

            'nombre'=>$request->nombre,

            'slug'=>Str::slug($request->nombre),

            'parent_id'=>$request->parent_id,

            'orden'=>$request->orden ?? 1

        ]);

        return redirect()
            ->route('organigrama.index')
            ->with('success','Bloque creado correctamente.');
    }

    public function edit(Organigrama $organigrama)
    {
        $padres = Organigrama::where('id','!=',$organigrama->id)
            ->orderBy('nombre')
            ->get();

        return view(
            'organigrama.edit',
            compact('organigrama','padres')
        );
    }

    public function update(Request $request, Organigrama $organigrama)
    {
        $request->validate([

            'nombre'=>'required|max:200',

            'parent_id'=>'nullable|exists:organigrama_bloques,id',

            'orden'=>'nullable|integer|min:1'

        ]);

        $organigrama->update([

            'nombre'=>$request->nombre,

            'slug'=>Str::slug($request->nombre),

            'parent_id'=>$request->parent_id,

            'orden'=>$request->orden ?? 1

        ]);

        return redirect()
            ->route('organigrama.index')
            ->with('success','Bloque actualizado.');
    }

    public function destroy(Organigrama $organigrama)
    {
        $organigrama->delete();

        return back()->with(
            'success',
            'Bloque eliminado correctamente.'
        );
    }

    // Vista individual de los bloques con funcionarios y subbloques
    public function show($slug)
    {
        $bloque = Organigrama::with([

            // Funcionarios del bloque principal
            'funcionarios',

            // Subbloques
            'children',

            // Funcionarios de cada subbloque
            'children.funcionarios',

            // Nietos (opcional)
            'children.children',

            // Funcionarios de los nietos
            'children.children.funcionarios',

            // Para mostrar la ruta de navegación
            'parent'

        ])->where('slug', $slug)->firstOrFail();

        return view(
            'organigrama.show',
            compact('bloque')
        );
    }

}