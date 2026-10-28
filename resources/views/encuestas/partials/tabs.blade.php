{{-- Pestañas del módulo de encuestas: cada encuesta en su propia página --}}
@php
    $periodoTabs = $periodo ?? null;
    $pestanas = [
        'tramites'   => ['Satisfacción de trámites', route('dashboard.encuestas', array_filter(['tab' => 'tramites', 'periodo' => $periodoTabs]))],
        'evaluacion' => ['Evaluación del sitio web', route('dashboard.encuestas', array_filter(['tab' => 'evaluacion', 'periodo' => $periodoTabs]))],
        'cacsp'      => ['Atención al cliente (CACSP)', route('dashboard.encuestas.cacsp', array_filter(['periodo' => $periodoTabs]))],
    ];
@endphp
<nav class="enc-tabs" aria-label="Encuestas">
    @foreach($pestanas as $clave => [$etiqueta, $url])
        <a href="{{ $url }}" @if($activa === $clave) aria-current="page" @endif>
            {{ $etiqueta }}
            @isset($conteos[$clave])<small>{{ number_format($conteos[$clave], 0, ',', '.') }}</small>@endisset
        </a>
    @endforeach
</nav>
