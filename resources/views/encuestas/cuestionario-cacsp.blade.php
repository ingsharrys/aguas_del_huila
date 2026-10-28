<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Cuestionario de Evaluación de Atencion al Cliente Servicios Públicos</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Cuestionario de Evaluación de Atencion al Cliente Servicios Públicos</h2>   
                <p class="text-lg flex flex-wrap justify-center gap-2">             
                    <a href="/" class="hover:text-[#00C81F]">
                        Inicio
                    </a>
                    <span>/</span>
                    <a href="https://aguasdelhuila.gov.co/transparencia-y-acceso-a-la-informacion-publica" class="hover:text-[#00C81F]">
                        Transparencia y Acceso a la Información Pública
                    </a>
                    <span>/</span>
                    <span class="font-bold"> Cuestionario de Evaluación de Atencion al Cliente Servicios Públicos</span>
                </p>
            </div>
        </div>

        <!-- formulario -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Tarjeta Principal -->
    <div class="bg-white shadow-xl rounded-2xl border-t-8 border-[#0047DC] border-x border-b border-gray-100 overflow-hidden">

        <div class="p-6 sm:p-10 w-full">

            <!-- Encabezado del Formulario -->
            <div class="mb-8 border-b border-gray-100 pb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">
                    Evaluación de Atención al Cliente
                </h1>
                <p class="text-sm text-gray-500 mt-1">Servicios Públicos — Por favor complete los datos a continuación</p>
            </div>

            {{-- Alertas de Éxito o Error General --}}
            @if(session('success'))
                <div class="flex items-center gap-3 p-4 mb-6 text-sm text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200">
                    <svg class="w-5 h-5 shrink-0 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center gap-3 p-4 mb-6 text-sm text-rose-800 rounded-xl bg-rose-50 border border-rose-200">
                    <svg class="w-5 h-5 shrink-0 text-rose-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="flex items-center gap-3 p-4 mb-6 text-sm text-amber-800 rounded-xl bg-amber-50 border border-amber-200">
                    <svg class="w-5 h-5 shrink-0 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div>Por favor, revisa los errores indicados en el formulario.</div>
                </div>
            @endif

            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                Aguas del Huila S.A. E.S.P. está realizando un estudio sobre la prestación de los servicios de acueducto, alcantarillado y aseo en el municipio.
                Sus respuestas nos ayudarán a mejorar. Las preguntas marcadas con <span class="text-rose-500">*</span> son obligatorias.
            </p>

            <form action="{{ route('cuestionario.cacsp.store') }}" method="POST" id="cacsp-form" class="space-y-8" novalidate>
                @csrf

                @php
                    $abierta = false;
                    $clasesCampo = 'w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors';
                    $clasesOpcion = 'flex items-center gap-3 p-3 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-300 hover:bg-blue-50/30 transition-all has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50 has-[:checked]:ring-1 has-[:checked]:ring-blue-500';
                    $numeroSeccion = 0;
                @endphp

                @foreach($preguntas as $key => $pregunta)
                    @php
                        $oldValue = old("respuestas.$key");
                        $tipo = $pregunta['tipo'];
                        $opciones = is_array($pregunta['opciones'] ?? null) ? $pregunta['opciones'] : [];
                        $obligatoria = !empty($pregunta['obligatoria']);
                        $alternativa = $pregunta['alternativa'] ?? null;
                        $altMarcada = (bool) old("alternativas.$key");
                        $ancho = in_array($tipo, ['radio', 'checkbox', 'textarea', 'matriz', 'duracion']) || mb_strlen($pregunta['titulo']) > 60;
                    @endphp

                    @if(isset($pregunta['seccion']))
                        @if($abierta)
                                </div>
                            </div>
                        @endif
                        @php $abierta = true; $numeroSeccion++; @endphp
                        <div class="bg-gray-50/50 rounded-2xl border border-gray-200/80 overflow-hidden shadow-sm seccion-cacsp">
                            <div class="bg-gray-100/80 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-base font-semibold text-gray-800">{{ $numeroSeccion }}. {{ $pregunta['seccion'] }}</h2>
                                @isset($pregunta['introduccion'])
                                    <p class="text-sm text-gray-600 mt-1">{{ $pregunta['introduccion'] }}</p>
                                @endisset
                            </div>
                            <div class="p-6 bg-white grid grid-cols-1 md:grid-cols-2 gap-6">
                    @endif

                    <div class="pregunta-container {{ $ancho ? 'md:col-span-2' : '' }}" data-key="{{ $key }}">
                        <label class="block text-sm font-semibold text-gray-900 mb-2" @if(in_array($tipo, ['text', 'number', 'tel', 'date', 'textarea', 'select'])) for="campo-{{ $key }}" @endif>
                            {{ $pregunta['titulo'] }}
                            @if($obligatoria) <span class="text-rose-500">*</span> @endif
                        </label>
                        @isset($pregunta['ayuda'])
                            <p class="text-xs text-gray-500 -mt-1 mb-2">{{ $pregunta['ayuda'] }}</p>
                        @endisset

                        @if(in_array($tipo, ['text', 'number', 'tel', 'date']))
                            <input type="{{ $tipo }}" id="campo-{{ $key }}" name="respuestas[{{ $key }}]"
                                   value="{{ $oldValue ?? ($tipo === 'date' ? now()->toDateString() : '') }}"
                                   class="{{ $clasesCampo }}"
                                   @if($obligatoria) required @endif
                                   @if($tipo === 'number') inputmode="numeric" @endif
                                   @if($tipo === 'tel') inputmode="tel" pattern="[0-9+\s()\-]{7,20}" @endif
                                   @if($tipo === 'date') max="{{ now()->toDateString() }}" @endif
                                   @isset($pregunta['atributos']['min']) min="{{ $pregunta['atributos']['min'] }}" @endisset
                                   @isset($pregunta['atributos']['max']) max="{{ $pregunta['atributos']['max'] }}" @endisset
                                   @if($tipo !== 'date') maxlength="255" @endif>

                        @elseif($tipo === 'textarea')
                            <textarea id="campo-{{ $key }}" name="respuestas[{{ $key }}]" rows="3" maxlength="2000" class="{{ $clasesCampo }}"
                                      @if($obligatoria) required @endif>{{ $oldValue }}</textarea>

                        @elseif($tipo === 'select')
                            <select id="campo-{{ $key }}" name="respuestas[{{ $key }}]" class="{{ $clasesCampo }}" @if($obligatoria) required @endif>
                                <option value="">Seleccione...</option>
                                @foreach($opciones as $val => $label)
                                    <option value="{{ $val }}" @selected((string) $oldValue === (string) $val)>{{ $label }}</option>
                                @endforeach
                            </select>

                        @elseif($tipo === 'radio')
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-{{ count($opciones) > 4 ? 3 : count($opciones) }} gap-3" role="radiogroup">
                                @foreach($opciones as $val => $label)
                                    <label class="{{ $clasesOpcion }}">
                                        <input type="radio" name="respuestas[{{ $key }}]" value="{{ $val }}"
                                               class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                               @checked((string) $oldValue === (string) $val)
                                               @if($obligatoria) required @endif>
                                        <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>

                        @elseif($tipo === 'checkbox')
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3" data-grupo-checkbox @if($obligatoria) data-obligatorio="1" @endif>
                                @foreach($opciones as $val => $label)
                                    <label class="{{ $clasesOpcion }}">
                                        <input type="checkbox" name="respuestas[{{ $key }}][]" value="{{ $val }}"
                                               class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                               @checked(is_array($oldValue) && in_array((string) $val, array_map('strval', $oldValue), true))>
                                        <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>

                        @elseif($tipo === 'matriz')
                            {{-- Tabla de calificación: una fila por aspecto; en pantallas pequeñas cada fila se apila --}}
                            <div class="space-y-3">
                                @foreach($pregunta['filas'] as $fila => $definicion)
                                    <fieldset class="fila-matriz rounded-xl border border-gray-200 p-3" data-fila="{{ $fila }}">
                                        <legend class="px-1 text-sm text-gray-800 font-medium">{{ $definicion['texto'] }}</legend>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            @foreach($opciones as $val => $label)
                                                <label class="flex items-center gap-2 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg cursor-pointer text-sm text-gray-700 hover:border-blue-300 has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                                                    <input type="radio" name="respuestas[{{ $key }}][{{ $fila }}]" value="{{ $val }}"
                                                           class="w-4 h-4 text-blue-600 border-gray-300"
                                                           @checked((string) ($oldValue[$fila] ?? '') === (string) $val)
                                                           @if($obligatoria) required @endif>
                                                    {{ $label }}
                                                </label>
                                            @endforeach
                                        </div>
                                        <span class="error-pregunta text-xs text-rose-600 font-medium mt-1 block">@error("respuestas.$key.$fila"){{ $message }}@enderror</span>
                                    </fieldset>
                                @endforeach
                            </div>

                        @elseif($tipo === 'duracion')
                            <div class="grid grid-cols-2 gap-3 max-w-md">
                                <input type="number" name="respuestas[{{ $key }}][cantidad]" min="0" max="100000" inputmode="numeric" placeholder="Cantidad"
                                       value="{{ $oldValue['cantidad'] ?? '' }}" class="{{ $clasesCampo }}" @if($obligatoria) required @endif>
                                <select name="respuestas[{{ $key }}][unidad]" class="{{ $clasesCampo }}" @if($obligatoria) required @endif>
                                    <option value="">Unidad...</option>
                                    @foreach(\App\Support\CuestionarioCacsp::UNIDADES_TIEMPO as $val => $label)
                                        <option value="{{ $val }}" @selected(($oldValue['unidad'] ?? '') === $val)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if($alternativa)
                            <label class="inline-flex items-center gap-2 mt-2 text-sm text-gray-700 cursor-pointer">
                                <input type="checkbox" name="alternativas[{{ $key }}]" value="1" class="alternativa rounded border-gray-300" @checked($altMarcada)>
                                {{ $alternativa['etiqueta'] }}
                            </label>
                        @endif

                        <span class="error-pregunta text-xs text-rose-600 font-medium mt-1.5 block">@error("respuestas.$key"){{ $message }}@enderror @error("respuestas.$key.cantidad"){{ $message }}@enderror @error("respuestas.$key.unidad"){{ $message }}@enderror</span>
                    </div>
                @endforeach

                @if($abierta)
                        </div>
                    </div>
                @endif

                {{-- Mensaje cuando la encuesta termina (el hogar no tiene acueducto) --}}
                <div id="mensaje-fin" class="hidden rounded-xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-800">
                    Como el hogar no cuenta con servicio de acueducto, la encuesta termina aquí. Complete los datos de control, autorice el tratamiento de datos y guarde.
                </div>

                <!-- Tratamiento de datos (Ley 1581 de 2012) -->
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                    <label class="flex items-start gap-3 text-sm text-gray-700">
                        <input type="checkbox" name="autoriza" value="1" required class="mt-1 rounded border-gray-300" @checked(old('autoriza'))>
                        <span>Autorizo a Aguas del Huila S.A. E.S.P. el tratamiento de mis datos personales para fines de evaluación del servicio, de conformidad con la Ley 1581 de 2012. <span class="text-rose-500">*</span></span>
                    </label>
                    @error('autoriza') <span class="text-xs text-rose-600 font-medium mt-1.5 block">{{ $message }}</span> @enderror
                </div>

                <!-- Botón de Envío -->
                <button type="submit" id="cacsp-enviar"
                        class="w-full bg-[#0047DC] hover:bg-blue-700 text-white font-semibold rounded-xl text-base px-6 py-4 shadow-lg hover:shadow-xl transition-all focus:ring-4 focus:ring-blue-200 flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Guardar Cuestionario
                </button>
            </form>

        </div>

    </div>
