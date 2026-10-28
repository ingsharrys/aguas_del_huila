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
@endphp

<style>
    .enc {
        color-scheme: dark;
        --surface: #1a1a19;
        --surface-2: #232322;
        --borde: #34342f;
        --texto: #f0efec;
        --texto-2: #c3c2b7;
        --texto-3: #8f8e86;
        --serie-1: #3987e5;
        --serie-2: #d95926;
        --pos-2: #3987e5;
        --pos-1: #1c5cab;
        --neutro: #4a4a46;
        --neg-1: #9b3a3a;
        --neg-2: #e66767;
        --seq-4: #3987e5;
        --seq-3: #256abf;
        --seq-2: #1c5cab;
        --seq-1: #184f95;
        --bueno: #0ca30c;
        --critico: #e66767;
        font-family: inherit;
        color: var(--texto);
        display: flex;
        flex-direction: column;
        gap: 24px;
        width: 100%;
    }
    .enc * { box-sizing: border-box; }
    .enc h1, .enc h2, .enc h3, .enc p { margin: 0; }

    /* Encabezado y filtros */
    .enc-cabecera { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px; }
    .enc-titulo { font-size: 26px; font-weight: 800; letter-spacing: -0.02em; }
    .enc-subtitulo { color: var(--texto-3); font-size: 14px; margin-top: 4px; }
    .enc-segmento { display: inline-flex; background: var(--surface); border: 1px solid var(--borde); border-radius: 10px; padding: 3px; gap: 2px; }
    .enc-segmento a { padding: 7px 14px; border-radius: 7px; font-size: 13px; font-weight: 600; color: var(--texto-2); text-decoration: none; white-space: nowrap; }
    .enc-segmento a:hover { color: var(--texto); background: var(--surface-2); }
    .enc-segmento a[aria-current="page"] { background: var(--texto); color: #111; }

    /* Tarjetas */
    .enc-grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
    .enc-grid-2 { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(min(100%, 420px), 1fr)); }
    .enc-tarjeta { background: var(--surface); border: 1px solid var(--borde); border-radius: 14px; padding: 20px; min-width: 0; }
    .enc-tarjeta-cab { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 16px; }
    .enc-tarjeta h3 { font-size: 15px; font-weight: 700; color: var(--texto); line-height: 1.35; }
    .enc-tarjeta .enc-nota { font-size: 12px; color: var(--texto-3); margin-top: 3px; }

    /* Indicadores */
    .enc-kpi-etiqueta { font-size: 13px; color: var(--texto-2); font-weight: 500; }
    .enc-kpi-valor { font-size: 34px; font-weight: 800; letter-spacing: -0.03em; margin-top: 8px; line-height: 1; font-variant-numeric: tabular-nums; }
    .enc-kpi-pie { display: flex; align-items: center; gap: 8px; margin-top: 12px; font-size: 12px; color: var(--texto-3); }
    .enc-delta { display: inline-flex; align-items: center; gap: 3px; font-weight: 700; padding: 2px 7px; border-radius: 999px; font-size: 12px; }
    .enc-delta.sube { color: var(--bueno); background: rgba(12, 163, 12, .12); }
    .enc-delta.baja { color: var(--critico); background: rgba(230, 103, 103, .12); }
    .enc-medidor { height: 6px; border-radius: 999px; background: var(--surface-2); margin-top: 14px; overflow: hidden; }
    .enc-medidor span { display: block; height: 100%; border-radius: 999px; background: var(--serie-1); }

    /* Secciones */
    .enc-seccion { display: flex; flex-direction: column; gap: 16px; }
    .enc-seccion-cab { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 12px; padding-top: 8px; }
    .enc-seccion-cab h2 { font-size: 19px; font-weight: 800; letter-spacing: -0.01em; }
    .enc-acciones { display: flex; flex-wrap: wrap; gap: 8px; }
    .enc-boton { display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 9px; font-size: 13px; font-weight: 600; text-decoration: none; border: 1px solid var(--borde); color: var(--texto); background: var(--surface); }
    .enc-boton:hover { background: var(--surface-2); }
    .enc-boton.primario { background: #2a78d6; border-color: #2a78d6; color: #fff; }
    .enc-boton.primario:hover { background: #256abf; }
    .enc-boton svg { width: 15px; height: 15px; }

    /* Barra apilada (escalas) */
    .enc-apilada { display: flex; gap: 2px; height: 28px; border-radius: 6px; overflow: hidden; }
    .enc-apilada > div { height: 100%; min-width: 3px; cursor: default; transition: opacity .15s; }
    .enc-apilada > div:first-child { border-radius: 4px 0 0 4px; }
    .enc-apilada > div:last-child { border-radius: 0 4px 4px 0; }
    .enc-apilada:hover > div { opacity: .55; }
    .enc-apilada:hover > div:hover { opacity: 1; }
    .enc-leyenda { list-style: none; padding: 0; margin: 14px 0 0; display: grid; gap: 7px; }
    .enc-leyenda li { display: grid; grid-template-columns: 10px 1fr auto auto; align-items: center; gap: 10px; font-size: 13px; color: var(--texto-2); }
    .enc-leyenda i { width: 10px; height: 10px; border-radius: 3px; display: block; }
    .enc-leyenda b { color: var(--texto); font-weight: 700; font-variant-numeric: tabular-nums; text-align: right; }
    .enc-leyenda small { color: var(--texto-3); font-size: 12px; min-width: 34px; text-align: right; font-variant-numeric: tabular-nums; }

    /* Barras horizontales (categorías) */
    .enc-barras { display: grid; gap: 12px; }
    .enc-barra-fila { display: grid; gap: 6px; }
    .enc-barra-texto { display: flex; justify-content: space-between; gap: 8px; font-size: 13px; color: var(--texto-2); }
    .enc-barra-texto b { color: var(--texto); font-variant-numeric: tabular-nums; }
    .enc-barra-pista { height: 8px; background: var(--surface-2); border-radius: 4px; overflow: hidden; }
    .enc-barra-pista span { display: block; height: 100%; background: var(--serie-1); border-radius: 0 4px 4px 0; }

    /* Indicador Sí/No */
    .enc-sino { display: flex; align-items: center; gap: 18px; }
    .enc-anillo { --p: 0; width: 84px; height: 84px; border-radius: 50%; flex-shrink: 0; background: conic-gradient(var(--pos-2) calc(var(--p) * 1%), var(--surface-2) 0); display: grid; place-items: center; }
    .enc-anillo span { width: 64px; height: 64px; border-radius: 50%; background: var(--surface); display: grid; place-items: center; font-size: 18px; font-weight: 800; font-variant-numeric: tabular-nums; }

    /* Comentarios */
    .enc-comentarios { list-style: none; margin: 0; padding: 0; display: grid; gap: 12px; }
    .enc-comentarios li { padding: 12px 14px; border-radius: 10px; background: var(--surface-2); }
    .enc-comentarios p { font-size: 13px; color: var(--texto); line-height: 1.5; }
    .enc-comentarios small { display: block; font-size: 11px; color: var(--texto-3); margin-top: 6px; }

    .enc-vacio { color: var(--texto-3); font-size: 13px; padding: 18px 0; text-align: center; }
    .enc-grafico { position: relative; height: 260px; }

    /* Tooltip */
    .enc-tooltip { position: fixed; z-index: 60; pointer-events: none; background: #0b0b0b; color: #f0efec; border: 1px solid var(--borde); border-radius: 8px; padding: 8px 10px; font-size: 12px; line-height: 1.4; box-shadow: 0 8px 24px rgba(0, 0, 0, .4); opacity: 0; transition: opacity .1s; max-width: 240px; }
    .enc-tooltip b { display: block; font-size: 13px; }
</style>

<div class="enc">

    {{-- Encabezado --}}
    <div class="enc-cabecera">
        <div>
            <h1 class="enc-titulo">Encuestas</h1>
            <p class="enc-subtitulo">Satisfacción con trámites y servicios y evaluación del sitio web · {{ $textoPeriodo }}</p>
        </div>
        <nav class="enc-segmento" aria-label="Período">
            @foreach($periodos as $valor => $etiqueta)
                <a href="{{ route('dashboard.encuestas', ['periodo' => $valor]) }}" @if($periodo === (string) $valor) aria-current="page" @endif>{{ $etiqueta }}</a>
            @endforeach
        </nav>
    </div>

    {{-- Indicadores principales --}}
    <div class="enc-grid">
        @foreach([
            ['Respuestas · Trámites', $tr['total'], $tr['variacion'], "{$tr['historico']} en total"],
            ['Respuestas · Evaluación web', $ev['total'], $ev['variacion'], "{$ev['historico']} en total"],
        ] as [$etiqueta, $valor, $variacion, $pie])
            <div class="enc-tarjeta">
                <p class="enc-kpi-etiqueta">{{ $etiqueta }}</p>
                <p class="enc-kpi-valor">{{ number_format($valor, 0, ',', '.') }}</p>
                <div class="enc-kpi-pie">
                    @if(!is_null($variacion))
                        <span class="enc-delta {{ $variacion >= 0 ? 'sube' : 'baja' }}" title="Comparado con el período anterior">
                            {{ $variacion >= 0 ? '▲' : '▼' }} {{ abs($variacion) }}%
                        </span>
                        <span>vs. período anterior</span>
                    @else
                        <span>{{ $pie }}</span>
                    @endif
                </div>
            </div>
        @endforeach

        @foreach([
            ['Calidad de la información', $tr['kpis']['informacion'], 'Excelente o buena · Trámites'],
            ['Satisfacción con el sitio', $ev['kpis']['satisfaccion'], 'Satisfecho o muy satisfecho · Web'],
        ] as [$etiqueta, $valor, $nota])
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
                <p class="enc-nota">{{ count($tendencia['etiquetas']) > 0 && ($periodo === 'todo' || (int) $periodo > 90) ? 'Por mes' : 'Por semana' }}</p>
            </div>
        </div>
        @if(array_sum($tendencia['tramites']) + array_sum($tendencia['evaluacion']) === 0)
            <p class="enc-vacio">No hay respuestas en {{ $textoPeriodo }}.</p>
        @else
            <div class="enc-grafico"><canvas id="enc-tendencia" role="img" aria-label="Respuestas por período de las encuestas de trámites y de evaluación web"></canvas></div>
        @endif
    </div>

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

    <div class="enc-tooltip" id="enc-tooltip" role="tooltip"></div>
</div>

<script type="application/json" id="enc-datos-tendencia">@json($tendencia)</script>

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
                        { label: 'Trámites y servicios', data: datos.tramites, borderColor: color('--serie-1'), backgroundColor: color('--serie-1') },
                        { label: 'Evaluación web', data: datos.evaluacion, borderColor: color('--serie-2'), backgroundColor: color('--serie-2') },
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
                        legend: { position: 'top', align: 'end', labels: { color: color('--texto-2'), usePointStyle: true, pointStyle: 'line', boxWidth: 18, padding: 16 } },
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
