<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
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

class BlogResource extends Resource
{
    use Translatable;

    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $modelLabel = 'Article';

    protected static ?string $pluralModelLabel = 'Blog & Actualités';

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
                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options(Blog::TYPES)
                            ->default(Blog::TYPE_BLOG)
                            ->required()
                            ->selectablePlaceholder(false),
                        Forms\Components\FileUpload::make('featured_image')
                            ->image()
                            ->directory('blogs')
                            ->visibility('public'),
                        Forms\Components\DateTimePicker::make('published_at'),
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
                        Forms\Components\Textarea::make('excerpt')
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
                        Infolists\Components\TextEntry::make('excerpt')
                            ->label('Extrait')
                            ->getStateUsing(fn ($record) => is_array($record->excerpt) ? ($record->excerpt[app()->getLocale()] ?? Arr::first($record->excerpt) ?? '') : (string) $record->excerpt)
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('content')
                            ->label('Contenu')
                            ->getStateUsing(fn ($record) => is_array($record->content) ? ($record->content[app()->getLocale()] ?? Arr::first($record->content) ?? '') : (string) $record->content)
                            ->html()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('published_at')->label('Publié le')->dateTime(),
                    ])
                    ->columns(2),
                Infolists\Components\Section::make('Paramètres')
                    ->schema([
                        Infolists\Components\TextEntry::make('slug'),
                        Infolists\Components\TextEntry::make('type')
                            ->label('Type')
                            ->badge()
                            ->formatStateUsing(fn (?string $state): string => Blog::TYPES[$state] ?? (string) $state),
                        Infolists\Components\TextEntry::make('sort_order'),
                        Infolists\Components\IconEntry::make('is_active')->boolean(),
                    ])
                    ->columns(4),
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
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => Blog::TYPES[$state] ?? (string) $state)
                    ->color(fn (?string $state): string => $state === Blog::TYPE_NEWS ? 'warning' : 'primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
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
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options(Blog::TYPES),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'view' => Pages\ViewBlog::route('/{record}'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
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
