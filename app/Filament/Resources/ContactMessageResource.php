<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Administration des messages de contact reçus depuis le site public.
 */
class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Site public';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Message contact';

    protected static ?string $pluralModelLabel = 'Messages contact';

    protected static ?string $recordTitleAttribute = 'email';

    /**
     * Les messages proviennent uniquement du site public.
     */
    public static function canCreate(): bool
    {
        return false;
    }

    /**
     * Formulaire d’édition (statut uniquement).
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Traitement')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options(ContactMessage::statusOptions())
                            ->required()
                            ->native(false),
                    ]),
            ]);
    }

    /**
     * Fiche détaillée en lecture seule.
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Expéditeur')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')->label('Nom'),
                        Infolists\Components\TextEntry::make('email')->copyable(),
                        Infolists\Components\TextEntry::make('phone')->label('Téléphone'),
                        Infolists\Components\TextEntry::make('locale')->label('Langue'),
                        Infolists\Components\TextEntry::make('source')
                            ->label('Source')
                            ->formatStateUsing(fn (string $state): string => ContactMessage::sourceOptions()[$state] ?? $state),
                    ])
                    ->columns(2),
                Infolists\Components\Section::make('Message')
                    ->schema([
                        Infolists\Components\TextEntry::make('message')
                            ->label('Contenu')
                            ->columnSpanFull(),
                    ]),
                Infolists\Components\Section::make('Suivi')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')
                            ->label('Statut')
                            ->formatStateUsing(fn (string $state): string => ContactMessage::statusOptions()[$state] ?? $state),
                        Infolists\Components\TextEntry::make('created_at')->dateTime()->label('Reçu le'),
                        Infolists\Components\TextEntry::make('read_at')->dateTime()->label('Lu le'),
                        Infolists\Components\TextEntry::make('ip_address')->label('IP'),
                    ])
                    ->columns(2),
            ]);
    }

    /**
     * Liste des messages.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('source')
                    ->label('Source')
                    ->formatStateUsing(fn (string $state): string => ContactMessage::sourceOptions()[$state] ?? $state),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ContactMessage::statusOptions()[$state] ?? $state),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(ContactMessage::statusOptions()),
                Tables\Filters\SelectFilter::make('source')
                    ->options(ContactMessage::sourceOptions()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * @return array<class-string>
     */
    public static function getRelations(): array
    {
        return [];
    }

    /**
     * @return array<string, class-string>
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
