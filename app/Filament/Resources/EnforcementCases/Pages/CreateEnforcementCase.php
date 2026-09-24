<?php

namespace App\Filament\Resources\EnforcementCases\Pages;

use App\Filament\Resources\EnforcementCases\EnforcementCaseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEnforcementCase extends CreateRecord
{
    protected static string $resource = EnforcementCaseResource::class;

    protected function afterCreate(): void
    {
        $this->record->statusHistory()->create([
            'status' => $this->record->current_status,
            'remarks' => 'Case filed.',
            'changed_by' => auth()->id(),
            'changed_at' => now(),
        ]);
    }
}
