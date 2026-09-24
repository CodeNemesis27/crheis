<?php

namespace App\Filament\Resources\EnforcementActions\Pages;

use App\Filament\Resources\EnforcementActions\EnforcementActionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEnforcementAction extends ViewRecord
{
    protected static string $resource = EnforcementActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
