<?php

namespace App\Filament\Resources\Confiscations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ConfiscationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['subject', 'apprehendingOfficer', 'office']))
            ->columns([
                TextColumn::make('confiscation_number')->searchable()->sortable(),
                TextColumn::make('subject_label')->label('Entity'),
                TextColumn::make('type')->badge(),
                TextColumn::make('commodity_type')->toggleable(),
                TextColumn::make('quantity')
                    ->formatStateUsing(fn($state, $record) => $state ? "{$state} {$record->unit}" : '—'),
                TextColumn::make('date_confiscated')->date()->sortable(),
                TextColumn::make('disposition')
                    ->badge()
                    ->colors([
                        'gray' => 'Pending',
                        'success' => ['Donated', 'Forfeited'],
                        'danger' => 'Destroyed',
                        'primary' => 'Released',
                        'warning' => 'Sold',
                    ]),
                TextColumn::make('office.name')->label('Office')->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')->options(self::typeOptions()),
                SelectFilter::make('commodity_type')->options(self::commodityTypeOptions()),
                SelectFilter::make('disposition')->options(self::dispositionOptions()),
                SelectFilter::make('office_id')->label('Office')
                    ->relationship('office', 'name')->searchable()->preload(),
            ])
            ->defaultSort('date_confiscated', 'desc')
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
