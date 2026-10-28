<x-layouts.app :title="__('Crear Servicio')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black text-white">Nueva Servicio</h1>
            
            <a href="{{ route('servicios.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>
        <form 
            action="{{ route('servicios.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg"
        >
            @csrf

            <!-- 🧱 Columna izquierda (70%) -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Título -->
                <div>
                    <label for="titulo" class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
                    <input 
                        type="text" 
                        name="titulo" 
                        id="titulo"
                        value="{{ old('titulo') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el título de la servicio"
                        required
                    >
                </div>

                <!-- Contenido -->
                <div>
                    <label for="contenido" class="block text-sm font-semibold text-gray-700 mb-1">Contenido</label>
                    <textarea 
                        name="contenido" 
                        id="contenido" 
                        rows="15"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none px-2 py-4 text-gray-900"
                        placeholder="Escribe el contenido completo de la servicio..."
                        
                    >{{ old('contenido') }}</textarea>
                </div>
            </div>

            <!-- 🧱 Columna derecha (30%) -->
            <div class="space-y-6">

                <!-- nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        id="nombre"
                        value="{{ old('nombre') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el nombre de la servicio"
                        required
                    >
                </div>

                <!-- Icono -->
                <div>
                    <label for="icono" class="block text-sm font-semibold text-gray-700 mb-1">Icono</label>
                    <div 
                        id="preview-container" 
                        class="w-full h-48 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 overflow-hidden mb-3"
                    >
                        <span id="preview-text-icono" class="text-gray-400">Previsualización</span>
                        <img id="preview-image-icono" class="hidden w-full h-full object-cover" alt="Previsualización">
                    </div>
                    <input 
                        type="file" 
                        name="icono" 
                        id="icono"
                        accept="image/*"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                    >
                    @error('icono')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Imagen Portada -->
                <div>
                    <label for="imagen_portada" class="block text-sm font-semibold text-gray-700 mb-1">Imagen Portada (1200*628px)</label>
                    <div 
                        id="preview-container" 
                        class="w-full h-48 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 overflow-hidden mb-3"
                    >
                        <span id="preview-text" class="text-gray-400">Previsualización</span>
                        <img id="preview-image" class="hidden w-full h-full object-cover" alt="Previsualización">
                    </div>
                    <input 
                        type="file" 
                        name="imagen_portada" 
                        id="imagen_portada"
                        accept="image/*"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                        required
                    >
                    @error('imagen_portada')
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

    <!-- 🧠 Script para previsualizar la icono -->
    <script>
        document.getElementById('icono').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('preview-image-icono');
            const previewText = document.getElementById('preview-text-icono');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewText.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
                previewText.classList.remove('hidden');
            }
        });
    </script>

    <!-- 🧠 Script para previsualizar la imagen -->
    <script>
        document.getElementById('imagen_portada').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('preview-image');
            const previewText = document.getElementById('preview-text');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewText.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
                previewText.classList.remove('hidden');
            }
        });
    </script>

    <!-- 🧠 Script para editor de texto -->
    <script src="https://cdn.tiny.cloud/1/vei68lbtpicw0h1neof21mul0wjhn4c8ls4wgi2icevlq716/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: 'textarea[name=contenido]',
            plugins: 'lists link image table code fullscreen preview media',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code fullscreen preview',
            menubar: false,
            height: 400,
            branding: false,
            content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; }',

            // ⚙️ Configuración de subida de imágenes
            images_upload_url: "{{ route('upload.image') }}",
            automatic_uploads: true,
            file_picker_types: 'image',

            images_upload_credentials: true, // Enviar cookies CSRF

            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },

            // ⚙️ Agrega CSRF token al request (Laravel lo necesita)
            images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', "{{ route('upload.image') }}");
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.setRequestHeader('Accept', 'application/json');

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status < 200 || xhr.status >= 300) {
                        let mensaje = 'Error al subir la imagen (' + xhr.status + ').';
                        try { const r = JSON.parse(xhr.responseText); mensaje = (r.errors && r.errors.file && r.errors.file[0]) || r.message || mensaje; } catch (e) {}
                        reject({ message: mensaje, remove: true });
                        return;
                    }

                    const json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location !== 'string') {
                        reject('Respuesta JSON inválida: ' + xhr.responseText);
                        return;
                    }

                    resolve(json.location);
                };

                xhr.onerror = () => {
                    reject('Error de conexión al subir la imagen.');
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }),
        });
        </script>

</x-layouts.app>
