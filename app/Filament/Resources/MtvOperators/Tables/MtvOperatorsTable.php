<?php

namespace App\Filament\Resources\MtvOperators\Tables;

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

class MtvOperatorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('operator_name')->searchable()->sortable(),
                TextColumn::make('operator_type')->badge(),
                TextColumn::make('owner_name')->searchable()->toggleable(),
                TextColumn::make('accreditation_number')->searchable()->toggleable(),
                TextColumn::make('accreditation_status')
                    ->badge()
                    ->colors([
                        'gray' => 'Pending',
                        'success' => 'Active',
                        'warning' => ['Suspended', 'Expired'],
                        'danger' => 'Revoked',
                        'secondary' => 'Closed',
                    ]),
                TextColumn::make('accreditation_expiry_at')->date()->sortable()->toggleable(),
                TextColumn::make('vehicles_count')->label('Vehicles')->counts('vehicles'),
                TextColumn::make('registeringOffice.name')->label('Office')->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('operator_type')
                    ->options([
                        'Individual' => 'Individual',
                        'Company' => 'Company',
                    ]),
                SelectFilter::make('accreditation_status')->options([
                    'Pending' => 'Pending',
                    'Active' => 'Active',
                    'Suspended' => 'Suspended',
                    'Revoked' => 'Revoked',
                    'Expired' => 'Expired',
                    'Closed' => 'Closed',
                ]),
                SelectFilter::make('registering_office_id')->label('Office')
                    ->relationship('registeringOffice', 'name')->searchable()->preload(),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->defaultSort('operator_name');
    }
}
