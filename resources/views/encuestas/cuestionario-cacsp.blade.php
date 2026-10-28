<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Cuestionario de Evaluación de Atención al Cliente Servicios Públicos</title>
        <style>
            /* Estilos propios del cuestionario (no dependen de las clases compiladas del sitio) */
            .cx {
                --azul: #0047DC; --azul-600: #0039b0; --azul-50: #eef3ff; --azul-100: #dbe5ff;
                --verde: #00a61b; --tinta: #0f172a; --tinta-2: #475569; --tinta-3: #94a3b8;
                --borde: #e2e8f0; --borde-2: #cbd5e1; --fondo: #f6f8fc; --blanco: #fff; --error: #dc2626;
                --e5: #1d5fd1; --e4: #5b8fe6; --e3: #94a3b8; --e2: #f08c6c; --e1: #d9363e; --e9: #cbd5e1;
                font-family: inherit; color: var(--tinta); background: var(--fondo); padding: 40px 16px 64px;
            }
            .cx *, .cx *::before, .cx *::after { box-sizing: border-box; }
            .cx-principal, .cx-pregunta, .cx-fila { scroll-margin-top: calc(var(--cx-tope, 132px) + 80px); }
            .cx h1, .cx h2, .cx h3, .cx p { margin: 0; }
            .cx-oculto { position: absolute !important; opacity: 0; width: 1px; height: 1px; pointer-events: none; }
            .cx-sr { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap; }

            .cx-shell { max-width: 1180px; margin: 0 auto; display: grid; grid-template-columns: 280px minmax(0, 1fr); gap: 32px; align-items: start; }
            @media (max-width: 1000px) { .cx-shell { grid-template-columns: 1fr; } .cx-indice { display: none; } }

            /* Índice lateral */
            .cx-indice { position: sticky; top: var(--cx-tope, 132px); background: var(--blanco); border: 1px solid var(--borde); border-radius: 18px; padding: 22px; box-shadow: 0 1px 2px rgba(15,23,42,.04); }
            .cx-indice-titulo { font-size: 12px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--tinta-3); margin-bottom: 14px; }
            .cx-indice ol { list-style: none; margin: 0; padding: 0; display: grid; gap: 2px; }
            .cx-indice button { all: unset; box-sizing: border-box; width: 100%; display: flex; align-items: center; gap: 12px; padding: 9px 10px; border-radius: 10px; font-size: 14px; color: var(--tinta-2); cursor: pointer; }
            .cx-indice button:disabled { cursor: default; opacity: .55; }
            .cx-indice button:not(:disabled):hover { background: var(--fondo); }
            .cx-indice button:focus-visible { outline: 2px solid var(--azul); outline-offset: 2px; }
            .cx-indice .cx-num { flex-shrink: 0; width: 26px; height: 26px; border-radius: 50%; display: grid; place-items: center; font-size: 12px; font-weight: 700; border: 1.5px solid var(--borde-2); color: var(--tinta-3); background: var(--blanco); }
            .cx-indice li[data-estado="actual"] button { background: var(--azul-50); color: var(--azul); font-weight: 600; }
            .cx-indice li[data-estado="actual"] .cx-num { background: var(--azul); border-color: var(--azul); color: #fff; }
            .cx-indice li[data-estado="hecho"] .cx-num { background: #e7f8ea; border-color: #b6e8be; color: var(--verde); }
            .cx-indice-ayuda { margin-top: 18px; padding-top: 16px; border-top: 1px solid var(--borde); font-size: 12px; color: var(--tinta-3); line-height: 1.5; }

            /* Columna principal */
            .cx-principal { display: grid; gap: 20px; min-width: 0; }
            .cx-tarjeta { background: var(--blanco); border: 1px solid var(--borde); border-radius: 18px; box-shadow: 0 1px 2px rgba(15,23,42,.04); }
            .cx-encabezado { padding: 28px 32px; }
            .cx-etiqueta { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: var(--azul); background: var(--azul-50); padding: 5px 10px; border-radius: 999px; }
            .cx-encabezado h1 { font-size: clamp(22px, 3vw, 28px); font-weight: 800; letter-spacing: -.02em; margin-top: 14px; line-height: 1.2; }
            .cx-encabezado p { color: var(--tinta-2); font-size: 15px; line-height: 1.6; margin-top: 10px; max-width: 720px; }
            .cx-datos { display: flex; flex-wrap: wrap; gap: 18px; margin-top: 18px; font-size: 13px; color: var(--tinta-2); }
            .cx-datos span { display: inline-flex; align-items: center; gap: 6px; }
            .cx-datos svg { width: 16px; height: 16px; color: var(--azul); }

            /* Progreso */
            .cx-progreso { position: sticky; top: var(--cx-tope, 132px); z-index: 5; padding: 16px 24px; display: flex; align-items: center; gap: 18px; }
            .cx-progreso-texto { font-size: 13px; color: var(--tinta-2); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 60%; }
            .cx-progreso-texto b { color: var(--tinta); }
            .cx-barra { flex: 1; height: 8px; background: var(--fondo); border-radius: 999px; overflow: hidden; min-width: 80px; }
            .cx-barra span { display: block; height: 100%; width: 0; background: linear-gradient(90deg, var(--azul), #3b82f6); border-radius: 999px; transition: width .35s ease; }

            /* Pasos */
            .cx-paso { padding: 32px; }
            .cx-paso[hidden] { display: none !important; }
            .cx-paso-cab { margin-bottom: 26px; padding-bottom: 20px; border-bottom: 1px solid var(--borde); }
            .cx-paso-cab small { font-size: 12px; font-weight: 700; color: var(--azul); letter-spacing: .05em; text-transform: uppercase; }
            .cx-paso-cab h2 { font-size: 22px; font-weight: 800; letter-spacing: -.01em; margin-top: 6px; }
            .cx-paso-cab p { font-size: 14px; color: var(--tinta-2); line-height: 1.6; margin-top: 8px; }
            .cx-preguntas { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 26px 22px; }
            @media (max-width: 720px) { .cx-preguntas { grid-template-columns: 1fr; } .cx-paso { padding: 22px 18px; } .cx-encabezado { padding: 22px 18px; } }
            .cx-ancho { grid-column: 1 / -1; }

            /* Pregunta */
            .cx-pregunta-titulo { display: block; font-size: 15px; font-weight: 600; line-height: 1.45; color: var(--tinta); margin-bottom: 10px; }
            .cx-obligatoria { color: var(--error); margin-left: 2px; }
            .cx-ayuda { font-size: 13px; color: var(--tinta-3); margin: -4px 0 10px; }
            .cx-input { width: 100%; height: 48px; padding: 0 14px; border: 1.5px solid var(--borde-2); border-radius: 12px; font-size: 15px; color: var(--tinta); background: var(--blanco); transition: border-color .15s, box-shadow .15s; }
            textarea.cx-input { height: auto; min-height: 96px; padding: 12px 14px; resize: vertical; line-height: 1.5; }
            .cx-input:focus { outline: none; border-color: var(--azul); box-shadow: 0 0 0 4px var(--azul-100); }
            .cx-input:disabled { background: var(--fondo); color: var(--tinta-3); }
            .cx-pregunta.con-error .cx-input { border-color: var(--error); }
            .cx-error { display: block; font-size: 13px; color: var(--error); font-weight: 500; margin-top: 8px; }
            .cx-error:empty { display: none; }

            /* Opciones tipo chip */
            .cx-opciones { display: flex; flex-wrap: wrap; gap: 10px; }
            .cx-chip { position: relative; display: inline-flex; align-items: center; gap: 10px; min-height: 46px; padding: 10px 16px; border: 1.5px solid var(--borde-2); border-radius: 12px; background: var(--blanco); font-size: 14px; font-weight: 500; color: var(--tinta-2); cursor: pointer; transition: all .15s; user-select: none; }
            .cx-chip:hover { border-color: #93b4f5; background: #fafcff; }
            .cx-chip::before { content: ""; width: 18px; height: 18px; border-radius: 50%; border: 2px solid var(--borde-2); flex-shrink: 0; background: var(--blanco); transition: all .15s; }
            .cx-chip.multiple::before { border-radius: 5px; }
            .cx-chip:has(input:checked) { border-color: var(--azul); background: var(--azul-50); color: var(--azul); font-weight: 600; }
            .cx-chip:has(input:checked)::before { border-color: var(--azul); background: var(--azul); box-shadow: inset 0 0 0 3px #fff; }
            .cx-chip.multiple:has(input:checked)::before { box-shadow: none; background: var(--azul) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6 9 17l-5-5'/%3E%3C/svg%3E") center / 12px no-repeat; }
            .cx-chip:has(input:focus-visible) { box-shadow: 0 0 0 4px var(--azul-100); }
            .cx-chip:has(input:disabled) { opacity: .5; cursor: not-allowed; }

            /* Escala de calificación (pregunta única) */
            .cx-escala { display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); gap: 8px; }
            @media (max-width: 720px) { .cx-escala { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
            .cx-nivel { position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; min-height: 76px; padding: 12px 6px; border: 1.5px solid var(--borde-2); border-radius: 14px; background: var(--blanco); cursor: pointer; font-size: 13px; font-weight: 600; color: var(--tinta-2); text-align: center; transition: all .15s; }
            .cx-nivel i { width: 14px; height: 14px; border-radius: 50%; background: var(--c); opacity: .9; }
            .cx-nivel:hover { border-color: var(--c); }
            .cx-nivel:has(input:checked) { border-color: var(--c); background: color-mix(in srgb, var(--c) 10%, white); color: var(--tinta); box-shadow: inset 0 0 0 1px var(--c); }
            .cx-nivel:has(input:checked) i { box-shadow: 0 0 0 4px color-mix(in srgb, var(--c) 25%, white); }
            .cx-nivel:has(input:focus-visible) { box-shadow: 0 0 0 4px var(--azul-100); }

            /* Matriz (tabla de calificación) */
            .cx-matriz { border: 1.5px solid var(--borde); border-radius: 14px; overflow: hidden; }
            .cx-matriz-cab, .cx-fila { display: grid; grid-template-columns: minmax(220px, 1fr) repeat(var(--n), minmax(64px, 84px)); align-items: center; }
            .cx-matriz-cab { background: var(--fondo); border-bottom: 1px solid var(--borde); }
            .cx-matriz-cab span { padding: 12px 6px; font-size: 12px; font-weight: 700; color: var(--tinta-2); text-align: center; line-height: 1.25; }
            .cx-matriz-cab span:first-child { text-align: left; padding-left: 18px; color: var(--tinta-3); text-transform: uppercase; letter-spacing: .04em; font-size: 11px; }
            .cx-fila { border-top: 1px solid var(--borde); transition: background .15s; }
            .cx-fila:first-of-type { border-top: 0; }
            .cx-fila:hover { background: #fafcff; }
            .cx-fila[hidden] { display: none; }
            .cx-fila-texto { padding: 14px 18px; font-size: 14px; line-height: 1.45; color: var(--tinta); }
            .cx-fila .cx-error { grid-column: 1 / -1; padding: 0 18px 12px; margin: 0; }
            .cx-fila.con-error { background: #fef2f2; }
            .cx-celda { position: relative; display: grid; place-items: center; height: 100%; min-height: 54px; cursor: pointer; }
            .cx-celda-marca { width: 22px; height: 22px; border-radius: 50%; border: 2px solid var(--borde-2); background: var(--blanco); transition: all .15s; }
            .cx-celda:hover .cx-celda-marca { border-color: var(--c, var(--azul)); }
            .cx-celda:has(input:checked) .cx-celda-marca { border-color: var(--c, var(--azul)); background: var(--c, var(--azul)); box-shadow: inset 0 0 0 4px #fff; }
            .cx-celda:has(input:focus-visible) .cx-celda-marca { box-shadow: 0 0 0 4px var(--azul-100); }
            .cx-celda-texto { display: none; }
            @media (max-width: 760px) {
                .cx-matriz-cab { display: none; }
                .cx-fila { display: block; padding: 14px 14px 16px; }
                .cx-fila-texto { padding: 0 0 10px; font-weight: 600; display: block; }
                .cx-fila-opciones { display: flex; flex-wrap: wrap; gap: 8px; }
                .cx-celda { display: inline-flex; gap: 8px; min-height: 40px; padding: 8px 12px; border: 1.5px solid var(--borde-2); border-radius: 10px; }
                .cx-celda:has(input:checked) { border-color: var(--c, var(--azul)); background: color-mix(in srgb, var(--c, var(--azul)) 9%, white); }
                .cx-celda-marca { width: 16px; height: 16px; }
                .cx-celda-texto { display: inline; font-size: 13px; font-weight: 500; color: var(--tinta-2); }
                .cx-fila .cx-error { padding: 8px 0 0; }
            }
            @media (min-width: 761px) { .cx-fila-opciones { display: contents; } }

            /* Duración */
            .cx-duracion { display: grid; grid-template-columns: 140px 200px; gap: 10px; }
            @media (max-width: 480px) { .cx-duracion { grid-template-columns: 1fr 1fr; } }

            .cx-alternativa { display: inline-flex; align-items: center; gap: 10px; margin-top: 12px; font-size: 14px; color: var(--tinta-2); cursor: pointer; }
            .cx-alternativa input { width: 18px; height: 18px; accent-color: var(--azul); }

            /* Navegación */
            .cx-navegacion { display: flex; justify-content: space-between; align-items: center; gap: 12px; padding: 18px 24px; border-top: 1px solid var(--borde); }
            .cx-boton { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 48px; padding: 0 22px; border-radius: 12px; font-size: 15px; font-weight: 700; border: 1.5px solid transparent; cursor: pointer; transition: all .15s; text-decoration: none; }
            .cx-boton svg { width: 18px; height: 18px; }
            .cx-boton.primario { background: var(--azul); color: #fff; }
            .cx-boton.primario:hover { background: var(--azul-600); }
            .cx-boton.secundario { background: var(--blanco); color: var(--tinta); border-color: var(--borde-2); }
            .cx-boton.secundario:hover { border-color: var(--tinta-3); }
            .cx-boton.enviar { background: var(--verde); color: #fff; }
            .cx-boton.enviar:hover { background: #008c17; }
            .cx-boton:disabled { opacity: .6; cursor: wait; }
            .cx-boton:focus-visible { outline: none; box-shadow: 0 0 0 4px var(--azul-100); }
            .cx-boton[hidden] { display: none; }

            /* Avisos */
            .cx-aviso { display: flex; gap: 12px; padding: 16px 18px; border-radius: 14px; font-size: 14px; line-height: 1.5; }
            .cx-aviso svg { width: 20px; height: 20px; flex-shrink: 0; margin-top: 1px; }
            .cx-aviso.info { background: var(--azul-50); color: #1e3a8a; border: 1px solid var(--azul-100); margin-bottom: 18px; }
            .cx-aviso.error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
            .cx-aviso[hidden] { display: none; }

            .cx-resumen { margin: 0 0 22px; padding: 0; display: grid; gap: 8px; }
            .cx-resumen li { display: flex; justify-content: space-between; gap: 12px; padding: 12px 14px; border: 1px solid var(--borde); border-radius: 12px; font-size: 14px; color: var(--tinta-2); list-style: none; }
            .cx-resumen li b { color: var(--verde); font-weight: 600; white-space: nowrap; }
            .cx-autoriza { display: flex; gap: 12px; padding: 18px; border-radius: 14px; background: var(--fondo); border: 1.5px solid var(--borde); font-size: 14px; line-height: 1.55; color: var(--tinta-2); cursor: pointer; }
            .cx-autoriza input { width: 20px; height: 20px; margin-top: 2px; flex-shrink: 0; accent-color: var(--azul); }
            .cx-autoriza:has(input:checked) { border-color: var(--azul); background: var(--azul-50); }

            /* Confirmación */
            .cx-exito { text-align: center; padding: 56px 32px; }
            .cx-exito-icono { width: 72px; height: 72px; margin: 0 auto 20px; border-radius: 50%; background: #e7f8ea; color: var(--verde); display: grid; place-items: center; }
            .cx-exito-icono svg { width: 36px; height: 36px; }
            .cx-exito h2 { font-size: 26px; font-weight: 800; }
            .cx-exito p { color: var(--tinta-2); font-size: 15px; line-height: 1.6; max-width: 520px; margin: 12px auto 26px; }
        </style>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Cuestionario de Atención al Cliente</h2>
                <p class="text-lg flex flex-wrap justify-center gap-2">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a>
                    <span>/</span>
                    <a href="{{ url('/transparencia-y-acceso-a-la-informacion-publica') }}" class="hover:text-[#00C81F]">Transparencia y Acceso a la Información Pública</a>
                    <span>/</span>
                    <span class="font-bold">Cuestionario de Atención al Cliente</span>
                </p>
            </div>
        </div>

        @php
            $colorNivel = ['5' => 'var(--e5)', '4' => 'var(--e4)', '3' => 'var(--e3)', '2' => 'var(--e2)', '1' => 'var(--e1)', '9' => 'var(--e9)'];
            // Agrupar las preguntas en secciones: cada sección es un paso del asistente
            $secciones = [];
            foreach ($preguntas as $key => $pregunta) {
                if (isset($pregunta['seccion']) || !$secciones) {
                    $secciones[] = ['titulo' => $pregunta['seccion'] ?? 'Cuestionario', 'introduccion' => $pregunta['introduccion'] ?? null, 'preguntas' => []];
                }
                $secciones[array_key_last($secciones)]['preguntas'][$key] = $pregunta;
            }
        @endphp

        <section class="cx">
            <div class="cx-shell" @if(session('success')) style="grid-template-columns: minmax(0, 820px); justify-content: center" @endif>

                {{-- Índice de secciones --}}
                @unless(session('success'))
                    <aside class="cx-indice" aria-label="Secciones del cuestionario">
                        <p class="cx-indice-titulo">Secciones</p>
                        <ol id="cx-indice"></ol>
                        <p class="cx-indice-ayuda">Las secciones que no aplican según sus respuestas se omiten automáticamente.</p>
                    </aside>
                @endunless

                <div class="cx-principal">
                    <div class="cx-tarjeta cx-encabezado">
                        <span class="cx-etiqueta">Aguas del Huila S.A. E.S.P.</span>
                        <h1>Evaluación de Atención al Cliente de Servicios Públicos</h1>
                        <p>Estamos realizando un estudio sobre la prestación de los servicios de acueducto, alcantarillado y aseo en el municipio. Sus respuestas nos ayudarán a mejorar los servicios que recibe.</p>
                        <div class="cx-datos">
                            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> 10 a 15 minutos</span>
                            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg> Datos protegidos (Ley 1581 de 2012)</span>
                            <span><span class="cx-obligatoria">*</span> Respuesta obligatoria</span>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="cx-tarjeta cx-exito" role="status">
                            <div class="cx-exito-icono"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></div>
                            <h2>¡Cuestionario enviado!</h2>
                            <p>{{ session('success') }}</p>
                            <a href="{{ route('cuestionario.cacsp') }}" class="cx-boton primario">Registrar otro cuestionario</a>
                        </div>
                    @else
                        <div class="cx-tarjeta cx-progreso" aria-live="polite">
                            <span class="cx-progreso-texto" id="cx-progreso-texto">Paso <b>1</b> de {{ count($secciones) + 1 }}</span>
                            <div class="cx-barra" aria-hidden="true"><span id="cx-barra"></span></div>
                        </div>

                        @if(session('error'))
                            <div class="cx-aviso error" role="alert">{{ session('error') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="cx-aviso error" role="alert">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>
                                <span>Hay {{ $errors->count() }} {{ $errors->count() === 1 ? 'respuesta por revisar' : 'respuestas por revisar' }}. Lo llevamos a la primera.</span>
                            </div>
                        @endif

                        <form action="{{ route('cuestionario.cacsp.store') }}" method="POST" id="cacsp-form" class="cx-tarjeta" novalidate>
                            @csrf

                            @foreach($secciones as $indice => $seccion)
                                <section class="cx-paso seccion-cacsp" data-titulo="{{ $seccion['titulo'] }}" @if($indice > 0) hidden @endif>
                                    <header class="cx-paso-cab">
                                        <small class="cx-paso-numero">Sección {{ $indice + 1 }}</small>
                                        <h2>{{ $seccion['titulo'] }}</h2>
                                        @if($seccion['introduccion'])<p>{{ $seccion['introduccion'] }}</p>@endif
                                    </header>

                                    <div class="cx-preguntas">
                                        @foreach($seccion['preguntas'] as $key => $pregunta)
                                            @php
                                                $oldValue = old("respuestas.$key", $errors->any() ? null : ($pregunta['predeterminado'] ?? null));
                                                $tipo = $pregunta['tipo'];
                                                $opciones = is_array($pregunta['opciones'] ?? null) ? $pregunta['opciones'] : [];
                                                $obligatoria = !empty($pregunta['obligatoria']);
                                                $alternativa = $pregunta['alternativa'] ?? null;
                                                $esEscala = !empty($pregunta['escala']) && $tipo === 'radio';
                                                $ancho = in_array($tipo, ['radio', 'checkbox', 'textarea', 'matriz', 'duracion']) || mb_strlen($pregunta['titulo']) > 60;
                                                $errorPropio = $errors->first("respuestas.$key") ?: $errors->first("respuestas.$key.cantidad") ?: $errors->first("respuestas.$key.unidad");
                                            @endphp

                                            <div class="cx-pregunta pregunta-container {{ $ancho ? 'cx-ancho' : '' }} {{ $errorPropio ? 'con-error' : '' }}" data-key="{{ $key }}">
                                                <label class="cx-pregunta-titulo" id="titulo-{{ $key }}" @if(in_array($tipo, ['text', 'number', 'tel', 'cedula', 'date', 'textarea', 'select'])) for="campo-{{ $key }}" @endif>
                                                    {{ $pregunta['titulo'] }}@if($obligatoria)<span class="cx-obligatoria" aria-hidden="true">*</span>@endif
                                                </label>
                                                @isset($pregunta['ayuda'])<p class="cx-ayuda">{{ $pregunta['ayuda'] }}</p>@endisset

                                                @if(in_array($tipo, ['text', 'number', 'tel', 'cedula', 'date']))
                                                    <input type="{{ $tipo === 'cedula' ? 'text' : $tipo }}" id="campo-{{ $key }}" name="respuestas[{{ $key }}]" class="cx-input"
                                                           value="{{ $oldValue ?? ($tipo === 'date' ? now()->toDateString() : '') }}"
                                                           @if($obligatoria) required @endif
                                                           @if($tipo === 'number') inputmode="numeric" @endif
                                                           @if($tipo === 'tel') inputmode="tel" pattern="[0-9+\s()\-]{7,20}" autocomplete="tel" @endif
                                                           @if($tipo === 'cedula') inputmode="numeric" pattern="[0-9]{5,12}" maxlength="12" placeholder="Sin puntos ni espacios" title="Entre 5 y 12 dígitos, sin puntos ni espacios" @endif
                                                           @if($key === 'P1_nombre') autocomplete="name" @endif
                                                           @if($tipo === 'date') max="{{ now()->toDateString() }}" @endif
                                                           @isset($pregunta['atributos']['min']) min="{{ $pregunta['atributos']['min'] }}" @endisset
                                                           @isset($pregunta['atributos']['max']) max="{{ $pregunta['atributos']['max'] }}" @endisset
                                                           @if(!in_array($tipo, ['date', 'cedula'])) maxlength="255" @endif>

                                                @elseif($tipo === 'textarea')
                                                    <textarea id="campo-{{ $key }}" name="respuestas[{{ $key }}]" rows="3" maxlength="2000" class="cx-input" @if($obligatoria) required @endif>{{ $oldValue }}</textarea>

                                                @elseif($tipo === 'select')
                                                    <select id="campo-{{ $key }}" name="respuestas[{{ $key }}]" class="cx-input" @if($obligatoria) required @endif>
                                                        <option value="">Seleccione...</option>
                                                        @foreach($opciones as $val => $label)
                                                            <option value="{{ $val }}" @selected((string) $oldValue === (string) $val)>{{ $label }}</option>
                                                        @endforeach
                                                    </select>

                                                @elseif($esEscala)
                                                    <div class="cx-escala" role="radiogroup" aria-labelledby="titulo-{{ $key }}">
                                                        @foreach($opciones as $val => $label)
                                                            <label class="cx-nivel" style="--c: {{ $colorNivel[$val] ?? 'var(--azul)' }}">
                                                                <input class="cx-oculto" type="radio" name="respuestas[{{ $key }}]" value="{{ $val }}" @checked((string) $oldValue === (string) $val) @if($obligatoria) required @endif>
                                                                <i aria-hidden="true"></i>{{ $label }}
                                                            </label>
                                                        @endforeach
                                                    </div>

                                                @elseif($tipo === 'radio')
                                                    <div class="cx-opciones" role="radiogroup" aria-labelledby="titulo-{{ $key }}">
                                                        @foreach($opciones as $val => $label)
                                                            <label class="cx-chip">
                                                                <input class="cx-oculto" type="radio" name="respuestas[{{ $key }}]" value="{{ $val }}" @checked((string) $oldValue === (string) $val) @if($obligatoria) required @endif>
                                                                {{ $label }}
                                                            </label>
                                                        @endforeach
                                                    </div>

                                                @elseif($tipo === 'checkbox')
                                                    <div class="cx-opciones" data-grupo-checkbox @if($obligatoria) data-obligatorio="1" @endif role="group" aria-labelledby="titulo-{{ $key }}">
                                                        @foreach($opciones as $val => $label)
                                                            <label class="cx-chip multiple">
                                                                <input class="cx-oculto" type="checkbox" name="respuestas[{{ $key }}][]" value="{{ $val }}" @checked(is_array($oldValue) && in_array((string) $val, array_map('strval', $oldValue), true))>
                                                                {{ $label }}
                                                            </label>
                                                        @endforeach
                                                    </div>

                                                @elseif($tipo === 'matriz')
                                                    <div class="cx-matriz" style="--n: {{ count($opciones) }}" role="group" aria-labelledby="titulo-{{ $key }}">
                                                        <div class="cx-matriz-cab" aria-hidden="true">
                                                            <span>Aspecto</span>
                                                            @foreach($opciones as $label)<span>{{ $label }}</span>@endforeach
                                                        </div>
                                                        @foreach($pregunta['filas'] as $fila => $definicion)
                                                            @php $errorFila = $errors->first("respuestas.$key.$fila"); @endphp
                                                            <div class="cx-fila fila-matriz {{ $errorFila ? 'con-error' : '' }}" data-fila="{{ $fila }}" role="radiogroup" aria-label="{{ $definicion['texto'] }}">
                                                                <span class="cx-fila-texto">{{ $definicion['texto'] }}</span>
                                                                <div class="cx-fila-opciones">
                                                                    @foreach($opciones as $val => $label)
                                                                        <label class="cx-celda" @if(!empty($pregunta['escala']) || $key === 'P38') style="--c: {{ $colorNivel[$val] ?? 'var(--azul)' }}" @endif>
                                                                            <input class="cx-oculto" type="radio" name="respuestas[{{ $key }}][{{ $fila }}]" value="{{ $val }}"
                                                                                   @checked((string) ($oldValue[$fila] ?? '') === (string) $val) @if($obligatoria) required @endif>
                                                                            <span class="cx-celda-marca" aria-hidden="true"></span>
                                                                            <span class="cx-celda-texto" aria-hidden="true">{{ $label }}</span>
                                                                            <span class="cx-sr">{{ $label }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                </div>
                                                                <span class="cx-error error-pregunta" role="alert">{{ $errorFila }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                @elseif($tipo === 'duracion')
                                                    <div class="cx-duracion">
                                                        <input type="number" name="respuestas[{{ $key }}][cantidad]" min="0" max="100000" inputmode="numeric" placeholder="Cantidad" aria-label="Cantidad"
                                                               value="{{ $oldValue['cantidad'] ?? '' }}" class="cx-input" @if($obligatoria) required @endif>
                                                        <select name="respuestas[{{ $key }}][unidad]" class="cx-input" aria-label="Unidad de tiempo" @if($obligatoria) required @endif>
                                                            <option value="">Unidad…</option>
                                                            @foreach(\App\Support\CuestionarioCacsp::UNIDADES_TIEMPO as $val => $label)
                                                                <option value="{{ $val }}" @selected(($oldValue['unidad'] ?? '') === $val)>{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif

                                                @if($alternativa)
                                                    <label class="cx-alternativa">
                                                        <input type="checkbox" name="alternativas[{{ $key }}]" value="1" class="alternativa" @checked(old("alternativas.$key"))>
                                                        {{ $alternativa['etiqueta'] }}
                                                    </label>
                                                @endif

                                                <span class="cx-error error-pregunta" role="alert">{{ $tipo === 'matriz' ? '' : $errorPropio }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @endforeach

                            {{-- Último paso: revisión y envío --}}
                            <section class="cx-paso cx-final" data-titulo="Revisión y envío" hidden>
                                <header class="cx-paso-cab">
                                    <small class="cx-paso-numero">Último paso</small>
                                    <h2>Revisión y envío</h2>
                                    <p>Revise el resumen. Puede volver a cualquier sección desde el índice o con el botón «Anterior».</p>
                                </header>

                                <div class="cx-aviso info" id="mensaje-fin" hidden>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                                    <span>Como el hogar no cuenta con servicio de acueducto, la encuesta termina después de la cobertura de servicios (según el cuestionario).</span>
                                </div>

                                <ul class="cx-resumen" id="cx-resumen"></ul>

                                <label class="cx-autoriza">
                                    <input type="checkbox" name="autoriza" value="1" required @checked(old('autoriza'))>
                                    <span>Autorizo a Aguas del Huila S.A. E.S.P. el tratamiento de mis datos personales para fines de evaluación del servicio, de conformidad con la Ley 1581 de 2012. <span class="cx-obligatoria">*</span></span>
                                </label>
                                <span class="cx-error" id="error-autoriza">@error('autoriza'){{ $message }}@enderror</span>
                            </section>

                            <div class="cx-navegacion">
                                <button type="button" class="cx-boton secundario" id="cx-anterior">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                    Anterior
                                </button>
                                <button type="button" class="cx-boton primario" id="cx-siguiente">
                                    Siguiente
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                </button>
                                <button type="submit" class="cx-boton enviar" id="cacsp-enviar" hidden>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                    <span>Enviar cuestionario</span>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </section>

        @include('partials.footer')

        @unless(session('success'))
        <script type="application/json" id="cacsp-reglas">@json($reglasJs)</script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('cacsp-form');
                const reglas = JSON.parse(document.getElementById('cacsp-reglas').textContent);
                const contenedor = clave => form.querySelector(`.pregunta-container[data-key="${clave}"]`);
                const todosLosPasos = [...form.querySelectorAll('.cx-paso')];

                // La barra de navegación del sitio es fija: los elementos "pegajosos" van debajo de ella
                const ajustarTope = () => {
                    const barra = document.getElementById('mainNavbarFijo');
                    const alto = barra && getComputedStyle(barra).position === 'fixed' ? barra.getBoundingClientRect().bottom : 0;
                    document.querySelector('.cx').style.setProperty('--cx-tope', `${Math.max(0, alto) + 12}px`);
                };
                ajustarTope();
                window.addEventListener('resize', ajustarTope);
                let actual = 0;

                /* ---------- Condiciones (misma lógica que el servidor) ---------- */
                function valor(ruta) {
                    const [clave, fila] = ruta.split('.');
                    const nombre = fila ? `respuestas[${clave}][${fila}]` : `respuestas[${clave}]`;
                    return [...form.querySelectorAll(`[name="${nombre}"], [name="${nombre}[]"]`)]
                        .filter(c => !c.disabled)
                        .filter(c => (c.type === 'checkbox' || c.type === 'radio') ? c.checked : c.value.trim() !== '')
                        .map(c => c.value);
                }

                function coincide(ruta, esperado, visibles) {
                    if (esperado && typeof esperado === 'object' && !Array.isArray(esperado) && 'distinto' in esperado) {
                        return !coincide(ruta, esperado.distinto, visibles);
                    }
                    if (visibles[ruta.split('.')[0]] === false) return false;
                    const actuales = valor(ruta);
                    if (esperado === '*') return actuales.length > 0;
                    return [].concat(esperado).map(String).some(v => actuales.includes(v));
                }
                const todas = (c, v) => !c || Object.entries(c).every(([r, e]) => coincide(r, e, v));
                const alguna = (c, v) => !c || Object.entries(c).some(([r, e]) => coincide(r, e, v));

                function habilitar(elemento, activo) {
                    elemento.querySelectorAll('input, select, textarea').forEach(campo => {
                        if (campo.disabled === !activo) return;
                        campo.disabled = !activo;
                        if (!activo && !campo.classList.contains('alternativa')) {
                            if (campo.type === 'checkbox' || campo.type === 'radio') campo.checked = false;
                            else if (campo.type !== 'date') campo.value = '';
                        }
                    });
                }

                function evaluar() {
                    const visibles = {};
                    let finalizado = false;

                    Object.entries(reglas).forEach(([clave, regla]) => {
                        const caja = contenedor(clave);
                        let visible = (!finalizado || regla.siempre) && todas(regla.si, visibles) && alguna(regla.si_alguno, visibles);

                        if (visible && regla.filas) {
                            let algunaFila = false;
                            Object.entries(regla.filas).forEach(([fila, cond]) => {
                                const filaVisible = todas(cond, visibles);
                                const elemento = caja.querySelector(`.fila-matriz[data-fila="${fila}"]`);
                                elemento.hidden = !filaVisible;
                                habilitar(elemento, filaVisible);
                                algunaFila ||= filaVisible;
                            });
                            visible = algunaFila;
                        }

                        caja.style.display = visible ? '' : 'none';
                        if (!regla.filas || !visible) habilitar(caja, visible);
                        visibles[clave] = visible;

                        // "No tiene teléfono" / "No sabe": deshabilita el campo de respuesta
                        const alt = caja.querySelector('.alternativa');
                        if (visible && alt) {
                            caja.querySelectorAll('input:not(.alternativa), select, textarea').forEach(c => {
                                c.disabled = alt.checked;
                                if (alt.checked) c.value = '';
                            });
                        }

                        if (visible && regla.finaliza_si && todas(regla.finaliza_si, visibles)) finalizado = true;
                    });

                    // Una sección sin preguntas visibles no es un paso
                    form.querySelectorAll('.seccion-cacsp').forEach(seccion => {
                        seccion.dataset.vacia = [...seccion.querySelectorAll('.pregunta-container')].some(c => c.style.display !== 'none') ? '0' : '1';
                    });
                    document.getElementById('mensaje-fin').hidden = !finalizado;
                    pintarNavegacion();
                }

                /* ---------- Validación de un paso ---------- */
                function validar(ambito) {
                    let primerError = null;
                    ambito.querySelectorAll('.error-pregunta').forEach(span => span.textContent = '');
                    ambito.querySelectorAll('.con-error').forEach(el => el.classList.remove('con-error'));

                    ambito.querySelectorAll('.pregunta-container').forEach(caja => {
                        if (caja.style.display === 'none') return;
                        const marcar = (destino, mensaje) => {
                            destino.querySelector(':scope > .error-pregunta').textContent = mensaje;
                            destino.classList.add('con-error');
                            primerError ??= destino;
                        };

                        const filas = caja.querySelectorAll('.fila-matriz');
                        if (filas.length) {
                            filas.forEach(fila => {
                                if (fila.hidden) return;
                                const radios = [...fila.querySelectorAll('input[type=radio]')];
                                if (radios.some(r => r.required) && !radios.some(r => r.checked)) marcar(fila, 'Seleccione una opción.');
                            });
                            return;
                        }

                        const grupo = caja.querySelector('[data-grupo-checkbox][data-obligatorio]');
                        const campos = [...caja.querySelectorAll('input, select, textarea')].filter(c => !c.disabled && !c.classList.contains('alternativa'));
                        if (grupo && !campos.some(c => c.checked)) {
                            marcar(caja, 'Seleccione al menos una opción.');
                        } else {
                            const invalido = campos.find(c => !c.checkValidity());
                            if (invalido) marcar(caja, invalido.validity.valueMissing ? 'Esta pregunta es obligatoria.' : (invalido.validationMessage || 'Revise esta respuesta.'));
                        }
                    });

                    return primerError;
                }

                /* ---------- Pasos ---------- */
                const pasos = () => todosLosPasos.filter(p => p.dataset.vacia !== '1');

                function irA(indice, desplazar = true) {
                    const lista = pasos();
                    actual = Math.max(0, Math.min(indice, lista.length - 1));
                    todosLosPasos.forEach(p => p.hidden = p !== lista[actual]);
                    pintarNavegacion();
                    if (desplazar) form.closest('.cx-principal').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }

                function pintarNavegacion() {
                    const lista = pasos();
                    const visible = todosLosPasos.find(p => !p.hidden);
                    if (visible && lista.includes(visible)) {
                        actual = lista.indexOf(visible);
                    } else if (visible) {
                        // El paso visible dejó de aplicar (cambió una respuesta): mostrar el más cercano
                        actual = Math.min(actual, lista.length - 1);
                        todosLosPasos.forEach(p => p.hidden = p !== lista[actual]);
                    }
                    const total = lista.length;

                    document.getElementById('cx-progreso-texto').innerHTML = `Paso <b>${actual + 1}</b> de ${total} · `;
                    document.getElementById('cx-progreso-texto').append(lista[actual]?.dataset.titulo ?? '');
                    document.getElementById('cx-barra').style.width = `${Math.round((actual + 1) / total * 100)}%`;
                    lista.forEach((p, i) => {
                        const n = p.querySelector('.cx-paso-numero');
                        if (n && !p.classList.contains('cx-final')) n.textContent = `Sección ${i + 1} de ${total - 1}`;
                    });

                    document.getElementById('cx-anterior').style.visibility = actual === 0 ? 'hidden' : 'visible';
                    const esUltimo = actual === total - 1;
                    document.getElementById('cx-siguiente').hidden = esUltimo;
                    document.getElementById('cacsp-enviar').hidden = !esUltimo;

                    const indice = document.getElementById('cx-indice');
                    indice.innerHTML = '';
                    lista.forEach((p, i) => {
                        const li = document.createElement('li');
                        li.dataset.estado = i === actual ? 'actual' : (i < actual ? 'hecho' : 'pendiente');
                        const boton = document.createElement('button');
                        boton.type = 'button';
                        boton.disabled = i > actual;
                        boton.innerHTML = `<span class="cx-num">${i < actual ? '✓' : i + 1}</span><span></span>`;
                        boton.lastChild.textContent = p.dataset.titulo;
                        boton.addEventListener('click', () => irA(i));
                        li.appendChild(boton);
                        indice.appendChild(li);
                    });

                    if (esUltimo) pintarResumen(lista.slice(0, -1));
                }

                function pintarResumen(secciones) {
                    const ul = document.getElementById('cx-resumen');
                    ul.innerHTML = '';
                    secciones.forEach(seccion => {
                        const preguntas = [...seccion.querySelectorAll('.pregunta-container')].filter(c => c.style.display !== 'none');
                        const respondidas = preguntas.filter(c => [...c.querySelectorAll('input, select, textarea')]
                            .some(x => !x.disabled && ((x.type === 'radio' || x.type === 'checkbox') ? x.checked : x.value.trim() !== ''))).length;
                        const li = document.createElement('li');
                        li.innerHTML = '<span></span><b></b>';
                        li.firstChild.textContent = seccion.dataset.titulo;
                        li.lastChild.textContent = `${respondidas} de ${preguntas.length} respondidas`;
                        ul.appendChild(li);
                    });
                }

                document.getElementById('cx-siguiente').addEventListener('click', () => {
                    const error = validar(pasos()[actual]);
                    if (error) { error.scrollIntoView({ behavior: 'smooth', block: 'center' }); return; }
                    irA(actual + 1);
                });
                document.getElementById('cx-anterior').addEventListener('click', () => irA(actual - 1));

                form.addEventListener('change', evaluar);
                form.addEventListener('input', e => { if (e.target.matches('input[type=text]')) evaluar(); });

                form.addEventListener('submit', evento => {
                    // Validar todo; si algo falta, llevar al paso correspondiente
                    for (const [i, paso] of pasos().entries()) {
                        if (paso.classList.contains('cx-final')) continue;
                        const error = validar(paso);
                        if (error) { evento.preventDefault(); irA(i, false); error.scrollIntoView({ behavior: 'smooth', block: 'center' }); return; }
                    }
                    const autoriza = form.querySelector('[name="autoriza"]');
                    if (!autoriza.checked) {
                        evento.preventDefault();
                        document.getElementById('error-autoriza').textContent = 'Debe autorizar el tratamiento de datos personales para enviar.';
                        autoriza.focus();
                        return;
                    }
                    const boton = document.getElementById('cacsp-enviar');
                    boton.disabled = true;
                    boton.querySelector('span').textContent = 'Enviando…';
                });

                evaluar();

                // Si el servidor devolvió errores, abrir el paso con el primero
                const conError = pasos().findIndex(p => [...p.querySelectorAll('.cx-error')].some(s => s.textContent.trim()));
                irA(conError >= 0 ? conError : 0, conError >= 0);
            });
        </script>
        @endunless

    </body>
</html>
