<?php

namespace App\Filament\Resources\TeamMemberResource\Pages;

use App\Filament\Resources\TeamMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTeamMember extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = TeamMemberResource::class;

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
