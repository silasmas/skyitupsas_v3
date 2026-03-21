<x-filament-widgets::widget class="fi-tour-guide-widget">
    <x-filament::section>
        <x-slot name="heading">
            {{ __('Guide d\'utilisation') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Découvrez comment utiliser le panneau d\'administration avec ce tutoriel interactif.') }}
        </x-slot>

        <div class="flex items-center gap-4">
            <div x-data="{}" @click="typeof window.startFilamentTour === 'function' && window.startFilamentTour()">
                <x-filament::button
                    color="primary"
                    icon="heroicon-o-academic-cap"
                    tag="button"
                    type="button"
                >
                    {{ __('Démarrer le tutoriel') }}
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
