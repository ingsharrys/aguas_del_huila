<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hover:text-[#0047DC]">
    <head>
        @include('partials.header')
        <title>Aguas del Huila - Organigrama - {{ $bloque->nombre }}</title>
    </head>
    <body class="bg-white">

        @include('partials.navbar')

        <!-- banner inicial -->
        <div class="w-full h-[200px] sm:h-[150px] md:h-[200px] lg:h-[300px] overflow-hidden shadow-lg -top-8 bg-center bg-no-repeat bg-cover relative" style="background-image: url('{{ asset('storage/img/banner_seccion.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-l from-slate-50/5 to-[#0047DC]/80 flex flex-col justify-center items-center text-white text-center px-16 md:px-32">
                <h2 class="text-3xl lg:text-5xl font-bold mb-2">{{ $bloque->nombre }}</h2>
                <p class="text-lg">
                    <a href="/" class="hover:text-[#00C81F]">Inicio</a> /
                    <a href="{{ route('transparencia') }}" class="hover:text-[#00C81F]">Institucional</a> /
                    <a class="hover:text-[#00C81F]" href="{{ route('organigrama') }}">Organigrama</a> /
                    <span class="font-bold">{{ $bloque->nombre }}</span>
                </p>
            </div>
        </div>
        
        <div class="px-2 lg:px-32 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                
                <!-- Funcionarios del bloque principal -->
        
                @if($bloque->funcionarios->count())
        
                    @php
                        $cantidadFuncionarios = $bloque->funcionarios->count();
                        $bloqueCompleto = $cantidadFuncionarios > 1;
                    @endphp
        
                    <div class="{{ $bloqueCompleto ? 'lg:col-span-2' : '' }}">
        
                        {{-- Nombre del bloque --}}
                        <div class="bg-white shadow rounded-lg p-6 border-t-8 border-[#0047DC] mb-4">
                            <h2 class="text-2xl font-bold text-[#0047DC]">
                                {{ $bloque->nombre }}
                            </h2>
                        </div>
        
                        <!-- Funcionarios -->
                        <div class="grid grid-cols-1 {{ $bloqueCompleto ? 'lg:grid-cols-2' : '' }} gap-8">
        
                            @foreach($bloque->funcionarios as $funcionario)
        
                                <article class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition">
        
                                    <div class="bg-[#0047DC] text-white p-5">
        
                                        <h3 class="text-xl font-bold">
                                            {{ $funcionario->nombre }}
                                        </h3>
        
                                        <p class="text-sm text-blue-100 mt-1">
                                            {{ $funcionario->cargo }}
                                        </p>
        
                                    </div>
        
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        
                                        <div>
                                            <img
                                                src="{{ asset('storage/'.$funcionario->foto) }}"
                                                class="rounded-xl w-full object-cover aspect-square shadow"
                                                alt="{{ $funcionario->nombre }}"
                                            >
                                        </div>
        
                                        <div>
                                            <div class="text-black text-justify">
                                                {!! $funcionario->descripcion !!}
                                            </div>
                                        </div>
        
                                    </div>
    
                                    <div class="border-t bg-gray-50 px-6 py-4">
        
                                        <div class="grid md:grid-cols-2 gap-4 text-sm">
        
                                            @if($funcionario->telefono)
                                                <div>
                                                    <span class="font-semibold text-[#0047DC]">
                                                        Teléfono
                                                    </span>
        
                                                    <br>
        
                                                    {{ $funcionario->telefono }}
                                                </div>
                                            @endif
        
                                            @if($funcionario->correo)
                                                <div>
                                                    <span class="font-semibold text-[#0047DC]">
                                                        Correo
                                                    </span>
        
                                                    <br>
        
                                                    <a
                                                        href="mailto:{{ $funcionario->correo }}"
                                                        class="text-[#00C81F] hover:underline"
                                                    >
                                                        {{ $funcionario->correo }}
                                                    </a>
                                                </div>
                                            @endif
        
                                        </div>
        
                                    </div>
        
                                </article>
        
                            @endforeach
        
                        </div>
        
                    </div>
        
                @endif
        
        
                <!-- Funcionarios del subbloque -->
        
                @foreach($bloque->children as $subbloque)
        
                    @if($subbloque->funcionarios->count())
        
                        @php
                            $cantidadFuncionarios = $subbloque->funcionarios->count();
                            $subbloqueCompleto = $cantidadFuncionarios > 1;
                        @endphp
        
                        <div class="{{ $subbloqueCompleto ? 'lg:col-span-2' : '' }}">
        
                            <div class="bg-white shadow rounded-lg p-6 border-t-8 border-[#0047DC] mb-4">
        
                                <h2 class="text-2xl font-bold text-[#0047DC]">
                                    {{ $subbloque->nombre }}
                                </h2>
        
                            </div>
        
                            <div class="grid grid-cols-1 {{ $subbloqueCompleto ? 'lg:grid-cols-2' : '' }} gap-8">
        
                                @foreach($subbloque->funcionarios as $funcionario)
        
                                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition">
        
                                        <div class="bg-[#0047DC] text-white p-5">
        
                                            <h3 class="text-xl font-bold">
                                                {{ $funcionario->nombre }}
                                            </h3>
        
                                            <p class="text-sm text-blue-100 mt-1">
                                                {{ $funcionario->cargo }}
                                            </p>
        
                                        </div>
        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        
                                            <div>
        
                                                <img
                                                    src="{{ asset('storage/'.$funcionario->foto) }}"
                                                    class="rounded-xl w-full object-cover aspect-square shadow"
                                                    alt="{{ $funcionario->nombre }}"
                                                >
        
                                            </div>
        
                                            <div>
        
                                                <div class="text-black text-justify">
                                                    {!! $funcionario->descripcion !!}
                                                </div>
        
                                            </div>
        
                                        </div>
        
                                        <div class="border-t bg-gray-50 px-6 py-4">
        
                                            <div class="grid md:grid-cols-2 gap-4 text-sm">
        
                                                @if($funcionario->telefono)
        
                                                    <div>
        
                                                        <span class="font-semibold text-[#0047DC]">
                                                            Teléfono
                                                        </span>
        
                                                        <br>
        
                                                        {{ $funcionario->telefono }}
        
                                                    </div>
        
                                                @endif
        
                                                @if($funcionario->correo)
        
                                                    <div>
        
                                                        <span class="font-semibold text-[#0047DC]">
                                                            Correo
                                                        </span>
        
                                                        <br>
        
                                                        <a
                                                            href="mailto:{{ $funcionario->correo }}"
                                                            class="text-[#00C81F] hover:underline"
                                                        >
                                                            {{ $funcionario->correo }}
                                                        </a>
        
                                                    </div>
        
                                                @endif
        
                                            </div>
        
                                        </div>
        
                                    </article>
        
                                @endforeach
        
                            </div>
        
                        </div>
        
                    @endif
        
                @endforeach
        
            </div>
        </div>

        @include('partials.footer')

    </body>
</html>
