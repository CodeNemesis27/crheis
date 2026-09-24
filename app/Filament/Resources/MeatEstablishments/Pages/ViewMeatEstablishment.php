<?php

namespace App\Filament\Resources\MeatEstablishments\Pages;

use App\Filament\Resources\MeatEstablishments\MeatEstablishmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMeatEstablishment extends ViewRecord
{
    protected static string $resource = MeatEstablishmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
