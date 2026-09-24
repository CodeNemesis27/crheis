<?php

namespace App\Filament\Resources\EnforcementCases\Pages;

use App\Filament\Resources\EnforcementCases\EnforcementCaseResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEnforcementCase extends EditRecord
{
    protected static string $resource = EnforcementCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        if ($this->record->wasChanged('current_status')) {
            $this->record->statusHistory()->create([
                'status' => $this->record->current_status,
                'changed_by' => auth()->id(),
                'changed_at' => now(),
            ]);
        }
    }
}
