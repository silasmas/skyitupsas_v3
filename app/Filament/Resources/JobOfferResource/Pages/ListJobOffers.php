<?php

namespace App\Filament\Resources\JobOfferResource\Pages;

use App\Filament\Resources\JobOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobOffers extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = JobOfferResource::class;

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
