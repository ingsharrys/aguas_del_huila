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

            <form action="{{ route('cuestionario.cacsp.store') }}" method="POST" id="cacsp-form" class="space-y-8">
                @csrf

                <!-- 1. DATOS GENERALES -->
                <div class="bg-gray-50/50 rounded-2xl border border-gray-200/80 overflow-hidden shadow-sm">
                    <div class="bg-gray-100/80 px-6 py-4 border-b border-gray-200 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0047DC]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <h2 class="text-base font-semibold text-gray-800">1. Datos Generales</h2>
                    </div>
                    
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white">
                        
                        <!-- Municipio -->
                        <div>
                            <label class="block mb-1.5 text-sm font-medium text-gray-700">
                                Municipio <span class="text-rose-500">*</span>
                            </label>
                            <select name="municipio_id" required 
                                    class="w-full bg-gray-50 border @error('municipio_id') border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:ring-blue-500 focus:border-blue-500 @enderror text-gray-900 text-sm rounded-xl block p-3 transition-colors">
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('municipio_id') == '1' ? 'selected' : '' }}>Neiva</option>
                            </select>
                            @error('municipio_id') <span class="text-xs text-rose-600 mt-1 font-medium block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Ubicación -->
                        <div>
                            <label class="block mb-1.5 text-sm font-medium text-gray-700">
                                Ubicación <span class="text-rose-500">*</span>
                            </label>
                            <select name="ubicacion" required 
                                    class="w-full bg-gray-50 border @error('ubicacion') border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:ring-blue-500 focus:border-blue-500 @enderror text-gray-900 text-sm rounded-xl block p-3 transition-colors">
                                <option value="">Seleccione...</option>
                                <option value="URBANO" {{ old('ubicacion') == 'URBANO' ? 'selected' : '' }}>Urbano</option>
                                <option value="RURAL" {{ old('ubicacion') == 'RURAL' ? 'selected' : '' }}>Rural</option>
                            </select>
                            @error('ubicacion') <span class="text-xs text-rose-600 mt-1 font-medium block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label class="block mb-1.5 text-sm font-medium text-gray-700">
                                Nombre del Usuario <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" required 
                                   placeholder="Ingrese su nombre completo"
                                   class="w-full bg-gray-50 border @error('nombre') border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:ring-blue-500 focus:border-blue-500 @enderror text-gray-900 text-sm rounded-xl block p-3 transition-colors">
                            @error('nombre') <span class="text-xs text-rose-600 mt-1 font-medium block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Edad -->
                        <div>
                            <label class="block mb-1.5 text-sm font-medium text-gray-700">
                                Edad <span class="text-rose-500">*</span>
                            </label>
                            <input type="number" name="edad" min="18" value="{{ old('edad') }}" required 
                                   placeholder="Ej: 25"
                                   class="w-full bg-gray-50 border @error('edad') border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:ring-blue-500 focus:border-blue-500 @enderror text-gray-900 text-sm rounded-xl block p-3 transition-colors">
                            @error('edad') <span class="text-xs text-rose-600 mt-1 font-medium block">{{ $message }}</span> @enderror
                        </div>

                    </div>
                </div>

                <!-- 2. PREGUNTAS DINÁMICAS (CUESTIONARIO) -->
                <div class="bg-gray-50/50 rounded-2xl border border-gray-200/80 overflow-hidden shadow-sm">
                    <div class="bg-gray-100/80 px-6 py-4 border-b border-gray-200 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0047DC]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <h2 class="text-base font-semibold text-gray-800">2. Cuestionario</h2>
                    </div>

                    <div class="p-6 bg-white space-y-6 divide-y divide-gray-100">
                        @foreach($preguntas as $key => $pregunta)
                            @php
                                $oldValue = old("respuestas.$key");
                                $isHidden = $pregunta['tipo'] === 'hidden';
                                $tieneCondicion = isset($pregunta['condicion']);
                            @endphp

                            {{-- Contenedor de la pregunta con Data Attributes para JS --}}
                            <div class="pregunta-container pt-6 first:pt-0" 
                                 data-key="{{ $key }}"
                                 @if($tieneCondicion)
                                     data-condicion-campo="{{ $pregunta['condicion']['campo'] }}"
                                     data-condicion-operador="{{ $pregunta['condicion']['operador'] }}"
                                     data-condicion-valor="{{ is_array($pregunta['condicion']['valor']) ? json_encode($pregunta['condicion']['valor']) : $pregunta['condicion']['valor'] }}"
                                     style="display: none;"
                                 @endif>
                                
                                @if(!$isHidden)
                                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                                        {{ $pregunta['titulo'] }} 
                                        @if($pregunta['obligatoria']) <span class="text-rose-500">*</span> @endif
                                    </label>
                                @endif

                                <div class="space-y-2">
                                    {{-- Input de Texto o Número --}}
                                    @if($pregunta['tipo'] === 'text' || $pregunta['tipo'] === 'number')
                                        <input type="{{ $pregunta['tipo'] }}" 
                                               name="respuestas[{{ $key }}]" 
                                               class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors" 
                                               value="{{ $oldValue }}" 
                                               {{ $pregunta['obligatoria'] ? 'required' : '' }}
                                               {{ isset($pregunta['atributos']['min']) ? 'min='.$pregunta['atributos']['min'] : '' }}>

                                    {{-- Textarea --}}
                                    @elseif($pregunta['tipo'] === 'textarea')
                                        <textarea name="respuestas[{{ $key }}]" 
                                                  rows="3" 
                                                  class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors" 
                                                  {{ $pregunta['obligatoria'] ? 'required' : '' }}>{{ $oldValue }}</textarea>

                                    {{-- Select --}}
                                    @elseif($pregunta['tipo'] === 'select')
                                        <select name="respuestas[{{ $key }}]" 
                                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-3 transition-colors" 
                                                {{ $pregunta['obligatoria'] ? 'required' : '' }}>
                                            <option value="">Seleccione...</option>
                                            @if(is_array($pregunta['opciones']))
                                                @foreach($pregunta['opciones'] as $val => $label)
                                                    <option value="{{ $val }}" {{ $oldValue == $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    {{-- Radio Buttons (Radio Cards modernas) --}}
                                    @elseif($pregunta['tipo'] === 'radio')
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                            @foreach($pregunta['opciones'] as $val => $label)
                                                <label class="flex items-center gap-3 p-3 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-300 hover:bg-blue-50/30 transition-all has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                                                    <input type="radio" 
                                                           name="respuestas[{{ $key }}]" 
                                                           value="{{ $val }}" 
                                                           class="input-radio-dynamic w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" 
                                                           {{ $oldValue == $val ? 'checked' : '' }}
                                                           {{ $pregunta['obligatoria'] ? 'required' : '' }}>
                                                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                    {{-- Checkbox (Selección Múltiple) --}}
                                    @elseif($pregunta['tipo'] === 'checkbox')
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                            @foreach($pregunta['opciones'] as $val => $label)
                                                <label class="flex items-center gap-3 p-3 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-300 hover:bg-blue-50/30 transition-all has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50/50 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                                                    <input type="checkbox" 
                                                           name="respuestas[{{ $key }}][]" 
                                                           value="{{ $val }}" 
                                                           class="input-checkbox-dynamic w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500" 
                                                           {{ is_array($oldValue) && in_array($val, $oldValue) ? 'checked' : '' }}>
                                                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                    {{-- Hidden --}}
                                    @elseif($pregunta['tipo'] === 'hidden')
                                        <input type="hidden" name="respuestas[{{ $key }}]" value="{{ $oldValue }}">
                                    @endif
                                </div>
                                
                                {{-- Error Específico --}}
                                @error("respuestas.$key") 
                                    <span class="text-xs text-rose-600 font-medium mt-1.5 block">{{ $message }}</span> 
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botón de Envío -->
                <button type="submit" 
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
            document.addEventListener('DOMContentLoaded', function() {
                
                // Función principal que evalúa qué preguntas deben mostrarse
                function evaluateConditions() {
                    const containers = document.querySelectorAll('.pregunta-container[data-condicion-campo]');
                    
                    containers.forEach(container => {
                        const campoRef = container.getAttribute('data-condicion-campo');
                        const operador = container.getAttribute('data-condicion-operador');
                        const valorReq = container.getAttribute('data-condicion-valor');
                        
                        // Obtener los inputs del campo de referencia (puede ser radio, checkbox, etc.)
                        // Buscamos name="respuestas[KEY]" o name="respuestas[KEY][]"
                        const refInputs = document.querySelectorAll(`[name="respuestas[${campoRef}]"], [name="respuestas[${campoRef}][]"]`);
                        
                        let selectedValues = [];
                        refInputs.forEach(input => {
                            if ((input.type === 'checkbox' || input.type === 'radio') && input.checked) {
                                selectedValues.push(input.value);
                            } else if (input.type !== 'checkbox' && input.type !== 'radio' && input.value) {
                                selectedValues.push(input.value);
                            }
                        });

                        let isVisible = false;

                        // Lógica de evaluación según el operador
                        if (operador === '==') {
                            isVisible = selectedValues.includes(valorReq);
                        } else if (operador === 'in_array') {
                            isVisible = selectedValues.includes(valorReq);
                        } else if (operador === 'intersect') {
                            let arrReq = JSON.parse(valorReq); // Ej: ["1", "2"]
                            isVisible = arrReq.some(val => selectedValues.includes(val));
                        }

                        // Mostrar/Ocultar y Habilitar/Deshabilitar
                        // Deshabilitar es crucial para que el navegador ignore campos requeridos ocultos
                        const innerInputs = container.querySelectorAll('input, select, textarea');
                        
                        if (isVisible) {
                            container.style.display = 'block';
                            innerInputs.forEach(input => input.disabled = false);
                        } else {
                            container.style.display = 'none';
                            innerInputs.forEach(input => {
                                input.disabled = true;
                                // Limpiar el valor si se oculta para no enviar basura
                                if (input.type === 'checkbox' || input.type === 'radio') {
                                    input.checked = false;
                                } else {
                                    input.value = '';
                                }
                            });
                        }
                    });
                }

                // Asignar el evento 'change' a todos los inputs dinámicos
                const allDynamicInputs = document.querySelectorAll('input, select, textarea');
                allDynamicInputs.forEach(input => {
                    input.addEventListener('change', evaluateConditions);
                });

                // Ejecutar al cargar la página (vital si se recarga con errores de validación 'old')
                evaluateConditions();
            });
        </script>

    </body>
</html>
