<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Noticia;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Str;

class NoticiaSeeder extends Seeder
{
    public function run(): void
    {
        // Tomamos la primera categoría
        $categoria = Categoria::first();
        $usuario = User::first(); // Asegúrate de tener un usuario creado

        if (!$usuario) {
            $this->command->warn('⚠️ No hay usuarios registrados. Crea uno antes de ejecutar el seeder de noticias.');
            return;
        }

        $noticias = [
            [
                'titulo' => 'Nueva planta de tratamiento en Neiva',
                'contenido' => 'Aguas del Huila inaugura una nueva planta de tratamiento que mejorará el servicio de agua potable...',
                'imagen_portada' => 'portada-oxaca.jpg',
            ],
            [
                'titulo' => 'Campaña de uso responsable del agua',
                'contenido' => 'Se lanza una nueva campaña para fomentar el uso responsable del agua entre los ciudadanos...',
                'imagen_portada' => 'portada-oxaca.jpg',
            ],
        ];

        foreach ($noticias as $n) {
            Noticia::create([
                'titulo' => $n['titulo'],
                'slug' => Str::slug($n['titulo']),
                'contenido' => $n['contenido'],
                'categoria_id' => $categoria?->id,
                'user_id' => $usuario->id,
                'publicado' => true,
                'imagen_portada' => $n['imagen_portada'],
            ]);
        }
    }
}
