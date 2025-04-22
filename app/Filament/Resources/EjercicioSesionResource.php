<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EjercicioSesionResource\Pages;
use App\Filament\Resources\EjercicioSesionResource\RelationManagers;
use App\Models\EjercicioSesion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EjercicioSesionResource extends Resource
{
    protected static ?string $model = EjercicioSesion::class;

    protected static ?string $navigationIcon = 'heroicon-s-check-badge';

    protected static ?string $navigationGroup = 'Ejercicios';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('idSesion')
                ->label('Sesión')
                ->relationship('sesion', 'idSesion') // relación si está definida
                ->required(),
                Forms\Components\Select::make('idEjercicio')
                ->label('Ejercicio aplicado')
                ->relationship('ejercicio', 'nombre') // usa el nombre del ejercicio
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('sesion.idSesion')
                ->label('Sesión')
                ->sortable(),
                Tables\Columns\TextColumn::make('ejercicio.nombre')
                ->label('Ejercicio')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('duracion')
                ->label('Duración (min)')
                ->sortable(),
                Tables\Columns\TextColumn::make('intensidad')
                ->label('Intensidad (%)')
                ->sortable(),
            ])
            ->defaultSort('idSesion', 'desc')
            
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->action(fn (EjercicioSesion $record) => $record->delete())
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
            'index' => Pages\ListEjercicioSesions::route('/'),
            'create' => Pages\CreateEjercicioSesion::route('/create'),
            'edit' => Pages\EditEjercicioSesion::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Ejercicios Realizados';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Ejercicios Realizados';
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
