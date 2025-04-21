<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EjercicioResource\Pages;
use App\Filament\Resources\EjercicioResource\RelationManagers;
use App\Models\Ejercicio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EjercicioResource extends Resource
{
    protected static ?string $model = Ejercicio::class;

    protected static ?string $navigationIcon = 'heroicon-s-bolt';

    protected static ?string $navigationGroup = 'Ejercicios';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nombre')
                ->label('Nombre del ejercicio')
                ->required()
                ->maxLength(100),
                Forms\Components\Textarea::make('descripcion')
                ->label('Descripción')
                ->rows(4)
                ->maxLength(500)
                ->placeholder('Describe los rangos de movimiento, fases, recomendaciones, etc.')
                ->columnSpanFull(),
                Forms\Components\TextInput::make('duracion_predeterminada')
                ->label('Duración (minutos)')
                ->type('number')
                ->minValue(1)
                ->maxValue(120)
                ->required(),
                Forms\Components\TextInput::make('intensidad_predeterminada')
                ->label('Intensidad (%)')
                ->type('number')
                ->minValue(0)
                ->maxValue(100)
                ->required(),
                Forms\Components\Toggle::make('aplica_fes')
                ->label('¿Incluye estimulación eléctrica funcional (FES)?')
                ->inline(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nombre')
                ->label('Ejercicio')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('duracion_predeterminada')
                ->label('Duración')
                ->suffix(' min')
                ->sortable(),
                Tables\Columns\TextColumn::make('intensidad_predeterminada')
                ->label('Intensidad')
                ->suffix('%')
                ->sortable(),
                Tables\Columns\IconColumn::make('aplica_fes')
                ->label('FES')
                ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)->label('Creado'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)->label('Actualizado'),
            ])
                ->defaultSort('nombre')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->action(fn (Ejercicio $record) => $record->delete())
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
            'index' => Pages\ListEjercicios::route('/'),
            'create' => Pages\CreateEjercicio::route('/create'),
            'edit' => Pages\EditEjercicio::route('/{record}/edit'),
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
