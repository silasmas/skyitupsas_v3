<?php

namespace App\Filament\Resources\RealisationResource\Pages;

use App\Filament\Resources\RealisationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRealisations extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = RealisationResource::class;

    public function mount(): void
    {
        parent::mount();
        $this->mountTranslatable();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
