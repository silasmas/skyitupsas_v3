<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerResource extends Resource
{
    use Translatable;

    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $modelLabel = 'Partenaire';

    protected static ?string $pluralModelLabel = 'Partenaires';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identité')
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                if (filled($state) && blank($get('slug'))) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\TextInput::make('website_url')
                            ->label('Site web')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('partners')
                            ->disk('public')
                            ->visibility('public'),
                        Forms\Components\Toggle::make('open_in_new_tab')
                            ->label('Ouvrir le lien dans un nouvel onglet')
                            ->default(true),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\ImageEntry::make('logo')
                            ->label('Logo')
                            ->disk('public')
                            ->getStateUsing(fn ($record) => $record->logo && Storage::disk('public')->exists($record->logo) ? $record->logo : null),
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nom')
                            ->getStateUsing(fn ($record) => is_array($record->name) ? ($record->name[app()->getLocale()] ?? Arr::first($record->name) ?? '') : (string) $record->name),
                        Infolists\Components\TextEntry::make('website_url')
                            ->label('Site')
                            ->url(fn ($state) => filled($state) ? (string) $state : null)
                            ->openUrlInNewTab(),
                        Infolists\Components\IconEntry::make('is_active')->label('Actif')->boolean(),
                        Infolists\Components\TextEntry::make('sort_order')->label('Ordre'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->disk('public')
                    ->height(40)
                    ->getStateUsing(fn ($record) => $record->logo && Storage::disk('public')->exists($record->logo) ? $record->logo : null),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('website_url')
                    ->label('Site')
                    ->url(fn ($state) => filled($state) ? (string) $state : null)
                    ->openUrlInNewTab()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'view' => Pages\ViewPartner::route('/{record}'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }

    protected static function resolveTranslatableState(mixed $value): string
    {
        if (is_array($value)) {
            return $value[app()->getLocale()] ?? Arr::first($value) ?? '';
        }

        return (string) $value;
    }
}
