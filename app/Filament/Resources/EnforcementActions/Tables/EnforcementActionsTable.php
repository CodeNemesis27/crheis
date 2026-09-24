<?php

namespace App\Filament\Resources\EnforcementActions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EnforcementActionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['subject', 'violation', 'issuedBy', 'office']))
            ->columns([
                TextColumn::make('action_number')->searchable()->sortable(),
                TextColumn::make('subject_label')->label('Entity'),
                TextColumn::make('action_type')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => self::actionTypeOptions()[$state] ?? $state),
                TextColumn::make('violation.violation_number')->label('Violation')->placeholder('—'),
                TextColumn::make('penalty_amount')->money('PHP')->placeholder('—')->toggleable(),
                TextColumn::make('issued_at')->date()->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => self::statusOptions()[$state] ?? $state)
                    ->colors([
                        'gray' => 'issued',
                        'primary' => 'acknowledged',
                        'success' => 'complied',
                        'warning' => 'contested',
                        'secondary' => 'lifted',
                    ]),
                TextColumn::make('office.name')->label('Office')->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('action_type')->options(self::actionTypeOptions()),
                SelectFilter::make('status')->options(self::statusOptions()),
                SelectFilter::make('office_id')->label('Office')
                    ->relationship('office', 'name')->searchable()->preload(),
            ])
            ->defaultSort('issued_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }

    protected static function statusOptions(): array
    {
        return [
            'Issued' => 'Issued',
            'Acknowledged' => 'Acknowledged',
            'Complied' => 'Complied',
            'Contested' => 'Contested',
            'Lifted' => 'Lifted',
        ];
    }

    protected static function actionTypeOptions(): array
    {
        return [
            'Notice of Violation' => 'Notice of Violation',
            'Warning' => 'Warning',
            'Show Cause Order' => 'Show Cause Order',
            'Suspension' => 'Suspension',
            'Revocation' => 'Revocation',
            'Fine' => 'Fine',
            'Closure Order' => 'Closure Order',
            'Other' => 'Other',
        ];
    }
}
