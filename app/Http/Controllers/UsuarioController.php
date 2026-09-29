<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Area;
use App\Models\Cargo;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        // Obtener listas para los selectores del filtro
        $areas = Area::orderBy('nombre')->get();
        $cargos = Cargo::orderBy('nombre')->get();

        // Consulta de usuarios con filtros dinámicos
        $usuarios = User::query()
            ->with(['roles', 'area', 'cargo']) // Precargar relaciones para evitar N+1
            ->when($request->filled('buscar'), fn($q) => 
                $q->where('name', 'like', "%{$request->buscar}%")
            )
            ->when($request->filled('buscar_correo'), fn($q) => 
                $q->where('email', 'like', "%{$request->buscar_correo}%")
            )
            ->when($request->filled('area_id'), fn($q) => 
                $q->where('area_id', $request->area_id)
            )
            ->when($request->filled('cargo_id'), fn($q) => 
                $q->where('cargo_id', $request->cargo_id)
            )
            ->when($request->filled('es_jefe'), fn($q) => 
                $q->where('es_jefe', $request->es_jefe)
            )
            ->when($request->filled('tipo_vinculacion'), fn($q) => 
                $q->where('tipo_vinculacion', $request->tipo_vinculacion)
            )
            ->when($request->filled('estado'), fn($q) => 
                $q->where('estado', $request->estado)
            )
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends($request->query()); // Mantiene todos los filtros activos en la paginación

        return view('usuarios.index', compact('usuarios', 'areas', 'cargos'));
    }

    public function create()
    {
        $user = auth()->user();

        $roles = Role::all();
        $areas = Area::where('estado', 1)->get();
        $cargos = Cargo::where('estado', 1)->get();

        // Si el usuario pertenece al área 1, excluimos el rol y el área de Administrador
        if ($user->area_id == 1) {
            $roles = $roles->reject(fn($role) => $role->name === 'Administrador');
            $areas = $areas->reject(fn($area) => $area->nombre === 'Administrador' || $area->id == 1);
        }

        return view('usuarios.create', compact('roles', 'areas', 'cargos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres'               => 'required|string|max:255',
            'apellidos'             => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:50|unique:users,numero_identificacion',
            'username'              => 'required|string|max:100|unique:users,username',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'rol'                   => 'required|string',
            'area_id'               => 'required|exists:areas,id',
            'cargo_id'              => 'required|exists:cargos,id',
            'tipo_vinculacion'      => 'required|in:Contratista,Periodo Fijo / Libre Nombramiento,Planta',
            'fecha_terminacion'     => 'required_if:tipo_vinculacion,Contratista,Periodo Fijo / Libre Nombramiento|nullable|date',
            'es_jefe'               => 'nullable|boolean',
        ],
        [
            'numero_identificacion.unique' => 'Este número de identificación ya está registrado.',
            'username.unique' => 'Este nombre de usuario ya está registrado.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
        ]);

        $usuario = User::create([
            'name'                  => trim($request->nombres . ' ' . $request->apellidos),
            'nombres'               => $request->nombres,
            'apellidos'             => $request->apellidos,
            'numero_identificacion' => $request->numero_identificacion,
            'username'              => $request->username,
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
            'area_id'               => $request->area_id,
            'es_jefe'               => $request->has('es_jefe') ? 1 : 0,
            'cargo_id'              => $request->cargo_id,
            'tipo_vinculacion'      => $request->tipo_vinculacion,
            'fecha_terminacion'     => $request->tipo_vinculacion === 'Planta' ? null : $request->fecha_terminacion,
        ]);

        $usuario->syncRoles([$request->rol]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $usuario)
    {
        $user = auth()->user();

        $roles = Role::all();
        $userRoles = $usuario->roles->pluck('name')->toArray();
        $areas = Area::where('estado', 1)->get();
        $cargos = Cargo::where('estado', 1)->get();

        // Si el usuario autenticado es del área 1, ocultamos el rol y área de Administrador
        if ($user->area_id == 1) {
            $roles = $roles->reject(fn($role) => $role->name === 'Administrador');
            $areas = $areas->reject(fn($area) => $area->nombre === 'Administrador' || $area->id == 1);
        }

        return view('usuarios.edit', compact('usuario', 'roles', 'userRoles', 'areas', 'cargos'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombres'               => 'required|string|max:255',
            'apellidos'             => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:50|unique:users,numero_identificacion,' . $usuario->id,
            'username'              => 'required|string|max:100|unique:users,username,' . $usuario->id,
            'email'                 => 'required|email|unique:users,email,' . $usuario->id,
            'password'              => 'nullable|min:6|confirmed',
            'rol'                   => 'required|string',
            'area_id'               => 'required|exists:areas,id',
            'cargo_id'              => 'required|exists:cargos,id',
            'tipo_vinculacion'      => 'required|in:Contratista,Periodo Fijo / Libre Nombramiento,Planta',
            'fecha_terminacion'     => 'required_if:tipo_vinculacion,Contratista,Periodo Fijo / Libre Nombramiento|nullable|date',
            'estado'                => 'required|in:Activado,Desactivado',
            'es_jefe'               => 'nullable|boolean',
        ],
        [
            'numero_identificacion.unique' => 'Este número de identificación ya está registrado.',
            'username.unique' => 'Este nombre de usuario ya está registrado.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
        ]);

        $datos = [
            'name'                  => trim($request->nombres . ' ' . $request->apellidos),
            'nombres'               => $request->nombres,
            'apellidos'             => $request->apellidos,
            'numero_identificacion' => $request->numero_identificacion,
            'username'              => $request->username,
            'email'                 => $request->email,
            'area_id'               => $request->area_id,
            'es_jefe'               => $request->has('es_jefe') ? 1 : 0,
            'cargo_id'              => $request->cargo_id,
            'tipo_vinculacion'      => $request->tipo_vinculacion,
            'fecha_terminacion'     => $request->tipo_vinculacion === 'Planta' ? null : $request->fecha_terminacion,
            'estado'                => $request->estado,
        ];

        // Actualizar contraseña solo si fue ingresada
        if ($request->filled('password')) {
            $datos['password'] = bcrypt($request->password);
        }

        $usuario->update($datos);
        $usuario->syncRoles([$request->rol]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}

