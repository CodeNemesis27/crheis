<?php

namespace App\Filament\Resources\MeatEstablishments\Tables;

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

class MeatEstablishmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registration_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('business_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('establishment_type')
                    ->badge(),
                TextColumn::make('owner_name')
                    ->searchable(),
                TextColumn::make('accreditation_status')
                    ->badge()
                    ->colors([
                        'gray' => 'Pending',
                        'success' => 'Active',
                        'warning' => ['Suspended', 'Expired'],
                        'danger' => 'Revoked',
                        'secondary' => 'Closed',
                    ]),
                TextColumn::make('accreditation_expiry_at')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('registeringOffice.name')
                    ->label('Office')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('establishment_type')
                    ->options([
                        'Wet Market' => 'Wet Market',
                        'Slaughterhouse' => 'Slaughterhouse',
                        'Butchery' => 'Butchery',
                        'Poultry Dressing Plant' => 'Poultry Dressing Plant',
                        'Meat Cutting Plant' => 'Meat Cutting Plant',
                        'Meat Processing Plant' => 'Meat Processing Plant',
                        'Cold Storage' => 'Cold Storage',
                        'Meat Shop' => 'Meat Shop',
                        'Warehouse' => 'Warehouse',
                        'Supermarket' => 'Supermarket',
                        'MTV' => 'MTV',
                    ]),
                SelectFilter::make('accreditation_status')
                    ->options([
                        'Pending' => 'Pending',
                        'Active' => 'Active',
                        'Suspended' => 'Suspended',
                        'Revoked' => 'Revoked',
                        'Expired' => 'Expired',
                        'Closed' => 'Closed',
                    ]),
                SelectFilter::make('registering_office_id')
                    ->label('Office')
                    ->relationship('registeringOffice', 'name')
                    ->searchable()
                    ->preload(),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->defaultSort('business_name');
    }
}
