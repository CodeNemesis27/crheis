<?php

namespace App\Filament\Resources\EnforcementActions\Pages;

use App\Filament\Resources\EnforcementActions\EnforcementActionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEnforcementAction extends EditRecord
{
    protected static string $resource = EnforcementActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
