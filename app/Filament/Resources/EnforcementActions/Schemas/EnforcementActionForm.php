<?php

namespace App\Filament\Resources\EnforcementActions\Schemas;

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

class EnforcementActionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Action subject')
                            ->description('Which regulated entity this enforcement action is issued against.')
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
                                    ->afterStateUpdated(fn(Set $set) => $set('violation_id', null)),
                            ]),
                        Section::make('Dates & status')
                            ->description('When this action was issued and its current standing.')
                            ->columns(3)
                            ->components([
                                DatePicker::make('issued_at')
                                    ->required()
                                    ->default(now())
                                    ->placeholder('Select date'),
                                DatePicker::make('effectivity_date')
                                    ->placeholder('Select date')
                                    ->helperText('When the action takes effect, if not immediate.'),
                                DatePicker::make('expiry_date')
                                    ->placeholder('Select date')
                                    ->helperText('For time-bound actions like suspensions.'),
                                Select::make('status')
                                    ->options(self::statusOptions())
                                    ->required()->default('issued')
                                    ->placeholder('Select status')
                                    ->columnSpanFull(),
                            ]),
                        Section::make('Issuance')
                            ->description('Who issued this action and which office is accountable for it.')
                            ->columns(2)
                            ->components([
                                Select::make('issued_by')
                                    ->label('Issued by')
                                    ->relationship('issuedBy', 'name')
                                    ->searchable()->preload()->required()
                                    ->placeholder('Select issuing officer'),
                                Select::make('office_id')
                                    ->label('Office')
                                    ->relationship('office', 'name')
                                    ->searchable()->preload()->required()
                                    ->placeholder('Select office'),
                            ]),
                        FileUpload::make('image')
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Action details')
                            ->description('The nature of the enforcement action and the violation it responds to, if any.')
                            ->columns(2)
                            ->components([
                                TextInput::make('action_number')
                                    ->required()->maxLength(255)->unique(ignoreRecord: true)
                                    ->placeholder('e.g. EA-2026-00187'),
                                Select::make('action_type')
                                    ->options(self::actionTypeOptions())
                                    ->required()
                                    ->live()
                                    ->placeholder('Select action type'),
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
                                    ->placeholder('None (issued independently)')
                                    ->helperText('Only violations already logged for this entity appear here.'),
                                TextInput::make('penalty_amount')
                                    ->label('Penalty amount')
                                    ->numeric()
                                    ->prefix('₱')
                                    ->placeholder('0.00')
                                    ->visible(fn(Get $get) => $get('action_type') === 'fine')
                                    ->helperText('Only applicable when the action type is a fine.'),
                            ]),
                        Section::make('Description')
                            ->description('Details of the action for the record.')
                            ->components([
                                Textarea::make('description')
                                    ->rows(3)
                                    ->placeholder('Describe the basis and terms of this action...')
                                    ->columnSpanFull(),
                            ]),
                    ]),

            ])->columns(2);
    }

    protected static function statusOptions(): array
    {
        return [
            'Issued' => 'Issued',
            'Acknowledged' => 'Acknowledged',
            'Complied' => 'Complied',
            'Contested' => 'Contested',
            'Lifted' => 'Lifted',
        ];
    }

    protected static function actionTypeOptions(): array
    {
        return [
            'Notice of Violation' => 'Notice of Violation',
            'Warning' => 'Warning',
            'Show Cause Order' => 'Show Cause Order',
            'Suspension' => 'Suspension',
            'Revocation' => 'Revocation',
            'Fine' => 'Fine',
            'Closure Order' => 'Closure Order',
            'Other' => 'Other',
        ];
    }
}
