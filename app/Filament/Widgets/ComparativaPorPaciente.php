<?php

namespace App\Filament\Widgets;

use App\Models\Paciente;
use Filament\Widgets\BarChartWidget;

class ComparativaPorPaciente extends BarChartWidget
{
    protected static ?string $heading = '🧑 Dolor promedio por paciente';
    protected static ?int $sort = 40;

    protected function getData(): array
    {
        $pacientes = Paciente::with(['sesiones'])->get();

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($pacientes as $paciente) {
            $promedioDolor = $paciente->sesiones()->avg('nivel_dolor');
            $labels[] = $paciente->nombre;
            $data[] = round($promedioDolor, 2);

            // Asignar color por nivel de dolor
            if ($promedioDolor <= 3) {
                $colors[] = 'rgba(76, 175, 80, 0.6)'; // Verde
            } elseif ($promedioDolor <= 6) {
                $colors[] = 'rgba(255, 152, 0, 0.6)'; // Naranja
            } else {
                $colors[] = 'rgba(244, 67, 54, 0.6)'; // Rojo
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Nivel de dolor (/10)',
                    'data' => $data,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $labels,
        ];
    }


    // protected function getType(): string
    // {
    //     return 'doughnut';
    // }
}
