<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobOfferResource\Pages;
use App\Filament\Resources\JobOfferResource\RelationManagers;
use App\Models\JobOffer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class JobOfferResource extends Resource
{
    use Translatable;

    protected static ?string $model = JobOffer::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Recrutement';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Offre d\'emploi';

    protected static ?string $pluralModelLabel = 'Offres d\'emploi';

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
                        Forms\Components\TextInput::make('title')
                            ->label('Intitulé')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                if (filled($state) && blank($get('slug'))) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\Select::make('contract_type')
                            ->label('Type de contrat')
                            ->options([
                                'cdi' => 'CDI',
                                'cdd' => 'CDD',
                                'stage' => 'Stage',
                                'mission' => 'Mission / prestation',
                                'freelance' => 'Freelance',
                            ])
                            ->native(false),
                        Forms\Components\TextInput::make('location')
                            ->label('Lieu')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Publiée (brouillon si désactivé)')
                            ->default(true),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Date de publication')
                            ->seconds(false)
                            ->native(false),
                        Forms\Components\DateTimePicker::make('closes_at')
                            ->label('Date limite de candidature')
                            ->seconds(false)
                            ->native(false),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Contenu')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Description du poste')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('requirements')
                            ->label('Profil recherché / exigences')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('title')
                            ->label('Intitulé')
                            ->getStateUsing(fn ($record) => is_array($record->title) ? ($record->title[app()->getLocale()] ?? Arr::first($record->title) ?? '') : (string) $record->title),
                        Infolists\Components\TextEntry::make('slug')->label('Slug'),
                        Infolists\Components\TextEntry::make('contract_type')->label('Contrat'),
                        Infolists\Components\TextEntry::make('location')
                            ->label('Lieu')
                            ->getStateUsing(fn ($record) => is_array($record->location) ? ($record->location[app()->getLocale()] ?? Arr::first($record->location) ?? '') : (string) ($record->location ?? '')),
                        Infolists\Components\TextEntry::make('published_at')->dateTime()->label('Publication'),
                        Infolists\Components\TextEntry::make('closes_at')->dateTime()->label('Clôture'),
                        Infolists\Components\IconEntry::make('is_active')->label('Active')->boolean(),
                    ])
                    ->columns(2),
                Infolists\Components\Section::make('Texte')
                    ->schema([
                        Infolists\Components\TextEntry::make('description')
                            ->label('Description')
                            ->getStateUsing(fn ($record) => is_array($record->description) ? ($record->description[app()->getLocale()] ?? Arr::first($record->description) ?? '') : (string) ($record->description ?? ''))
                            ->html()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('requirements')
                            ->label('Exigences')
                            ->getStateUsing(fn ($record) => is_array($record->requirements) ? ($record->requirements[app()->getLocale()] ?? Arr::first($record->requirements) ?? '') : (string) ($record->requirements ?? ''))
                            ->html()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Intitulé')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contract_type')
                    ->label('Contrat')
                    ->badge()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('closes_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('applications_count')
                    ->counts('applications')
                    ->label('Candidatures')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
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
        return [
            RelationManagers\ApplicationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobOffers::route('/'),
            'create' => Pages\CreateJobOffer::route('/create'),
            'view' => Pages\ViewJobOffer::route('/{record}'),
            'edit' => Pages\EditJobOffer::route('/{record}/edit'),
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
