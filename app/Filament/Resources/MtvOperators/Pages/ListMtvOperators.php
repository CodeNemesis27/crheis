<?php

namespace App\Filament\Resources\MtvOperators\Pages;

use App\Filament\Resources\MtvOperators\MtvOperatorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMtvOperators extends ListRecords
{
    protected static string $resource = MtvOperatorResource::class;

    protected ?string $heading = 'MTV Operators';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
