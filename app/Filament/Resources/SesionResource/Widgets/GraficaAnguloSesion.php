<?php

namespace App\Filament\Resources\SesionResource\Widgets;

use App\Models\MetricaSesion;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Route;
use Filament\Support\Enums\Alignment;

class GraficaAnguloSesion extends Widget
{
    protected static string $view = 'filament.resources.sesion-resource.widgets.grafica-angulo-sesion';

    public ?int $sessionId = null;

    public function mount(): void
    {
        $this->sessionId = request()->route('record'); // obtiene el ID de la sesión actual
    }

    protected function getViewData(): array
    {
        $metricas = MetricaSesion::where('idSesion', $this->sessionId)
            ->orderBy('momento')
            ->get(['momento', 'angulo']);

        return [
            'datos' => $metricas->map(fn ($m) => [
                'momento' => $m->momento->format('H:i:s'),
                'angulo' => $m->angulo,
            ]),
        ];
    }
}
