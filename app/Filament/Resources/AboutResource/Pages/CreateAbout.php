<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAbout extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = AboutResource::class;

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
