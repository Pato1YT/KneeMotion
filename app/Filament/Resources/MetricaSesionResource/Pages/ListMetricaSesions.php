<?php

namespace App\Filament\Resources\MetricaSesionResource\Pages;

use App\Filament\Resources\MetricaSesionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMetricaSesions extends ListRecords
{
    protected static string $resource = MetricaSesionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
