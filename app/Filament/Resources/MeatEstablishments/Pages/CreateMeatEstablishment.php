<?php

namespace App\Filament\Resources\MeatEstablishments\Pages;

use App\Filament\Resources\MeatEstablishments\MeatEstablishmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMeatEstablishment extends CreateRecord
{
    protected static string $resource = MeatEstablishmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }
}
