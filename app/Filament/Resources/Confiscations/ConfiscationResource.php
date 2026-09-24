<?php

namespace App\Filament\Resources\Confiscations;

use App\Filament\Resources\Confiscations\Pages\CreateConfiscation;
use App\Filament\Resources\Confiscations\Pages\EditConfiscation;
use App\Filament\Resources\Confiscations\Pages\ListConfiscations;
use App\Filament\Resources\Confiscations\Pages\ViewConfiscation;
use App\Filament\Resources\Confiscations\Schemas\ConfiscationForm;
use App\Filament\Resources\Confiscations\Schemas\ConfiscationInfolist;
use App\Filament\Resources\Confiscations\Tables\ConfiscationsTable;
use App\Models\Confiscation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ConfiscationResource extends Resource
{
    protected static ?string $model = Confiscation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBoxXMark;

    protected static string|UnitEnum|null $navigationGroup = 'Enforcement';

    public static function form(Schema $schema): Schema
    {
        return ConfiscationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ConfiscationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConfiscationsTable::configure($table);
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
            'index' => ListConfiscations::route('/'),
            'create' => CreateConfiscation::route('/create'),
            'view' => ViewConfiscation::route('/{record}'),
            'edit' => EditConfiscation::route('/{record}/edit'),
        ];
    }
}
