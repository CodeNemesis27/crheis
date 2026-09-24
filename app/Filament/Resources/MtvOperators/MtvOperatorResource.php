<?php

namespace App\Filament\Resources\MtvOperators;

use App\Filament\Resources\MtvOperators\Pages\CreateMtvOperator;
use App\Filament\Resources\MtvOperators\Pages\EditMtvOperator;
use App\Filament\Resources\MtvOperators\Pages\ListMtvOperators;
use App\Filament\Resources\MtvOperators\Pages\ViewMtvOperator;
use App\Filament\Resources\MtvOperators\Schemas\MtvOperatorForm;
use App\Filament\Resources\MtvOperators\Schemas\MtvOperatorInfolist;
use App\Filament\Resources\MtvOperators\Tables\MtvOperatorsTable;
use App\Models\MtvOperator;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MtvOperatorResource extends Resource
{
    protected static ?string $model = MtvOperator::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;

    protected static string|UnitEnum|null $navigationGroup = 'Regulated Entities';

    protected static ?string $navigationLabel = 'MTV Operators';

    public static function form(Schema $schema): Schema
    {
        return MtvOperatorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MtvOperatorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MtvOperatorsTable::configure($table);
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
            'index' => ListMtvOperators::route('/'),
            'create' => CreateMtvOperator::route('/create'),
            'view' => ViewMtvOperator::route('/{record}'),
            'edit' => EditMtvOperator::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
