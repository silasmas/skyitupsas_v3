<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
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

class AboutResource extends Resource
{
    use Translatable;

    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $modelLabel = 'À propos';

    protected static ?string $pluralModelLabel = 'À propos';

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
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(3),
                Forms\Components\Section::make('Titres principaux')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('big_title')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('big_title_1')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('big_title_2')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('welcome_title_1')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('welcome_title_2')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Contenu')
                    ->schema([
                        Forms\Components\Textarea::make('content')
                            ->rows(4),
                        Forms\Components\RichEditor::make('content1'),
                        Forms\Components\RichEditor::make('content2'),
                    ]),
                Forms\Components\Section::make('Labels')
                    ->schema([
                        Forms\Components\TextInput::make('experience_label')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('diploma_label')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('expertise_label')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('work_countries_label')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsed(),
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
                        Infolists\Components\TextEntry::make('title')
                            ->label('Titre')
                            ->getStateUsing(fn ($record) => is_array($record->title) ? ($record->title[app()->getLocale()] ?? Arr::first($record->title) ?? '') : (string) $record->title),
                        Infolists\Components\TextEntry::make('subtitle')
                            ->label('Sous-titre')
                            ->getStateUsing(fn ($record) => is_array($record->subtitle) ? ($record->subtitle[app()->getLocale()] ?? Arr::first($record->subtitle) ?? '') : (string) $record->subtitle),
                        Infolists\Components\TextEntry::make('big_title')
                            ->label('Grand titre')
                            ->getStateUsing(fn ($record) => is_array($record->big_title) ? ($record->big_title[app()->getLocale()] ?? Arr::first($record->big_title) ?? '') : (string) $record->big_title),
                        Infolists\Components\TextEntry::make('content')
                            ->label('Contenu')
                            ->getStateUsing(fn ($record) => is_array($record->content) ? ($record->content[app()->getLocale()] ?? Arr::first($record->content) ?? '') : (string) ($record->content ?? ''))
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('content1')
                            ->label('Contenu 1')
                            ->getStateUsing(fn ($record) => is_array($record->content1) ? ($record->content1[app()->getLocale()] ?? Arr::first($record->content1) ?? '') : (string) ($record->content1 ?? ''))
                            ->html()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('content2')
                            ->label('Contenu 2')
                            ->getStateUsing(fn ($record) => is_array($record->content2) ? ($record->content2[app()->getLocale()] ?? Arr::first($record->content2) ?? '') : (string) ($record->content2 ?? ''))
                            ->html()
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'view' => Pages\ViewAbout::route('/{record}'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
