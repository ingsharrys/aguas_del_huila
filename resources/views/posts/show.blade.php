<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.header')
        <title>Aguas del Huila |  PDA</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">Plan Departamental de Aguas</h2>
                <p class="text-lg">Inicio </span class="font-bold">/  PDA</span></p>
            </div>
        </div>

        <section class="px-2 lg:px-32 py-8" x-data="{ tab: '{{ $activeTab->slug }}' }">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Columna izquierda: Tabs -->
                <div class="border-r pr-4">
                    <ul class="space-y-2">

                        <li>
                            <button 
                                @click="tab = '{{ $pda->slug }}'" 
                                :class="tab === '{{ $pda->slug }}' ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                {{ $pda->nombre }}
                            </button>
                        </li>

                        @foreach($pdaPosts as $pdaHijo)
                        <li>
                            <button 
                                @click="tab = '{{ $pdaHijo->slug }}'" 
                                :class="tab === '{{ $pdaHijo->slug }}' ? 'bg-[#0047DC] text-white hover:bg-green-500' : 'bg-gray-100 text-gray-700 cursor-pointer'"
                                class="w-full text-left py-2 px-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                {{ $pdaHijo->nombre }}
                            </button>
                        </li>
                        @endforeach

                    </ul>
                </div>

                <!-- Columna derecha: Contenido -->
                <div class="lg:col-span-2">

                    <div x-show="tab === '{{ $pda->slug }}'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">Plan Departamental de Aguas (PDA)</h2>
                        <div class="text-gray-900 leading-relaxed">{!! $pda->contenido !!}</div>
                        @if(isset($archivos[$pda->id]) && $archivos[$pda->id]->count())
                            <h3 class="text-xl font-semibold text-[#0047DC] mb-2">Archivos disponibles:</h3>
                            <ul class="list-disc ml-6">
                                @foreach($archivos[$pda->id] as $archivo)
                                    <li class="flex justify-between py-4">
                                        <div class="flex gap-4 pr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-corner-down-right-icon lucide-corner-down-right text-black"><path d="m15 10 5 5-5 5"/><path d="M4 4v7a4 4 0 0 0 4 4h12"/></svg>
                                            <a href="{{ asset('storage/' . $archivo->archivo) }}" 
                                            class="text-black hover:text-[#0047DC]" target="_blank">
                                                {{ $archivo->nombre }}
                                            </a>
                                        </div>
                                        <a href="{{ asset('storage/' . $archivo->archivo) }}" target="_blank" class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-[#00C81F] hover:bg-green-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg> Descargar</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    @foreach($pdaPosts as $pdaHijo)
                    <div x-show="tab === '{{ $pdaHijo->slug }}'">
                        <h2 class="text-2xl font-bold text-[#0047DC] mb-4">{{ $pdaHijo->nombre }}</h2>

                        <div class="text-gray-900 leading-relaxed">{!! $pdaHijo->contenido !!}</div>

                        @if(isset($archivos[$pdaHijo->id]) && $archivos[$pdaHijo->id]->count())
                            <h3 class="text-xl font-semibold text-[#0047DC] mt-6 mb-3">Archivos disponibles:</h3>
                            <ul class="list-disc ml-6">
                                @foreach($archivos[$pdaHijo->id] as $archivo)
                                    <li class="flex justify-between py-4">
                                        <div class="flex gap-4 pr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-corner-down-right-icon lucide-corner-down-right text-black"><path d="m15 10 5 5-5 5"/><path d="M4 4v7a4 4 0 0 0 4 4h12"/></svg>
                                            <a href="{{ asset('storage/' . $archivo->archivo) }}" 
                                            class="text-black hover:text-[#0047DC]" target="_blank">
                                                {{ $archivo->nombre }}
                                            </a>
                                        </div>
                                        <a href="{{ asset('storage/' . $archivo->archivo) }}" target="_blank" class="flex w-48 px-4 py-2 border-green-700 rounded-lg text-white bg-[#00C81F] hover:bg-green-600 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg> Descargar</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    @endforeach

                </div>
            </div>
        </section>

        @include('partials.footer')

    </body>
</html>
