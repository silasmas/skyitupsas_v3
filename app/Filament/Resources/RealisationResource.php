<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RealisationResource\Pages;
use App\Filament\Resources\RealisationResource\RelationManagers;
use App\Models\Realisation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class RealisationResource extends Resource
{
    use Translatable;

    protected static ?string $model = Realisation::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $modelLabel = 'Réalisation';

    protected static ?string $pluralModelLabel = 'Réalisations';

    protected static ?string $recordTitleAttribute = 'title';

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
                        Forms\Components\FileUpload::make('featured_image')
                            ->image()
                            ->directory('realisations')
                            ->visibility('public'),
                        Forms\Components\TextInput::make('client')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('project_date'),
                        Forms\Components\TextInput::make('project_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Contenu')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->rows(3),
                        Forms\Components\RichEditor::make('content'),
                    ]),
                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\Textarea::make('meta_description')
                            ->rows(3),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Contenu')
                    ->schema([
                        Infolists\Components\ImageEntry::make('featured_image')
                            ->label('Image')
                            ->getStateUsing(fn ($record) => $record->featured_image && Storage::exists($record->featured_image) ? $record->featured_image : null)
                            ->defaultImageUrl(asset('assets/img/watermark.png')),
                        Infolists\Components\TextEntry::make('title')
                            ->label('Titre')
                            ->getStateUsing(fn ($record) => is_array($record->title) ? ($record->title[app()->getLocale()] ?? Arr::first($record->title) ?? '') : (string) $record->title),
                        Infolists\Components\TextEntry::make('description')
                            ->label('Description')
                            ->getStateUsing(fn ($record) => is_array($record->description) ? ($record->description[app()->getLocale()] ?? Arr::first($record->description) ?? '') : (string) $record->description)
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('content')
                            ->label('Contenu')
                            ->getStateUsing(fn ($record) => is_array($record->content) ? ($record->content[app()->getLocale()] ?? Arr::first($record->content) ?? '') : (string) $record->content)
                            ->html()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('client')
                            ->label('Client')
                            ->getStateUsing(fn ($record) => is_array($record->client ?? null) ? (($record->client[app()->getLocale()] ?? Arr::first($record->client)) ?? '') : (string) ($record->client ?? '')),
                        Infolists\Components\TextEntry::make('project_date')->label('Date du projet')->date(),
                        Infolists\Components\TextEntry::make('project_url')
                            ->label('URL du projet')
                            ->url(fn ($state) => filled($state) && ! is_array($state) ? (string) $state : null)
                            ->openUrlInNewTab(),
                    ])
                    ->columns(2),
                Infolists\Components\Section::make('Paramètres')
                    ->schema([
                        Infolists\Components\TextEntry::make('slug'),
                        Infolists\Components\TextEntry::make('sort_order'),
                        Infolists\Components\IconEntry::make('is_active')->boolean(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->circular()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('client')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('project_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRealisations::route('/'),
            'create' => Pages\CreateRealisation::route('/create'),
            'view' => Pages\ViewRealisation::route('/{record}'),
            'edit' => Pages\EditRealisation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getEloquentQuery()->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return static::getPluralModelLabel();
    }
}
