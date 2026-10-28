<x-layouts.app :title="__('Editar Test de Conocimiento')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            {{-- Encabezado --}}
            <div class="flex flex-wrap w-full justify-between items-center mb-4 gap-3">

                <div>
                    <h1 class="font-black text-white text-xl">
                        Editar Test de Conocimiento
                    </h1>

                    <p class="text-sm text-gray-300 mt-1">
                        Registre la información básica del test.
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


            {{-- Formulario --}}
            <div class="bg-white rounded-xl shadow-lg p-6">

                <form action="{{ route('testes.update', $testis->id) }}" method="POST">

                    @csrf
                    @method('PUT')


                    {{-- Información general --}}
                    <div class="mb-8">

                        <div class="border-b border-gray-200 pb-3 mb-6">

                            <h2 class="text-lg font-bold text-gray-800">
                                Información general
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Actualice la información básica que identifica el test.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Nombre --}}
                            <div>

                                <label for="nombre"
                                    class="block text-sm font-medium text-gray-700 mb-1">

                                    Nombre del test
                                    <span class="text-red-500">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="nombre"
                                    id="nombre"
                                    value="{{ old('nombre', $testis->nombre) }}"
                                    required
                                    maxlength="255"
                                    placeholder="Ej. Test de Conocimiento Ambiental"
                                    class="w-full px-3 py-2 border border-gray-300 text-black
                                           rounded-lg text-sm
                                           focus:ring-blue-500 focus:border-blue-500
                                           @error('nombre')
                                               border-red-500
                                           @enderror">

                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- Estado --}}
                            <div>

                                <label for="estado"
                                    class="block text-sm font-medium text-gray-700 mb-1">

                                    Estado
                                    <span class="text-red-500">*</span>

                                </label>

                                <select
                                    name="estado"
                                    id="estado"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 text-black
                                           rounded-lg text-sm
                                           focus:ring-blue-500 focus:border-blue-500
                                           @error('estado')
                                               border-red-500
                                           @enderror">

                                    <option value="Activo"
                                        {{ old('estado', $testis->estado) === 'Activo' ? 'selected' : '' }}>
                                        Activo
                                    </option>

                                    <option value="Inactivo"
                                        {{ old('estado', $testis->estado) === 'Inactivo' ? 'selected' : '' }}>
                                        Inactivo
                                    </option>

                                </select>

                                @error('estado')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Descripción --}}
                            <div class="md:col-span-2">

                                <label for="descripcion"
                                    class="block text-sm font-medium text-gray-700 mb-1">

                                    Descripción

                                </label>

                                <textarea
                                    name="descripcion"
                                    id="descripcion"
                                    rows="5"
                                    placeholder="Escriba una descripción del test..."
                                    class="w-full px-3 py-2 border border-gray-300 text-black
                                           rounded-lg text-sm
                                           focus:ring-blue-500 focus:border-blue-500
                                           @error('descripcion')
                                               border-red-500
                                           @enderror">{{ old('descripcion', $testis->descripcion) }}</textarea>

                                @error('descripcion')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- Información del test --}}
                    <div class="mb-8">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            {{-- Preguntas --}}
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">

                                <p class="text-sm text-gray-500">
                                    Preguntas
                                </p>

                                <p class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ $testis->preguntas()->count() }}
                                </p>

                            </div>


                            {{-- Intentos --}}
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">

                                <p class="text-sm text-gray-500">
                                    Intentos
                                </p>

                                <p class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ $testis->intentos()->count() }}
                                </p>

                            </div>


                            {{-- Creado --}}
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">

                                <p class="text-sm text-gray-500">
                                    Creado
                                </p>

                                <p class="text-base font-semibold text-gray-800 mt-2">
                                    {{ $testis->created_at?->format('d/m/Y H:i') }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Advertencia si tiene resultados --}}
                    @if ($testis->intentos()->exists())

                        <div class="mb-8 flex gap-3 p-4 rounded-lg
                                    bg-yellow-50 border border-yellow-200">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="text-yellow-600 flex-shrink-0 mt-0.5">

                                <path d="M10.3 2.9 1.8 17a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0Z" />

                                <path d="M12 9v4" />

                                <path d="M12 17h.01" />

                            </svg>

                            <div>

                                <p class="text-sm font-medium text-yellow-800">
                                    Este test tiene resultados registrados
                                </p>

                                <p class="text-sm text-yellow-700 mt-1">
                                    Los cambios realizados aquí no modificarán los
                                    resultados históricos de los participantes.
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- Botones --}}
                    <div class="flex flex-col-reverse sm:flex-row
                                justify-end gap-3
                                border-t border-gray-200 pt-6">

                        <a href="{{ route('testes.index') }}"
                            class="inline-flex items-center justify-center
                                   px-5 py-2.5 rounded-lg
                                   text-gray-700 bg-gray-100
                                   hover:bg-gray-200
                                   transition-colors">

                            Cancelar

                        </a>

                        <button type="submit"
                            class="inline-flex items-center justify-center
                                   gap-2 px-5 py-2.5 rounded-lg
                                   text-white bg-green-600
                                   hover:bg-green-700
                                   transition-colors cursor-pointer">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save-check preview-icon"><path d="M12.5 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10.2a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4v4.35"/><path d="m16 19 2 2 4-4"/><path d="M17 15.13V14a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>

                            Guardar cambios

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-layouts.app>
