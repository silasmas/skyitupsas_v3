<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

/**
 * Widget dashboard pour lancer le tutoriel interactif (Shepherd).
 */
class TourGuideWidget extends Widget
{
    protected static ?int $sort = -10;

    protected static string $view = 'filament.widgets.tour-guide-widget';

    protected int | string | array $columnSpan = 'full';

    /**
     * Affiche toujours le guide sur le tableau de bord.
     */
    public static function canView(): bool
    {
        return true;
    }

    /**
     * Déclenche le tutoriel côté navigateur (fiable avec Livewire/Filament).
     */
    public function startTour(): void
    {
        $this->js(<<<'JS'
            if (typeof window.startFilamentTour === 'function') {
                window.startFilamentTour();
            } else {
                window.alert('Le tutoriel n\'a pas pu démarrer. Rechargez la page puis réessayez.');
            }
        JS);
    }
}
