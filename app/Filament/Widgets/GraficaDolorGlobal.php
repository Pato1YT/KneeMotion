<?php

namespace App\Filament\Widgets;

use App\Models\Sesion;
use Filament\Widgets\LineChartWidget;

class GraficaDolorGlobal extends LineChartWidget
{
    protected static ?string $heading = '😣 Nivel de dolor promedio por sesión';
    protected static ?int $sort = 30;

    protected function getData(): array
    {
        $datos = Sesion::select('idSesion', 'nivel_dolor')
            ->orderBy('idSesion')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Dolor (0 a 10)',
                    'data' => $datos->pluck('nivel_dolor'),
                    'borderColor' => '#f44336',
                    'backgroundColor' => 'rgba(244,67,54,0.2)',
                ],
            ],
            'labels' => $datos->pluck('idSesion'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
