<x-layouts.app :title="__('Editar Funcionario')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black text-white">Editar Funcionario</h1>
            
            <a href="{{ route('funcionarios.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>

        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg">
            @csrf
            @method('PUT')
            
            <div class="lg:col-span-2 space-y-6">

                <!-- Título -->
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre del Funcionario</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        id="nombre"
                        value="{{ old('nombre', $funcionario->nombre) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el nombre del funcionario"
                        required
                    >
                </div>

                <!-- Cargo -->
                <div>
                    <label for="cargo" class="block text-sm font-semibold text-gray-700 mb-1">
                        Cargo
                    </label>

                    <input
                        type="text"
                        name="cargo"
                        id="cargo"
                        value="{{ old('cargo', $funcionario->cargo) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Ej. Gerente General"
                    >
                </div>

                <!-- descripcion -->
                <div>
                    <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-1">Contenido</label>
                    <textarea 
                        name="descripcion" 
                        id="descripcion" 
                        rows="15"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none px-2 py-4 text-gray-900"
                        placeholder="Escribe la descripcion completa del funcionario..."
                        required
                    >{{ old('descripcion', $funcionario->descripcion) }}</textarea>
                </div>

            </div>

            <!-- 🧱 Columna derecha (30%) -->
            <div class="space-y-6">

                <!-- telefono -->
                <div>
                    <label for="telefono" class="block text-sm font-semibold text-gray-700 mb-1">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        id="telefono"
                        value="{{ old('telefono', $funcionario->telefono) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="608 8750000"
                    >
                </div>

                <!-- Correo -->
                <div>
                    <label for="correo" class="block text-sm font-semibold text-gray-700 mb-1">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="correo"
                        id="correo"
                        value="{{ old('correo', $funcionario->correo) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="correo@aguasdelhuila.gov.co"
                    >
                </div>

                <!-- Imagen Portada -->
                <div>
                    <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">Imagen Portada (1200*628px)</label>
                    <div class="mt-2 border rounded-lg p-2 flex items-center justify-center bg-gray-50">
                        <img 
                            id="preview-imagen" 
                            src="{{ $funcionario->foto ? asset('storage/' . $funcionario->foto) : asset('storage/portada-web.jpg') }}" 
                            alt="Previsualización" 
                            class="max-h-48 object-cover rounded-lg"
                        >
                    </div>
                    <input 
                        type="file" 
                        name="foto" 
                        id="foto"
                        accept="image/*"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                    >
                    @error('foto')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bloque -->
                <div>
                    <label for="bloque_id" class="block text-sm font-semibold text-gray-700 mb-1">Bloque</label>
                    <select 
                        name="bloque_id" 
                        id="bloque_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        required
                    >
                        <option value="">-- Seleccione un bloque --</option>
                        @foreach ($bloques as $bloque)
                            <option value="{{ $bloque->id }}" {{ old('bloque_id',$funcionario->bloque_id) == $bloque->id ? 'selected' : '' }}>{{ $bloque->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- orden -->
                <div>
                    <label for="orden" class="block text-sm font-semibold text-gray-700 mb-1">
                        Orden de visualización
                    </label>

                    <input
                        type="number"
                        name="orden"
                        id="orden"
                        min="1"
                        value="{{ old('orden', $funcionario->orden) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                    >
                </div>

                <!-- activo -->
                <div class="pt-2">

                    <label class="flex items-center gap-3 cursor-pointer">

                        <input
                            type="checkbox"
                            name="activo"
                            value="1"
                            {{ old('activo',$funcionario->activo) ? 'checked' : '' }}
                            class="w-5 h-5 rounded text-blue-600 border-gray-300 focus:ring-blue-500"
                        >

                        <span class="font-medium text-gray-700">
                            Funcionario activo
                        </span>

                    </label>

                    <p class="text-xs text-gray-500 mt-2">
                        Si está desactivado, no se mostrará en el organigrama público.
                    </p>

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

    <!-- 🧠 Script para previsualizar la imagen -->
    <script>
        document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-imagen');

            if (file) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(file);
            } else {
                preview.src = "http://localhost:8000/storage/portada-web.jpg";
            }
        });
    </script>

    <!-- 🧠 Script para editor de texto -->
    <script src="https://cdn.tiny.cloud/1/vei68lbtpicw0h1neof21mul0wjhn4c8ls4wgi2icevlq716/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
        tinymce.init({
            selector:'#descripcion',
            plugins: 'lists link table',
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist link ',
            menubar: false,
            height: 400,
            branding: false,
            content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; }',
        });
        </script>
</x-layouts.app>

