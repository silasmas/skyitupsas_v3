<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * Liste des témoignages clients dans Filament.
 */
class ListTestimonials extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = TestimonialResource::class;

    /**
     * Initialise la page et le switcher de locale.
     */
    public function mount(): void
    {
        parent::mount();
        $this->mountTranslatable();
    }

    /**
     * @return array<int, \Filament\Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
