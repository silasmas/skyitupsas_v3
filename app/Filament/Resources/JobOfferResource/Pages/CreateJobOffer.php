<?php

namespace App\Filament\Resources\JobOfferResource\Pages;

use App\Filament\Resources\JobOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJobOffer extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

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
        ];
    }
}
