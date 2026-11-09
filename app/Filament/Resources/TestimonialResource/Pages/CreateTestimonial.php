<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

/**
 * Création d'un témoignage client.
 */
class CreateTestimonial extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

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
        ];
    }
}
