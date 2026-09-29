<x-layouts.app :title="__('Importar Archivos')">
    <div class="w-full">
        <div class="flex w-full justify-between mb-4">
            <a href="{{ route('archivos.index') }}" class="flex w-48 px-4 py-2 border-red-700 rounded-lg text-white bg-red-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-arrow-left-icon lucide-square-arrow-left"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
        </div>

        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-xl shadow">

                <div class="border-b px-6 py-4">
                    <h1 class="text-2xl font-bold text-black">
                        Importación Masiva de Archivos
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Importe múltiples documentos mediante un archivo ZIP.
                        Cada carpeta interna deberá llamarse con el ID del Post al
                        cual pertenecen los archivos.
                    </p>

                </div>

                <form
                    action="{{ route('archivos.importar') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="text-black">

                    @csrf

                    <div class="p-6">

                        <label class="block font-semibold mb-2">
                            Archivo ZIP
                        </label>

                        <input
                            type="file"
                            name="zip"
                            accept=".zip"
                            required
                            class="block w-full border rounded-lg p-3">

                        @error('zip')
                            <div class="text-red-600 mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="bg-gray-50 px-6 py-4 flex justify-end">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                            Importar archivos

                        </button>

                    </div>

                </form>

            </div>

        </div>
                
    </div>
</x-layouts.app>
