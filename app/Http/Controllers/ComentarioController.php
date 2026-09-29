<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    public function index(Request $request)
    {

        $query = Comentario::with([
                'archivo.post',
                'departamento'
            ])
            ->latest();

        // Buscar por nombre de la persona
        if($request->filled('persona')){

            $query->where('nombre','like','%'.$request->persona.'%');

        }

        // Buscar por identificación
        if($request->filled('buscar')){

            $query->where('identificacion','like','%'.$request->buscar.'%');

        }

        // Buscar por nombre del archivo
        if ($request->filled('archivo')) {
            $query->whereHas('archivo', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->archivo . '%');
            });
        }

        // Filtrar estado
        if($request->estado != ''){

            $query->where('aprobado',$request->estado);

        }

        $comentarios = $query->paginate(20)
            ->withQueryString();

        $archivos = Archivo::orderBy('nombre')->get();

        return view(
            'comentarios.index',
            compact(
                'comentarios',
                'archivos'
            )
        );

    }

    public function aprobar(Comentario $comentario)
    {

        $comentario->update([

            'aprobado'=>1

        ]);

        return back()->with(
            'success',
            'Comentario aprobado correctamente.'
        );

    }

    public function destroy(Comentario $comentario)
    {

        $comentario->delete();

        return back()->with(
            'success',
            'Comentario eliminado correctamente.'
        );

    }

}