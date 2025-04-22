<?php

namespace App\Filament\Resources\SesionResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class MetricasSesionRelationManager extends RelationManager
{
    protected static string $relationship = 'metricas';

    public function form(Form $form): Form
    {
        return $form->schema([]); // Sin formulario, es solo lectura
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('momento')
                ->label('Momento')
                ->dateTime('d/m/Y H:i:s'),

            Tables\Columns\TextColumn::make('angulo')
                ->label('Ángulo (°)'),

            Tables\Columns\TextColumn::make('fuerza')
                ->label('Fuerza'),

            Tables\Columns\TextColumn::make('temperatura')
                ->label('Temperatura (°C)'),

            Tables\Columns\TextColumn::make('intensidad_fes')
                ->label('FES (%)'),
        ])
        ->paginated([10]) // muestra 10 métricas por página
        ->defaultSort('momento', 'asc');
    }
}
