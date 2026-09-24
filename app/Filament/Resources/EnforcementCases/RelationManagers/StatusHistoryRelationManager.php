<?php

namespace App\Filament\Resources\EnforcementCases\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatusHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'statusHistory';

    protected static ?string $title = 'Status History';

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

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('status')
                    ->options(self::statusOptions())
                    ->required()
                    ->placeholder('Select status'),
                DateTimePicker::make('changed_at')
                    ->required()
                    ->default(now())
                    ->placeholder('Select date & time'),
                Textarea::make('remarks')
                    ->rows(3)
                    ->placeholder('Reason for this status change...')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('status')
            ->columns([
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'Pending',
                        'primary' => 'Under Review',
                        'success' => ['Resolved', 'Completed'],
                        'warning' => 'Under Appeal',
                        'secondary' => 'Dismissed',
                    ]),
                TextColumn::make('remarks')->wrap()->placeholder('—'),
                TextColumn::make('changedBy.name')->label('Changed by')->placeholder('—'),
                TextColumn::make('changed_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateDataUsing(function (array $data) {
                        $data['changed_by'] = auth()->id();

                        return $data;
                    }),
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                //
            ])
            ->defaultSort('changed_at', 'desc');
    }
}
