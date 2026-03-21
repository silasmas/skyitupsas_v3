<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Filament\Resources\TeamMemberResource\RelationManagers;
use App\Models\TeamMember;
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

class TeamMemberResource extends Resource
{
    use Translatable;

    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $modelLabel = 'Membre d\'équipe';

    protected static ?string $pluralModelLabel = 'Membres d\'équipe';

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
                        Forms\Components\FileUpload::make('picture')
                            ->image()
                            ->directory('team-members')
                            ->disk('public')
                            ->visibility('public'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                if (filled($state) && blank($get('slug'))) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\TextInput::make('role')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Réseaux sociaux')
                    ->schema([
                        Forms\Components\TextInput::make('facebook')->url()->maxLength(255),
                        Forms\Components\TextInput::make('twitter')->url()->maxLength(255),
                        Forms\Components\TextInput::make('instagram')->url()->maxLength(255),
                        Forms\Components\TextInput::make('linkedin')->url()->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsed(),
                Forms\Components\Section::make('Profil')
                    ->schema([
                        Forms\Components\Repeater::make('assets')
                            ->simple(Forms\Components\TextInput::make('item')->required())
                            ->formatStateUsing(fn ($state) => is_array($state) ? collect($state)->map(fn ($v) => ['item' => is_array($v) ? ($v['item'] ?? $v) : $v])->values()->all() : [])
                            ->dehydrateStateUsing(fn ($state) => collect($state ?? [])->pluck('item')->filter()->values()->all())
                            ->defaultItems(0),
                        Forms\Components\Repeater::make('experience')
                            ->simple(Forms\Components\TextInput::make('item')->required())
                            ->formatStateUsing(fn ($state) => is_array($state) ? collect($state)->map(fn ($v) => ['item' => is_array($v) ? ($v['item'] ?? $v) : $v])->values()->all() : [])
                            ->dehydrateStateUsing(fn ($state) => collect($state ?? [])->pluck('item')->filter()->values()->all())
                            ->defaultItems(0),
                        Forms\Components\Repeater::make('diplomas')
                            ->simple(Forms\Components\TextInput::make('item')->required())
                            ->formatStateUsing(fn ($state) => is_array($state) ? collect($state)->map(fn ($v) => ['item' => is_array($v) ? ($v['item'] ?? $v) : $v])->values()->all() : [])
                            ->dehydrateStateUsing(fn ($state) => collect($state ?? [])->pluck('item')->filter()->values()->all())
                            ->defaultItems(0),
                        Forms\Components\Repeater::make('expertises')
                            ->simple(Forms\Components\TextInput::make('item')->required())
                            ->formatStateUsing(fn ($state) => is_array($state) ? collect($state)->map(fn ($v) => ['item' => is_array($v) ? ($v['item'] ?? $v) : $v])->values()->all() : [])
                            ->dehydrateStateUsing(fn ($state) => collect($state ?? [])->pluck('item')->filter()->values()->all())
                            ->defaultItems(0),
                        Forms\Components\Repeater::make('work_countries')
                            ->simple(Forms\Components\TextInput::make('item')->required())
                            ->formatStateUsing(fn ($state) => is_array($state) ? collect($state)->map(fn ($v) => ['item' => is_array($v) ? ($v['item'] ?? $v) : $v])->values()->all() : [])
                            ->dehydrateStateUsing(fn ($state) => collect($state ?? [])->pluck('item')->filter()->values()->all())
                            ->defaultItems(0),
                    ])
                    ->columns(1)
                    ->collapsed(),
                Forms\Components\Section::make('Paramètres')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Identité')
                    ->schema([
                        Infolists\Components\ImageEntry::make('picture')
                            ->label('Photo')
                            ->circular()
                            ->disk('public')
                            ->getStateUsing(fn ($record) => $record->picture && Storage::disk('public')->exists($record->picture) ? $record->picture : null)
                            ->defaultImageUrl(fn ($record) => static::getInitialsSvgUrl($record)),
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nom')
                            ->getStateUsing(fn ($record) => is_array($record->name) ? ($record->name[app()->getLocale()] ?? Arr::first($record->name) ?? '') : (string) $record->name),
                        Infolists\Components\TextEntry::make('role')
                            ->label('Rôle')
                            ->getStateUsing(fn ($record) => is_array($record->role) ? ($record->role[app()->getLocale()] ?? Arr::first($record->role) ?? '') : (string) $record->role),
                        Infolists\Components\TextEntry::make('slug')->label('Slug'),
                    ])
                    ->columns(2),
                Infolists\Components\Section::make('Réseaux sociaux')
                    ->schema([
                        Infolists\Components\TextEntry::make('facebook')
                            ->url(fn ($state) => filled($state) && ! is_array($state) ? (string) $state : null)
                            ->openUrlInNewTab()
                            ->label('Facebook'),
                        Infolists\Components\TextEntry::make('twitter')
                            ->url(fn ($state) => filled($state) && ! is_array($state) ? (string) $state : null)
                            ->openUrlInNewTab()
                            ->label('Twitter'),
                        Infolists\Components\TextEntry::make('instagram')
                            ->url(fn ($state) => filled($state) && ! is_array($state) ? (string) $state : null)
                            ->openUrlInNewTab()
                            ->label('Instagram'),
                        Infolists\Components\TextEntry::make('linkedin')
                            ->url(fn ($state) => filled($state) && ! is_array($state) ? (string) $state : null)
                            ->openUrlInNewTab()
                            ->label('LinkedIn'),
                    ])
                    ->columns(2)
                    ->collapsed(),
                Infolists\Components\Section::make('Profil')
                    ->schema([
                        Infolists\Components\TextEntry::make('assets')
                            ->label('Atouts')
                            ->getStateUsing(function ($record) {
                                $val = $record->assets ?? [];
                                return is_array($val) ? implode(', ', array_map(fn ($v) => is_array($v) ? ($v['item'] ?? '') : $v, $val)) : (string) $val;
                            }),
                        Infolists\Components\TextEntry::make('experience')
                            ->label('Expérience')
                            ->getStateUsing(function ($record) {
                                $val = $record->experience ?? [];
                                return is_array($val) ? implode(', ', array_map(fn ($v) => is_array($v) ? ($v['item'] ?? '') : $v, $val)) : (string) $val;
                            }),
                        Infolists\Components\TextEntry::make('diplomas')
                            ->label('Diplômes')
                            ->getStateUsing(function ($record) {
                                $val = $record->diplomas ?? [];
                                return is_array($val) ? implode(', ', array_map(fn ($v) => is_array($v) ? ($v['item'] ?? '') : $v, $val)) : (string) $val;
                            }),
                        Infolists\Components\TextEntry::make('expertises')
                            ->label('Expertises')
                            ->getStateUsing(function ($record) {
                                $val = $record->expertises ?? [];
                                return is_array($val) ? implode(', ', array_map(fn ($v) => is_array($v) ? ($v['item'] ?? '') : $v, $val)) : (string) $val;
                            }),
                        Infolists\Components\TextEntry::make('work_countries')
                            ->label('Pays')
                            ->getStateUsing(function ($record) {
                                $val = $record->work_countries ?? [];
                                return is_array($val) ? implode(', ', array_map(fn ($v) => is_array($v) ? ($v['item'] ?? '') : $v, $val)) : (string) $val;
                            }),
                    ])
                    ->columns(1)
                    ->collapsed(),
                Infolists\Components\Section::make('Paramètres')
                    ->schema([
                        Infolists\Components\TextEntry::make('sort_order')->label('Ordre'),
                        Infolists\Components\IconEntry::make('is_active')->label('Actif')->boolean(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('picture')
                    ->circular()
                    ->size(48)
                    ->disk('public')
                    ->defaultImageUrl(fn ($record) => static::getInitialsSvgUrl($record))
                    ->getStateUsing(fn ($record) => $record->picture && Storage::disk('public')->exists($record->picture) ? $record->picture : null)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->toggleable(),
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
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'view' => Pages\ViewTeamMember::route('/{record}'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
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

    protected static function getInitials(string $name): string
    {
        if (blank($name)) {
            return '?';
        }
        $parts = array_filter(explode(' ', trim($name)));
        if (count($parts) >= 2) {
            return strtoupper(mb_substr($parts[0], 0, 1).mb_substr($parts[array_key_last($parts)], 0, 1));
        }

        return strtoupper(mb_substr($name, 0, min(2, mb_strlen($name))));
    }

    protected static function getInitialsSvgUrl(TeamMember $record): string
    {
        $name = is_string($record->name) ? $record->name : ($record->getTranslation('name', app()->getLocale()) ?? '?');
        $initials = static::getInitials($name);
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><rect width="48" height="48" fill="#f59e0b" rx="24"/><text x="24" y="24" dominant-baseline="central" text-anchor="middle" font-family="sans-serif" font-size="22" font-weight="bold" fill="white">'.htmlspecialchars($initials).'</text></svg>';

        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }
}
