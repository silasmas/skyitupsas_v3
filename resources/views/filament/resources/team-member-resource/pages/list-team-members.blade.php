<x-filament-panels::page
    @class([
        'fi-resource-list-records-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])
>
    <div class="flex flex-col gap-y-6">
        <x-filament-panels::resources.tabs />

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE, scopes: $this->getRenderHookScopes()) }}

        @if($viewLayout === 'grid')
            @php
                $records = $this->getTableRecords();
            @endphp
            @if($records->isEmpty())
                <div class="rounded-xl bg-gray-50 px-4 py-12 text-center dark:bg-white/5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Aucun membre d'équipe</p>
                    <x-filament::button tag="a" href="{{ $this->getResource()::getUrl('create') }}" class="mt-4">
                        Ajouter un membre
                    </x-filament::button>
                </div>
            @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($records as $record)
                    @php
                        $locale = $this->activeLocale ?? app()->getLocale();
                        $name = is_string($record->name) ? $record->name : ($record->getTranslation('name', $locale) ?? '?');
                        $hasValidPicture = $record->picture && \Illuminate\Support\Facades\Storage::disk('public')->exists($record->picture);
                        $parts = array_filter(explode(' ', trim($name ?? '')));
                        $initials = match (true) {
                            empty($parts) => '?',
                            count($parts) >= 2 => strtoupper(mb_substr($parts[0], 0, 1) . mb_substr($parts[array_key_last($parts)], 0, 1)),
                            default => strtoupper(mb_substr($name, 0, min(2, mb_strlen($name)))),
                        };
                    @endphp
                    <x-filament::card class="overflow-hidden flex flex-col">
                        <div class="flex flex-col items-center gap-3 p-4 flex-1">
                            <div class="relative h-32 w-32 shrink-0">
                                @if($hasValidPicture)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($record->picture) }}" alt="{{ $name }}" class="h-32 w-32 rounded-full object-cover ring-2 ring-gray-200 dark:ring-white/10" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                    <div class="hidden absolute inset-0 flex items-center justify-center rounded-full bg-primary-100 text-5xl font-bold text-primary-600 ring-2 ring-gray-200 dark:bg-primary-500/20 dark:text-primary-400 dark:ring-white/10">
                                        {{ $initials }}
                                    </div>
                                @else
                                    <div class="flex h-32 w-32 items-center justify-center rounded-full bg-primary-100 text-5xl font-bold text-primary-600 ring-2 ring-gray-200 dark:bg-primary-500/20 dark:text-primary-400 dark:ring-white/10">
                                        {{ $initials }}
                                    </div>
                                @endif
                            </div>
                            <div class="w-full text-center">
                                <p class="font-semibold text-gray-950 dark:text-white">{{ $name }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ is_string($record->role) ? $record->role : $record->getTranslation('role', $locale) }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-3 dark:border-white/10">
                        <div class="flex flex-nowrap justify-center items-center gap-1">
                            @if($this->getResource()::canView($record))
                                <x-filament::icon-button
                                    tag="a"
                                    href="{{ $this->getResource()::getUrl('view', ['record' => $record]) }}"
                                    icon="heroicon-o-eye"
                                    color="gray"
                                    size="sm"
                                    tooltip="Voir"
                                />
                            @endif
                            @if($this->getResource()::canEdit($record))
                                <x-filament::icon-button
                                    tag="a"
                                    href="{{ $this->getResource()::getUrl('edit', ['record' => $record]) }}"
                                    icon="heroicon-o-pencil-square"
                                    size="sm"
                                    tooltip="Modifier"
                                />
                            @endif
                            @if($this->getResource()::canDelete($record))
                                <x-filament::icon-button
                                    icon="heroicon-o-trash"
                                    color="danger"
                                    size="sm"
                                    tooltip="Supprimer"
                                    wire:click="deleteRecord({{ $record->getKey() }})"
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer ce membre ?"
                                />
                            @endif
                        </div>
                        </div>
                    </x-filament::card>
                @endforeach
            </div>
            @if($records instanceof \Illuminate\Contracts\Pagination\Paginator && $records->hasPages())
                <div class="mt-4">
                    {{ $records->links() }}
                </div>
            @endif
            @endif
        @else
            {{ $this->table }}
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_AFTER, scopes: $this->getRenderHookScopes()) }}
    </div>
</x-filament-panels::page>
