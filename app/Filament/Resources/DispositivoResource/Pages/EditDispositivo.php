<?php

namespace App\Filament\Resources\DispositivoResource\Pages;

use App\Filament\Resources\DispositivoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDispositivo extends EditRecord
{
    protected static string $resource = DispositivoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
