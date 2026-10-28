<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Guarda archivos subidos con un nombre aleatorio y una extensión de una lista permitida.
 * Nunca usa la extensión que envía el navegador, para evitar que se suban .php, .html, etc.
 */
class ArchivoSeguro
{
    public const IMAGENES = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    public const DOCUMENTOS = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'webp'];

    // Documentos institucionales (incluye formatos de datos y comprimidos para descargas)
    public const DOCUMENTOS_INSTITUCIONALES = [
        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'xlsm', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'ods', 'odp', 'odg', 'csv', 'txt', 'rtf',
        'jpg', 'jpeg', 'png', 'gif', 'webp', 'tif', 'tiff', 'mp4', 'mov', 'mp3', 'zip', 'rar', '7z', 'kmz', 'kml', 'dwg', 'dxf',
    ];

    /**
     * Guarda el archivo y devuelve la ruta relativa dentro del disco.
     */
    public static function guardar(UploadedFile $archivo, string $carpeta, array $permitidas, string $disco = 'public', string $campo = 'file'): string
    {
        $extension = static::extension($archivo, $permitidas, $campo);

        return $archivo->storeAs($carpeta, Str::uuid() . '.' . $extension, $disco);
    }

    /**
     * Extensión segura: la del nombre original solo si está permitida y coincide con el contenido.
     */
    public static function extension(UploadedFile $archivo, array $permitidas, string $campo = 'archivo'): string
    {
        $original = strtolower($archivo->getClientOriginalExtension());
        $detectada = strtolower((string) $archivo->guessExtension());

        // Extensiones que el contenido puede reportar de otra forma (Office = zip, CSV = texto, etc.)
        $equivalentes = [
            'jpg'  => ['jpeg'], 'jpeg' => ['jpg'], 'tif' => ['tiff'], 'tiff' => ['tif'],
            'docx' => ['zip'], 'xlsx' => ['zip'], 'xlsm' => ['zip', 'xlsx'], 'pptx' => ['zip'], 'ppsx' => ['zip', 'pptx'],
            'odt' => ['zip'], 'ods' => ['zip'], 'odp' => ['zip'], 'odg' => ['zip'], 'kmz' => ['zip'],
            'doc' => ['xls', 'ppt', 'msg'], 'xls' => ['doc', 'ppt', 'html', 'txt'], 'ppt' => ['doc', 'xls', 'pps'], 'pps' => ['ppt'],
            'csv' => ['txt', 'c', 'html'], 'txt' => ['c', 'csv'], 'kml' => ['xml', 'txt'], 'dxf' => ['txt'], 'rtf' => ['txt'],
            'mov' => ['qt'],
        ];

        $imagenes = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'tif', 'tiff'];

        $coincide = $original === $detectada
            || in_array($detectada, $equivalentes[$original] ?? [], true)
            // Imagen con la extensión de otro formato de imagen (ej. JPG guardado como .png)
            || (in_array($original, $imagenes, true) && in_array($detectada, $imagenes, true))
            || in_array($detectada, ['', 'bin'], true); // contenido no identificable: se confía en la lista blanca

        if (in_array($original, $permitidas, true) && $coincide) {
            return $original;
        }

        throw ValidationException::withMessages([
            $campo => "El archivo \"{$archivo->getClientOriginalName()}\" no tiene un formato permitido.",
        ]);
    }
}
