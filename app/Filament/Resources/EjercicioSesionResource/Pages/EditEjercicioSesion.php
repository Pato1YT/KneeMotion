<?php

namespace App\Filament\Resources\EjercicioSesionResource\Pages;

use App\Filament\Resources\EjercicioSesionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEjercicioSesion extends EditRecord
{
    protected static string $resource = EjercicioSesionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
