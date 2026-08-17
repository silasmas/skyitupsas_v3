<?php

namespace App\Filament\Resources\ServiceModuleResource\Pages;

use App\Filament\Resources\ServiceModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceModule extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ServiceModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
