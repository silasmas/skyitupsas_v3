<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicePillarResource\Pages;
use App\Filament\Resources\ServicePillarResource\RelationManagers;
use App\Models\ServicePillar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Arr;

/**
 * Resource Filament des piliers stratégiques de services.
 */
class ServicePillarResource extends Resource
{
    use Translatable;

    protected static ?string $model = ServicePillar::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $navigationLabel = 'Piliers services';

    protected static ?string $modelLabel = 'Pilier service';

    protected static ?string $pluralModelLabel = 'Piliers services';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    /**
     * Formulaire de création / édition d'un pilier.
     *
     * @param  Form  $form  Formulaire Filament
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identification')
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('icon')
                            ->maxLength(255)
                            ->placeholder('heroicon-o-...'),
                        Forms\Components\TextInput::make('featured_image')
                            ->label('Image (chemin sous assets/img/)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Contenu stratégique')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre du pilier')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('tagline')
                            ->label('Accroche / citation')
                            ->rows(2)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('client_challenge')
                            ->label('Enjeu client')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('offer_summary')
                            ->label('Notre offre (résumé)')
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('differentiator')
                            ->label('Argumentaire commercial différenciateur')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\Textarea::make('meta_description')
                            ->rows(3),
                    ])
                    ->collapsed(),
            ]);
    }

    /**
     * Fiche de consultation d'un pilier.
     *
     * @param  Infolist  $infolist  Infolist Filament
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Contenu')
                    ->schema([
                        Infolists\Components\TextEntry::make('title')
                            ->label('Titre')
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->title)),
                        Infolists\Components\TextEntry::make('tagline')
                            ->label('Accroche')
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->tagline)),
                        Infolists\Components\TextEntry::make('client_challenge')
                            ->label('Enjeu client')
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->client_challenge)),
                        Infolists\Components\TextEntry::make('offer_summary')
                            ->label('Notre offre')
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->offer_summary)),
                        Infolists\Components\TextEntry::make('differentiator')
                            ->label('Argumentaire')
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->differentiator))
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    /**
     * Liste des piliers.
     *
     * @param  Table  $table  Table Filament
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modules_count')
                    ->label('Modules')
                    ->counts('modules'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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

    /**
     * @return array<class-string>
     */
    public static function getRelations(): array
    {
        return [
            RelationManagers\ModulesRelationManager::class,
        ];
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicePillars::route('/'),
            'create' => Pages\CreateServicePillar::route('/create'),
            'view' => Pages\ViewServicePillar::route('/{record}'),
            'edit' => Pages\EditServicePillar::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getEloquentQuery()->count();
    }

    /**
     * @param  mixed  $value  Valeur traduisible
     */
    protected static function resolveTranslatableState(mixed $value): string
    {
        if (is_array($value)) {
            return $value[app()->getLocale()] ?? Arr::first($value) ?? '';
        }

        return (string) $value;
    }
}
