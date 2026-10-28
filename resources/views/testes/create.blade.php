<x-layouts.app :title="__('Nuevo Test de Conocimiento')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">

            {{-- Encabezado --}}
            <div class="flex flex-wrap w-full justify-between items-center mb-4 gap-3">

                <div>
                    <h1 class="font-black text-white text-xl">
                        Nuevo Test de Conocimiento
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

                <form action="{{ route('testes.store') }}" method="POST">

                    @csrf

                    {{-- Información general --}}
                    <div class="mb-8">

                        <div class="border-b border-gray-200 pb-3 mb-6">

                            <h2 class="text-lg font-bold text-gray-800">
                                Información general
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Información básica que identifica el test.
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
                                    value="{{ old('nombre') }}"
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

                                    <option value="">
                                        Seleccione un estado
                                    </option>

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
                                           @enderror">{{ old('descripcion') }}</textarea>

                                @error('descripcion')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- Información --}}
                    <div class="mb-8">

                        <div class="flex gap-3 p-4 rounded-lg bg-blue-50 border border-blue-100">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="text-blue-600 flex-shrink-0 mt-0.5">

                                <circle cx="12" cy="12" r="10" />

                                <path d="M12 16v-4" />

                                <path d="M12 8h.01" />

                            </svg>

                            <div>

                                <p class="text-sm font-medium text-blue-800">
                                    Siguiente paso
                                </p>

                                <p class="text-sm text-blue-700 mt-1">
                                    Después de crear el test podrá agregar las preguntas
                                    y las opciones de respuesta desde la administración
                                    del test.
                                </p>

                            </div>

                        </div>

                    </div>


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
                                   text-white bg-blue-600
                                   hover:bg-blue-700
                                   transition-colors cursor-pointer">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">

                                <path d="M12 5v14" />
                                <path d="M5 12h14" />

                            </svg>

                            Crear Test

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-layouts.app>
