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
        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'odt', 'ods', 'odp', 'csv', 'txt',
        'jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'mp3', 'zip', 'rar',
    ];

    /**
     * Guarda el archivo y devuelve la ruta relativa dentro del disco.
     */
    public static function guardar(UploadedFile $archivo, string $carpeta, array $permitidas, string $disco = 'public'): string
    {
        $extension = static::extension($archivo, $permitidas);

        return $archivo->storeAs($carpeta, Str::uuid() . '.' . $extension, $disco);
    }

    /**
     * Extensión segura: la del nombre original solo si está permitida y coincide con el contenido.
     */
    public static function extension(UploadedFile $archivo, array $permitidas): string
    {
        $original = strtolower($archivo->getClientOriginalExtension());
        $detectada = strtolower((string) $archivo->guessExtension());

        // Equivalencias habituales entre la extensión y la detección por contenido
        $equivalentes = [
            'jpeg' => 'jpg',
            'docx' => 'zip', 'xlsx' => 'zip', 'pptx' => 'zip', 'odt' => 'zip', 'ods' => 'zip', 'odp' => 'zip',
            'doc' => 'bin', 'xls' => 'bin', 'ppt' => 'bin', 'csv' => 'txt',
        ];

        $coincide = $original === $detectada
            || ($equivalentes[$original] ?? null) === $detectada
            || ($equivalentes[$detectada] ?? null) === $original
            || in_array($detectada, ['', 'bin'], true); // contenido no identificable: se confía en la lista blanca

        if (in_array($original, $permitidas, true) && $coincide) {
            return $original;
        }

        throw ValidationException::withMessages([
            'archivo' => "El archivo \"{$archivo->getClientOriginalName()}\" no tiene un formato permitido.",
        ]);
    }
}
