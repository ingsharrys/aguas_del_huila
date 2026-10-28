<x-layouts.app :title="__('Encuestas')">
@php
    $tr = $estadisticas['tramites'];
    $ev = $estadisticas['evaluacion'];
    $periodos = ['30' => '30 días', '90' => '90 días', '365' => '12 meses', 'todo' => 'Todo'];
    $textoPeriodo = $periodo === 'todo' ? 'todo el histórico' : 'los últimos ' . $periodos[$periodo];

    // Colores por posición en escalas ordenadas de mejor a peor (divergente azul ↔ rojo, gris neutro)
    $divergente = [
        2 => ['var(--pos-2)', 'var(--neg-2)'],
        3 => ['var(--pos-2)', 'var(--neutro)', 'var(--neg-2)'],
        4 => ['var(--pos-2)', 'var(--pos-1)', 'var(--neg-1)', 'var(--neg-2)'],
        5 => ['var(--pos-2)', 'var(--pos-1)', 'var(--neutro)', 'var(--neg-1)', 'var(--neg-2)'],
    ];
    // Escala ordinal de un solo tono (mayor → menor)
    $ordinal = ['var(--seq-4)', 'var(--seq-3)', 'var(--seq-2)', 'var(--seq-1)'];

    $pct = fn ($v, $t) => $t ? round($v / $t * 100) : 0;

    // Pestaña activa: cada encuesta tiene su propia página
    $esTramites = $tab === 'tramites';
    $actual = $esTramites ? $tr : $ev;
    $serie = $tendencia[$tab];
    $kpis = $esTramites
        ? [
            ['Calidad de la información', $tr['kpis']['informacion'], 'Excelente o buena'],
            ['Trámite fácil de realizar', $tr['kpis']['facilidad'], 'Respondió Sí'],
            ['Beneficio del trámite', $tr['kpis']['beneficio'], 'Alto o moderado'],
        ]
        : [
            ['Satisfacción con el sitio', $ev['kpis']['satisfaccion'], 'Satisfecho o muy satisfecho'],
            ['Encontró la información', $ev['kpis']['informacion'], 'Sí, toda'],
            ['Información actualizada', $ev['kpis']['actualizada'], 'Actualizada o muy actualizada'],
        ];
@endphp

@include('encuestas.partials.estilos')

