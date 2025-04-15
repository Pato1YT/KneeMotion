<?php

namespace App\Filament\Resources\DispositivoResource\Pages;

use App\Filament\Resources\DispositivoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDispositivos extends ListRecords
{
    protected static string $resource = DispositivoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
