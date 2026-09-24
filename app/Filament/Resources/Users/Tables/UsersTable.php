<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('employee_id')
                    ->label('Employee ID')
                    ->toggleable(),
                TextColumn::make('office.name')
                    ->label('Office')
                    ->placeholder('—'),
                TextColumn::make('role')
                    ->badge(),
                TextColumn::make('position')
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'System Admin' => 'System Admin',
                        'NMIS Central' => 'NMIS Central',
                        'NMIS Regional' => 'NMIS Regional',
                        'Inspector' => 'Inspector',
                        'Legal Officer' => 'Legal Officer',
                        'LGU Staff' => 'LGU Staff',
                        'Viewer' => 'Viewer',
                    ]),
                SelectFilter::make('office_id')
                    ->label('Office')
                    ->relationship('office', 'name')
                    ->searchable()
                    ->preload(),
                TernaryFilter::make('is_active'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->defaultSort('name');
    }
}
