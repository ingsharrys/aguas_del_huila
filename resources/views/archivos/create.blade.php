<x-layouts.app :title="__('Crear Archivo')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black text-white">Nuevo Archivo</h1>
            
            <a href="{{ route('archivos.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
            @role('Administrador')
                <a href="{{ route('archivos.importar.form') }}" class="flex w-48 px-4 py-2 border-blue-700 rounded-lg text-white bg-blue-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Importar</a>
            @endrole
        </div>
        <form 
            action="{{ route('archivos.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg"
        >
            @csrf

            <!-- 🧱 Columna izquierda (70%) -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Título -->
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        id="nombre"
                        value="{{ old('titulo') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el título de la archivo"
                        required
                    >
                </div>

                <!-- padre -->
                <div>
                    <label for="post_id" class="block text-sm font-semibold text-gray-700 mb-1">Asociar a un post</label>
                    <select 
                        name="post_id" 
                        id="post_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900 select2-field"
                    >
                        <option value="">Seleccionar...</option>
                        @foreach ($posts as $post)
                            <option value="{{ $post->id }}" 
                                {{ old('post_id', $postSeleccionado ?? '') == $post->id ? 'selected' : '' }}>
                                {{ $post->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div x-data="{ comentarios: {{ old('comentarios', 0) ? 'true' : 'false' }} }">

                    <!-- Permitir comentarios -->
                    <div class="mt-5">

                        <label class="flex items-center gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                name="comentarios"
                                value="1"
                                x-model="comentarios"
                                class="w-5 h-5 rounded text-blue-600 border-gray-300 focus:ring-blue-500"
                            >

                            <span class="font-medium text-gray-700">
                                Permitir comentarios ciudadanos
                            </span>

                        </label>

                        <p class="text-xs text-gray-500 mt-2">
                            Si activa esta opción, el documento recibirá comentarios únicamente durante el periodo definido.
                        </p>

                    </div>

                    <!-- Fechas -->
                    <div
                        x-show="comentarios"
                        x-transition
                        class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4"
                    >

                        <div>

                            <label
                                for="inicio"
                                class="block text-sm font-semibold text-gray-700 mb-1"
                            >
                                Fecha de inicio
                            </label>

                            <input
                                type="date"
                                id="inicio"
                                name="inicio"
                                value="{{ old('inicio') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-3 text-black"
                                x-model="fechaInicio"
                            >

                        </div>

                        <div>

                            <label
                                for="fin"
                                class="block text-sm font-semibold text-gray-700 mb-1"
                            >
                                Fecha de cierre
                            </label>

                            <input
                                type="date"
                                id="fin"
                                name="fin"
                                value="{{ old('fin') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-3 text-black"
                                :min="fechaInicio"
                            >

                        </div>

                    </div>

                </div>

            </div>

            <!-- 🧱 Columna derecha (30%) -->
            <div class="space-y-6">

                <!-- Archivo -->
                <div>
                    <label for="archivo" class="block text-sm font-semibold text-gray-700 mb-1">Seleccionar archivo (MAX: 30MB)</label>
                    <input type="file" name="archivo" id="archivo" required
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900">
                    @error('archivo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Botón -->
                <div class="pt-4">
                    <button 
                        type="submit"
                        class="flex text-center justify-center gap-2 w-full bg-blue-600 text-white font-semibold py-2 rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg> Publicar
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
