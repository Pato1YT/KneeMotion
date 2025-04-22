<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MetricaSesionResource\Pages;
use App\Models\MetricaSesion;
use App\Models\Sesion;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MetricaSesionResource extends Resource
{
    protected static ?string $model = MetricaSesion::class;

    protected static ?string $navigationIcon = 'heroicon-s-chart-bar';

    protected static ?string $navigationGroup = 'Sesiones';

    protected static ?int $navigationSort = 4;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('idSesion')
                    ->relationship('sesion', 'idSesion')
                    ->required()
                    ->label('Sesión'),

                TextInput::make('metrica')
                    ->required()
                    ->label('Métrica'),

                TextInput::make('valor')
                    ->numeric()
                    ->required()
                    ->label('Valor'),

                TextInput::make('unidad')
                    ->required()
                    ->label('Unidad'),

                DateTimePicker::make('momento')
                    ->required()
                    ->label('Momento'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sesion.idSesion')->label('Sesión'),
                Tables\Columns\TextColumn::make('metrica')->label('Métrica'),
                Tables\Columns\TextColumn::make('valor')->label('Valor'),
                Tables\Columns\TextColumn::make('unidad')->label('Unidad'),
                Tables\Columns\TextColumn::make('momento')->label('Momento'),
                Tables\Columns\TextColumn::make('created_at')->label('Creado'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMetricaSesions::route('/'),
            'create' => Pages\CreateMetricaSesion::route('/create'),
            'edit' => Pages\EditMetricaSesion::route('/{record}/edit'),
        ];
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
