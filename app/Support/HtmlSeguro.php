<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;

/**
 * Limpia HTML escrito en el editor (TinyMCE) con una lista blanca de etiquetas,
 * atributos y estilos. Elimina scripts, eventos (onclick...), iframes y enlaces javascript:.
 */
class HtmlSeguro
{
    private const ETIQUETAS = [
        'p', 'br', 'hr', 'div', 'span', 'b', 'strong', 'i', 'em', 'u', 's', 'strike', 'sub', 'sup',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre', 'code',
        'ul', 'ol', 'li', 'a', 'img', 'figure', 'figcaption',
        'table', 'caption', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td', 'colgroup', 'col',
    ];

    // Solo en contenido editorial: videos y mapas incrustados de proveedores conocidos
    private const ETIQUETAS_MULTIMEDIA = ['iframe', 'video', 'audio', 'source'];

    private const ORIGENES_IFRAME = [
        '#^https://(www\.)?youtube(-nocookie)?\.com/embed/#i',
        '#^https://player\.vimeo\.com/video/#i',
        '#^https://(www\.)?google\.com/maps/embed#i',
        '#^https://(www\.)?facebook\.com/plugins/#i',
    ];

    // Etiquetas que se eliminan junto con su contenido
    private const PELIGROSAS = ['script', 'style', 'iframe', 'object', 'embed', 'form', 'input', 'button', 'textarea', 'select', 'svg', 'math', 'link', 'meta', 'base', 'frame', 'frameset', 'template', 'noscript'];

    private const ATRIBUTOS = [
        '*'   => ['style', 'title', 'class'],
        'a'   => ['href', 'target', 'rel'],
        'img' => ['src', 'alt', 'width', 'height'],
        'td'  => ['colspan', 'rowspan', 'width', 'height', 'align', 'valign'],
        'th'  => ['colspan', 'rowspan', 'width', 'height', 'align', 'valign', 'scope'],
        'table' => ['border', 'cellpadding', 'cellspacing', 'width'],
        'col' => ['span', 'width'],
        'ol'  => ['start', 'type'],
        'iframe' => ['src', 'width', 'height', 'allow', 'allowfullscreen', 'frameborder', 'loading', 'referrerpolicy'],
        'video'  => ['src', 'controls', 'width', 'height', 'poster', 'preload'],
        'audio'  => ['src', 'controls', 'preload'],
        'source' => ['src', 'type'],
    ];

    private const ESTILOS = [
        'text-align', 'color', 'background-color', 'font-weight', 'font-style', 'font-size', 'font-family',
        'text-decoration', 'width', 'height', 'max-width', 'padding', 'padding-left', 'padding-right',
        'margin', 'margin-left', 'margin-right', 'border', 'border-collapse', 'vertical-align', 'line-height',
        'list-style-type',
    ];

    /**
     * Devuelve HTML seguro. Si el texto no tiene etiquetas (respuestas antiguas en texto plano), conserva los saltos de línea.
     */
    public static function mostrar(?string $texto): string
    {
        $texto = (string) $texto;

        if (!preg_match('/<\/?[a-z][a-z0-9]*(\s[^>]*)?\/?>/i', $texto)) {
            return nl2br(e($texto));
        }

        return static::limpiar($texto);
    }

    /**
     * Contenido editorial (noticias, posts, servicios...): además permite videos y mapas incrustados.
     */
    public static function contenido(?string $html): string
    {
        return static::limpiar($html, true);
    }

