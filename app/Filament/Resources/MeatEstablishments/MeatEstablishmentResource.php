<?php

namespace App\Filament\Resources\MeatEstablishments;

use App\Filament\Resources\MeatEstablishments\Pages\CreateMeatEstablishment;
use App\Filament\Resources\MeatEstablishments\Pages\EditMeatEstablishment;
use App\Filament\Resources\MeatEstablishments\Pages\ListMeatEstablishments;
use App\Filament\Resources\MeatEstablishments\Pages\ViewMeatEstablishment;
use App\Filament\Resources\MeatEstablishments\Schemas\MeatEstablishmentForm;
use App\Filament\Resources\MeatEstablishments\Schemas\MeatEstablishmentInfolist;
use App\Filament\Resources\MeatEstablishments\Tables\MeatEstablishmentsTable;
use App\Models\MeatEstablishment;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MeatEstablishmentResource extends Resource
{
    protected static ?string $model = MeatEstablishment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static string|UnitEnum|null $navigationGroup = 'Regulated Entities';

    protected static ?string $recordTitleAttribute = 'business_name';

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Registration No.' => $record->registration_number,
            'Establishment Type' => $record->establishment_type,
        ];
    }

    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Action::make('view')
                ->url(static::getUrl('view', ['record' => $record])),
            Action::make('edit')
                ->url(static::getUrl('edit', ['record' => $record])),
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return MeatEstablishmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MeatEstablishmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MeatEstablishmentsTable::configure($table);
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
            'index' => ListMeatEstablishments::route('/'),
            'create' => CreateMeatEstablishment::route('/create'),
            'view' => ViewMeatEstablishment::route('/{record}'),
            'edit' => EditMeatEstablishment::route('/{record}/edit'),
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
