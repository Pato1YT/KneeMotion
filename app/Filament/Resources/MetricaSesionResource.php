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
