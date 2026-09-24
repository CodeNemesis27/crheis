<?php

namespace App\Filament\Resources\MtvOperators\Pages;

use App\Filament\Resources\MtvOperators\MtvOperatorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMtvOperator extends CreateRecord
{
    protected static string $resource = MtvOperatorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }
}
