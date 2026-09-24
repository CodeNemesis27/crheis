<?php

namespace App\Filament\Resources\Confiscations\Pages;

use App\Filament\Resources\Confiscations\ConfiscationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditConfiscation extends EditRecord
{
    protected static string $resource = ConfiscationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
