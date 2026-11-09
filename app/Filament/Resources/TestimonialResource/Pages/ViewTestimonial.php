<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

/**
 * Consultation d'un témoignage client.
 */
class ViewTestimonial extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = TestimonialResource::class;

    /**
     * @return array<int, \Filament\Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
