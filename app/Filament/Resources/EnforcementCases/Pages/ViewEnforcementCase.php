<?php

namespace App\Filament\Resources\EnforcementCases\Pages;

use App\Filament\Resources\EnforcementCases\EnforcementCaseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEnforcementCase extends ViewRecord
{
    protected static string $resource = EnforcementCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
