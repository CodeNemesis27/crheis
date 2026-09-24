<?php

namespace App\Filament\Resources\MtvVehicles;

use App\Filament\Resources\MtvVehicles\Pages\CreateMtvVehicle;
use App\Filament\Resources\MtvVehicles\Pages\EditMtvVehicle;
use App\Filament\Resources\MtvVehicles\Pages\ListMtvVehicles;
use App\Filament\Resources\MtvVehicles\Pages\ViewMtvVehicle;
use App\Filament\Resources\MtvVehicles\Schemas\MtvVehicleForm;
use App\Filament\Resources\MtvVehicles\Schemas\MtvVehicleInfolist;
use App\Filament\Resources\MtvVehicles\Tables\MtvVehiclesTable;
use App\Models\MtvVehicle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MtvVehicleResource extends Resource
{
    protected static ?string $model = MtvVehicle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static string|UnitEnum|null $navigationGroup = 'Regulated Entities';

    protected static ?string $navigationLabel = 'MTV Vehicles';

    public static function form(Schema $schema): Schema
    {
        return MtvVehicleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MtvVehicleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MtvVehiclesTable::configure($table);
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
            'index' => ListMtvVehicles::route('/'),
            'create' => CreateMtvVehicle::route('/create'),
            'view' => ViewMtvVehicle::route('/{record}'),
            'edit' => EditMtvVehicle::route('/{record}/edit'),
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
