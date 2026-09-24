<?php

namespace App\Filament\Resources\EnforcementActions\Pages;

use App\Filament\Resources\EnforcementActions\EnforcementActionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEnforcementActions extends ListRecords
{
    protected static string $resource = EnforcementActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
