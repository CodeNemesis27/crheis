<?php

namespace App\Filament\Resources\Confiscations\Pages;

use App\Filament\Resources\Confiscations\ConfiscationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewConfiscation extends ViewRecord
{
    protected static string $resource = ConfiscationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