<div class="enc">

    {{-- Encabezado --}}
    <div class="enc-cabecera">
        <div>
            <h1 class="enc-titulo">Encuestas</h1>
            <p class="enc-subtitulo">Resultados de las encuestas de percepción ciudadana · {{ $textoPeriodo }}</p>
        </div>
        <nav class="enc-segmento" aria-label="Período">
            @foreach($periodos as $valor => $etiqueta)
                <a href="{{ route('dashboard.encuestas', ['tab' => $tab, 'periodo' => $valor]) }}" @if($periodo === (string) $valor) aria-current="page" @endif>{{ $etiqueta }}</a>
            @endforeach
        </nav>
    </div>

    @include('encuestas.partials.tabs', ['activa' => $tab, 'conteos' => ['tramites' => $tr['total'], 'evaluacion' => $ev['total'], 'cacsp' => $estadisticas['cacsp']['total']]])

    {{-- Indicadores de la encuesta activa --}}
    <div class="enc-grid">
        <div class="enc-tarjeta">
            <p class="enc-kpi-etiqueta">Respuestas</p>
            <p class="enc-kpi-valor">{{ number_format($actual['total'], 0, ',', '.') }}</p>
            <div class="enc-kpi-pie">
                @if(!is_null($actual['variacion']))
                    <span class="enc-delta {{ $actual['variacion'] >= 0 ? 'sube' : 'baja' }}" title="Comparado con el período anterior">
                        {{ $actual['variacion'] >= 0 ? '▲' : '▼' }} {{ abs($actual['variacion']) }}%
                    </span>
                    <span>vs. período anterior</span>
                @else
                    <span>{{ number_format($actual['historico'], 0, ',', '.') }} en total</span>
                @endif
            </div>
        </div>

        @foreach($kpis as [$etiqueta, $valor, $nota])
            <div class="enc-tarjeta">
                <p class="enc-kpi-etiqueta">{{ $etiqueta }}</p>
                <p class="enc-kpi-valor">{{ is_null($valor) ? '—' : $valor . '%' }}</p>
                <div class="enc-medidor" role="img" aria-label="{{ $etiqueta }}: {{ $valor ?? 0 }}%"><span style="width: {{ $valor ?? 0 }}%"></span></div>
                <div class="enc-kpi-pie"><span>{{ $nota }}</span></div>
            </div>
        @endforeach
    </div>

    {{-- Tendencia --}}
    <div class="enc-tarjeta">
        <div class="enc-tarjeta-cab">
            <div>
                <h3>Respuestas en el tiempo</h3>
                <p class="enc-nota">{{ $periodo === 'todo' || (int) $periodo > 90 ? 'Por mes' : 'Por semana' }}</p>
            </div>
        </div>
        @if(array_sum($serie) === 0)
            <p class="enc-vacio">No hay respuestas en {{ $textoPeriodo }}.</p>
        @else
            <div class="enc-grafico"><canvas id="enc-tendencia" role="img" aria-label="Respuestas por período"></canvas></div>
        @endif
    </div>

    @if($esTramites)
    {{-- ================= Trámites y servicios ================= --}}
    <section class="enc-seccion">
        <div class="enc-seccion-cab">
            <h2>Satisfacción de trámites y servicios</h2>
            <div class="enc-acciones">
                <a class="enc-boton" href="{{ route('encuesta.tramite') }}" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                    Ver formulario
                </a>
                <a class="enc-boton primario" href="{{ route('dashboard.encuestas.tramites') }}">Ver respuestas</a>
            </div>
        </div>

        <div class="enc-grid-2">
            @foreach([
                ['informacion', '¿La información fue clara y completa?', $divergente],
                ['beneficio', '¿Cuál es el grado de beneficio con el trámite?', null],
            ] as [$campo, $titulo, $colores])
                @include('encuestas.partials.escala', [
                    'titulo' => $titulo,
                    'datos' => $tr['preguntas'][$campo],
                    'colores' => $colores ? ($colores[count($tr['preguntas'][$campo])] ?? $ordinal) : $ordinal,
                ])
            @endforeach
        </div>

        <div class="enc-grid">
            @include('encuestas.partials.sino', ['titulo' => '¿Realizar el trámite fue fácil?', 'datos' => $tr['preguntas']['facilidad']])
            @include('encuestas.partials.categorias', ['titulo' => '¿Por cuál medio tuvo acceso?', 'datos' => $tr['preguntas']['medio']])
            @include('encuestas.partials.categorias', ['titulo' => '¿A qué grupo pertenece?', 'datos' => $tr['preguntas']['grupo']])
        </div>

        <div class="enc-grid-2">
            @include('encuestas.partials.categorias', ['titulo' => 'Trámites más evaluados', 'datos' => $tr['top']->all(), 'vacio' => 'Aún no hay trámites registrados en este período.'])

            <div class="enc-tarjeta">
                <div class="enc-tarjeta-cab">
                    <div>
                        <h3>Costos reportados por los ciudadanos</h3>
                        <p class="enc-nota">Últimos comentarios</p>
                    </div>
                </div>
                @forelse($tr['comentarios'] as $comentario)
                    @if($loop->first)<ul class="enc-comentarios">@endif
                        <li>
                            <p>{{ \Illuminate\Support\Str::limit($comentario->costos, 220) }}</p>
                            <small>{{ $comentario->tramite ?: 'Trámite sin especificar' }} · {{ optional($comentario->created_at)->translatedFormat('d M Y') }}</small>
                        </li>
                    @if($loop->last)</ul>@endif
                @empty
                    <p class="enc-vacio">No hay comentarios en este período.</p>
                @endforelse
            </div>
        </div>
    </section>
    @else
    {{-- ================= Evaluación del sitio web ================= --}}
    <section class="enc-seccion">
        <div class="enc-seccion-cab">
            <h2>Evaluación del sitio web</h2>
            <div class="enc-acciones">
                <a class="enc-boton" href="{{ route('encuesta.evaluacion') }}" target="_blank" rel="noopener">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                    Ver formulario
                </a>
                <a class="enc-boton primario" href="{{ route('dashboard.encuestas.evaluacion') }}">Ver respuestas</a>
            </div>
        </div>

        <div class="enc-grid-2">
            @foreach([
                ['satisfaccion', '¿Qué tan satisfecho está con el sitio web?'],
                ['actualizada', '¿Qué tan actualizada está la información?'],
                ['informacion', '¿Encontró la información que buscaba?'],
            ] as [$campo, $titulo])
                @include('encuestas.partials.escala', [
                    'titulo' => $titulo,
                    'datos' => $ev['preguntas'][$campo],
                    'colores' => $divergente[count($ev['preguntas'][$campo])] ?? $ordinal,
                ])
            @endforeach

            @include('encuestas.partials.sino', ['titulo' => '¿Fue fácil navegar el sitio?', 'datos' => $ev['preguntas']['facilidad']])
        </div>
    </section>
    @endif

    <div class="enc-tooltip" id="enc-tooltip" role="tooltip"></div>
