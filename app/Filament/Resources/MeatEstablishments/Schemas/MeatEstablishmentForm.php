<?php

namespace App\Filament\Resources\MeatEstablishments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MeatEstablishmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([

                        Section::make('Establishment identity')
                            ->description('Core identifiers used to search for and reference this establishment.')
                            ->columns(2)
                            ->components([
                                TextInput::make('registration_number')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('e.g. NMIS-EST-2026-001'),
                                TextInput::make('business_name')
                                    ->required()
                                    ->placeholder('e.g. Davao Prime Meats Corp.'),
                                TextInput::make('trade_name')
                                    ->placeholder('e.g. Prime Cuts')
                                    ->helperText('Leave blank if the establishment operates under its registered business name.'),
                                Select::make('establishment_type')
                                    ->options([
                                        'Wet Market' => 'Wet Market',
                                        'Slaughterhouse' => 'Slaughterhouse',
                                        'Butchery' => 'Butchery',
                                        'Poultry Dressing Plant' => 'Poultry Dressing Plant',
                                        'Meat Cutting Plant' => 'Meat Cutting Plant',
                                        'Meat Processing Plant' => 'Meat Processing Plant',
                                        'Cold Storage' => 'Cold Storage',
                                        'Meat Shop' => 'Meat Shop',
                                        'Warehouse' => 'Warehouse',
                                        'Supermarket' => 'Supermarket',
                                        'MTV' => 'MTV',
                                    ])
                                    ->required()
                                    ->placeholder('Select establishment type'),
                            ]),

                        Section::make('Location')
                            ->description('Physical address where inspections and enforcement activities take place.')
                            ->columns(2)
                            ->components([
                                TextInput::make('address_line')
                                    ->columnSpanFull()
                                    ->placeholder('e.g. Purok 3, National Highway'),
                                TextInput::make('barangay')
                                    ->placeholder('e.g. Barangay Matina'),
                                TextInput::make('city_municipality')
                                    ->placeholder('e.g. Davao City'),
                                TextInput::make('province')
                                    ->placeholder('e.g. Davao del Sur'),
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
                            ]),

                        Section::make('Remarks')
                            ->description('Optional internal notes not shown to the establishment.')
                            ->components([
                                Textarea::make('remarks')
                                    ->rows(3)
                                    ->placeholder('Any additional context worth recording...')
                                    ->columnSpanFull(),
                            ]),

                    ])->columnSpan(6),

                Group::make()
                    ->schema([

                        Section::make('Owner information')
                            ->description('The individual or entity legally responsible for this establishment.')
                            ->columns(2)
                            ->components([
                                TextInput::make('owner_name')
                                    ->required()
                                    ->placeholder('e.g. Juan Dela Cruz'),
                                TextInput::make('tin')
                                    ->placeholder('e.g. 123-456-789-000')
                                    ->helperText('Tax Identification Number, if available.'),
                                TextInput::make('owner_contact_number')
                                    ->tel()
                                    ->placeholder('09XXXXXXXXX'),
                                TextInput::make('owner_email')
                                    ->email()
                                    ->placeholder('owner@example.com'),
                            ]),

                        Section::make('Accreditation')
                            ->description('Current standing and the office with jurisdiction over this establishment.')
                            ->columns(2)
                            ->components([
                                TextInput::make('accreditation_number')
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('e.g. NMIS-ACC-2026-001')
                                    ->helperText('Left blank until accreditation is granted.'),
                                Select::make('accreditation_status')
                                    ->options([
                                        'Pending' => 'Pending',
                                        'Active' => 'Active',
                                        'Suspended' => 'Suspended',
                                        'Revoked' => 'Revoked',
                                        'Expired' => 'Expired',
                                        'Closed' => 'Closed',
                                    ])
                                    ->required()->default('pending')
                                    ->placeholder('Select status'),
                                DatePicker::make('accreditation_issued_at')
                                    ->label('Issued on')
                                    ->placeholder('Select date'),
                                DatePicker::make('accreditation_expiry_at')
                                    ->label('Expires on')
                                    ->placeholder('Select date')
                                    ->helperText('Used to flag establishments due for renewal.'),
                                Select::make('registering_office_id')
                                    ->label('Registering office')
                                    ->relationship('registeringOffice', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->placeholder('Select office')
                                    ->helperText('The office with jurisdiction over this establishment\'s records.')
                                    ->columnSpanFull(),
                            ]),

                    ])->columnSpan(6),

            ])->columns(12);
    }
}
