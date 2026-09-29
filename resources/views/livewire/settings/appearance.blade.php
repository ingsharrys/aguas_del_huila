<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Apariencia')" :subheading=" __('Actualiza la configuración de apariencia de tu cuenta.')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance" class="!bg-blue-950">
            <flux:radio value="light" icon="sun" class="!text-white bg-zinc-600 focus:!text-black">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon" class="!text-white bg-zinc-950">{{ __('Dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop" class="!text-white bg-red-950 focus:!text-black">{{ __('Sistema') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
