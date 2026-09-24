<?php

namespace App\Filament\Resources\MtvOperators\Pages;

use App\Filament\Resources\MtvOperators\MtvOperatorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMtvOperator extends ViewRecord
{
    protected static string $resource = MtvOperatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
