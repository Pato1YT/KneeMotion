<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SesionResource\Pages;
use App\Filament\Resources\SesionResource\RelationManagers;
use App\Models\Sesion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SesionResource extends Resource
{
    protected static ?string $model = Sesion::class;

    protected static ?string $navigationIcon = 'heroicon-s-calendar';

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
            'index' => Pages\ListSesions::route('/'),
            'create' => Pages\CreateSesion::route('/create'),
            'edit' => Pages\EditSesion::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Sesión';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Sesiones';
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
