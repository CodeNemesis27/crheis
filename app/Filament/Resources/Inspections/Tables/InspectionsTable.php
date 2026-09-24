<?php

namespace App\Filament\Resources\Inspections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InspectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['subject', 'inspector', 'office']))
            ->columns([
                TextColumn::make('report_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject_label')
                    ->label('Entity'),
                TextColumn::make('inspection_type')
                    ->badge(),
                TextColumn::make('inspection_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('inspector.name')
                    ->label('Inspector')
                    ->searchable(),
                TextColumn::make('result')
                    ->badge()
                    ->colors([
                        'success' => 'Passed',
                        'warning' => 'Passed With Findings',
                        'danger' => 'Failed',
                    ]),
                TextColumn::make('office.name')
                    ->label('Office')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('inspection_type')
                    ->options([
                        'Routine' => 'Routine',
                        'Follow Up' => 'Follow Up',
                        'Complaint Based' => 'Complaint Based',
                        'Pre Accreditation' => 'Pre Accreditation',
                        'Renewal' => 'Renewal',
                    ]),
                SelectFilter::make('result')
                    ->options([
                        'Passed' => 'Passed',
                        'Passed With Findings' => 'Passed With Findings',
                        'Failed' => 'Failed',
                    ]),
                SelectFilter::make('office_id')->label('Office')
                    ->relationship('office', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('inspection_date', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
