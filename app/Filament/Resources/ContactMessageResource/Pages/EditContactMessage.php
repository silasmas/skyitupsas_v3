<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactMessage extends EditRecord
{
    protected static string $resource = ContactMessageResource::class;

    /**
     * Actions disponibles lors de l’édition.
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Marque le message comme lu à l’ouverture si encore nouveau.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record instanceof ContactMessage && $this->record->status === ContactMessage::STATUS_NEW) {
            $this->record->update([
                'status' => ContactMessage::STATUS_READ,
                'read_at' => now(),
            ]);
            $data['status'] = ContactMessage::STATUS_READ;
        }

        return $data;
    }
}
