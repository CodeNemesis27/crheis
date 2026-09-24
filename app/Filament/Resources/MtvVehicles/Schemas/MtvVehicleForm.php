<?php

namespace App\Filament\Resources\MtvVehicles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MtvVehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Vehicle identity')
                    ->description('Core identifiers used to search for and reference this vehicle.')
                    ->columns(2)
                    ->components([
                        Select::make('mtv_operator_id')
                            ->label('Operator')
                            ->relationship('mtvOperator', 'operator_name')
                            ->searchable()->preload()->required()
                            ->placeholder('Select operator')
                            ->helperText('The operator who owns or manages this vehicle.'),
                        TextInput::make('plate_number')
                            ->required()->maxLength(255)->unique(ignoreRecord: true)
                            ->placeholder('e.g. ABC 1234'),
                        Select::make('vehicle_type')
                            ->options([
                                'Refrigerated Van' => 'Refrigerated Van',
                                'Insulated Truck' => 'Insulated Truck',
                                'Open Truck' => 'Open Truck',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->placeholder('Select vehicle type'),
                        TextInput::make('capacity_kg')
                            ->label('Capacity (kg)')
                            ->numeric()
                            ->suffix('kg')
                            ->placeholder('e.g. 2500')
                            ->helperText('Maximum rated load capacity, if known.'),
                    ]),

                Section::make('Vehicle details')
                    ->description('Descriptive and identifying details from the vehicle\'s registration.')
                    ->columns(3)
                    ->components([
                        TextInput::make('make')->maxLength(255)->placeholder('e.g. Isuzu'),
                        TextInput::make('model')->maxLength(255)->placeholder('e.g. NPR 400'),
                        TextInput::make('year_model')->maxLength(255)->placeholder('e.g. 2022'),
                        TextInput::make('engine_number')
                            ->maxLength(255)
                            ->placeholder('e.g. 4HK1-123456')
                            ->helperText('Optional; used to resolve disputes over vehicle identity.'),
                        TextInput::make('chassis_number')
                            ->maxLength(255)
                            ->placeholder('e.g. JALFTR85J87123456')
                            ->helperText('Optional; used to resolve disputes over vehicle identity.'),
                    ]),

                Section::make('MTV permit')
                    ->description('Current standing of this vehicle\'s meat transport permit.')
                    ->columns(2)
                    ->components([
                        TextInput::make('permit_number')
                            ->maxLength(255)->unique(ignoreRecord: true)
                            ->placeholder('e.g. NMIS-MTV-PERMIT-2026-001')
                            ->helperText('Left blank until the permit is issued.'),
                        Select::make('permit_status')
                            ->options([
                                'Pending' => 'Pending',
                                'Active' => 'Active',
                                'Suspended' => 'Suspended',
                                'Revoked' => 'Revoked',
                                'Expired' => 'Expired',
                            ])
                            ->required()->default('Pending')
                            ->placeholder('Select status'),
                        DatePicker::make('permit_issued_at')
                            ->label('Issued on')
                            ->placeholder('Select date'),
                        DatePicker::make('permit_expiry_at')
                            ->label('Expires on')
                            ->placeholder('Select date')
                            ->helperText('Used to flag vehicles due for permit renewal.'),
                    ]),
            ]);
    }
}
