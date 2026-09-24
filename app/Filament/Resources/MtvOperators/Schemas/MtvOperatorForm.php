<?php

namespace App\Filament\Resources\MtvOperators\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MtvOperatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Operator identity')
                            ->description('Core identifiers used to search for and reference this operator.')
                            ->columns(2)
                            ->components([
                                Select::make('operator_type')
                                    ->options([
                                        'Individual' => 'Individual',
                                        'Company' => 'Company',
                                    ])
                                    ->required()
                                    ->live()
                                    ->placeholder('Select operator type'),
                                TextInput::make('operator_name')
                                    ->required()->maxLength(255)
                                    ->placeholder('e.g. Dela Cruz Hauling Services'),
                                TextInput::make('owner_name')
                                    ->maxLength(255)
                                    ->placeholder('e.g. Juan Dela Cruz'),
                                TextInput::make('tin')
                                    ->maxLength(255)
                                    ->placeholder('e.g. 123-456-789-000'),
                                TextInput::make('business_permit_number')
                                    ->maxLength(255)
                                    ->placeholder('e.g. BP-2026-004521')
                                    ->helperText('Leave blank for individuals without one.'),
                            ]),
                        Section::make('Contact')
                            ->description('Primary contact for coordination and notice routing.')
                            ->columns(2)
                            ->components([
                                TextInput::make('contact_number')
                                    ->tel()->maxLength(255)
                                    ->placeholder('+63 9XX XXX XXXX'),
                                TextInput::make('email')
                                    ->email()->maxLength(255)
                                    ->placeholder('operator@example.com'),
                            ]),

                        Section::make('Location')
                            ->description('Business or residential address on record for this operator.')
                            ->columns(2)
                            ->components([
                                TextInput::make('address_line')
                                    ->maxLength(255)->columnSpanFull()
                                    ->placeholder('e.g. Purok 3, National Highway'),
                                TextInput::make('barangay')->maxLength(255)->placeholder('e.g. Barangay Matina'),
                                TextInput::make('city_municipality')->maxLength(255)->placeholder('e.g. Davao City'),
                                TextInput::make('province')->maxLength(255)->placeholder('e.g. Davao del Sur'),
                                TextInput::make('region')->maxLength(255)->placeholder('e.g. Region XI'),
                            ]),

                    ]),

                Group::make()
                    ->schema([
                        Section::make('Accreditation')
                            ->description('Current standing and the office with jurisdiction over this operator.')
                            ->columns(2)
                            ->components([
                                TextInput::make('accreditation_number')
                                    ->maxLength(255)->unique(ignoreRecord: true)
                                    ->placeholder('e.g. NMIS-MTV-2026-001')
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
                                    ->required()->default('Pending')
                                    ->placeholder('Select status'),
                                DatePicker::make('accreditation_issued_at')
                                    ->label('Issued on')
                                    ->placeholder('Select date'),
                                DatePicker::make('accreditation_expiry_at')
                                    ->label('Expires on')
                                    ->placeholder('Select date')
                                    ->helperText('Used to flag operators due for renewal.'),
                                Select::make('registering_office_id')
                                    ->label('Registering office')
                                    ->relationship('registeringOffice', 'name')
                                    ->searchable()->preload()->required()
                                    ->placeholder('Select office')
                                    ->helperText('The office with jurisdiction over this operator\'s records.')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Remarks')
                            ->description('Optional internal notes not shown to the operator.')
                            ->components([
                                Textarea::make('remarks')
                                    ->rows(3)
                                    ->placeholder('Any additional context worth recording...')
                                    ->columnSpanFull(),
                            ]),
                    ]),

            ])->columns(2);
    }
}
