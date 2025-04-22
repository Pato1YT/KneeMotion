<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MetricaSesionResource\Pages;
use App\Filament\Resources\MetricaSesionResource\RelationManagers;
use App\Models\MetricaSesion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MetricaSesionResource extends Resource
{
    protected static ?string $model = MetricaSesion::class;

    protected static ?string $navigationIcon = 'heroicon-s-chart-bar';

    protected static ?string $navigationGroup = 'Sesiones';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('sesion.paciente.nombre')
                ->label('Paciente')
                ->searchable()
                ->sortable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('sesion.inicio')
                ->label('Inicio de Sesión')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('sesion.paciente.usuario.nombre')
                ->label('Fisioterapeuta')
                ->toggleable(),
                Tables\Columns\TextColumn::make('idSesion')
                ->label('Sesión')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('momento')
                ->label('Momento')
                ->dateTime('d/m/Y H:i:s')
                ->sortable(),
                Tables\Columns\TextColumn::make('angulo')
                ->label('Ángulo (°)')
                ->sortable(),
                Tables\Columns\TextColumn::make('fuerza')
                ->label('Fuerza')
                ->sortable(),
                Tables\Columns\TextColumn::make('temperatura')
                ->label('Temperatura (°C)')
                ->sortable(),
                Tables\Columns\TextColumn::make('intensidad_fes')
                ->label('FES (%)')
                ->sortable(),
            ])
            ->defaultSort('momento', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->action(fn (MetricaSesion $record) => $record->delete())
                ->requiresConfirmation()
                ->modalIcon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMetricaSesions::route('/'),
            'create' => Pages\CreateMetricaSesion::route('/create'),
            'edit' => Pages\EditMetricaSesion::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Lecturas de Dispositivos';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Lecturas de Dispositivos';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() == 0 ? 'warning' : 'primary';
    }
}