</section>

        @include('partials.footer')

        <script type="application/json" id="cacsp-reglas">@json($reglasJs)</script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('cacsp-form');
                const reglas = JSON.parse(document.getElementById('cacsp-reglas').textContent);
                const contenedor = clave => form.querySelector(`.pregunta-container[data-key="${clave}"]`);

                // Valor actual de una respuesta ("P7.acueducto" = fila de una matriz); solo campos habilitados
                function valor(ruta) {
                    const [clave, fila] = ruta.split('.');
                    const nombre = fila ? `respuestas[${clave}][${fila}]` : `respuestas[${clave}]`;
                    const campos = [...form.querySelectorAll(`[name="${nombre}"], [name="${nombre}[]"]`)].filter(c => !c.disabled);
                    const valores = campos
                        .filter(c => (c.type === 'checkbox' || c.type === 'radio') ? c.checked : c.value.trim() !== '')
                        .map(c => c.value);
                    return valores;
                }

                function coincide(ruta, esperado, visibles) {
                    const base = ruta.split('.')[0];
                    if (visibles[base] === false) return false;
                    const actuales = valor(ruta);
                    if (esperado === '*') return actuales.length > 0;
                    return [].concat(esperado).map(String).some(v => actuales.includes(v));
                }

                const todas = (cond, vis) => !cond || Object.entries(cond).every(([r, e]) => coincide(r, e, vis));
                const alguna = (cond, vis) => !cond || Object.entries(cond).some(([r, e]) => coincide(r, e, vis));

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
                            let alguna_fila = false;
                            Object.entries(regla.filas).forEach(([fila, cond]) => {
                                const filaVisible = todas(cond, visibles);
                                const elemento = caja.querySelector(`.fila-matriz[data-fila="${fila}"]`);
                                elemento.style.display = filaVisible ? '' : 'none';
                                habilitar(elemento, filaVisible);
                                alguna_fila ||= filaVisible;
                            });
                            visible = alguna_fila;
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

                    // Ocultar secciones sin preguntas visibles
                    form.querySelectorAll('.seccion-cacsp').forEach(seccion => {
                        const hay = [...seccion.querySelectorAll('.pregunta-container')].some(c => c.style.display !== 'none');
                        seccion.style.display = hay ? '' : 'none';
                    });
                    document.getElementById('mensaje-fin').classList.toggle('hidden', !finalizado);
                }

                form.addEventListener('change', evaluar);
                form.addEventListener('input', e => { if (e.target.matches('input[type=text]')) evaluar(); });

                // Validación antes de enviar: el mensaje aparece junto a cada pregunta
                form.addEventListener('submit', evento => {
                    let primerError = null;
                    form.querySelectorAll('.error-pregunta').forEach(span => span.textContent = '');

                    form.querySelectorAll('.pregunta-container').forEach(caja => {
                        if (caja.style.display === 'none') return;

                        const marcar = (destino, mensaje) => {
                            destino.querySelector('.error-pregunta').textContent = mensaje;
                            primerError ??= caja;
                        };

                        // Filas de matrices
                        caja.querySelectorAll('.fila-matriz').forEach(fila => {
                            if (fila.style.display === 'none') return;
                            const radios = [...fila.querySelectorAll('input[type=radio]')];
                            if (radios.some(r => r.required) && !radios.some(r => r.checked)) marcar(fila, 'Seleccione una opción.');
                        });
                        if (caja.querySelector('.fila-matriz')) return;

                        const grupo = caja.querySelector('[data-grupo-checkbox][data-obligatorio]');
                        const campos = [...caja.querySelectorAll('input, select, textarea')].filter(c => !c.disabled && !c.classList.contains('alternativa'));

                        if (grupo && !campos.some(c => c.checked)) {
                            marcar(caja, 'Seleccione al menos una opción.');
                        } else {
                            const invalido = campos.find(c => !c.checkValidity());
                            if (invalido) marcar(caja, invalido.validationMessage || 'Esta pregunta es obligatoria.');
                        }
                    });

                    const autoriza = form.querySelector('[name="autoriza"]');
                    if (!primerError && !autoriza.checked) {
                        evento.preventDefault();
                        autoriza.reportValidity();
                        return;
                    }

                    if (primerError) {
                        evento.preventDefault();
                        primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        return;
                    }

                    document.getElementById('cacsp-enviar').disabled = true; // evitar doble envío
                });

                evaluar();

                const errorServidor = [...form.querySelectorAll('.error-pregunta')].find(span => span.textContent.trim());
                errorServidor?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        </script>

    </body>
</html>
