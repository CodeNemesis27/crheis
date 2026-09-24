<?php

namespace App\Filament\Resources\EnforcementActions;

use App\Filament\Resources\EnforcementActions\Pages\CreateEnforcementAction;
use App\Filament\Resources\EnforcementActions\Pages\EditEnforcementAction;
use App\Filament\Resources\EnforcementActions\Pages\ListEnforcementActions;
use App\Filament\Resources\EnforcementActions\Pages\ViewEnforcementAction;
use App\Filament\Resources\EnforcementActions\Schemas\EnforcementActionForm;
use App\Filament\Resources\EnforcementActions\Schemas\EnforcementActionInfolist;
use App\Filament\Resources\EnforcementActions\Tables\EnforcementActionsTable;
use App\Models\EnforcementAction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EnforcementActionResource extends Resource
{
    protected static ?string $model = EnforcementAction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldExclamation;

    protected static string|UnitEnum|null $navigationGroup = 'Enforcement';

    public static function form(Schema $schema): Schema
    {
        return EnforcementActionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EnforcementActionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EnforcementActionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEnforcementActions::route('/'),
            'create' => CreateEnforcementAction::route('/create'),
            'view' => ViewEnforcementAction::route('/{record}'),
            'edit' => EditEnforcementAction::route('/{record}/edit'),
        ];
    }
}
