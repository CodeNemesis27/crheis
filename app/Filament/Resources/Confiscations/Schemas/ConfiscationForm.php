<?php

namespace App\Filament\Resources\Confiscations\Schemas;

use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class ConfiscationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Confiscation subject')
                    ->description('Which regulated entity this confiscation, apprehension, or seizure is attributed to.')
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
                            ->afterStateUpdated(function (Set $set) {
                                $set('subject_id', null);
                                $set('enforcement_case_id', null);
                            }),
                        Select::make('subject_id')
                            ->label('Regulated entity')
                            ->required()
                            ->live()
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
                            })
                            ->afterStateUpdated(fn(Set $set) => $set('enforcement_case_id', null)),
                    ]),

                Section::make('Incident details')
                    ->description('What was taken, where, and under what classification.')
                    ->columns(2)
                    ->components([
                        TextInput::make('confiscation_number')
                            ->required()->maxLength(255)->unique(ignoreRecord: true)
                            ->placeholder('e.g. CONF-2026-00071'),
                        Select::make('type')
                            ->options(self::typeOptions())
                            ->required()
                            ->placeholder('Select type'),
                        TextInput::make('location')
                            ->required()->maxLength(255)
                            ->placeholder('e.g. Checkpoint, Sirawan, Toril, Davao City')
                            ->columnSpanFull(),
                        Select::make('commodity_type')
                            ->options(self::commodityTypeOptions())
                            ->required()
                            ->placeholder('Select commodity type'),
                        DatePicker::make('date_confiscated')
                            ->required()
                            ->default(now())
                            ->placeholder('Select date'),
                    ]),

                Section::make('Item description & quantity')
                    ->description('Specifics of what was confiscated, for the record and eventual disposition.')
                    ->columns(3)
                    ->components([
                        Textarea::make('item_description')
                            ->required()
                            ->rows(2)
                            ->placeholder('e.g. Assorted pork cuts without health certificate')
                            ->columnSpanFull(),
                        TextInput::make('quantity')
                            ->numeric()
                            ->placeholder('e.g. 150'),
                        TextInput::make('unit')
                            ->maxLength(255)
                            ->placeholder('e.g. kg, heads, units')
                            ->helperText('Unit the quantity is measured in.'),
                        TextInput::make('estimated_value')
                            ->label('Estimated value')
                            ->numeric()
                            ->prefix('₱')
                            ->placeholder('0.00')
                            ->helperText('Approximate market value, for reporting purposes.'),
                    ]),

                Section::make('Case linkage')
                    ->description('Attach this incident to a formal case once it escalates, if it does.')
                    ->components([
                        Select::make('enforcement_case_id')
                            ->label('Related case')
                            ->relationship(
                                name: 'enforcementCase',
                                titleAttribute: 'case_number',
                                modifyQueryUsing: fn(Builder $query, Get $get) => $query
                                    ->where('subject_type', $get('subject_type'))
                                    ->where('subject_id', $get('subject_id')),
                            )
                            ->searchable()->preload()->nullable()
                            ->disabled(fn(Get $get) => blank($get('subject_id')))
                            ->placeholder('None (no case filed yet)')
                            ->helperText('Only cases already logged for this entity appear here.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Disposition')
                    ->description('What ultimately happened to the confiscated item(s).')
                    ->columns(2)
                    ->components([
                        Select::make('disposition')
                            ->options(self::dispositionOptions())
                            ->required()->default('Pending')
                            ->placeholder('Select disposition'),
                        DatePicker::make('disposition_date')
                            ->placeholder('Select date')
                            ->helperText('Leave blank while disposition is still pending.'),
                        Textarea::make('remarks')
                            ->rows(2)
                            ->placeholder('Any additional context on the disposition or incident...')
                            ->columnSpanFull(),
                    ]),

                Section::make('Apprehension')
                    ->description('Who apprehended this and which office is accountable for it.')
                    ->columns(2)
                    ->components([
                        Select::make('apprehending_officer_id')
                            ->label('Apprehending officer')
                            ->relationship('apprehendingOfficer', 'name')
                            ->searchable()->preload()->required()
                            ->placeholder('Select officer'),
                        Select::make('office_id')
                            ->label('Office')
                            ->relationship('office', 'name')
                            ->searchable()->preload()->required()
                            ->placeholder('Select office'),
                    ]),
            ]);
    }

    protected static function typeOptions(): array
    {
        return [
            'Confiscation' => 'Confiscation',
            'Apprehension' => 'Apprehension',
            'Seizure' => 'Seizure',
        ];
    }

    protected static function commodityTypeOptions(): array
    {
        return [
            'Live Animal' => 'Live Animal',
            'Carcass' => 'Carcass',
            'Processed Meat' => 'Processed Meat',
            'Vehicle' => 'Vehicle',
            'Equipment' => 'Equipment',
            'Document' => 'Document',
            'Other' => 'Other',
        ];
    }

    protected static function dispositionOptions(): array
    {
        return [
            'Pending' => 'Pending',
            'Donated' => 'Donated',
            'Destroyed' => 'Destroyed',
            'Released' => 'Released',
            'Forfeited' => 'Forfeited',
            'Sold' => 'Sold',
        ];
    }
}
