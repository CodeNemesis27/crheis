<?php

namespace App\Filament\Resources\ViolationTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ViolationTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('category')
                    ->badge(),
                TextColumn::make('default_severity')
                    ->badge()
                    ->colors([
                        'gray' => 'Minor',
                        'warning' => 'Major',
                        'danger' => 'Critical',
                    ]),
                TextColumn::make('legal_basis')
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'Sanitation' => 'Sanitation',
                        'Documentation' => 'Documentation',
                        'Unauthorized Operation' => 'Unauthorized Operation',
                        'Animal Welfare' => 'Animal Welfare',
                        'Transport Violation' => 'Transport Violation',
                        'Food Safety' => 'Food Safety',
                        'Other' => 'Other',
                    ]),
                SelectFilter::make('default_severity')
                    ->options([
                        'Minor' => 'Minor',
                        'Major' => 'Major',
                        'Critical' => 'Critical',
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
            ->defaultSort('code');
    }
}
