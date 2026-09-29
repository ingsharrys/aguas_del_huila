<x-layouts.app :title="__('Comprobante de Radicación')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="container w-full">
                
            <div class="w-full bg-white rounded-xl shadow-xl overflow-hidden print:shadow-none">
    
                <div class="flex w-full justify-end my-4 px-4">            
                    <a href="{{ route('dashboard.comunicaciones.pqrsdf') }}" class="flex w-48 px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-800 text-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-left-icon lucide-circle-arrow-left"><circle cx="12" cy="12" r="10"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg> Volver</a>
                </div>

                <!-- ================= HEADER ================= -->

                <div class="bg-[#0047DC] text-white">

                    <div class="flex flex-col md:flex-row justify-between items-center gap-6 p-8">

                        <div class="flex items-center gap-5">

                            <img
                                src="{{ asset('storage/img/logo/logo-aguas-2026.jpg') }}"
                                class="w-28 bg-white rounded-lg p-2"
                                alt="Logo">

                            <div>

                                <h1 class="text-2xl font-bold">
                                    Comprobante de Radicación
                                </h1>

                                <p class="text-blue-100">
                                    Aguas del Huila S.A. E.S.P.
                                </p>

                            </div>

                        </div>

                        <div class="text-right">

                            <p class="text-sm uppercase tracking-widest">
                                Código de Radicado
                            </p>

                            <p class="text-3xl font-bold">
                                {{ $pqrs->codigo_radicado }}
                            </p>

                        </div>

                    </div>

                </div>

                <!-- ================= ESTADO ================= -->

                <div class="bg-slate-50 border-y">

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 p-6">

                        <div>

                            <p class="text-sm text-gray-500">
                                Estado
                            </p>

                            <span
                                class="inline-flex mt-2 px-4 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">

                                {{ $pqrs->estado }}

                            </span>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Fecha respuesta
                            </p>

                            <p class="font-semibold mt-2 text-black">

                                {{ $pqrs->fecha_respuesta ?? 'Pendiente' }}

                            </p>

                        </div>
                        
                        <div>

                            <p class="text-sm text-gray-500">
                                Fecha límite de respuesta
                            </p>

                            <p class="font-semibold mt-2 text-black">

                                {{ $pqrs->fecha_limite_respuesta ?? 'Sin fecha límite' }}

                            </p>

                        </div>

                        @if($pqrs->estado == "Cancelada")
                            <p class="text-sm text-gray-500">
                                La PQRSDF fue cancelada y no se puede responder
                            </p>
                        @elseif($pqrs->estado == "Revisión")
                            <p class="text-sm text-gray-500">
                                La PQRSDF se encuentra en Revisión
                            </p>
                        @elseif($pqrs->estado == "Respondida")
                            <p class="text-sm text-gray-500">
                                La PQRSDF ya fue respondida
                            </p>
                        @else
                            <div class="flex w-full justify-center items-center my-4 px-4">            
                                @if($pqrs->area_id && $pqrs->user_id)
                                <button type="button" onclick="abrirModalRespuesta({{ $pqrs->id }})" class="flex w-48 h-fit px-4 py-2 rounded-lg text-white bg-green-600 hover:bg-green-800 text-center justify-center gap-2 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send-icon lucide-send"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"/><path d="m21.854 2.147-10.94 10.939"/></svg> Responder</button>
                                @else
                                <p class="text-sm text-gray-500">
                                    Asigne un área/usuario para habilitar la opción de responder la solicitud.
                                </p>
                                @endif
                            </div>
                        @endif
                        
                        @if($pqrs->estado != "Cancelada")
                            @if(auth()->user()->hasAnyRole(['Administrador', 'Editor']) || auth()->user()->es_jefe)
                            <div class="col-span-2">
                                <p class="text-sm text-gray-500 mb-2">
                                    Asignar usuario encargado y fecha límite de respuesta
                                </p>

                                <!-- SI YA ESTÁ ASIGNADA: MOSTRAR BOTÓN DE REASIGNAR -->
                                @if ($pqrs->user_id && $pqrs->area_id)
                                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-lg border">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800">
                                                Usuario asignado actualmente: 
                                                <span class="text-blue-600">{{ $pqrs->usuario->name ?? 'N/A' }}</span>
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Fecha límite: {{ $pqrs->fecha_limite_respuesta }}
                                            </p>
                                        </div>

                                        @if($pqrs->estado != "Respondida")
                                            <!-- Botón para abrir el Modal -->
                                            <button 
                                                type="button"
                                                onclick="document.getElementById('modalReasignar').classList.remove('hidden')"
                                                class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2.5 rounded-lg font-semibold transition cursor-pointer ml-auto"
                                            >
                                                Reasignar PQR
                                            </button>
                                        @endif
                                    </div>

                                <!-- SI ES LA PRIMERA ASIGNACIÓN: MOSTRAR FORMULARIO DIRECTO -->
                                @else
                                    <form action="{{ route('dashboard.comunicaciones.pqrsdf.asignar', $pqrs->id) }}" method="POST">
                                        @csrf

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-black">
                                            <div>
                                                <select name="user_id" class="w-full border rounded-lg px-4 py-3" required>
                                                    <option value="">Seleccione un usuario</option>
                                                    @foreach ($areas as $area)
                                                        @if ($area->usuarios->count())
                                                            <optgroup label="{{ $area->nombre }}">
                                                                @foreach ($area->usuarios as $usuario)
                                                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <select name="dias" class="w-full border rounded-lg px-4 py-3" required>
                                                    <option value="">Seleccione el plazo</option>
                                                    <option value="1">1 día</option>
                                                    <option value="2">2 días</option>
                                                    <option value="3">3 días</option>
                                                    <option value="5">5 días</option>
                                                    <option value="10">10 días</option>
                                                    <option value="15">15 días</option>
                                                    <option value="20">20 días</option>
                                                    <option value="30">30 días</option>
                                                </select>
                                            </div>

                                            <div>
                                                <button type="submit" class="bg-[#0047DC] hover:bg-[#0037AE] text-white px-8 py-3 rounded-lg font-semibold transition cursor-pointer w-full">
                                                    Asignar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>

                            <!-- MODAL DE REASIGNACIÓN -->
                            <div id="modalReasignar" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4">
                                <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 relative">
                                    
                                    <!-- Header Modal -->
                                    <div class="flex justify-between items-center pb-3 border-b mb-4">
                                        <h3 class="text-lg font-bold text-gray-800">Reasignar PQRSDF</h3>
                                        <button 
                                            type="button" 
                                            onclick="document.getElementById('modalReasignar').classList.add('hidden')"
                                            class="text-gray-400 hover:text-gray-600 text-xl font-bold"
                                        >
                                            &times;
                                        </button>
                                    </div>

                                    <!-- Formulario Reasignar -->
                                    <form action="{{ route('dashboard.comunicaciones.pqrsdf.asignar', $pqrs->id) }}" method="POST" class="space-y-4">
                                        @csrf

                                        <!-- Selección de Usuario -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Nuevo Usuario Encargado <span class="text-red-500">*</span></label>
                                            <select name="user_id" class="w-full border rounded-lg px-4 py-2.5 text-black" required>
                                                <option value="">Seleccione un usuario</option>
                                                @foreach ($areas as $area)
                                                    @if ($area->usuarios->count())
                                                        <optgroup label="{{ $area->nombre }}">
                                                            @foreach ($area->usuarios as $usuario)
                                                                <option value="{{ $usuario->id }}" {{ $pqrs->user_id == $usuario->id ? 'selected' : '' }}>
                                                                    {{ $usuario->name }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Selección de Plazo -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Nuevo Plazo <span class="text-red-500">*</span></label>
                                            <select name="dias" class="w-full border rounded-lg px-4 py-2.5 text-black" required>
                                                <option value="">Seleccione el plazo</option>
                                                <option value="1">1 día</option>
                                                <option value="2">2 días</option>
                                                <option value="3">3 días</option>
                                                <option value="5">5 días</option>
                                                <option value="10">10 días</option>
                                                <option value="15">15 días</option>
                                                <option value="20">20 días</option>
                                                <option value="30">30 días</option>
                                            </select>
                                        </div>

                                        <!-- Campo Motivo de Reasignación -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Motivo de Reasignación <span class="text-red-500">*</span></label>
                                            <textarea 
                                                name="motivo" 
                                                rows="3" 
                                                class="w-full border rounded-lg p-3 text-black text-sm" 
                                                placeholder="Escriba la razón por la cual está reasignando esta PQR..."
                                                required
                                            ></textarea>
                                        </div>

                                        <!-- Footer / Botones Modal -->
                                        <div class="flex justify-end gap-3 pt-3 border-t">
                                            <button 
                                                type="button" 
                                                onclick="document.getElementById('modalReasignar').classList.add('hidden')"
                                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                                            >
                                                Cancelar
                                            </button>
                                            <button 
                                                type="submit" 
                                                class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 font-semibold transition"
                                            >
                                                Confirmar Reasignación
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        @endif

                    </div>

                </div>

                <!-- ================= DATOS PERSONALES ================= -->

                <div class="p-8">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-5">

                        Información del solicitante

                    </h2>

                    @if($pqrs->identificado_anonimo == 'anonimo')

                        <div class="rounded-lg bg-yellow-50 border border-yellow-300 p-5">

                            <p class="font-semibold text-yellow-700">

                                La solicitud fue registrada de forma anónima.

                            </p>

                        </div>

                    @else

                        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Tipo de Solicitante
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->tipo_solicitante }}

                                </p>

                            </div>

                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Tipo de Identificación
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->tipo_identificacion }}

                                </p>

                            </div>

                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Número de Identificación / NIT
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->numero_identificacion }}

                                </p>

                            </div>

                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Nombre completo / Razón social
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    @if($pqrs->nombre_usuario)
                                        {{ $pqrs->nombre_usuario }} {{ $pqrs->apellido_usuario }} 
                                    @else
                                        {{ $pqrs->razon_social }}
                                    @endif

                                </p>

                            </div>
                            
                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Correo electrónico
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->correo_electronico }}

                                </p>

                            </div>
                            
                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    País
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    @if($pqrs->pais == 'Colombia')
                                        {{ $pqrs->pais }}
                                    @else
                                        {{ $pqrs->otro_pais }}
                                    @endif

                                </p>

                            </div>
                            
                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Departamento
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->departamento->nombre ?? 'No especificado' }}

                                </p>

                            </div>
                            
                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Municipio
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->municipio->nombre ?? 'No especificado' }}

                                </p>

                            </div>
                            
                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Dirección
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->direccion }}

                                </p>

                            </div>
                            
                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Teléfono Fijo
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->fijo ?? 'No especificado' }}

                                </p>

                            </div>
                            
                            <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                                <p class="text-sm text-gray-500">
                                    Teléfono Móvil
                                </p>

                                <p class="font-semibold mt-1 text-black">

                                    {{ $pqrs->movil ?? 'No especificado' }}

                                </p>

                            </div>


                        </div>

                    @endif

                </div>

                <!-- ================= DISCAPACIDAD ================= -->

                <div class="px-8 pb-8">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-5">

                        Información adicional

                    </h2>

                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

                        <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                            <p class="text-sm text-gray-500">
                                Presenta discapacidad
                            </p>

                            <p class="font-semibold mt-1 text-black">
                                @if($pqrs->discapacidad == 1)
                                    Sí
                                @else
                                    No
                                @endif
                            </p>

                        </div>

                        <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                            <p class="text-sm text-gray-500">
                                Tipo discapacidad
                            </p>

                            <p class="font-semibold mt-1 text-black">
                                @if($pqrs->tipo_discapacidad)
                                    {{ $pqrs->tipo_discapacidad }}
                                @else
                                    N/A
                                @endif
                            </p>

                        </div>

                        <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                            <p class="text-sm text-gray-500">
                                Otra discapacidad
                            </p>

                            <p class="font-semibold mt-1 text-black">
                                @if($pqrs->otra_discapacidad)
                                    {{ $pqrs->otra_discapacidad }}
                                @else
                                    N/A
                                @endif
                            </p>

                        </div>

                    </div>

                </div>

                <!-- ================= PQRS ================= -->

                <div class="px-8 pb-8">

                    <h2 class="text-xl font-bold text-[#0047DC] mb-5">

                        Información de la solicitud

                    </h2>

                    <div class="space-y-6">

                        <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                            <p class="text-sm text-gray-500">
                                Tipo de PQRSF
                            </p>

                            <p class="font-semibold mt-1 text-black">

                                {{ $pqrs->tipo_pqrsf ?? 'No especificado' }}

                            </p>

                        </div>

                        <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                            <p class="text-sm text-gray-500">
                                Tipo de respuesta
                            </p>

                            <p class="font-semibold mt-1 text-black">
                                {{ $pqrs->tipo_respuesta ?? 'No especificado' }}
                                @if($pqrs->tipo_respuesta == 'WhatsApp')
                                    <span class="block text-sm font-normal text-gray-700">WhatsApp: {{ $pqrs->movil ?? 'No especificado' }}</span>
                                @endif
                            </p>

                        </div>

                        <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                            <p class="text-sm text-gray-500">
                                Asunto
                            </p>

                            <p class="font-semibold mt-1 text-black">

                                {{ $pqrs->asunto ?? 'No especificado' }}

                            </p>

                        </div>

                        <div class="border-b-2 border-black rounded-lg p-4 bg-white">

                            <p class="text-sm text-gray-500">
                                Descripción
                            </p>

                            <p class="font-semibold mt-1 text-black">

                                {{ $pqrs->descripcion ?? 'No especificado' }}

                            </p>

                        </div>

                    </div>

                </div>

                <!-- ================= AUTORIZACIÓN ================= -->

                <div class="flex flex-wrap justify-between border-t bg-slate-50 px-8 py-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center">

                            ✓

                        </div>

                        <p class="text-sm text-black">

                            El usuario autorizó el tratamiento de sus datos personales.

                        </p>

                    </div>

                    <div>
                        <!-- Botón para cancelar PQR -->
                        @if($pqrs->estado !== 'Cancelada' && $pqrs->estado !== 'Respondida')
                            <button  type="button" onclick="document.getElementById('modalCancelar').classList.remove('hidden')" class="bg-red-600 hover:bg-red-700 text-white mt-2 px-4 py-2 rounded-lg text-sm font-semibold transition cursor-pointer" >
                                Cancelar PQRSDF
                            </button>
                        @endif
                        <!-- Mostrar info de cancelacion -->
                        @if($pqrs->estado == 'Cancelada')
                            <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-lg border">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">
                                        Cancelada por: 
                                        <span class="text-blue-600">{{ $pqrs->usuarioCancelado->name ?? 'N/A' }}</span>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Fecha de Cancelación: {{ \Carbon\Carbon::parse($pqrs->fecha_cancelacion)->format('d/m/Y h:i A') }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Motivo: {{ $pqrs->motivo_cancelacion }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
                <!-- ================= Historial de asignacion ================= -->
                @if(auth()->user()->hasAnyRole(['Administrador', 'Editor']) || auth()->user()->es_jefe)
                <div class="border-t bg-[#0047DC] px-8 py-6">
                    <h3 class="text-lg font-bold mb-3 text-white">Historial de Asignaciones</h3>
                </div>
                <div class="border-t bg-slate-50 px-8 py-6">

                    <div class="space-y-3">
                        @forelse ($pqrs->asignaciones as $asignacion)
                            <div class="p-3 border border-blue-100 rounded-lg bg-gray-50 flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">
                                        Asignado a: <span class="text-blue-600">{{ $asignacion->usuarioAsignado->name ?? "Sin Usuario" }}</span> 
                                        ({{ $asignacion->area->nombre }})
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        Asignado por: <strong>
                                            @if ($asignacion->dias == 0)
                                                Sistema
                                            @else
                                                {{ $asignacion->asignadoPor->name }}
                                            @endif
                                        </strong>
                                    </p>
                                    @if ($asignacion->motivo)
                                    <p class="text-xs text-gray-500 mt-1">
                                        Motivo: {{ $asignacion->motivo }}
                                    </p>
                                    @else
                                    <p class="text-xs text-green-800 mt-1">
                                        Primera Asignación
                                    </p>
                                    @endif
                                    <p class="text-xs text-gray-500 mt-1">
                                        Plazo: {{ $asignacion->dias }} días | Fecha Límite: {{ $asignacion->fecha_limite }}
                                    </p>
                                </div>
                                <span class="text-xs text-gray-400">
                                    {{ $asignacion->created_at->format('d/m/Y h:i A') }}
                                </span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No hay asignaciones registradas.</p>
                        @endforelse
                    </div>

                </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Modal responder PQR -->
    <div id="modalRespuesta" class="fixed inset-0 z-50 hidden" aria-hidden="true">
        <!-- Fondo -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="cerrarModalRespuesta()"></div>

        <!-- Contenedor -->
        <div class="relative flex min-h-screen items-center justify-center p-4">

            <div class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white shadow-2xl" >

                <!-- Header -->
                <div class="sticky top-0 z-10 flex items-center justify-between border-b bg-[#0047DC] text-white px-6 py-4">

                    <div>
                        <h2 class="text-xl font-bold">
                            Responder solicitud
                        </h2>

                        <p class="text-sm">
                            Información de la solicitud y respuesta
                        </p>
                    </div>

                    <button type="button" onclick="cerrarModalRespuesta()" class="flex h-9 w-9 items-center justify-center rounded-full text-green-500 hover:bg-gray-100 hover:text-gray-700 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M18 6 6 18"/> <path d="m6 6 12 12"/>
                        </svg>
                    </button>

                </div>


                <!-- Contenido -->
                <div class="p-6">

                    <!-- Información de la solicitud -->
                    <div class="mb-8">

                        <h3 class="mb-4 flex items-center gap-2 text-lg font-semibold text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"/> <path d="M12 16v-4"/> <path d="M12 8h.01"/> </svg>
                            Información de la solicitud
                        </h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                            <!-- Tipo PQRSF -->
                            <div class="rounded-lg bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase text-gray-500">
                                    Tipo de PQRSF
                                </p>

                                <p class="mt-1 font-medium text-gray-800">{{ $pqrs->tipo_pqrsf ?? 'No especificado' }}</p>
                            </div>

                            <!-- Tipo respuesta -->
                            <div class="rounded-lg bg-gray-50 p-4">
                                <p class="text-xs font-semibold uppercase text-gray-500">
                                    Tipo de respuesta
                                </p>

                                <p class="mt-1 font-medium text-gray-800">{{ $pqrs->tipo_respuesta ?? 'No especificada' }}</p>
                            </div>

                            <!-- Asunto -->
                            <div class="rounded-lg bg-gray-50 p-4 md:col-span-2">
                                <p class="text-xs font-semibold uppercase text-gray-500">
                                    Asunto
                                </p>

                                <p class="mt-1 font-medium text-gray-800">{{ $pqrs->asunto ?? 'No especificado' }}</p>
                            </div>

                            <!-- Descripción -->
                            <div class="rounded-lg bg-gray-50 p-4 md:col-span-2">
                                <p class="text-xs font-semibold uppercase text-gray-500">
                                    Descripción
                                </p>

                                <p class="mt-1 font-medium text-gray-800">{{ $pqrs->descripcion ?? 'No especificado' }}</p>
                            </div>

                        </div>

                    </div>


                    <!-- Formulario de respuesta -->
                    <div class="border-t pt-6">

                        <h3 class="mb-4 flex items-center gap-2 text-lg font-semibold text-gray-800">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/> </svg>

                            Respuesta
                        </h3>


                        <form id="formRespuesta" method="POST" action="{{ route('dashboard.comunicaciones.pqrsdf.responder') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- ID PQR -->
                            <input type="hidden" name="pqrsdf_id" value="{{ $pqrs->id }}">
                            <!-- Correo -->
                            @if($pqrs->tipo_respuesta == 'Correo Electrónico')
                            <div id="campoCorreo" class="mb-5" >
                                <label for="correo" class="mb-2 block text-sm font-medium text-gray-700" >Correo electrónico <span class="text-red-500">*</span></label>
                                <input type="email" name="correo" id="correo" class="w-full text-black rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200" value="{{ $pqrs->correo_electronico }}" placeholder="Correo electrónico de envío" >
                            </div>
                            @endif

                            @if(in_array($pqrs->tipo_respuesta, ['Físico / Mensajería', 'Correo Certificado']))
                            <!-- Dirección -->
                            <div id="campoDireccion" class="mb-5" >
                                <label for="direccion" class="mb-2 block text-sm font-medium text-gray-700" >Dirección <span class="text-red-500">*</span></label>
                                <input type="text" name="direccion" id="direccion" class="w-full text-black rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200" value="{{ $pqrs->direccion_mensajeria }}" placeholder="Dirección de envío" >
                            </div>
                            
                            <!-- Empresa de encomiendas -->
                            <div id="campoEmpresa" class="mb-5" >
                                <label for="empresa_encomienda" class="mb-2 block text-sm font-medium text-gray-700" > Empresa de encomiendas <span class="text-red-500">*</span></label>
                                <select name="empresa_encomienda" id="empresa_encomienda" class="w-full text-black rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200">
                                    <option value="">Seleccione una empresa</option>
                                    <option value="Servientrega">Servientrega</option>
                                    <option value="Inter Rapidísimo">Inter Rapidísimo</option>
                                    <option value="Coordinadora">Coordinadora</option>
                                    <option value="Envia">Envia</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <!-- numero de guia -->
                            <div id="campoNumeroGuia" class="mb-5" >
                                <label for="numero_guia" class="mb-2 block text-sm font-medium text-gray-700" >Número de guía <span class="text-red-500">*</span></label>
                                <input type="text" name="numero_guia" id="numero_guia" class="w-full text-black rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200" placeholder="Número de guía de envío" >
                            </div>
                            @endif
                            <!-- Título -->
                            <div class="mb-5">
                                <label for="titulo_respuesta" class="mb-2 block text-sm font-medium text-gray-700" >Título de respuesta <span class="text-red-500">*</span></label>
                                <input type="text" name="titulo_respuesta" id="titulo_respuesta" required class="w-full text-black rounded-lg border border-gray-300 px-4 py-2.5 outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200" placeholder="Título de la respuesta" >
                            </div>
                            <!-- Texto -->
                            <div class="mb-6">
                                <label for="texto_respuesta" class="mb-2 block text-sm font-medium text-gray-700" > Texto de respuesta <span class="text-red-500">*</span> </label>
                                <textarea  name="texto_respuesta"  id="texto_respuesta"  rows="15" class="w-full border-gray-300 rounded-lg shadow-sm resize-none px-2 py-4 text-gray-900 focus:border-green-500 focus:ring-2 focus:ring-green-200" placeholder="Escriba aquí la respuesta a la solicitud..." required >{{ old('texto_respuesta') }}</textarea>
                            </div>
                            @if($pqrs->tipo_respuesta == 'Correo Electrónico')
                            <!-- Documentos adjuntos -->
                            <div class="mb-6">

                                <label for="documentos" class="mb-2 block text-sm font-medium text-gray-700">Documentos adjuntos</label>

                                <div class="rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-green-500 transition">

                                    <input type="file" name="documentos[]" id="documentos" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" class="hidden" >

                                    <label for="documentos" class="block cursor-pointer" >

                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3 text-gray-400" ><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>

                                        <p class="text-sm font-medium text-gray-700">Seleccionar documentos</p>

                                        <p class="mt-1 text-xs text-gray-500">Puedes seleccionar uno o varios archivos</p>

                                        <p class="mt-1 text-xs text-gray-400">PDF, Word, Excel, JPG o PNG</p>

                                    </label>

                                </div>


                                <!-- Archivos seleccionados -->
                                <div id="listaDocumentos" class="mt-3 space-y-2" ></div>

                            </div>
                            @endif
                            <!-- Botones -->
                            <div class="flex justify-end gap-3 border-t pt-5">
                                <button type="button" onclick="cerrarModalRespuesta()" class="rounded-lg border border-gray-300 px-5 py-2.5 font-medium text-gray-700 hover:bg-gray-100 cursor-pointer" > Cancelar </button>
                                <button type="submit" class="flex items-center gap-2 rounded-lg bg-green-600 px-5 py-2.5 font-medium text-white hover:bg-green-700 cursor-pointer" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="m22 2-7 20-4-9-9-4Z"/> <path d="M22 2 11 13"/> </svg>
                                    Enviar respuesta
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Modal de Cancelación -->
    <div id="modalCancelar" class="hidden fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 relative">
            <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4">Cancelar PQRSDF</h3>

            <form action="{{ route('dashboard.comunicaciones.pqrsdf.cancelar', $pqrs->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Motivo de Cancelación <span class="text-red-500">*</span></label>
                    <textarea 
                        name="motivo_cancelacion" 
                        rows="4" 
                        class="w-full border rounded-lg p-3 text-black text-sm" 
                        placeholder="Escriba detalladamente la razón de la cancelación..."
                        required
                    ></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-3 border-t">
                    <button 
                        type="button" 
                        onclick="document.getElementById('modalCancelar').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition cursor-pointer"
                    >
                        Volver
                    </button>
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold transition cursor-pointer"
                    >
                        Confirmar Cancelación
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // ============================================================
        // MODAL
        // ============================================================

        function abrirModalRespuesta(button) {

            const modal = document.getElementById('modalRespuesta');

            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');
        }


        function cerrarModalRespuesta() {

            const modal = document.getElementById('modalRespuesta');

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');
        }


        // Cerrar con tecla ESC
        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                cerrarModalRespuesta();
            }

        });


        // ============================================================
        // DOCUMENTOS
        // ============================================================

        const inputDocumentos = document.getElementById('documentos');
        const listaDocumentos = document.getElementById('listaDocumentos');

        // Lista interna de archivos
        let archivosSeleccionados = new DataTransfer();


        // ============================================================
        // SELECCIONAR ARCHIVOS
        // ============================================================

        inputDocumentos.addEventListener('change', function () {

            const nuevosArchivos = Array.from(this.files);

            nuevosArchivos.forEach(function (archivo) {

                // Verificar si el archivo ya existe
                const existe = Array.from(
                    archivosSeleccionados.files
                ).some(function (archivoExistente) {

                    return (
                        archivoExistente.name === archivo.name &&
                        archivoExistente.size === archivo.size &&
                        archivoExistente.lastModified === archivo.lastModified
                    );

                });


                // Agregar solamente si no existe
                if (!existe) {

                    archivosSeleccionados.items.add(archivo);

                }

            });


            // Actualizar el input
            inputDocumentos.files = archivosSeleccionados.files;


            // Mostrar lista
            mostrarDocumentos();

        });


        // ============================================================
        // MOSTRAR DOCUMENTOS
        // ============================================================

        function mostrarDocumentos() {

            listaDocumentos.innerHTML = '';

            Array.from(archivosSeleccionados.files).forEach(
                function (archivo, index) {

                    const elemento = document.createElement('div');

                    elemento.className =
                        'flex items-center justify-between gap-3 rounded-lg border border-gray-200 bg-gray-50 px-4 py-3';


                    elemento.innerHTML = `

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-green-100">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="text-green-600"
                                >
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" x2="8" y1="13" y2="13"/>
                                    <line x1="16" x2="8" y1="17" y2="17"/>
                                    <polyline points="10 9 9 9 8 9"/>
                                </svg>

                            </div>


                            <div class="min-w-0">

                                <p class="truncate text-sm font-medium text-gray-700">
                                    ${archivo.name}
                                </p>

                                <p class="text-xs text-gray-400">
                                    ${formatearTamano(archivo.size)}
                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            onclick="eliminarDocumento(${index})"
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-red-500 hover:bg-red-100 hover:text-red-700 transition cursor-pointer"
                            title="Eliminar documento"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M3 6h18"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                <line x1="10" x2="10" y1="11" y2="17"/>
                                <line x1="14" x2="14" y1="11" y2="17"/>
                            </svg>

                        </button>

                    `;


                    listaDocumentos.appendChild(elemento);

                }
            );

        }


        // ============================================================
        // ELIMINAR DOCUMENTO
        // ============================================================

        function eliminarDocumento(index) {

            const nuevaLista = new DataTransfer();


            Array.from(archivosSeleccionados.files).forEach(
                function (archivo, i) {

                    if (i !== index) {

                        nuevaLista.items.add(archivo);

                    }

                }
            );


            // Reemplazar lista interna
            archivosSeleccionados = nuevaLista;


            // Actualizar input
            inputDocumentos.files = archivosSeleccionados.files;


            // Actualizar visualización
            mostrarDocumentos();

        }


        // ============================================================
        // FORMATEAR TAMAÑO
        // ============================================================

        function formatearTamano(bytes) {

            if (bytes === 0) {
                return '0 Bytes';
            }


            const unidades = [
                'Bytes',
                'KB',
                'MB',
                'GB'
            ];


            const indice = Math.floor(
                Math.log(bytes) / Math.log(1024)
            );


            return (
                parseFloat(
                    (bytes / Math.pow(1024, indice)).toFixed(2)
                )
                + ' '
                + unidades[indice]
            );

        }

    </script>

    <!-- 🧠 Script para editor de texto -->
    <script src="https://cdn.tiny.cloud/1/vei68lbtpicw0h1neof21mul0wjhn4c8ls4wgi2icevlq716/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: 'textarea[name=texto_respuesta]',
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

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('Error HTTP: ' + xhr.status);
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
