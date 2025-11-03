<x-layouts.app :title="__('Editar Banner')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <h1 class="text-center content-center font-black">Editar Banner</h1>
            
            <a href="{{ route('banners.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>

        <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-5 bg-gray-100 rounded-lg">
            @csrf
            @method('PUT')
            
            <div class="lg:col-span-2 space-y-6">

                <!-- Título -->
                <div>
                    <label for="titulo" class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
                    <input 
                        type="text" 
                        name="titulo" 
                        id="titulo"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el título de la banner"
                        value="{{ old('titulo', $banner->titulo) }}"
                        required
                    >
                </div>

                <!-- subtitulo -->
                <div>
                    <label for="subtitulo" class="block text-sm font-semibold text-gray-700 mb-1">Subtítulo</label>
                    <input 
                        type="text" 
                        name="subtitulo" 
                        id="subtitulo"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el subtítulo del banner"
                        value="{{ old('subtitulo', $banner->subtitulo) }}"
                        required
                    >
                </div>

                <!-- boton -->
                <div>
                    <label for="boton" class="block text-sm font-semibold text-gray-700 mb-1">botón</label>
                    <input 
                        type="text" 
                        name="boton" 
                        id="boton"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el texto del botón del banner"
                        value="{{ old('boton', $banner->boton) }}"
                        required
                    >
                </div>

                <!-- enlace -->
                <div>
                    <label for="enlace" class="block text-sm font-semibold text-gray-700 mb-1">Enlace</label>
                    <input 
                        type="text" 
                        name="enlace" 
                        id="enlace"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-4 text-gray-900"
                        placeholder="Escribe el enlace del botón"
                        value="{{ old('enlace', $banner->enlace) }}"
                        required
                    >
                </div>


            </div>

            <div class="space-y-6">

                <!-- Imagen Portada -->
                <div>
                    <label for="imagen" class="block text-sm font-semibold text-gray-700 mb-1">Imagen Portada</label>
                    <div class="mt-2 border rounded-lg p-2 flex items-center justify-center bg-gray-50">
                        <img 
                            id="preview-imagen" 
                            src="{{ $banner->imagen ? asset('storage/' . $banner->imagen) : asset('storage/portada-web.jpg') }}" 
                            alt="Previsualización" 
                            class="max-h-48 object-cover rounded-lg"
                        >
                    </div>
                    <input 
                        type="file" 
                        name="imagen" 
                        id="imagen"
                        accept="image/*"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                    >
                </div>

                <!-- Estado del banner -->
                <div>
                    <label for="activo" class="block text-sm font-semibold text-gray-700 mb-2">Estado del banner</label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="activo" 
                            id="activo" 
                            value="1" 
                            class="sr-only peer"
                            {{ old('activo', $banner->activo) ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-red-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-red-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600"></div>
                        <span class="ml-3 text-sm font-medium text-red-700 peer-checked:text-green-600">
                            {{ old('activo', $banner->activo) ? 'Activo' : 'Inactivo' }}
                        </span>
                    </label>
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

    <!-- 🧠 Script para previsualizar la imagen -->
    <script>
        document.getElementById('imagen').addEventListener('change', function(event) {
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

    <!-- Script para el estado -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkbox = document.getElementById("activo");
        const label = checkbox.closest("label").querySelector("span");

        checkbox.addEventListener("change", function () {
            label.textContent = this.checked ? "Activo" : "Inactivo";
        });
    });
    </script>

</x-layouts.app>

