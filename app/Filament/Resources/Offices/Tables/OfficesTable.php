<?php

namespace App\Filament\Resources\Offices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OfficesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->searchable()->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'primary' => 'national',
                        'success' => 'regional',
                        'warning' => 'provincial',
                        'gray' => ['city', 'municipal', 'lgu'],
                    ]),
                TextColumn::make('parentOffice.name')
                    ->label('Parent office')
                    ->placeholder('—'),
                TextColumn::make('region')->toggleable(),
                TextColumn::make('province')->toggleable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'national' => 'National',
                        'regional' => 'Regional',
                        'provincial' => 'Provincial',
                        'city' => 'City',
                        'municipal' => 'Municipal',
                        'lgu' => 'LGU',
                    ]),
                TernaryFilter::make('is_active'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->defaultSort('name');
    }
}
