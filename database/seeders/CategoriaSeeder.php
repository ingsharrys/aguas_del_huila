<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Actualidad', 'descripcion' => 'Noticias recientes y comunicados institucionales.'],
            ['nombre' => 'Eventos', 'descripcion' => 'Actividades y eventos organizados por la empresa.'],
            ['nombre' => 'Comunicados', 'descripcion' => 'Información oficial dirigida a la comunidad.'],
            ['nombre' => 'Proyectos', 'descripcion' => 'Avances y resultados de proyectos institucionales.'],
        ];

        foreach ($categorias as $cat) {
            Categoria::create([
                'nombre' => $cat['nombre'],
                'slug' => Str::slug($cat['nombre']),
                'descripcion' => $cat['descripcion'],
            ]);
        }
    }
}
