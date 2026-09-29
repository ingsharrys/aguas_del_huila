<x-layouts.app :title="__('Editar Bloque')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black text-white">Editar Bloque</h1>
            
            <a href="{{ route('organigrama.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>

        <form action="{{ route('organigrama.update', $organigrama->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg">
            @csrf
            @method('PUT')
            
            <div class="lg:col-span-2 space-y-6">

                <!-- Título -->
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        id="nombre"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el nombre del bloque"
                        value="{{ old('nombre', $organigrama->nombre) }}"
                        required
                    >
                </div>

                <!-- Orden -->
                <div>
                    <label for="orden" class="block text-sm font-semibold text-gray-700 mb-1">
                        Orden de visualización
                    </label>

                    <input
                        type="number"
                        name="orden"
                        id="orden"
                        min="1"
                        value="{{ old('orden', 1) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                    >

                    <p class="text-xs text-gray-500 mt-2">
                        Entre menor sea el número, primero aparecerá el bloque.
                    </p>
                </div>

            </div>

            <div class="space-y-6">

                <!-- Padre_id -->
                <div>
                    <label for="parent_id" class="block text-sm font-semibold text-gray-700 mb-1">Asociar a un bloque padre</label>
                    <select 
                        name="parent_id" 
                        id="parent_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900 select2-field"
                    >
                        <option value="">-- Ninguno --</option>
                        @foreach ($padres as $padre)
                            <option value="{{ $padre->id }}" {{ old('parent_id') == $padre->id ? 'selected' : '' }}>
                                {{ $padre->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón -->
                <div class="pt-4">
                    <button 
                        type="submit"
                        class="flex text-center justify-center gap-2 w-full bg-blue-600 text-white font-semibold py-2 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-fading-arrow-up-icon lucide-circle-fading-arrow-up"><path d="M12 2a10 10 0 0 1 7.38 16.75"/><path d="m16 12-4-4-4 4"/><path d="M12 16V8"/><path d="M2.5 8.875a10 10 0 0 0-.5 3"/><path d="M2.83 16a10 10 0 0 0 2.43 3.4"/><path d="M4.636 5.235a10 10 0 0 1 .891-.857"/><path d="M8.644 21.42a10 10 0 0 0 7.631-.38"/></svg> Actualizar
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-layouts.app>

