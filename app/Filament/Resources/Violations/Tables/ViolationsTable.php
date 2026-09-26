<?php

namespace App\Filament\Resources\Violations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ViolationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['subject', 'violationType', 'reportedBy', 'office']))
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('violation_number')->searchable()->sortable(),
                TextColumn::make('subject_label')->label('Entity'),
                TextColumn::make('violationType.title')->label('Violation type')->wrap(),
                TextColumn::make('severity')
                    ->badge()
                    ->colors([
                        'gray' => 'Minor',
                        'warning' => 'Major',
                        'danger' => 'Critical',
                    ]),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'danger' => 'Open',
                        'warning' => 'Under Investigation',
                        'success' => 'Resolved',
                        'gray' => 'Dismissed',
                    ]),
                TextColumn::make('date_committed')->date()->sortable(),
                TextColumn::make('office.name')->label('Office')->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('violation_type_id')->label('Violation type')
                    ->relationship('violationType', 'title')->searchable()->preload(),
                SelectFilter::make('severity')->options([
                    'Minor' => 'Minor',
                    'Major' => 'Major',
                    'Critical' => 'Critical',
                ]),
                SelectFilter::make('status')->options([
                    'Open' => 'Open',
                    'Under Investigation' => 'Under Investigation',
                    'Resolved' => 'Resolved',
                    'Dismissed' => 'Dismissed',
                ]),
                SelectFilter::make('office_id')->label('Office')
                    ->relationship('office', 'name')->searchable()->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->defaultSort('date_reported', 'desc');
    }
}
