<?php

namespace App\Filament\Resources\EnforcementCases\Schemas;

use App\Models\MeatEstablishment;
use App\Models\MtvOperator;
use App\Models\MtvVehicle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class EnforcementCaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Case subject')
                    ->description('Which regulated entity this case concerns.')
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
                                $set('violation_id', null);
                                $set('enforcement_action_id', null);
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
                            ->afterStateUpdated(function (Set $set) {
                                $set('violation_id', null);
                                $set('enforcement_action_id', null);
                            }),
                    ]),

                Section::make('Case origin')
                    ->description('The violation and/or enforcement action this case escalates from, if any.')
                    ->columns(2)
                    ->components([
                        Select::make('violation_id')
                            ->label('Related violation')
                            ->relationship(
                                name: 'violation',
                                titleAttribute: 'violation_number',
                                modifyQueryUsing: fn(Builder $query, Get $get) => $query
                                    ->where('subject_type', $get('subject_type'))
                                    ->where('subject_id', $get('subject_id')),
                            )
                            ->searchable()->preload()->nullable()
                            ->disabled(fn(Get $get) => blank($get('subject_id')))
                            ->placeholder('None')
                            ->helperText('Only violations logged for this entity appear here.'),
                        Select::make('enforcement_action_id')
                            ->label('Related enforcement action')
                            ->relationship(
                                name: 'enforcementAction',
                                titleAttribute: 'action_number',
                                modifyQueryUsing: fn(Builder $query, Get $get) => $query
                                    ->where('subject_type', $get('subject_type'))
                                    ->where('subject_id', $get('subject_id')),
                            )
                            ->searchable()->preload()->nullable()
                            ->disabled(fn(Get $get) => blank($get('subject_id')))
                            ->placeholder('None')
                            ->helperText('Only enforcement actions logged for this entity appear here.'),
                    ]),

                Section::make('Case details')
                    ->description('Identifying information and current due-process standing.')
                    ->columns(2)
                    ->components([
                        TextInput::make('case_number')
                            ->required()->maxLength(255)->unique(ignoreRecord: true)
                            ->placeholder('e.g. CASE-2026-00098'),
                        DatePicker::make('filed_at')
                            ->required()
                            ->default(now())
                            ->placeholder('Select date'),
                        Select::make('current_status')
                            ->options(self::statusOptions())
                            ->required()->default('Pending')
                            ->placeholder('Select status')
                            ->helperText('Changing this after the case is filed automatically logs a new entry in the status history below.'),
                        Toggle::make('is_confidential')
                            ->label('Confidential')
                            ->default(true)
                            ->helperText('Restricts visibility per your panel\'s access policy; leave on unless this case is a matter of public record.'),
                    ]),

                Section::make('Assignment')
                    ->description('Who is handling this case and under which office.')
                    ->columns(2)
                    ->components([
                        Select::make('assigned_office_id')
                            ->label('Assigned office')
                            ->relationship('assignedOffice', 'name')
                            ->searchable()->preload()->required()
                            ->placeholder('Select office'),
                        Select::make('assigned_officer_id')
                            ->label('Assigned officer')
                            ->relationship('assignedOfficer', 'name')
                            ->searchable()->preload()->nullable()
                            ->placeholder('Select officer')
                            ->helperText('Can be left unassigned while the case is pending intake.'),
                    ]),

                Section::make('Resolution')
                    ->description('Fill in once the case reaches a final outcome.')
                    ->columns(2)
                    ->components([
                        Textarea::make('resolution')
                            ->rows(3)
                            ->placeholder('Summarize the outcome and any conditions imposed...')
                            ->columnSpanFull(),
                        DatePicker::make('resolved_at')
                            ->placeholder('Select date')
                            ->helperText('Leave blank until the case is resolved, dismissed, or completed.'),
                    ]),
            ]);
    }

    protected static function statusOptions(): array
    {
        return [
            'Pending' => 'Pending',
            'Under Review' => 'Under Review',
            'Resolved' => 'Resolved',
            'Under Appeal' => 'Under Appeal',
            'Dismissed' => 'Dismissed',
            'Completed' => 'Completed',
        ];
    }
}
