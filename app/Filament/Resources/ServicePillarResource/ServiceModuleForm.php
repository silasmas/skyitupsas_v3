<?php

namespace App\Filament\Resources\ServicePillarResource;

use Filament\Forms;

/**
 * Schéma de formulaire partagé pour les modules de services.
 */
class ServiceModuleForm
{
    /**
     * Champs Filament d'un module (multilingue via resource parent).
     *
     * @return array<int, Forms\Components\Component>
     */
    public static function schema(): array
    {
        return [
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
                    Forms\Components\TextInput::make('cta_delay')
                        ->label('Délai CTA')
                        ->placeholder('48h')
                        ->maxLength(50),
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
                        ->label('Titre du module')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('benefit_text')
                        ->label('Bénéfice client (texte marketing)')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('summary_text')
                        ->label('Formulation générique / preuve')
                        ->rows(4)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('cta_label')
                        ->label('Libellé CTA')
                        ->placeholder('Profitez-en : recevez votre audit sous 48h, sans engagement.')
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('SEO')
                ->schema([
                    Forms\Components\Textarea::make('meta_description')
                        ->rows(3),
                ])
                ->collapsed(),
        ];
    }
}
