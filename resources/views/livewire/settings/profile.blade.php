<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {

    public string $nombres = '';
    public string $apellidos = '';
    public string $identificacion = '';
    public string $username = '';
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        $this->nombres = $user->nombres ?? '';
        $this->apellidos = $user->apellidos ?? '';
        $this->identificacion = $user->numero_identificacion ?? '';
        $this->username = $user->username ?? '';
        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'nombres' => [
                'required',
                'string',
                'max:255',
            ],

            'apellidos' => [
                'required',
                'string',
                'max:255',
            ],

            'identificacion' => [
                'required',
                'string',
                'max:50',
                Rule::unique(User::class, 'numero_identificacion')
                    ->ignore($user->id),
            ],

            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class, 'username')
                    ->ignore($user->id),
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ],
        [
            'identificacion.unique' => 'Este número de identificación ya está registrado.',
            'username.unique' => 'Este nombre de usuario ya está registrado.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
        ]);

        // Construir automáticamente el nombre completo
        $name = trim(
            $validated['nombres'] . ' ' . $validated['apellidos']
        );

        $user->fill([
            'nombres' => $validated['nombres'],
            'apellidos' => $validated['apellidos'],
            'numero_identificacion' => $validated['identificacion'],
            'username' => $validated['username'],   
            'name' => $name,
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Actualizar también el valor mostrado en el componente
        $this->name = $name;

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout
    :heading="__('Perfil')"
    :subheading="__('Consulta y actualiza tu información personal.')"
>

    <form
        wire:submit="updateProfileInformation"
        class="my-6 w-full space-y-8 !text-white"
    >

        {{-- ============================================================= --}}
        {{-- INFORMACIÓN PERSONAL                                         --}}
        {{-- ============================================================= --}}

        <div>

            <h3 class="text-lg font-semibold text-white mb-4">
                Información personal
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nombres --}}
                <div class="flex flex-col">
                    <label>Nombres</label>
                    <input wire:model="nombres" type="text" required autocomplete="given-name" placeholder="Ingresa tu nombres" class="bg-white text-black rounded-xl border-1 border-black py-2 px-4"/>
                </div>

                {{-- Apellidos --}}
                <div class="flex flex-col">
                    <label>Apellidos</label>
                    <input wire:model="apellidos" type="text" required autocomplete="family-name" placeholder="Ingresa tu apellidos" class="bg-white text-black rounded-xl border-1 border-black py-2 px-4"/>
                </div>

                {{-- Número de identificación --}}
                <div class="flex flex-col">
                    <label>Número de identificación</label>
                    <input wire:model="identificacion" type="number" required autocomplete="off" placeholder="Ingresa tu Número de identificación" class="bg-white text-black rounded-xl border-1 border-black py-2 px-4"/>
                    @error('identificacion')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                {{-- Usuario --}}
                <div class="flex flex-col">
                    <label>Usuario</label>
                    <input wire:model="username" type="text" required autocomplete="username" placeholder="Ingresa tu usuario" class="bg-white text-black rounded-xl border-1 border-black py-2 px-4"/>
                    @error('username')
                        <span class="text-sm text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                {{-- Correo electrónico --}}
                <div class="md:col-span-2">

                    <div class="flex flex-col">
                        <label>Correo electrónico</label>
                        <input wire:model="email" type="email" required autocomplete="email" placeholder="Ingresa tu Correo electrónico" class="bg-white text-black rounded-xl border-1 border-black py-2 px-4"/>
                        @error('email')
                            <span class="text-sm text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    @if (
                        auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
                        && ! auth()->user()->hasVerifiedEmail()
                    )

                        <div>

                            <flux:text class="mt-4">

                                {{ __('Tu dirección de correo electrónico no está verificada.') }}

                                <flux:link
                                    class="text-sm cursor-pointer text-white"
                                    wire:click.prevent="resendVerificationNotification"
                                >
                                    {{ __('Haz clic aquí para reenviar el correo electrónico de verificación.') }}
                                </flux:link>

                            </flux:text>

                            @if (session('status') === 'verification-link-sent')

                                <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">

                                    {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}

                                </flux:text>

                            @endif

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- ============================================================= --}}
        {{-- INFORMACIÓN INSTITUCIONAL                                    --}}
        {{-- ============================================================= --}}

        <div class="border-t border-gray-200 dark:border-zinc-700 pt-6">

            <h3 class="text-lg font-semibold text-white mb-4">
                Información institucional
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Rol --}}
                <div class="flex flex-col col-span-2">
                    <label>Rol</label>
                    <div class="bg-white rounded-xl border-1 border-black py-2 px-4">
                        <h2 class="text-black">{{ auth()->user()->roles->pluck('name') ?? 'Sin área asignada' }}</h2>
                    </div>
                </div>

                {{-- Área --}}
                <div class="flex flex-col col-span-2">
                    <label>Área</label>
                    <div class="bg-white rounded-xl border-1 border-black py-2 px-4">
                        <h2 class="text-black">{{ auth()->user()->area?->nombre ?? 'Sin área asignada' }}</h2>
                    </div>
                </div>

                {{-- Cargo --}}
                <div class="flex flex-col">
                    <label>Cargo</label>
                    <div class="bg-white rounded-xl border-1 border-black py-2 px-4">
                        <h2 class="text-black">{{ auth()->user()->cargo?->nombre ?? 'Sin cargo asignado' }}</h2>
                    </div>
                </div>

                {{-- Jefe --}}
                <div class="flex flex-col">
                    <label>Jefe</label>
                    <div class="bg-white rounded-xl border-1 border-black py-2 px-4">
                        <h2 class="text-black">{{ auth()->user()->es_jefe ? 'Sí' : 'No' }}</h2>
                    </div>
                </div>

                {{-- Tipo de vinculación --}}
                <div class="flex flex-col">
                    <label>Tipo de vinculación</label>
                    <div class="bg-white rounded-xl border-1 border-black py-2 px-4">
                        <h2 class="text-black">{{ auth()->user()->tipo_vinculacion ?? 'No especificado' }}</h2>
                    </div>
                </div>

                {{-- Fecha de terminación --}}
                <div class="flex flex-col">
                    <label>Fecha de terminación</label>
                    <div class="bg-white rounded-xl border-1 border-black py-2 px-4">
                        <h2 class="text-black">{{ auth()->user()->fecha_terminacion ? \Carbon\Carbon::parse(auth()->user()->fecha_terminacion)->format('d/m/Y') : 'Sin fecha de terminación' }}</h2>
                    </div>
                </div>

                {{-- Estado --}}
                <div class="flex flex-col">
                    <label>Estado</label>
                    <div class="bg-white rounded-xl border-1 border-black py-2 px-4">
                        <h2 class="text-black">{{ auth()->user()->estado }}</h2>
                    </div>
                </div>

                {{-- Fecha de creación --}}
                <div class="flex flex-col">
                    <label>Usuario creado el</label>
                    <div class="bg-white rounded-xl border-1 border-black py-2 px-4">
                        <h2 class="text-black">{{ auth()->user()->created_at?->format('d/m/Y H:i') }}</h2>
                    </div>
                </div>

            </div>

        </div>


        {{-- ============================================================= --}}
        {{-- BOTÓN                                                         --}}
        {{-- ============================================================= --}}

        <div class="flex items-center gap-4">

            <div class="flex items-center justify-end">

                <flux:button
                    variant="primary"
                    type="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-900 cursor-pointer"
                    data-test="update-profile-button"
                >
                    {{ __('Guardar cambios') }}
                </flux:button>

            </div>

            <x-action-message
                class="me-3 text-green-500"
                on="profile-updated"
            >
                {{ __('Guardado.') }}
            </x-action-message>

        </div>

    </form>


    {{-- Eliminar cuenta --}}
    <livewire:settings.delete-user-form />

</x-settings.layout>
</section>
