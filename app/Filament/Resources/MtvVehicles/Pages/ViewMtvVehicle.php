<?php

namespace App\Filament\Resources\MtvVehicles\Pages;

use App\Filament\Resources\MtvVehicles\MtvVehicleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMtvVehicle extends ViewRecord
{
    protected static string $resource = MtvVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
