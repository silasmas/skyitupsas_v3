<?php

namespace App\Filament\Resources\ServiceModuleResource\Pages;

use App\Filament\Resources\ServiceModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceModules extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ServiceModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
