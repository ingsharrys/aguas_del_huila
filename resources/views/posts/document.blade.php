<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>{{ $archivo->nombre }}</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] md:h-[250px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-xl lg:text-3xl font-bold mb-2">{{ $archivo->nombre }}</h2>
                <p class="text-md">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('posts.download') }}" class="hover:text-[#00C81F]">Documentos</a> /
                
                    @foreach($breadcrumbs as $index => $crumb)
                            <a class="hover:text-[#00C81F]" href="{{ url('documentos/' . $crumb->slug) }}">
                                {{ $crumb->nombre }}
                            </a> /
                    @endforeach
                    <span class="font-bold">{{ $archivo->nombre }}</span>
                </p>
            </div>
        </div>


        <!-- archivo -->
        <section class="px-2 lg:px-32 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Columna izquierda – Lista de secciones -->
                <aside class="bg-white shadow-md p-4 rounded-lg border-t-8 border-[#0047DC]">
                    <a href="{{ route('posts.file', $post->slug) }}" class="text-lg font-semibold mb-4 text-[#0047DC]">Volver a {{ $post->nombre }}</a>
                </aside>

                <!-- Columna derecha – Contenido -->
                <div class="lg:col-span-2 bg-white shadow-md p-6 rounded-lg">
                    <div class="max-w-6xl mx-auto py-10 px-4">

                        <div class="mb-6">
                            <a href="{{ asset('storage/' . $archivo->archivo) }}"
                            download
                            class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-[#00C81F] hover:bg-green-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg> Descargar</a>
                        </div>

                        @php
                            $url = asset('storage/' . $archivo->archivo);
                            $extension = strtolower(pathinfo($archivo->archivo, PATHINFO_EXTENSION));
                        @endphp

                        <div class="border rounded-lg shadow-lg overflow-hidden">

                            {{-- PDF --}}
                            @if($extension === 'pdf')
                                <iframe src="{{ $url }}" width="100%" height="800px"></iframe>

                            {{-- Imagen --}}
                            @elseif(in_array($extension, ['jpg','jpeg','png','webp']))
                                <img src="{{ $url }}" class="w-full">

                            {{-- Word / Excel --}}
                            @elseif(in_array($extension, ['doc','docx','xls','xlsx','ppt','pptx']))
                                <iframe
                                    src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($url) }}"
                                    width="100%"
                                    height="800px">
                                </iframe>

                            {{-- Otros --}}
                            @else
                                <div class="p-6 text-center">
                                    <p class="mb-4">Este archivo no puede visualizarse directamente.</p>
                                    <a href="{{ $url }}"
                                    class="px-6 py-2 bg-[#00C81F] text-white rounded">
                                        Descargar archivo
                                    </a>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>

                @if($archivo->comentarios)
                <!-- Zona Comentarios -->
                <!-- Columna izquierda -->
                <aside class="bg-white shadow-md p-4 rounded-lg border-t-8 border-[#0047DC]">
                    <div class="bg-blue-50 p-5 rounded-t-lg">

                        <h3 class="font-bold text-[#0047DC]">
                            Inicia
                        </h3>

                        <p class="font-bold text-black">
                            {{ \Carbon\Carbon::parse($archivo->inicio)->format('d/m/Y H:i') }}
                        </p>

                    </div>

                    <div class="bg-blue-50 p-5">

                        <h3 class="font-bold text-[#0047DC]">
                            Finaliza
                        </h3>

                        <p class="font-bold text-black">
                            @if($archivo->fin)
                            {{ \Carbon\Carbon::parse($archivo->fin)->format('d/m/Y H:i') }}
                            @else
                            —
                            @endif
                        </p>

                    </div>

                </aside>

                
                <!-- Columna derecha – Contenido -->
                <div class="lg:col-span-2 bg-white shadow-md p-6 rounded-lg">
                    <div class="max-w-6xl mx-auto px-4">

                        @if(session('success'))
                            <div
                                class="mb-6 flex items-start gap-3 rounded-lg border border-green-300 bg-green-50 p-4 text-green-800"
                                role="alert"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 flex-shrink-0 mt-0.5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 13l4 4L19 7"/>
                                </svg>

                                <div>
                                    <h3 class="font-semibold">Comentario enviado</h3>
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($puedeComentar)

                        <form
                            action="{{ route('archivo.comentario',$archivo) }}"
                            method="POST"
                            class="bg-gray-50 border border-gray-200 rounded-lg p-6 space-y-6">

                            @csrf

                            <div class="grid md:grid-cols-2 gap-5">

                                <div>

                                    <label class="text-[#0047DC] text-sm font-semibold mb-3">
                                        Número de identificación
                                    </label>

                                    <input
                                        type="text"
                                        name="identificacion"
                                        value="{{ old('identificacion') }}"
                                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                                        required>

                                </div>

                                <div>

                                    <label class="text-[#0047DC] text-sm font-semibold mb-3">
                                        Nombre Completo
                                    </label>

                                    <input
                                        type="text"
                                        name="nombre"
                                        value="{{ old('nombre') }}"
                                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                                        required>

                                </div>

                                <div>

                                    <label class="text-[#0047DC] text-sm font-semibold mb-3">
                                        Departamento de nacimiento
                                    </label>

                                    <select
                                        name="departamento_id"
                                        class="block w-full border border-gray-300 rounded-lg px-2 py-4 text-gray-900 focus:ring-2 focus:ring-blue-500"
                                        required
                                    >

                                        <option value="">Seleccione un departamento</option>

                                        @foreach($departamentos as $departamento)

                                            <option
                                                value="{{ $departamento->id }}"
                                                {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}
                                            >
                                                {{ $departamento->nombre }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <div class="mt-5">

                                <label class="text-[#0047DC] text-sm font-semibold mb-3">
                                    Comentario
                                </label>

                                <textarea
                                    name="comentario"
                                    rows="6"
                                    class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 px-2 py-4 text-gray-900"
                                    required>{{ old('comentario') }}</textarea>

                            </div>

                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                                <div class="flex items-start gap-3">
                                    <input
                                        type="checkbox"
                                        id="acepta_terminos"
                                        name="acepta_terminos"
                                        value="1"
                                        required
                                        class="mt-1 rounded border-gray-300 text-[#0047DC] focus:ring-[#0047DC]"
                                    >
                                    <label for="acepta_terminos" class="text-sm text-gray-700 leading-relaxed">
                                        Autorizo el tratamiento de mis datos personales de conformidad con la normativa vigente sobre protección de datos personales.
                                    </label>
                                </div>
                            </div>

                            <button
                                class="mt-5 bg-[#0047DC] text-white px-8 py-3 rounded-lg">

                                Enviar comentario

                            </button>

                        </form>

                        @else

                        <div class="bg-red-50 border border-red-200 rounded-xl p-8 text-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-14 h-14 mx-auto text-red-700 mb-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M8 10h8M8 14h5m-8 7h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>

                            </svg>

                            <h3 class="text-lg font-semibold text-red-700">
                                El plazo para comentarios ha finalizado
                            </h3>

                            <p class="mt-2 text-gray-600">
                                {{ $archivo->nombre }}
                            </p>

                        </div>

                        @endif

                        @if ($errors->any())
                            <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4">
                                <h3 class="font-semibold text-red-700 mb-2">
                                    Se encontraron los siguientes errores:
                                </h3>

                                <ul class="list-disc ml-5 text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mt-12">

                            <h2 class="text-2xl font-bold text-[#0047DC] mb-6">
                                Comentarios ({{ $totalComentarios }})
                            </h2>

                            @forelse($comentarios as $comentario)

                                <article class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-5 hover:shadow-md transition">

                                    <div class="flex items-start justify-between">

                                        <div class="flex items-center gap-4">

                                            <!-- Avatar -->
                                            <div class="w-12 h-12 rounded-full bg-[#0047DC] text-white flex items-center justify-center font-bold text-lg">

                                                {{ strtoupper(substr($comentario->nombre ?? 'C',0,1)) }}

                                            </div>

                                            <div>

                                                <h3 class="font-semibold text-gray-900">
                                                    {{ $comentario->nombre }} - {{ $comentario->departamento?->nombre }}
                                                </h3>

                                                <p class="text-sm text-gray-500">
                                                    {{ $comentario->created_at->format('d/m/Y - h:i A') }}
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="text-gray-700 leading-4 whitespace-pre-line">

                                        {{ $comentario->comentario }}

                                    </div>

                                </article>

                            @empty

                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-8 text-center">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-14 h-14 mx-auto text-[#0047DC] mb-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M8 10h8M8 14h5m-8 7h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>

                                    </svg>

                                    <h3 class="text-lg font-semibold text-[#0047DC]">
                                        Aún no hay comentarios
                                    </h3>

                                    <p class="mt-2 text-gray-600">
                                        Sé el primero en compartir tu opinión sobre este documento.
                                    </p>

                                </div>

                            @endforelse

                            <div class="mt-8">

                                {{ $comentarios->links() }}

                            </div>

                        </div>
                    
                    </div>
                </div>
                    
                @endif
            </div>
        </section>

        @include('partials.footer')

    </body>
</html>
