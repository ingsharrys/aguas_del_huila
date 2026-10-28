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
                    </span class="font-bold"> Cuestionario de Evaluación de Atencion al Cliente Servicios Públicos</span>
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

            <form action="{{ route('cuestionario.cacsp.store') }}" method="POST" id="cacsp-form" class="space-y-8" novalidate>
                @csrf

                @php
                    // Inicio de cada sección del cuestionario (clave de la primera pregunta => título)
                    $secciones = [
                        'a_id_muestra' => '1. Datos generales',
                        'P7'           => '2. Servicios públicos del hogar',
                        'P8'           => '3. Acueducto y alcantarillado',
                        'P24'          => '4. Servicio de aseo',
                        'P41'          => '5. Percepciones generales',
                    ];
                    $abierta = false;
                    $clasesCampo = 'w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors';
                    $clasesOpcion = 'flex items-center gap-3 p-3 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-300 hover:bg-blue-50/30 transition-all has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50 has-[:checked]:ring-1 has-[:checked]:ring-blue-500';
                @endphp

                @foreach($preguntas as $key => $pregunta)
                    @php
                        $oldValue = old("respuestas.$key");
                        $tipo = $pregunta['tipo'];
                        $opciones = is_array($pregunta['opciones'] ?? null) ? $pregunta['opciones'] : [];
                        // En listas simples (ej. estrato 1..6) el valor enviado es la propia opción
                        if (array_is_list($opciones)) {
                            $opciones = array_combine(array_map('strval', $opciones), $opciones);
                        }
                        $condicion = $pregunta['condicion'] ?? null;
                        $obligatoria = !empty($pregunta['obligatoria']);
                    @endphp

                    @if(isset($secciones[$key]))
                        @if($abierta)
                                </div>
                            </div>
                        @endif
                        @php $abierta = true; @endphp
                        <div class="bg-gray-50/50 rounded-2xl border border-gray-200/80 overflow-hidden shadow-sm seccion-cacsp">
                            <div class="bg-gray-100/80 px-6 py-4 border-b border-gray-200">
                                <h2 class="text-base font-semibold text-gray-800">{{ $secciones[$key] }}</h2>
                            </div>
                            <div class="p-6 bg-white grid grid-cols-1 md:grid-cols-2 gap-6">
                    @endif

                    {{-- Contenedor de la pregunta; las condicionales se muestran según las respuestas --}}
                    <div class="pregunta-container {{ in_array($tipo, ['radio', 'checkbox', 'textarea']) ? 'md:col-span-2' : '' }} {{ $tipo === 'hidden' ? 'hidden' : '' }}"
                         data-key="{{ $key }}"
                         @if($condicion)
                             data-condicion-campo="{{ $condicion['campo'] }}"
                             data-condicion-operador="{{ $condicion['operador'] }}"
                             data-condicion-valor="{{ json_encode(array_map('strval', (array) $condicion['valor'])) }}"
                             style="display: none;"
                         @endif>

                        @if($tipo !== 'hidden')
                            <label class="block text-sm font-semibold text-gray-900 mb-2" @if(in_array($tipo, ['text', 'number', 'textarea', 'select'])) for="campo-{{ $key }}" @endif>
                                {{ $pregunta['titulo'] }}
                                @if($obligatoria) <span class="text-rose-500">*</span> @endif
                            </label>
                        @endif

                        @if($tipo === 'text' || $tipo === 'number')
                            <input type="{{ $tipo }}" id="campo-{{ $key }}" name="respuestas[{{ $key }}]" value="{{ $oldValue }}"
                                   class="{{ $clasesCampo }}"
                                   @if($obligatoria) required @endif
                                   @if($tipo === 'number') inputmode="numeric" @endif
                                   @isset($pregunta['atributos']['min']) min="{{ $pregunta['atributos']['min'] }}" @endisset
                                   @isset($pregunta['atributos']['max']) max="{{ $pregunta['atributos']['max'] }}" @endisset
                                   maxlength="255">

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
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
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
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3" data-grupo-checkbox="{{ $key }}" @if($obligatoria) data-obligatorio="1" @endif>
                                @foreach($opciones as $val => $label)
                                    <label class="{{ $clasesOpcion }}">
                                        <input type="checkbox" name="respuestas[{{ $key }}][]" value="{{ $val }}"
                                               class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                               @if($key === 'P7' && (string) $val === '4') data-excluyente="1" @endif
                                               @checked(is_array($oldValue) && in_array((string) $val, array_map('strval', $oldValue), true))>
                                        <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>

                        @elseif($tipo === 'hidden')
                            <input type="hidden" name="respuestas[{{ $key }}]" value="{{ $oldValue }}">
                        @endif

                        <span class="error-pregunta text-xs text-rose-600 font-medium mt-1.5 block">@error("respuestas.$key"){{ $message }}@enderror</span>
                    </div>
                @endforeach

                @if($abierta)
                        </div>
                    </div>
                @endif

                {{-- Mensaje cuando el hogar no tiene servicios --}}
                <div id="mensaje-sin-servicios" class="hidden rounded-xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-800">
                    Como su hogar no cuenta con servicios públicos, no es necesario responder más preguntas. Autorice el tratamiento de datos y guarde el cuestionario.
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

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('cacsp-form');
                const condicionales = [...form.querySelectorAll('.pregunta-container[data-condicion-campo]')];
                const P7_NINGUNO = '4';

                // Valores seleccionados de una pregunta (solo de campos habilitados)
                function valores(clave) {
                    return [...form.querySelectorAll(`[name="respuestas[${clave}]"], [name="respuestas[${clave}][]"]`)]
                        .filter(campo => !campo.disabled)
                        .filter(campo => (campo.type === 'checkbox' || campo.type === 'radio') ? campo.checked : campo.value !== '')
                        .map(campo => campo.value);
                }

                function cumple(contenedor) {
                    const seleccion = valores(contenedor.dataset.condicionCampo);
                    const requeridos = JSON.parse(contenedor.dataset.condicionValor);

                    switch (contenedor.dataset.condicionOperador) {
                        case '==':
                        case 'in_array':
                        case 'intersect':
                            return requeridos.some(valor => seleccion.includes(valor));
                        default:
                            return true;
                    }
                }

                function mostrar(contenedor, visible) {
                    contenedor.style.display = visible ? '' : 'none';
                    contenedor.querySelectorAll('input, select, textarea').forEach(campo => {
                        // Un campo oculto se deshabilita: no se envía ni bloquea el envío con "required"
                        campo.disabled = !visible;
                        if (!visible) {
                            if (campo.type === 'checkbox' || campo.type === 'radio') {
                                campo.checked = false;
                            } else {
                                campo.value = '';
                            }
                        }
                    });
                }

                function evaluarCondiciones() {
                    // Se repite hasta que no haya cambios: resuelve condiciones en cadena (P7 → P10 → P11)
                    let cambio = true;
                    for (let vuelta = 0; cambio && vuelta < 10; vuelta++) {
                        cambio = false;
                        condicionales.forEach(contenedor => {
                            const visible = cumple(contenedor);
                            const estaba = contenedor.style.display !== 'none';
                            if (visible !== estaba) {
                                mostrar(contenedor, visible);
                                cambio = true;
                            }
                        });
                    }

                    // Ocultar secciones sin preguntas visibles (ej. Aseo si el hogar no tiene ese servicio)
                    form.querySelectorAll('.seccion-cacsp').forEach(seccion => {
                        const visibles = [...seccion.querySelectorAll('.pregunta-container')]
                            .some(c => c.style.display !== 'none' && !c.classList.contains('hidden'));
                        seccion.style.display = visibles ? '' : 'none';
                    });

                    const sinServicios = valores('P7').includes(P7_NINGUNO);
                    document.getElementById('mensaje-sin-servicios').classList.toggle('hidden', !sinServicios);
                }

                // "Ninguno" excluye a las demás opciones de servicios
                form.querySelectorAll('[data-grupo-checkbox="P7"] input').forEach(casilla => {
                    casilla.addEventListener('change', () => {
                        if (!casilla.checked) return;
                        form.querySelectorAll('[data-grupo-checkbox="P7"] input').forEach(otra => {
                            if (otra !== casilla && (casilla.dataset.excluyente || otra.dataset.excluyente)) {
                                otra.checked = false;
                            }
                        });
                    });
                });

                form.addEventListener('change', evaluarCondiciones);

                // Validación antes de enviar: muestra el mensaje junto a cada pregunta
                form.addEventListener('submit', (evento) => {
                    let primerError = null;
                    form.querySelectorAll('.error-pregunta').forEach(span => span.textContent = '');

                    form.querySelectorAll('.pregunta-container').forEach(contenedor => {
                        if (contenedor.style.display === 'none') return;

                        const grupo = contenedor.querySelector('[data-grupo-checkbox][data-obligatorio]');
                        const campos = [...contenedor.querySelectorAll('input, select, textarea')].filter(c => !c.disabled);
                        let mensaje = '';

                        if (grupo && !campos.some(c => c.checked)) {
                            mensaje = 'Seleccione al menos una opción.';
                        } else {
                            const invalido = campos.find(c => !c.checkValidity());
                            if (invalido) mensaje = invalido.validationMessage || 'Esta pregunta es obligatoria.';
                        }

                        if (mensaje) {
                            contenedor.querySelector('.error-pregunta').textContent = mensaje;
                            primerError ??= contenedor;
                        }
                    });

                    const autoriza = form.querySelector('[name="autoriza"]');
                    if (!autoriza.checked) {
                        primerError ??= autoriza.closest('div');
                    }

                    if (primerError) {
                        evento.preventDefault();
                        primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        if (!autoriza.checked && primerError === autoriza.closest('div')) autoriza.reportValidity();
                        return;
                    }

                    // Evitar doble envío
                    document.getElementById('cacsp-enviar').disabled = true;
                });

                // Estado inicial (incluye los valores devueltos si hubo errores)
                // Ocultar sin borrar respuestas: si el formulario volvió con errores se conservan
                condicionales.forEach(contenedor => {
                    contenedor.style.display = 'none';
                    contenedor.querySelectorAll('input, select, textarea').forEach(campo => campo.disabled = true);
                });
                evaluarCondiciones();

                const errorServidor = [...form.querySelectorAll('.error-pregunta')].find(span => span.textContent.trim());
                errorServidor?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        </script>

    </body>
</html>
