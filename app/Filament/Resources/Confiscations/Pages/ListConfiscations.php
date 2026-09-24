<?php

namespace App\Filament\Resources\Confiscations\Pages;

use App\Filament\Resources\Confiscations\ConfiscationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConfiscations extends ListRecords
{
    protected static string $resource = ConfiscationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
