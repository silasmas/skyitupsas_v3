<?php

namespace App\Filament\Resources\ServicePillarResource\Pages;

use App\Filament\Resources\ServicePillarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServicePillar extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = ServicePillarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
