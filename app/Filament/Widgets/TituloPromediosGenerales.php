<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TituloPromediosGenerales extends Widget
{
    protected static string $view = 'filament.widgets.titulo-promedios-generales';

    protected static ?string $heading = null; // desactiva el heading automático
    protected static ?int $sort = 0; // para que se muestre arriba
    protected static ?string $maxWidth = 'full';
}
