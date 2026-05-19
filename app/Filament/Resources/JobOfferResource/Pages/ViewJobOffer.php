<?php

namespace App\Filament\Resources\JobOfferResource\Pages;

use App\Filament\Resources\JobOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJobOffer extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = JobOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
