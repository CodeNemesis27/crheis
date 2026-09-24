<?php

namespace App\Filament\Resources\EnforcementCases\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EnforcementCasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['subject', 'assignedOffice', 'assignedOfficer']))
            ->columns([
                TextColumn::make('case_number')->searchable()->sortable(),
                TextColumn::make('subject_label')->label('Entity'),
                TextColumn::make('current_status')
                    ->badge()
                    ->colors([
                        'gray' => 'Pending',
                        'primary' => 'Under Review',
                        'success' => ['Resolved', 'Completed'],
                        'warning' => 'Under Appeal',
                        'secondary' => 'Dismissed',
                    ]),
                TextColumn::make('filed_at')->date()->sortable(),
                TextColumn::make('assignedOffice.name')->label('Office')->toggleable(),
                TextColumn::make('assignedOfficer.name')->label('Officer')->placeholder('Unassigned')->toggleable(),
                IconColumn::make('is_confidential')->boolean()->label('Confidential'),
                TextColumn::make('resolved_at')->date()->placeholder('—')->toggleable(),
            ])
            ->filters([
                SelectFilter::make('current_status')->options(self::statusOptions()),
                SelectFilter::make('assigned_office_id')->label('Office')
                    ->relationship('assignedOffice', 'name')->searchable()->preload(),
                TernaryFilter::make('is_confidential'),
            ])
            ->defaultSort('filed_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
