<?php

namespace App\Filament\Resources\DispositivoResource\Pages;

use App\Filament\Resources\DispositivoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDispositivo extends CreateRecord
{
    protected static string $resource = DispositivoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['ultima_sincronizacion'] = now(); // o Carbon::now()
        return $data;
    }
}
