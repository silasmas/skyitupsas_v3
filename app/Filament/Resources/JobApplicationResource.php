<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplicationResource\Pages;
use App\Models\JobApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Recrutement';

    protected static ?int $navigationSort = 20;

    protected static ?string $modelLabel = 'Candidature';

    protected static ?string $pluralModelLabel = 'Candidatures';

    protected static ?string $recordTitleAttribute = 'email';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Traitement')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options(JobApplication::statusOptions())
                            ->required()
                            ->native(false),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Offre')
                    ->schema([
                        Infolists\Components\TextEntry::make('jobOffer.title')
                            ->label('Poste')
                            ->getStateUsing(fn (JobApplication $record) => $record->jobOffer?->getTranslation('title', app()->getLocale()) ?? '—'),
                        Infolists\Components\TextEntry::make('jobOffer.slug')->label('Slug offre'),
                    ])
                    ->columns(2),
                Infolists\Components\Section::make('Candidat')
                    ->schema([
                        Infolists\Components\TextEntry::make('first_name')->label('Prénom'),
                        Infolists\Components\TextEntry::make('last_name')->label('Nom'),
                        Infolists\Components\TextEntry::make('email')->copyable(),
                        Infolists\Components\TextEntry::make('phone')->label('Téléphone'),
                        Infolists\Components\TextEntry::make('linkedin_url')
                            ->label('LinkedIn')
                            ->url(fn ($state) => filled($state) ? (string) $state : null)
                            ->openUrlInNewTab(),
                        Infolists\Components\TextEntry::make('locale')->label('Langue'),
                        Infolists\Components\TextEntry::make('cover_letter')
                            ->label('Lettre de motivation')
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('cv_path')
                            ->label('CV')
                            ->formatStateUsing(function (?string $state): string {
                                if (! $state || ! Storage::disk('public')->exists($state)) {
                                    return '—';
                                }

                                return 'Télécharger le CV (PDF)';
                            })
                            ->url(function (?string $state): ?string {
                                if (! $state || ! Storage::disk('public')->exists($state)) {
                                    return null;
                                }

                                return Storage::disk('public')->url($state);
                            })
                            ->openUrlInNewTab(),
                    ])
                    ->columns(2),
                Infolists\Components\Section::make('Suivi')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')
                            ->label('Statut')
                            ->formatStateUsing(fn (string $state): string => JobApplication::statusOptions()[$state] ?? $state),
                        Infolists\Components\TextEntry::make('reviewed_at')->dateTime()->label('Examinée le'),
                        Infolists\Components\TextEntry::make('reviewer.name')->label('Par'),
                        Infolists\Components\TextEntry::make('created_at')->dateTime()->label('Envoyée le'),
                        Infolists\Components\TextEntry::make('ip_address')->label('IP'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Reçue le')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jobOffer.title')
                    ->label('Offre')
                    ->searchable(query: function ($query, string $search): void {
                        $query->whereHas('jobOffer', function ($q) use ($search): void {
                            foreach (config('app.available_locales', ['fr', 'en']) as $loc) {
                                $q->orWhere("title->{$loc}", 'like', '%'.$search.'%');
                            }
                        });
                    }),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => JobApplication::statusOptions()[$state] ?? $state),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(JobApplication::statusOptions()),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobApplications::route('/'),
            'view' => Pages\ViewJobApplication::route('/{record}'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }
}
