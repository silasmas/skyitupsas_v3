<?php

namespace App\Filament\Resources\ServicePillarResource\Pages;

use App\Filament\Resources\ServicePillarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServicePillar extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ServicePillarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
