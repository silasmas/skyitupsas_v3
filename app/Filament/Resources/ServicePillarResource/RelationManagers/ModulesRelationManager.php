<?php

namespace App\Filament\Resources\ServicePillarResource\RelationManagers;

use App\Filament\Resources\ServicePillarResource\ServiceModuleForm;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Gestion des modules rattachés à un pilier (CRUD multilingue).
 */
class ModulesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'modules';

    protected static ?string $title = 'Modules';

    protected static ?string $modelLabel = 'module';

    /**
     * Formulaire de création / édition d'un module.
     *
     * @param  Form  $form  Formulaire Filament
     */
    public function form(Form $form): Form
    {
        return $form->schema(ServiceModuleForm::schema());
    }

    /**
     * Tableau des modules du pilier.
     *
     * @param  Table  $table  Table Filament
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([
                Tables\Actions\LocaleSwitcher::make(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