</div>

<script type="application/json" id="enc-datos-tendencia">@json(['etiquetas' => $tendencia['etiquetas'], 'serie' => $serie])</script>

<script>
    (function () {
        // Tooltip para barras (elementos con data-tip)
        const tooltip = document.getElementById('enc-tooltip');
        document.querySelectorAll('.enc [data-tip]').forEach(el => {
            el.addEventListener('mousemove', e => {
                tooltip.innerHTML = el.dataset.tip;
                tooltip.style.opacity = 1;
                const x = Math.min(e.clientX + 14, window.innerWidth - tooltip.offsetWidth - 8);
                tooltip.style.left = x + 'px';
                tooltip.style.top = (e.clientY + 14) + 'px';
            });
            el.addEventListener('mouseleave', () => tooltip.style.opacity = 0);
        });

        // Gráfico de tendencia. Chart.js se carga una sola vez y funciona también con la navegación del panel (wire:navigate).
        const lienzo = document.getElementById('enc-tendencia');
        if (!lienzo) return;

        const cargarChart = () => window.Chart ? Promise.resolve() : (window.__encChart ??= new Promise((ok, error) => {
            const s = document.createElement('script');
            s.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js';
            s.onload = ok;
            s.onerror = error;
            document.head.appendChild(s);
        }));

        cargarChart().then(() => {
            const datos = JSON.parse(document.getElementById('enc-datos-tendencia').textContent);
            const css = getComputedStyle(document.querySelector('.enc'));
            const color = v => css.getPropertyValue(v).trim();

            Chart.getChart(lienzo)?.destroy();
            new Chart(lienzo, {
                type: 'line',
                data: {
                    labels: datos.etiquetas,
                    datasets: [
                        { label: 'Respuestas', data: datos.serie, borderColor: color('--serie-1'), backgroundColor: 'rgba(57,135,229,.12)', fill: true },
                    ].map(serie => ({ ...serie, borderWidth: 2, cubicInterpolationMode: 'monotone', pointRadius: 0, pointHoverRadius: 5, pointHoverBorderWidth: 2, pointHoverBorderColor: color('--surface') })),
                },
                options: {
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    scales: {
                        x: { grid: { display: false }, border: { color: color('--borde') }, ticks: { color: color('--texto-3'), maxRotation: 0, autoSkip: true, maxTicksLimit: 8 } },
                        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,.06)' }, border: { display: false }, ticks: { color: color('--texto-3'), precision: 0 } },
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: { backgroundColor: '#0b0b0b', borderColor: color('--borde'), borderWidth: 1, padding: 10, titleColor: '#f0efec', bodyColor: '#c3c2b7', usePointStyle: true },
                    },
                },
            });
        }).catch(() => {
            lienzo.closest('.enc-grafico').innerHTML = '<p class="enc-vacio">No se pudo cargar el gráfico. Verifique la conexión a internet.</p>';
        });
    })();
</script>
</x-layouts.app>
