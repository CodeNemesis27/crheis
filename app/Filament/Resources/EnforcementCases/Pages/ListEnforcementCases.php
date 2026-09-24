<?php

namespace App\Filament\Resources\EnforcementCases\Pages;

use App\Filament\Resources\EnforcementCases\EnforcementCaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEnforcementCases extends ListRecords
{
    protected static string $resource = EnforcementCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
