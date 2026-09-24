<?php

namespace App\Filament\Resources\MtvOperators\Pages;

use App\Filament\Resources\MtvOperators\MtvOperatorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMtvOperator extends EditRecord
{
    protected static string $resource = MtvOperatorResource::class;

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
