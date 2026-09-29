<?php

namespace App\Services;

use App\Models\Archivo;
use App\Models\Post;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class ArchivoImportService
{
    /**
     * Importar archivos desde un ZIP.
     */
    public function importar($archivoZip): array
    {
        $nombreTemporal = Str::random(30);

        $zipPath = storage_path(
            'app/temp/' . $nombreTemporal . '.zip'
        );

        $directorioTemporal = storage_path(
            'app/temp/' . $nombreTemporal
        );

        $importados = 0;
        $omitidos = 0;
        $errores = 0;

        try {

            /*
            |--------------------------------------------------------------------------
            | Crear carpeta temporal
            |--------------------------------------------------------------------------
            */

            if (!Storage::exists('temp')) {
                Storage::makeDirectory('temp');
            }

            $path = $archivoZip->storeAs(
                'temp',
                $nombreTemporal . '.zip',
                'local'
            );

            $zipPath = Storage::disk('local')->path($path);

            if (!file_exists($directorioTemporal)) {
                mkdir($directorioTemporal, 0777, true);
            }

            /*
            |--------------------------------------------------------------------------
            | Abrir ZIP
            |--------------------------------------------------------------------------
            */

            $zip = new ZipArchive();

            if ($zip->open($zipPath) !== true) {
                throw new \Exception(
                    'No fue posible abrir el archivo ZIP.'
                );
            }

            $zip->extractTo($directorioTemporal);

            $zip->close();

            /*
            |--------------------------------------------------------------------------
            | Recorrer carpetas (Post ID)
            |--------------------------------------------------------------------------
            */

            foreach (scandir($directorioTemporal) as $carpeta) {

                if (in_array($carpeta, ['.', '..'])) {
                    continue;
                }

                $rutaCarpeta = $directorioTemporal . DIRECTORY_SEPARATOR . $carpeta;

                if (!is_dir($rutaCarpeta)) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Validar Post ID
                |--------------------------------------------------------------------------
                */

                $postId = intval($carpeta);

                if ($postId <= 0) {

                    Log::warning(
                        "La carpeta '{$carpeta}' no corresponde a un Post ID."
                    );

                    $omitidos++;

                    continue;
                }

                if (!Post::where('id', $postId)->exists()) {

                    Log::warning(
                        "No existe el Post con ID {$postId}."
                    );

                    $omitidos++;

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Recorrer archivos
                |--------------------------------------------------------------------------
                */

                foreach (scandir($rutaCarpeta) as $archivo) {

                    if (in_array($archivo, ['.', '..'])) {
                        continue;
                    }

                    try {

                        $resultado = $this->procesarArchivo(
                            $rutaCarpeta,
                            $archivo,
                            $postId
                        );

                        switch ($resultado) {

                            case 'importado':
                                $importados++;
                                break;

                            case 'omitido':
                                $omitidos++;
                                break;

                            default:
                                $errores++;
                                break;
                        }

                    } catch (\Throwable $e) {

                        $errores++;

                        Log::error(
                            'Error importando archivo.',
                            [
                                'archivo' => $archivo,
                                'post_id' => $postId,
                                'mensaje' => $e->getMessage(),
                                'linea' => $e->getLine(),
                            ]
                        );

                    }

                }

            }

        } catch (\Throwable $e) {

            Log::error(
                'Error general en la importación.',
                [
                    'mensaje' => $e->getMessage(),
                    'linea' => $e->getLine(),
                ]
            );

            throw $e;

        } finally {

            /*
            |--------------------------------------------------------------------------
            | Eliminar ZIP temporal
            |--------------------------------------------------------------------------
            */

            if (file_exists($zipPath)) {
                @unlink($zipPath);
            }

            /*
            |--------------------------------------------------------------------------
            | Eliminar carpeta temporal
            |--------------------------------------------------------------------------
            */

            if (file_exists($directorioTemporal)) {
                FileFacade::deleteDirectory($directorioTemporal);
            }

        }

        /*
        |--------------------------------------------------------------------------
        | Resultado
        |--------------------------------------------------------------------------
        */

        return [

            'success' =>

                "Importación finalizada correctamente.

                Archivos importados: {$importados}

                Archivos omitidos: {$omitidos}

                Errores encontrados: {$errores}"

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | MÉTODOS PRIVADOS
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Procesa un archivo individual.
     */
    private function procesarArchivo(
        string $rutaCarpeta,
        string $archivo,
        int $postId
    ): string {

        $rutaArchivo = $rutaCarpeta . DIRECTORY_SEPARATOR . $archivo;

        if (!is_file($rutaArchivo)) {
            return 'omitido';
        }

        $extension = strtolower(
            pathinfo($archivo, PATHINFO_EXTENSION)
        );

        /*
        |--------------------------------------------------------------------------
        | Extensiones permitidas
        |--------------------------------------------------------------------------
        */

        $permitidos = [
            'pdf',
            'doc',
            'docx',
            'xls',
            'xlsx',
            'ppt',
            'pptx',
            'zip',
            'rar',
            'jpg',
            'jpeg',
            'png'
        ];

        if (!in_array($extension, $permitidos)) {
            return 'omitido';
        }

        $nombre = pathinfo($archivo, PATHINFO_FILENAME);

        $slugUnico = $this->generarSlugUnico($nombre);

        $nombreFisico = $slugUnico . '.' . $extension;

        $anio = now()->year;

        $rutaDestino = "posts/archivos/{$anio}/{$postId}";

        DB::transaction(function () use (

            $rutaArchivo,
            $rutaDestino,
            $nombre,
            $slugUnico,
            $nombreFisico,
            $postId

        ) {

            Storage::disk('public')->putFileAs(
                $rutaDestino,
                new File($rutaArchivo),
                $nombreFisico
            );

            Archivo::create([

                'nombre' => $nombre,

                'slug' => $slugUnico,

                'archivo' => $rutaDestino . '/' . $nombreFisico,

                'comentarios' => 0,

                'inicio' => null,

                'fin' => null,

                'post_id' => $postId,

            ]);

        });

        return 'importado';

    }


    /**
     * Genera un slug único.
     */
    private function generarSlugUnico(string $nombre): string
    {
        $slugBase = Str::slug($nombre);

        $slug = $slugBase;

        $contador = 1;

        while (Archivo::where('slug', $slug)->exists()) {

            $slug = $slugBase . '-' . $contador;

            $contador++;

        }

        return $slug;
    }

}