<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\MetricaSesion;

class GraficaMetricasGlobales extends ChartWidget
{
    protected static ?string $heading = '📐 Ángulo promedio por sesión';

    protected static ?int $sort = 10;
    protected function getData(): array
    {
        // agrupamos por sesión y sacamos el ángulo promedio
        $datos = MetricaSesion::selectRaw('idSesion, AVG(angulo) as promedio_angulo')
            ->groupBy('idSesion')
            ->orderBy('idSesion')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Ángulo promedio (°)',
                    'data' => $datos->pluck('promedio_angulo'),
                    'borderColor' => '#00bfa5',
                    'backgroundColor' => 'rgba(0,191,165,0.2)',
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
