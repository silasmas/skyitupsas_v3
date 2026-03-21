<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TourGuideWidget extends Widget
{
    protected static ?int $sort = 0;

    protected static string $view = 'filament.widgets.tour-guide-widget';

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return true;
    }
}
