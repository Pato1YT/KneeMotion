<?php

namespace App\Filament\Resources\SesionResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class EjerciciosSesionRelationManager extends RelationManager
{
    protected static string $relationship = 'ejerciciosSesion'; // nombre del método en el modelo Sesion

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('idEjercicio')
                ->label('Ejercicio aplicado')
                ->relationship('ejercicio', 'nombre')
                ->required(),

            Forms\Components\TextInput::make('duracion')
                ->label('Duración aplicada (min)')
                ->numeric()
                ->minValue(1)
                ->required(),

            Forms\Components\TextInput::make('intensidad')
                ->label('Intensidad aplicada (%)')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('ejercicio.nombre')
                ->label('Ejercicio')
                ->sortable(),

            Tables\Columns\TextColumn::make('duracion')
                ->label('Duración (min)')
                ->sortable(),

            Tables\Columns\TextColumn::make('intensidad')
                ->label('Intensidad (%)')
                ->sortable(),
        ])
        ->headerActions([
            Tables\Actions\CreateAction::make(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }
}
