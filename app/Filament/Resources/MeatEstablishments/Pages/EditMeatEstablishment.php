<?php

namespace App\Filament\Resources\MeatEstablishments\Pages;

use App\Filament\Resources\MeatEstablishments\MeatEstablishmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMeatEstablishment extends EditRecord
{
    protected static string $resource = MeatEstablishmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
