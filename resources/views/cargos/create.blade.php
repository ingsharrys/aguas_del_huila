<x-layouts.app :title="__('Crear Cargo')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black text-white">Nueva Cargo</h1>
            
            <a href="{{ route('cargos.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>
        <form  action="{{ route('cargos.store') }}"  method="POST"  enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre del Cargo <span class="text-red-500">*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre', $cargo->nombre ?? '') }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900">
                @error('nombre') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Estado <span class="text-red-500">*</span></label>
                <select name="estado" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900 bg-white">
                    <option value="1" {{ old('estado', $cargo->estado ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado', $cargo->estado ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <!-- Botón Guardar -->
            <div class="pt-4">
                <button  type="submit" class="flex text-center justify-center gap-2 w-full bg-blue-600 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 cursor-pointer transition">
                    Guardar
                </button>
            </div>

        </form>
    </div>
</x-layouts.app>
