<?php

namespace App\Filament\Resources\Offices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OfficeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Office details')
                    ->columns(2)
                    ->description('Identify and place this office in the hierarchy.')
                    ->components([
                        TextInput::make('code')
                            ->required()
                            ->placeholder('e.g. NMIS-R11')
                            ->unique(ignoreRecord: true),
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g. NMIS Regional Field Unit XI')
                            ->columnSpan(1),
                        Select::make('type')
                            ->placeholder('Select office level')
                            ->options([
                                'National' => 'National',
                                'Regional' => 'Regional',
                                'Provincial' => 'Provincial',
                                'City' => 'City',
                                'Municipal' => 'Municipal',
                                'LGU' => 'LGU',
                            ])
                            ->required(),
                        Select::make('parent_office_id')
                            ->label('Parent office')
                            ->relationship('parentOffice', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('None (top-level office)')
                            ->nullable()
                            ->helperText('Leave blank only for the national office.'),
                    ]),

                Section::make('Location')
                    ->columns(3)
                    ->description('Leave blank for the national office.')
                    ->components([
                        Select::make('region')
                            ->options([
                                'NCR' => 'NCR',
                                'CAR' => 'CAR',
                                'I' => 'I',
                                'II' => 'II',
                                'III' => 'III',
                                'IV-A' => 'IV-A',
                                'IV-B' => 'IV-B',
                                'V' => 'V',
                                'VI' => 'VI',
                                'VII' => 'VII',
                                'VIII' => 'VIII',
                                'NIR' => 'NIR',
                                'IX' => 'IX',
                                'X' => 'X',
                                'XI' => 'XI',
                                'XII' => 'XII',
                                'BARMM' => 'BARMM',
                            ]),
                        TextInput::make('province')
                            ->placeholder('e.g. Davao del Sur'),
                        TextInput::make('city_municipality')
                            ->placeholder('e.g. Davao City'),
                    ]),

                Section::make('Contact')
                    ->columns(2)
                    ->description('For coordination and notice routing.')
                    ->components([
                        TextInput::make('contact_number')
                            ->tel()
                            ->placeholder('09XXXXXXXXX'),
                        TextInput::make('email')
                            ->email()
                            ->placeholder('office@nmis.gov.ph'),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->helperText('Turn off when an office closes or merges.')
                            ->default(true),
                    ]),
            ]);
    }
}
