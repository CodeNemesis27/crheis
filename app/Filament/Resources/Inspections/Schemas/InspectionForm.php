<?php

namespace App\Filament\Resources\Inspections\Schemas;

use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class InspectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Inspection subject')
                            ->description('Which regulated entity this inspection was conducted on.')
                            ->columns(2)
                            ->components([
                                Select::make('subject_type')
                                    ->label('Entity type')
                                    ->options([
                                        'Meat Establishment' => 'Meat Establishment',
                                        'MTV Operator' => 'MTV Operator',
                                        'MTV Vehicle' => 'MTV Vehicle',
                                    ])
                                    ->required()
                                    ->live()
                                    ->placeholder('Select entity type')
                                    ->afterStateUpdated(fn(Set $set) => $set('subject_id', null)),
                                Select::make('subject_id')
                                    ->label('Regulated entity')
                                    ->required()
                                    ->searchable()
                                    ->disabled(fn(Get $get) => blank($get('subject_type')))
                                    ->placeholder('Search by name, registration, or plate number')
                                    ->helperText('Choose the entity type first, then search for it here.')
                                    ->getSearchResultsUsing(function (string $search, Get $get): array {
                                        return match ($get('subject_type')) {
                                            'Meat Establishment' => MeatEstablishment::query()
                                                ->where('business_name', 'like', "%{$search}%")
                                                ->orWhere('registration_number', 'like', "%{$search}%")
                                                ->limit(50)->pluck('business_name', 'id')->toArray(),
                                            'MTV Operator' => MtvOperator::query()
                                                ->where('operator_name', 'like', "%{$search}%")
                                                ->limit(50)->pluck('operator_name', 'id')->toArray(),
                                            'MTV Vehicle' => MtvVehicle::query()
                                                ->where('plate_number', 'like', "%{$search}%")
                                                ->limit(50)->pluck('plate_number', 'id')->toArray(),
                                            default => [],
                                        };
                                    })
                                    ->getOptionLabelUsing(function ($value, Get $get) {
                                        return match ($get('subject_type')) {
                                            'Meat Establishment' => MeatEstablishment::find($value)?->business_name,
                                            'MTV Operator' => MtvOperator::find($value)?->operator_name,
                                            'MTV Vehicle' => MtvVehicle::find($value)?->plate_number,
                                            default => null,
                                        };
                                    }),
                            ]),
                        Section::make('Inspection details')
                            ->description('When the inspection happened, who conducted it, and under which office.')
                            ->columns(2)
                            ->components([
                                TextInput::make('report_number')
                                    ->required()->maxLength(255)->unique(ignoreRecord: true)
                                    ->placeholder('e.g. INSP-2026-00456'),
                                Select::make('inspection_type')
                                    ->options([
                                        'Routine' => 'Routine',
                                        'Follow Up' => 'Follow Up',
                                        'Complaint Based' => 'Complaint Based',
                                        'Pre Accreditation' => 'Pre Accreditation',
                                        'Renewal' => 'Renewal',
                                    ])
                                    ->required()
                                    ->placeholder('Select inspection type'),
                                DatePicker::make('inspection_date')
                                    ->required()
                                    ->default(now())
                                    ->placeholder('Select date'),
                                Select::make('inspector_id')
                                    ->label('Inspector')
                                    ->relationship('inspector', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->placeholder('Select inspector'),
                                Select::make('office_id')
                                    ->label('Office')
                                    ->relationship('office', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->placeholder('Select office')
                                    ->helperText('The office that conducted or is responsible for this inspection.')
                                    ->columnSpanFull(),
                            ]),

                    ]),

                Group::make()
                    ->schema([
                        Section::make('Findings')
                            ->description('Outcome of the inspection and any recommended follow-up.')
                            ->components([
                                Select::make('result')
                                    ->options([
                                        'Passed' => 'Passed',
                                        'Passed With Findings' => 'Passed With Findings',
                                        'Failed' => 'Failed',
                                    ])
                                    ->required()
                                    ->placeholder('Select result'),
                                Textarea::make('findings')
                                    ->rows(3)
                                    ->placeholder('Describe what was observed during the inspection...')
                                    ->columnSpanFull(),
                                Textarea::make('recommendations')
                                    ->rows(3)
                                    ->placeholder('Any corrective action or follow-up recommended...')
                                    ->helperText('Leave blank if the result was a clean pass with no action needed.')
                                    ->columnSpanFull(),
                            ]),
                    ]),

            ])->columns(2);
    }
}
