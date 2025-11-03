<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $buscar_correo = $request->input('buscar_correo');

        $usuarios = User::query()
            ->with('roles')
            ->when($buscar, fn($q) => 
                $q->where('name', 'like', "%{$buscar}%")
            )
            ->when($buscar_correo, fn($q) => 
                $q->where('email', 'like', "%{$buscar_correo}%")
            )
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends($request->only(['buscar', 'buscar_correo'])); // 🔹 mantiene filtros al cambiar de página

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'rol'    => 'required|string'
        ]);

        $usuario = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $usuario->syncRoles([$request->rol]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $usuario)
    {
        $roles = Role::all();
        $userRoles = $usuario->roles->pluck('name')->toArray();

        return view('usuarios.edit', compact('usuario', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$usuario->id}",
            'rol' => 'required|string'
        ]);

        $usuario->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $usuario->update(['password' => bcrypt($request->password)]);
        }

        $usuario->syncRoles([$request->rol]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}

