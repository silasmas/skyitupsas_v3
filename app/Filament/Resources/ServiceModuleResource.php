<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceModuleResource\Pages;
use App\Filament\Resources\ServicePillarResource\ServiceModuleForm;
use App\Models\ServiceModule;
use App\Models\ServicePillar;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Resource Filament des modules de services (accès direct + filtre par pilier).
 */
class ServiceModuleResource extends Resource
{
    use Translatable;

    protected static ?string $model = ServiceModule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Contenu';

    protected static ?string $navigationLabel = 'Modules services';

    protected static ?string $modelLabel = 'Module service';

    protected static ?string $pluralModelLabel = 'Modules services';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'title';

    /**
     * @param  Form  $form  Formulaire Filament
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Rattachement')
                ->schema([
                    Select::make('service_pillar_id')
                        ->label('Pilier')
                        ->relationship('pillar', 'title')
                        ->getOptionLabelFromRecordUsing(fn (ServicePillar $record): string => (string) $record->getTranslation('title', app()->getLocale()))
                        ->required()
                        ->searchable()
                        ->preload(),
                ]),
            ...ServiceModuleForm::schema(),
        ]);
    }

    /**
     * @param  Table  $table  Table Filament
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pillar.title')
                    ->label('Pilier')
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('title')
                    ->label('Module')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('service_pillar_id')
                    ->label('Pilier')
                    ->relationship('pillar', 'title'),
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

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceModules::route('/'),
            'create' => Pages\CreateServiceModule::route('/create'),
            'edit' => Pages\EditServiceModule::route('/{record}/edit'),
        ];
    }
}
