<?php

namespace App\Http\Controllers;

use App\Support\ArchivoSeguro;
use App\Models\Funcionario;
use App\Models\Organigrama;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Funcionario::with('bloque');

        if($request->filled('buscar')){
            $query->where('nombre','like','%'.$request->buscar.'%');
        }

        if($request->filled('bloque_id')){
            $query->where('bloque_id',$request->bloque_id);
        }

        $funcionarios = $query
            ->orderBy('id')
            ->paginate(20);

        $bloques = Organigrama::orderBy('nombre')->get();

        return view(
            'funcionarios.index',
            compact(
                'funcionarios',
                'bloques'
            )
        );
    }

    public function create()
    {
        $bloques = Organigrama::orderBy('nombre')->get();

        return view(
            'funcionarios.create',
            compact('bloques')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'bloque_id'=>'required|exists:organigrama_bloques,id',
            'nombre'=>'required|max:200',
            'cargo'=>'required|max:200',
            'descripcion' => 'required|string',
            'telefono'=>'nullable|string',
            'correo'=>'nullable|email',
            'orden'=>'nullable|integer|min:1',
            'activo' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:500',
        ], [
                'foto.max' => 'La imagen no debe superar los 500 KB.',
            ]);

        // Guardamos la imagen
        $rutaImagen = null;
        if ($request->hasFile('foto')) {
            // Obtener el nombre y la extensión del archivo
            $originalName = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = ArchivoSeguro::extension($request->file('foto'), ArchivoSeguro::IMAGENES, 'foto');
            $filename = Str::slug($originalName) . '-' . uniqid() . '.' . $extension;
            // Guardar en la carpeta 'posts/archivos/AÑO/'
            $rutaImagen = $request->file('foto')->storeAs("funcionarios/", $filename, 'public');
        }

        // Creamos el funcioanrio
        $funcionario = new Funcionario();
        $funcionario->bloque_id = $request->bloque_id;
        $funcionario->nombre = $request->nombre;
        $funcionario->cargo = $request->cargo;
        $funcionario->descripcion = $request->descripcion;
        $funcionario->telefono = $request->telefono ?? NULL;
        $funcionario->correo = $request->correo;
        $funcionario->orden = $request->orden ?? 1;
        $funcionario->activo = $request->boolean('activo');
        $funcionario->foto = $rutaImagen;
        $funcionario->save();

        // Redirigimos con mensaje de éxito
        session()->flash('success', 'Funcionario creado correctamente');
        return redirect()->route('funcionarios.index');
    }

    public function edit(Funcionario $funcionario)
    {
        $bloques = Organigrama::orderBy('nombre')->get();

        return view(
            'funcionarios.edit',
            compact(
                'funcionario',
                'bloques'
            )
        );
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $request->validate([

            'bloque_id'     => 'required|exists:organigrama_bloques,id',
            'nombre'        => 'required|max:200',
            'cargo'         => 'required|max:200',
            'descripcion'   => 'required|string',

            'telefono'      => 'nullable|string',
            'correo'        => 'nullable|email',

            'orden'         => 'nullable|integer|min:1',
            'activo'        => 'nullable|boolean',

            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:500',

        ],[
            'foto.max' => 'La imagen no debe superar los 500 KB.',
        ]);


        // Si el usuario subió una nueva foto
        if($request->hasFile('foto')){

            // Eliminar la foto anterior
            if(
                $funcionario->foto &&
                Storage::disk('public')->exists($funcionario->foto)
            ){
                Storage::disk('public')->delete($funcionario->foto);
            }

            // Crear nuevo nombre
            $originalName = pathinfo(
                $request->file('foto')->getClientOriginalName(),
                PATHINFO_FILENAME
            );

            $extension = ArchivoSeguro::extension($request->file('foto'), ArchivoSeguro::IMAGENES, 'foto');

            $filename = Str::slug($originalName)
                . '-'
                . uniqid()
                . '.'
                . $extension;

            $funcionario->foto = $request->file('foto')->storeAs(
                'funcionarios',
                $filename,
                'public'
            );
        }

        $funcionario->bloque_id     = $request->bloque_id;
        $funcionario->nombre        = $request->nombre;
        $funcionario->cargo         = $request->cargo;
        $funcionario->descripcion   = $request->descripcion;

        $funcionario->telefono      = $request->telefono;
        $funcionario->correo        = $request->correo;

        $funcionario->orden         = $request->orden ?? 1;
        $funcionario->activo        = $request->boolean('activo');

        $funcionario->save();

        return redirect()
            ->route('funcionarios.index')
            ->with('success','Funcionario actualizado correctamente.');
    }

    public function destroy(Funcionario $funcionario)
    {
        // Verificar si existe una imagen asociada y eliminarla del almacenamiento
        if ($funcionario->foto && Storage::disk('public')->exists($funcionario->foto)) {
            Storage::disk('public')->delete($funcionario->foto);
        }

        // Eliminar la funcionario de la base de datos
        $funcionario->delete();

        // Redirigir con mensaje de éxito
        session()->flash('success', 'Noticia eliminada correctamente');
        return redirect()->route('funcionarios.index');
    }


}