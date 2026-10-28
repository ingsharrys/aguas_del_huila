<x-layouts.app :title="__('Editar Pregunta para el Test: ' . $teste->nombre)">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            {{-- Encabezado --}}
            <div class="flex flex-wrap w-full justify-between items-center mb-4 gap-3">

                <div>
                    <h1 class="font-black text-white text-xl">
                        Editar Pregunta para el Test: {{ $teste->nombre }}
                    </h1>

                    <p class="text-sm text-gray-300 mt-1">
                        Registre la información básica de la pregunta.
                    </p>
                </div>

                <a href="{{ route('testes.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                           text-gray-700 bg-white hover:bg-gray-100
                           transition-colors shadow-sm">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round">

                        <path d="m15 18-6-6 6-6" />

                    </svg>

                    Volver
                </a>

            </div>

            {{-- Errores generales --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex gap-3">

                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>

                        <div>
                            <h3 class="text-sm font-semibold text-red-800">
                                Hay errores en el formulario
                            </h3>

                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            @endif


            {{-- Formulario --}}
            <div class="bg-white rounded-xl shadow-lg p-6">

                <form action="{{ route('testes.preguntas.update', ['teste' => $teste->id,'pregunta' => $pregunta->id]) }}"
                    method="POST"
                    id="preguntaForm">

                    @csrf
                    @method('PUT')

                    {{-- Información de la pregunta --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">

                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-base font-semibold text-gray-800">
                                Información de la pregunta
                            </h2>
                        </div>

                        <div class="p-6 space-y-5">

                            {{-- Pregunta --}}
                            <div>
                                <label for="pregunta"
                                    class="block text-sm font-medium text-gray-700 mb-2">
                                    Pregunta
                                    <span class="text-red-500">*</span>
                                </label>

                                <textarea
                                    name="pregunta"
                                    id="pregunta"
                                    rows="4"
                                    required
                                    class="w-full rounded-lg border-gray-300 shadow-sm text-black px-2 py-3
                                        focus:border-blue-500 focus:ring-blue-500
                                        @error('pregunta') border-red-500 @enderror"
                                    placeholder="Escribe aquí la pregunta...">{{ old('pregunta', $pregunta->pregunta) }}</textarea>

                                @error('pregunta')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Orden y estado --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label for="orden"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Orden
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="number"
                                        name="orden"
                                        id="orden"
                                        min="1"
                                        required
                                        value="{{ old('orden', $pregunta->orden) }}"
                                        class="w-full rounded-lg border-gray-300 shadow-sm text-black px-2 py-3
                                            focus:border-blue-500 focus:ring-blue-500
                                            @error('orden') border-red-500 @enderror">

                                    @error('orden')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                    <p class="mt-1 text-xs text-gray-500">
                                        Define la posición de la pregunta dentro del test.
                                    </p>
                                </div>

                                <div>
                                    <label for="estado"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Estado
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <select
                                        name="estado"
                                        id="estado"
                                        required
                                        class="w-full rounded-lg border-gray-300 shadow-sm text-black px-2 py-3
                                            focus:border-blue-500 focus:ring-blue-500
                                            @error('estado') border-red-500 @enderror">

                                        <option value="Activo"
                                            {{ old('estado', 'Activo') === 'Activo' ? 'selected' : '' }}>
                                            Activo
                                        </option>

                                        <option value="Inactivo"
                                            {{ old('estado') === 'Inactivo' ? 'selected' : '' }}>
                                            Inactivo
                                        </option>

                                    </select>

                                    @error('estado')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- Opciones --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">

                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                                <div>
                                    <h2 class="text-base font-semibold text-gray-800">
                                        Opciones de respuesta
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Agrega entre 3 y 4 opciones y selecciona cuál es la correcta.
                                    </p>
                                </div>

                                <button
                                    type="button"
                                    id="btnAgregarOpcion"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2
                                        text-sm font-medium text-blue-600 bg-blue-50
                                        rounded-lg hover:bg-blue-100 transition-colors cursor-pointer">

                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4v16m8-8H4"/>
                                    </svg>

                                    Agregar opción
                                </button>

                            </div>
                        </div>

                        <div class="p-6">

                            {{-- Contenedor de opciones --}}
                            <div id="opcionesContainer" class="space-y-4">

                            @foreach ($pregunta->opciones as $index => $opcion)

                                <div class="opcion-item border border-gray-200 rounded-lg p-4"
                                    data-index="{{ $index }}"
                                    data-letra="{{ $opcion->letra }}">

                                    <div class="flex items-start gap-4">

                                        {{-- Respuesta correcta --}}
                                        <div class="pt-2">

                                            <input
                                                type="radio"
                                                name="respuesta_correcta"
                                                value="{{ $opcion->letra }}"
                                                id="correcta_{{ $opcion->letra }}"
                                                {{ old(
                                                    'respuesta_correcta',
                                                    $pregunta->opciones->firstWhere('es_correcta', true)?->letra
                                                ) === $opcion->letra ? 'checked' : '' }}
                                                class="w-4 h-4 text-green-600 border-gray-300
                                                    focus:ring-green-500">

                                        </div>


                                        {{-- Letra --}}
                                        <div class="flex-shrink-0">

                                            <div class="w-9 h-9 rounded-full bg-gray-100
                                                        flex items-center justify-center
                                                        font-semibold text-gray-700">

                                                {{ $opcion->letra }}

                                            </div>

                                        </div>


                                        {{-- Texto --}}
                                        <div class="flex-1">


                                            <input
                                                type="hidden"
                                                name="opciones[{{ $index }}][letra]"
                                                value="{{ $opcion->letra }}">


                                            <input
                                                type="text"
                                                name="opciones[{{ $index }}][texto]"
                                                id="opcion_{{ $opcion->letra }}"
                                                value="{{ old(
                                                    "opciones.$index.texto",
                                                    $opcion->texto
                                                ) }}"
                                                maxlength="500"
                                                required
                                                class="w-full rounded-lg border-gray-300 shadow-sm text-black px-2 py-3
                                                    focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="Escribe la opción {{ $opcion->letra }}...">


                                            @error("opciones.$index.texto")

                                                <p class="mt-1 text-sm text-red-600">
                                                    {{ $message }}
                                                </p>

                                            @enderror

                                        </div>


                                        {{-- Eliminar --}}
                                        @if ($index >= 3)

                                            <button
                                                type="button"
                                                class="btnEliminarOpcion mt-7 p-2 text-red-500
                                                    hover:text-red-600 hover:bg-red-50
                                                    rounded-lg transition-colors cursor-pointer"
                                                title="Eliminar opción">

                                                <svg class="w-5 h-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>

                                                </svg>

                                            </button>

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>

                            {{-- Ayuda --}}
                            <div class="mt-5 p-4 bg-blue-50 border border-blue-100 rounded-lg">
                                <div class="flex gap-3">

                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                                    </svg>

                                    <div class="text-sm text-blue-800">
                                        <p class="font-medium">
                                            Selecciona la respuesta correcta
                                        </p>

                                        <p class="mt-1">
                                            Marca el círculo ubicado a la izquierda de la opción
                                            que corresponde a la respuesta correcta.
                                        </p>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                        <a href="{{ route('testes.preguntas.index', $teste) }}"
                        class="inline-flex items-center justify-center px-5 py-2.5
                                text-sm font-medium text-gray-700 bg-white
                                border border-gray-300 rounded-lg
                                hover:bg-gray-50 transition-colors cursor-pointer">
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                                text-sm font-medium text-white bg-blue-600
                                rounded-lg hover:bg-blue-700 transition-colors cursor-pointer">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save-check preview-icon"><path d="M12.5 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10.2a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4v4.35"/><path d="m16 19 2 2 4-4"/><path d="M17 15.13V14a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>

                            Guardar pregunta
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

   <script>
document.addEventListener('DOMContentLoaded', function () {

    const container = document.getElementById('opcionesContainer');
    const btnAgregar = document.getElementById('btnAgregarOpcion');

    const letras = ['A', 'B', 'C', 'D'];


    function obtenerCantidadOpciones() {
        return container.querySelectorAll('.opcion-item').length;
    }


    function actualizarBotonAgregar() {

        const cantidad = obtenerCantidadOpciones();

        if (cantidad >= 4) {
            btnAgregar.classList.add('hidden');
        } else {
            btnAgregar.classList.remove('hidden');
        }
    }


    function crearOpcion(letra, index) {

        const div = document.createElement('div');

        div.className = 'opcion-item border border-gray-200 rounded-lg p-4';

        div.dataset.index = index;
        div.dataset.letra = letra;


        div.innerHTML = `
            <div class="flex items-start gap-4">

                <div class="pt-2">

                    <input
                        type="radio"
                        name="respuesta_correcta"
                        value="${letra}"
                        id="correcta_${letra}"
                        class="w-4 h-4 text-green-600 border-gray-300
                               focus:ring-green-500">

                </div>


                <div class="flex-shrink-0">

                    <div class="w-9 h-9 rounded-full bg-gray-100
                                flex items-center justify-center
                                font-semibold text-gray-700">

                        ${letra}

                    </div>

                </div>


                <div class="flex-1">

                    <input
                        type="hidden"
                        name="opciones[${index}][letra]"
                        value="${letra}">


                    <input
                        type="text"
                        name="opciones[${index}][texto]"
                        id="opcion_${letra}"
                        maxlength="500"
                        required
                        class="w-full rounded-lg border-gray-300 shadow-sm text-black
                               focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Escribe la opción ${letra}...">

                </div>


                <button
                    type="button"
                    class="btnEliminarOpcion mt-7 p-2 text-red-500
                           hover:text-red-600 hover:bg-red-50
                           rounded-lg transition-colors cursor-pointer"
                    title="Eliminar opción">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>

                    </svg>

                </button>

            </div>
        `;


        container.appendChild(div);

        agregarEventoEliminar(div);
    }


    function agregarEventoEliminar(opcion) {

        const boton = opcion.querySelector('.btnEliminarOpcion');

        if (!boton) {
            return;
        }


        boton.addEventListener('click', function () {

            if (obtenerCantidadOpciones() <= 3) {
                return;
            }


            const radio = opcion.querySelector(
                'input[type="radio"]'
            );


            /*
             * Si estamos eliminando la opción seleccionada
             * como correcta, seleccionamos otra automáticamente.
             */
            if (radio && radio.checked) {

                const radios = container.querySelectorAll(
                    'input[name="respuesta_correcta"]'
                );

                let nuevoSeleccionado = null;


                radios.forEach(function (item) {

                    if (item !== radio && !nuevoSeleccionado) {
                        nuevoSeleccionado = item;
                    }

                });


                if (nuevoSeleccionado) {
                    nuevoSeleccionado.checked = true;
                }

            }


            opcion.remove();

            actualizarIndices();

            actualizarBotonAgregar();

        });

    }


    function actualizarIndices() {

        const opciones = container.querySelectorAll('.opcion-item');


        opciones.forEach(function (opcion, index) {

            const letra = letras[index];


            opcion.dataset.index = index;
            opcion.dataset.letra = letra;


            const radio = opcion.querySelector(
                'input[type="radio"]'
            );


            const letraInput = opcion.querySelector(
                'input[type="hidden"]'
            );


            const textoInput = opcion.querySelector(
                'input[type="text"]'
            );


            const label = opcion.querySelector('label');


            const circulo = opcion.querySelector(
                '.w-9.h-9'
            );


            if (radio) {

                radio.value = letra;
                radio.id = `correcta_${letra}`;

            }


            if (letraInput) {

                letraInput.name =
                    `opciones[${index}][letra]`;

                letraInput.value = letra;

            }


            if (textoInput) {

                textoInput.name =
                    `opciones[${index}][texto]`;

                textoInput.id =
                    `opcion_${letra}`;

                textoInput.placeholder =
                    `Escribe la opción ${letra}...`;

            }


            if (label) {

                label.htmlFor =
                    `opcion_${letra}`;

                label.textContent =
                    `Opción ${letra}`;

            }


            if (circulo) {
                circulo.textContent = letra;
            }

        });

    }


    /*
     * Inicializar eventos de eliminación
     * para las opciones existentes.
     */
    container.querySelectorAll('.opcion-item').forEach(function (opcion) {

        agregarEventoEliminar(opcion);

    });


    /*
     * Agregar nueva opción.
     */
    btnAgregar.addEventListener('click', function () {

        const cantidad = obtenerCantidadOpciones();


        if (cantidad >= 4) {
            return;
        }


        const letra = letras[cantidad];


        crearOpcion(letra, cantidad);


        actualizarBotonAgregar();

    });


    actualizarBotonAgregar();

});
</script>
</x-layouts.app>


