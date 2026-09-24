<?php

namespace App\Filament\Resources\EnforcementCases;

use App\Filament\Resources\EnforcementCases\Pages\CreateEnforcementCase;
use App\Filament\Resources\EnforcementCases\Pages\EditEnforcementCase;
use App\Filament\Resources\EnforcementCases\Pages\ListEnforcementCases;
use App\Filament\Resources\EnforcementCases\Pages\ViewEnforcementCase;
use App\Filament\Resources\EnforcementCases\RelationManagers\StatusHistoryRelationManager;
use App\Filament\Resources\EnforcementCases\Schemas\EnforcementCaseForm;
use App\Filament\Resources\EnforcementCases\Schemas\EnforcementCaseInfolist;
use App\Filament\Resources\EnforcementCases\Tables\EnforcementCasesTable;
use App\Models\EnforcementCase;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EnforcementCaseResource extends Resource
{
    protected static ?string $model = EnforcementCase::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static string|UnitEnum|null $navigationGroup = 'Enforcement';

    public static function form(Schema $schema): Schema
    {
        return EnforcementCaseForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EnforcementCaseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EnforcementCasesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            StatusHistoryRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEnforcementCases::route('/'),
            'create' => CreateEnforcementCase::route('/create'),
            'view' => ViewEnforcementCase::route('/{record}'),
            'edit' => EditEnforcementCase::route('/{record}/edit'),
        ];
    }
}
