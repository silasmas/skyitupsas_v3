<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
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

/**
 * Resource Filament pour gérer les témoignages clients.
 */
class TestimonialResource extends Resource
{
    use Translatable;

    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $modelLabel = 'Témoignage';

    protected static ?string $pluralModelLabel = 'Témoignages';

    protected static ?string $recordTitleAttribute = 'name';

    /**
     * Formulaire de création / édition.
     *
     * @param  Form  $form  Formulaire Filament
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Témoignage')
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Textarea::make('quote')
                            ->label('Citation')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                if (filled($state) && blank($get('slug'))) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\TextInput::make('role')
                            ->label('Fonction')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('company')
                            ->label('Entreprise / organisation')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('photo')
                            ->label('Photo')
                            ->image()
                            ->directory('testimonials')
                            ->disk('public')
                            ->visibility('public'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Ordre')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    /**
     * Infolist de consultation.
     *
     * @param  Infolist  $infolist  Infolist Filament
     * @return Infolist
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\ImageEntry::make('photo')
                            ->label('Photo')
                            ->disk('public')
                            ->getStateUsing(fn ($record) => $record->photo && Storage::disk('public')->exists($record->photo) ? $record->photo : null),
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nom')
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->name)),
                        Infolists\Components\TextEntry::make('role')
                            ->label('Fonction')
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->role)),
                        Infolists\Components\TextEntry::make('company')
                            ->label('Entreprise')
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->company)),
                        Infolists\Components\TextEntry::make('quote')
                            ->label('Citation')
                            ->columnSpanFull()
                            ->getStateUsing(fn ($record) => static::resolveTranslatableState($record->quote)),
                        Infolists\Components\IconEntry::make('is_active')->label('Actif')->boolean(),
                        Infolists\Components\TextEntry::make('sort_order')->label('Ordre'),
                    ])
                    ->columns(2),
            ]);
    }

    /**
     * Table de listing.
     *
     * @param  Table  $table  Table Filament
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->disk('public')
                    ->height(40)
                    ->getStateUsing(fn ($record) => $record->photo && Storage::disk('public')->exists($record->photo) ? $record->photo : null),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company')
                    ->label('Entreprise')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
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
     * @return array<int, mixed>
     */
    public static function getRelations(): array
    {
        return [];
    }

    /**
     * @return array<string, \Filament\Resources\Pages\PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'view' => Pages\ViewTestimonial::route('/{record}'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    /**
     * Résout une valeur traduisible pour l'affichage admin.
     *
     * @param  mixed  $value  Valeur brute (string|array|null)
     * @return string
     */
    protected static function resolveTranslatableState(mixed $value): string
    {
        if (is_array($value)) {
            return $value[app()->getLocale()] ?? Arr::first($value) ?? '';
        }

        return (string) ($value ?? '');
    }
}
