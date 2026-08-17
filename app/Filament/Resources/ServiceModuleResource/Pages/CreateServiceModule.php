<?php

namespace App\Filament\Resources\ServiceModuleResource\Pages;

use App\Filament\Resources\ServiceModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceModule extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ServiceModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
