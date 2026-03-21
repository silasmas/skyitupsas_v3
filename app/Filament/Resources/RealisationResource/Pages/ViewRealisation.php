<?php

namespace App\Filament\Resources\RealisationResource\Pages;

use App\Filament\Resources\RealisationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRealisation extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = RealisationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
