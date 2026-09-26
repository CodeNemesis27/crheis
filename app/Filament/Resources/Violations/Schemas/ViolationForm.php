<?php

namespace App\Filament\Resources\Violations\Schemas;

use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use JohnRivera7\FilamentAntivirus\Rules\AntivirusFileRule;

class ViolationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Violation subject')
                            ->description('Which regulated entity this violation is attributed to.')
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
                                        $set('inspection_id', null);
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
                                    ->afterStateUpdated(fn(Set $set) => $set('inspection_id', null)),
                            ]),
                        Section::make('Dates & status')
                            ->description('Timeline of the violation and where it currently stands.')
                            ->columns(3)
                            ->components([
                                DatePicker::make('date_committed')
                                    ->required()
                                    ->placeholder('Select date')
                                    ->helperText('When the violation actually occurred.'),
                                DatePicker::make('date_reported')
                                    ->required()
                                    ->default(now())
                                    ->placeholder('Select date'),
                                Select::make('status')
                                    ->options([
                                        'Open' => 'Open',
                                        'Under Investigation' => 'Under Investigation',
                                        'Resolved' => 'Resolved',
                                        'Dismissed' => 'Dismissed',
                                    ])
                                    ->required()->default('Open')
                                    ->placeholder('Select status'),
                            ]),
                        Section::make('Reporting')
                            ->description('Who reported this and which office is handling it.')
                            ->columns(2)
                            ->components([
                                Select::make('reported_by')
                                    ->label('Reported by')
                                    ->relationship('reportedBy', 'name')
                                    ->searchable()->preload()->required()
                                    ->placeholder('Select reporting officer'),
                                Select::make('office_id')
                                    ->label('Office')
                                    ->relationship('office', 'name')
                                    ->searchable()->preload()->required()
                                    ->placeholder('Select office'),
                            ]),
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Violation record')
                            ->description('What was violated, and its origin and current classification.')
                            ->columns(2)
                            ->components([
                                TextInput::make('violation_number')
                                    ->required()->maxLength(255)->unique(ignoreRecord: true)
                                    ->placeholder('e.g. VIO-2026-00312'),
                                Select::make('violation_type_id')
                                    ->label('Violation type')
                                    ->relationship('violationType', 'title')
                                    ->searchable()->preload()->required()
                                    ->live()
                                    ->placeholder('Select violation type')
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        $type = \App\Models\ViolationType::find($state);
                                        if ($type) {
                                            $set('severity', $type->default_severity);
                                        }
                                    }),
                                Select::make('inspection_id')
                                    ->label('Related inspection')
                                    ->relationship(
                                        name: 'inspection',
                                        titleAttribute: 'report_number',
                                        modifyQueryUsing: fn(Builder $query, Get $get) => $query
                                            ->where('subject_type', $get('subject_type'))
                                            ->where('subject_id', $get('subject_id')),
                                    )
                                    ->searchable()->preload()->nullable()
                                    ->disabled(fn(Get $get) => blank($get('subject_id')))
                                    ->placeholder('None (reported independently)')
                                    ->helperText('Only inspections already logged for this entity appear here.'),
                                Select::make('severity')
                                    ->options([
                                        'Minor' => 'Minor',
                                        'Major' => 'Major',
                                        'Critical' => 'Critical',
                                    ])
                                    ->required()
                                    ->placeholder('Select severity')
                                    ->helperText('Pre-filled from the violation type\'s default; adjust if this instance warrants it.'),
                            ]),
                        Section::make('Description')
                            ->description('Narrative account of what happened, for the record.')
                            ->components([
                                FileUpload::make('attachment')
                                    ->disk('public')
                                    ->rules([new AntivirusFileRule()]),
                                Textarea::make('description')
                                    ->required()
                                    ->rows(3)
                                    ->placeholder('Describe the circumstances of the violation...')
                                    ->columnSpanFull(),
                            ]),
                    ]),

            ])->columns(2);
    }
}
