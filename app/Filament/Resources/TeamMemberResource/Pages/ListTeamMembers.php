<?php

namespace App\Filament\Resources\TeamMemberResource\Pages;

use App\Filament\Resources\TeamMemberResource;
use App\Models\TeamMember;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\Url;

class ListTeamMembers extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = TeamMemberResource::class;

    protected static string $view = 'filament.resources.team-member-resource.pages.list-team-members';

    #[Url]
    public string $viewLayout = 'table';

    public function mount(): void
    {
        parent::mount();
        $this->mountTranslatable();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\Action::make('toggleLayout')
                ->label(fn () => $this->viewLayout === 'table' ? 'Vue grille' : 'Vue tableau')
                ->icon(fn () => $this->viewLayout === 'table' ? 'heroicon-o-squares-2x2' : 'heroicon-o-list-bullet')
                ->action(fn () => $this->viewLayout = $this->viewLayout === 'table' ? 'grid' : 'table'),
            Actions\CreateAction::make(),
        ];
    }

    public function deleteRecord(int $id): void
    {
        $record = TeamMember::find($id);
        if ($record && static::getResource()::canDelete($record)) {
            $record->delete();
            $this->redirect(static::getResource()::getUrl('index'));
        }
    }
}
