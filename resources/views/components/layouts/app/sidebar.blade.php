<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-900">
        <flux:sidebar sticky stashable class="border-e border-zinc-700 bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Secciones')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" :class="request()->routeIs('dashboard') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    @role('Administrador|Editor')
                        <flux:navlist.item icon="flag" :href="route('banners.index')" :current="request()->routeIs('banners.*')" :class="request()->routeIs('banners.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Banners') }}</flux:navlist.item>
                        <flux:navlist.item icon="newspaper" :href="route('noticias.index')" :current="request()->routeIs('noticias.*')" :class="request()->routeIs('noticias.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Noticias') }}</flux:navlist.item>
                        <flux:navlist.item icon="folder" :href="route('posts.index')" :current="request()->routeIs('posts.*')" :class="request()->routeIs('posts.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Posts') }}</flux:navlist.item>
                        <flux:navlist.item icon="document" :href="route('archivos.index')" :current="request()->routeIs('archivos.*')" :class="request()->routeIs('archivos.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Archivos') }}</flux:navlist.item>
                        <flux:navlist.item icon="chat-bubble-bottom-center-text" :href="route('comentarios.index')" :current="request()->routeIs('comentarios.*')" :class="request()->routeIs('comentarios.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Comentarios') }}</flux:navlist.item>
                        <flux:navlist.item icon="user" :href="route('funcionarios.index')" :current="request()->routeIs('funcionarios.*')" :class="request()->routeIs('funcionarios.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Funcionarios') }}</flux:navlist.item>
                        <flux:navlist.item icon="users" :href="route('usuarios.index')" :current="request()->routeIs('usuarios.*')" :class="request()->routeIs('usuarios.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Usuarios') }}</flux:navlist.item>
                        @endrole
                        @role('Administrador')
                        <flux:navlist.item icon="server" :href="route('servicios.index')" :current="request()->routeIs('servicios.*')" :class="request()->routeIs('servicios.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Servicios') }}</flux:navlist.item>
                        <flux:navlist.item icon="tag" :href="route('categorias.index')" :current="request()->routeIs('categorias.*')" :class="request()->routeIs('categorias.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Categorias') }}</flux:navlist.item>
                        <flux:navlist.item icon="building-office-2" :href="route('organigrama.index')" :current="request()->routeIs('organigrama.*')" :class="request()->routeIs('organigrama.*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Organigrama') }}</flux:navlist.item>
                        @endrole
                        @role('Administrador|Editor|Extranet')
                        <flux:navlist.item icon="clipboard-document-list" :href="route('dashboard.encuestas')" :current="request()->routeIs('dashboard.encuestas')" :class="request()->routeIs('dashboard.encuestas') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Encuestas') }}</flux:navlist.item>
                        <flux:navlist.item icon="chat-bubble-left-right" :href="route('dashboard.comunicaciones')" :current="request()->routeIs('dashboard.comunicaciones*')" :class="request()->routeIs('dashboard.comunicaciones*') ? 'hover:!bg-gray-200 hover:!text-black' : 'hover:!bg-zinc-800 !text-white'" wire:navigate>{{ __('Comunicaciones') }}</flux:navlist.item>
                        @endrole
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    data-test="sidebar-menu-button"
                    class="bg-blue-100 hover:!bg-blue-200 !text-white"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-blue-700 !text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight text-black">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" class="bg-zinc-900 hover:bg-black text-white" wire:navigate>{{ __('Ajustes') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full bg-zinc-900 hover:bg-black text-white" data-test="logout-button">
                            {{ __('Cerrar Sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight text-black">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" class="bg-zinc-900" wire:navigate>{{ __('Ajustes') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full bg-zinc-900" data-test="logout-button">
                            {{ __('Cerrar Sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
