<x-layouts.app :title="__('Crear Banner')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black text-white">Nuevo Banner</h1>
            
            <a href="{{ route('banners.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>
        <form 
            action="{{ route('banners.store') }}" 
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
                        placeholder="Escribe el título de la banner"
                        required
                    >
                </div>

                <!-- subTítulo -->
                <div>
                    <label for="subtitulo" class="block text-sm font-semibold text-gray-700 mb-1">Subtítulo</label>
                    <input 
                        type="text" 
                        name="subtitulo" 
                        id="subtitulo"
                        value="{{ old('subtitulo') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el subtítulo de la banner"
                    >
                </div>

                <!-- boton -->
                <div>
                    <label for="boton" class="block text-sm font-semibold text-gray-700 mb-1">Botón</label>
                    <input 
                        type="text" 
                        name="boton" 
                        id="boton"
                        value="{{ old('boton') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el texto del boton del banner"
                    >
                </div>

                <!-- enlace -->
                <div>
                    <label for="enlace" class="block text-sm font-semibold text-gray-700 mb-1">Enlace</label>
                    <input 
                        type="text" 
                        name="enlace" 
                        id="enlace"
                        value="{{ old('enlace') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el enlace del botón"
                    >
                </div>


            </div>

            <!-- 🧱 Columna derecha (30%) -->
            <div class="space-y-6">

                <!-- Imagen Portada -->
                <div>
                    <label for="imagen" class="block text-sm font-semibold text-gray-700 mb-1">Imagen del banner (1350*400px)</label>
                    <div 
                        id="preview-container" 
                        class="w-full h-48 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 overflow-hidden mb-3"
                    >
                        <span id="preview-text" class="text-gray-400">Previsualización</span>
                        <img id="preview-image" class="hidden w-full h-full object-cover" alt="Previsualización">
                    </div>
                    <input 
                        type="file" 
                        name="imagen" 
                        id="imagen"
                        accept="image/*"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                        required
                    >
                    @error('imagen')
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

    <!-- 🧠 Script para previsualizar la imagen -->
    <script>
        document.getElementById('imagen').addEventListener('change', function(event) {
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

</x-layouts.app>
