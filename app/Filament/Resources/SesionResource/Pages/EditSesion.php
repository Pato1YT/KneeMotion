<?php

namespace App\Filament\Resources\SesionResource\Pages;

use App\Filament\Resources\SesionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\SesionResource\Widgets\GraficaAnguloSesion;

class EditSesion extends EditRecord
{
    protected static string $resource = SesionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // public function getHeaderWidgets(): array
    // {
    //     return [
    //     GraficaAnguloSesion::class,
    //     ];
    // }
}
