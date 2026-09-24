<?php

namespace App\Filament\Resources\MtvVehicles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class MtvVehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('plate_number')->searchable()->sortable(),
                TextColumn::make('mtvOperator.operator_name')->label('Operator')->searchable(),
                TextColumn::make('vehicle_type')->badge(),
                TextColumn::make('make')->toggleable(),
                TextColumn::make('model')->toggleable(),
                TextColumn::make('permit_number')->searchable()->toggleable(),
                TextColumn::make('permit_status')
                    ->badge()
                    ->colors([
                        'gray' => 'Pending',
                        'success' => 'Active',
                        'warning' => ['Suspended', 'Expired'],
                        'danger' => 'Revoked',
                    ]),
                TextColumn::make('permit_expiry_at')->date()->sortable()->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('vehicle_type')->options([
                    'Refrigerated Van' => 'Refrigerated Van',
                    'Insulated Truck' => 'Insulated Truck',
                    'Open Truck' => 'Open Truck',
                    'Other' => 'Other',
                ]),
                SelectFilter::make('permit_status')->options([
                    'Pending' => 'Pending',
                    'Active' => 'Active',
                    'Suspended' => 'Suspended',
                    'Revoked' => 'Revoked',
                    'Expired' => 'Expired',
                ]),
                SelectFilter::make('mtv_operator_id')->label('Operator')
                    ->relationship('mtvOperator', 'operator_name')->searchable()->preload(),
                // TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->defaultSort('plate_number');
    }
}
