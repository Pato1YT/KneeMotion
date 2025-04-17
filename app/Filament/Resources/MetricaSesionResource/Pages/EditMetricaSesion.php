<?php

namespace App\Filament\Resources\MetricaSesionResource\Pages;

use App\Filament\Resources\MetricaSesionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMetricaSesion extends EditRecord
{
    protected static string $resource = MetricaSesionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