    public static function limpiar(?string $html, bool $permitirMultimedia = false): string
    {
        $html = trim((string) $html);

        if ($html === '') {
            return '';
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $anterior = libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8"><div id="__raiz">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NONET);
        libxml_clear_errors();
        libxml_use_internal_errors($anterior);

        $raiz = $dom->getElementById('__raiz');

        if (!$raiz) {
            return e(strip_tags($html));
        }

        static::limpiarNodo($raiz, $permitirMultimedia);

        $resultado = '';
        foreach ($raiz->childNodes as $hijo) {
            $resultado .= $dom->saveHTML($hijo);
        }

        return $resultado;
    }

    private static function limpiarNodo(DOMNode $nodo, bool $multimedia): void
    {
        $etiquetas = $multimedia ? array_merge(self::ETIQUETAS, self::ETIQUETAS_MULTIMEDIA) : self::ETIQUETAS;
        $peligrosas = $multimedia ? array_diff(self::PELIGROSAS, ['iframe']) : self::PELIGROSAS;

        // Copia: la lista cambia mientras se eliminan nodos
        foreach (iterator_to_array($nodo->childNodes) as $hijo) {
            if ($hijo instanceof DOMElement) {
                $etiqueta = strtolower($hijo->nodeName);

                if (in_array($etiqueta, $peligrosas, true)) {
                    $nodo->removeChild($hijo);
                    continue;
                }

                // Iframes solo de proveedores de video/mapas conocidos
                if ($etiqueta === 'iframe' && !static::iframePermitido($hijo->getAttribute('src'))) {
                    $nodo->removeChild($hijo);
                    continue;
                }

                static::limpiarNodo($hijo, $multimedia);

                if (!in_array($etiqueta, $etiquetas, true)) {
                    // Etiqueta no permitida: se conserva solo su contenido
                    while ($hijo->firstChild) {
                        $nodo->insertBefore($hijo->firstChild, $hijo);
                    }
                    $nodo->removeChild($hijo);
                    continue;
                }

                static::limpiarAtributos($hijo, $etiqueta);
            } elseif ($hijo->nodeType === XML_COMMENT_NODE || $hijo->nodeType === XML_PI_NODE) {
                $nodo->removeChild($hijo);
            }
        }
    }

    private static function limpiarAtributos(DOMElement $elemento, string $etiqueta): void
    {
        $permitidos = array_merge(self::ATRIBUTOS['*'], self::ATRIBUTOS[$etiqueta] ?? []);

        foreach (iterator_to_array($elemento->attributes) as $atributo) {
            $nombre = strtolower($atributo->name);
            $valor = trim($atributo->value);

            if (!in_array($nombre, $permitidos, true)) {
                $elemento->removeAttribute($atributo->name);
                continue;
            }

            if (in_array($nombre, ['href', 'src'], true) && !static::urlSegura($valor, $nombre === 'src')) {
                $elemento->removeAttribute($atributo->name);
                continue;
            }

            if ($nombre === 'style') {
                $estilo = static::limpiarEstilo($valor);
                $estilo === '' ? $elemento->removeAttribute('style') : $elemento->setAttribute('style', $estilo);
            }
        }

        // Enlaces que abren otra pestaña no deben poder controlar esta página
        if ($etiqueta === 'a' && $elemento->getAttribute('target') === '_blank') {
            $elemento->setAttribute('rel', 'noopener noreferrer');
        }
    }

    private static function iframePermitido(string $src): bool
    {
        foreach (self::ORIGENES_IFRAME as $patron) {
            if (preg_match($patron, trim($src))) {
                return true;
            }
        }

        return false;
    }

    private static function urlSegura(string $url, bool $esImagen): bool
    {
        // Quitar caracteres de control y espacios usados para ofuscar "javascript:"
        $limpia = strtolower(preg_replace('/[\x00-\x20]+/', '', html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8')));

        if ($limpia === '' || str_starts_with($limpia, '#') || str_starts_with($limpia, '/') || str_starts_with($limpia, './') || str_starts_with($limpia, '../')) {
            return !str_starts_with($limpia, '//') || $esImagen;
        }

        if (preg_match('/^(https?):/', $limpia)) {
            return true;
        }

        if (!$esImagen && preg_match('/^(mailto|tel):/', $limpia)) {
            return true;
        }

        if ($esImagen && preg_match('#^data:image/(png|jpe?g|gif|webp);base64,#', $limpia)) {
            return true;
        }

        // Rutas relativas sin esquema (ej. "storage/noticias/x.jpg")
        return !str_contains($limpia, ':');
    }

    private static function limpiarEstilo(string $estilo): string
    {
        $limpias = [];

        foreach (explode(';', $estilo) as $declaracion) {
            [$propiedad, $valor] = array_pad(explode(':', $declaracion, 2), 2, '');
            $propiedad = strtolower(trim($propiedad));
            $valor = trim($valor);

            if (!in_array($propiedad, self::ESTILOS, true) || $valor === '') {
                continue;
            }

            // Bloquear url(), expression() y similares
            if (preg_match('/url\s*\(|expression|javascript|@import|[<>\\\\]/i', $valor)) {
                continue;
            }

            $limpias[] = "{$propiedad}: {$valor}";
        }

        return implode('; ', $limpias);
    }
}
