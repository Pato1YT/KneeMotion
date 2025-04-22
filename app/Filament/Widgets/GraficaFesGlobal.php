<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\MetricaSesion;

class GraficaFesGlobal extends ChartWidget
{
    protected static ?string $heading = '⚡ FES promedio por sesión';
    protected static ?int $sort = 20;
    protected function getData(): array
    {
        $datos = MetricaSesion::selectRaw('idSesion, AVG(intensidad_fes) as promedio_fes')
            ->groupBy('idSesion')
            ->orderBy('idSesion')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'FES promedio (%)',
                    'data' => $datos->pluck('promedio_fes'),
                    'borderColor' => '#ff9800',
                    'backgroundColor' => 'rgba(255,152,0,0.2)',
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
