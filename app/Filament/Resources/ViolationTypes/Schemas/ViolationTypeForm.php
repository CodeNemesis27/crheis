<?php

namespace App\Filament\Resources\ViolationTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViolationTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Violation type details')
                    ->description('Standardized definition used across all violation records — keep wording consistent rather than creating near-duplicate entries.')
                    ->columns(2)
                    ->components([
                        TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('e.g. VC-001'),
                        TextInput::make('title')
                            ->required()
                            ->placeholder('e.g. Slaughtering without a valid permit'),
                        Select::make('category')
                            ->options([
                                'Sanitation' => 'Sanitation',
                                'Documentation' => 'Documentation',
                                'Unauthorized Operation' => 'Unauthorized Operation',
                                'Animal Welfare' => 'Animal Welfare',
                                'Transport Violation' => 'Transport Violation',
                                'Food Safety' => 'Food Safety',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->placeholder('Select category'),
                        Select::make('default_severity')
                            ->options([
                                'Minor' => 'Minor',
                                'Major' => 'Major',
                                'Critical' => 'Critical',
                            ])
                            ->required()
                            ->placeholder('Select default severity')
                            ->helperText('Pre-fills severity when this type is picked on a violation; officers can still override it case by case.'),
                    ]),

                Section::make('Legal reference')
                    ->description('Ties this violation type back to the specific law or provision it enforces.')
                    ->components([
                        TextInput::make('legal_basis')
                            ->placeholder('e.g. RA 9296, Sec. 12')
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(3)
                            ->placeholder('Plain-language explanation of what qualifies as this violation...')
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->description('Inactive types are hidden from new records but remain on existing history.')
                    ->components([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Turn off to retire a violation type without deleting its history.'),
                    ]),
            ]);
    }
}
