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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        return 'Ejercicio de Sesión';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Ejercicios de Sesiones';
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
