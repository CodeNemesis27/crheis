<?php

namespace App\Filament\Resources\MeatEstablishments\Pages;

use App\Filament\Resources\MeatEstablishments\MeatEstablishmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMeatEstablishments extends ListRecords
{
    protected static string $resource = MeatEstablishmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
