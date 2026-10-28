<x-layouts.app :title="__('Configuración de correo')">
    @php
        $campo = 'w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 text-gray-900 bg-white';
        $etiqueta = 'block text-sm font-semibold text-gray-700 mb-1';
    @endphp

    <div class="w-full space-y-6">
        <div class="flex w-full justify-between">
            <h1 class="content-center font-black text-white text-2xl">Configuración de correo</h1>
        </div>

        @if(session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-red-800 break-words" role="alert">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-red-800" role="alert">
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach($errors->all() as $mensaje)
                        <li>{{ $mensaje }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Servidor SMTP -->
        <form method="POST" action="{{ route('configuracion.correo.smtp') }}" class="p-5 bg-gray-100 rounded-lg space-y-5">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-300 pb-3">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Servidor SMTP</h2>
                    <p class="text-sm text-gray-600">Cuenta desde la que el sitio envía todos los correos.</p>
                </div>
                <label class="inline-flex items-center gap-2 text-sm font-semibold text-gray-800">
                    <input type="hidden" name="activo" value="0">
                    <input type="checkbox" name="activo" value="1" class="rounded border-gray-300" @checked(old('activo', $smtp?->activo))>
                    Usar esta configuración
                </label>
            </div>

            @unless($smtp?->activo)
                <p class="text-sm rounded-lg bg-yellow-50 border border-yellow-200 text-yellow-800 p-3">
                    Mientras no esté activa, el sitio sigue enviando con la configuración del archivo <code>.env</code> del servidor.
                </p>
            @endunless

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="lg:col-span-2">
                    <label class="{{ $etiqueta }}">Servidor SMTP <span class="text-red-500">*</span></label>
                    <input type="text" name="host" value="{{ old('host', $smtp?->host) }}" required placeholder="mail.aguasdelhuila.gov.co" class="{{ $campo }}">
                </div>
                <div>
                    <label class="{{ $etiqueta }}">Puerto <span class="text-red-500">*</span></label>
                    <input type="number" name="puerto" value="{{ old('puerto', $smtp?->puerto ?? 587) }}" required min="1" max="65535" class="{{ $campo }}">
                </div>
                <div>
                    <label class="{{ $etiqueta }}">Cifrado</label>
                    <select name="cifrado" class="{{ $campo }}">
                        <option value="tls" @selected(old('cifrado', $smtp?->cifrado ?? 'tls') === 'tls')>TLS / STARTTLS (puerto 587)</option>
                        <option value="ssl" @selected(old('cifrado', $smtp?->cifrado) === 'ssl')>SSL (puerto 465)</option>
                        <option value="" @selected(old('cifrado', $smtp?->cifrado ?? 'tls') === '')>Ninguno</option>
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label class="{{ $etiqueta }}">Usuario</label>
                    <input type="text" name="usuario" value="{{ old('usuario', $smtp?->usuario) }}" autocomplete="off" placeholder="notificaciones@aguasdelhuila.gov.co" class="{{ $campo }}">
                </div>
                <div>
                    <label class="{{ $etiqueta }}">Contraseña</label>
                    <input type="password" name="password" value="" autocomplete="new-password" placeholder="{{ $smtp?->password ? '•••••••• (guardada)' : '' }}" class="{{ $campo }}">
                    @if($smtp?->password)
                        <p class="text-xs text-gray-500 mt-1">Déjela vacía para conservar la actual.</p>
                    @endif
                </div>
                <div>
                    <label class="{{ $etiqueta }}">Tiempo de espera (segundos) <span class="text-red-500">*</span></label>
                    <input type="number" name="timeout" value="{{ old('timeout', $smtp?->timeout ?? 30) }}" required min="5" max="120" class="{{ $campo }}">
                </div>
                <div class="lg:col-span-2">
                    <label class="{{ $etiqueta }}">Correo del remitente por defecto <span class="text-red-500">*</span></label>
                    <input type="email" name="remitente_correo" value="{{ old('remitente_correo', $smtp?->remitente_correo) }}" required placeholder="notificaciones@aguasdelhuila.gov.co" class="{{ $campo }}">
                </div>
                <div class="lg:col-span-2">
                    <label class="{{ $etiqueta }}">Nombre del remitente por defecto <span class="text-red-500">*</span></label>
                    <input type="text" name="remitente_nombre" value="{{ old('remitente_nombre', $smtp?->remitente_nombre ?? 'Aguas del Huila S.A. E.S.P.') }}" required class="{{ $campo }}">
                </div>
            </div>

            <div class="flex flex-wrap items-end gap-4 border-t border-gray-300 pt-4">
                <div class="grow max-w-sm">
                    <label class="{{ $etiqueta }}">Enviar correo de prueba a</label>
                    <input type="email" name="correo_prueba" value="{{ old('correo_prueba', auth()->user()->email) }}" class="{{ $campo }}">
                </div>
                <button type="submit" formaction="{{ route('configuracion.correo.probar') }}" formmethod="POST" class="px-5 py-2.5 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700 cursor-pointer">
                    Probar sin guardar
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 cursor-pointer">
                    Guardar SMTP
                </button>
            </div>
        </form>

        <!-- Remitentes por formulario -->
        <form method="POST" action="{{ route('configuracion.correo.remitentes') }}" class="p-5 bg-gray-100 rounded-lg space-y-5">
            @csrf
            @method('PUT')

            <div class="border-b border-gray-300 pb-3">
                <h2 class="text-lg font-bold text-gray-900">Remitente por formulario</h2>
                <p class="text-sm text-gray-600">
                    Si deja el remitente vacío se usa el remitente por defecto del SMTP.
                    El correo del remitente debe estar autorizado en el servidor SMTP (normalmente, el mismo dominio de la cuenta).
                </p>
            </div>

            @foreach(collect($envios)->groupBy('formulario', true) as $formulario => $tipos)
                <h3 class="font-bold text-gray-800">{{ $formulario }}</h3>

                @foreach($tipos as $clave => $envio)
                    @php $remitente = $remitentes[$clave] ?? null; @endphp
                    <div class="rounded-lg border border-gray-200 bg-white p-4 space-y-3">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $envio['nombre'] }}</p>
                            <p class="text-xs text-gray-500">{{ $envio['descripcion'] }}</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="{{ $etiqueta }}">Correo del remitente</label>
                                <input type="email" name="remitentes[{{ $clave }}][remitente_correo]" value="{{ old("remitentes.$clave.remitente_correo", $remitente?->remitente_correo) }}" placeholder="{{ $smtp?->remitente_correo }}" class="{{ $campo }}">
                            </div>
                            <div>
                                <label class="{{ $etiqueta }}">Nombre del remitente</label>
                                <input type="text" name="remitentes[{{ $clave }}][remitente_nombre]" value="{{ old("remitentes.$clave.remitente_nombre", $remitente?->remitente_nombre) }}" placeholder="{{ $smtp?->remitente_nombre }}" class="{{ $campo }}">
                            </div>
                            <div>
                                <label class="{{ $etiqueta }}">Responder a</label>
                                <input type="email" name="remitentes[{{ $clave }}][responder_a]" value="{{ old("remitentes.$clave.responder_a", $remitente?->responder_a) }}" placeholder="Opcional" class="{{ $campo }}">
                            </div>
                            @if($envio['destinatarios'])
                                <div class="md:col-span-3">
                                    <label class="{{ $etiqueta }}">Destinatarios internos</label>
                                    <input type="text" name="remitentes[{{ $clave }}][destinatarios]" value="{{ old("remitentes.$clave.destinatarios", $remitente?->destinatarios) }}" placeholder="info@aguasdelhuila.gov.co, pqrsdf@aguasdelhuila.gov.co" class="{{ $campo }}">
                                    <p class="text-xs text-gray-500 mt-1">Separados por coma. Si lo deja vacío se envía a info@aguasdelhuila.gov.co.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endforeach

            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 cursor-pointer">
                    Guardar remitentes
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
