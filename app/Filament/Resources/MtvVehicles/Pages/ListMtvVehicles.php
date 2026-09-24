<?php

namespace App\Filament\Resources\MtvVehicles\Pages;

use App\Filament\Resources\MtvVehicles\MtvVehicleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMtvVehicles extends ListRecords
{
    protected static string $resource = MtvVehicleResource::class;

    protected ?string $heading = 'MTV Vehicles';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
