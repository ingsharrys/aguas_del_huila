<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🔹 Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $editorRole = Role::firstOrCreate(['name' => 'Editor']);
        $userRole   = Role::firstOrCreate(['name' => 'Usuario']);

        // 🔹 Crear permisos
        $permissions = [
            'ver dashboard',
            'crear noticias',
            'editar noticias',
            'eliminar noticias',
            'publicar noticias'
        ];

        foreach ($permissions as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // 🔹 Asignar permisos a roles
        $adminRole->givePermissionTo(Permission::all());
        $editorRole->givePermissionTo(['ver dashboard', 'crear noticias', 'editar noticias']);
        $userRole->givePermissionTo(['ver dashboard']);

        // 🔹 Crear usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@aguashuila.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('admin123')
            ]
        );

        // 🔹 Asignar rol al usuario
        $admin->assignRole('Administrador');
    }
}
