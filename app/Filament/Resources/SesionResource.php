<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SesionResource\Pages;
use App\Filament\Resources\SesionResource\RelationManagers;
use App\Models\Dispositivo;
use App\Models\Paciente;
use App\Models\Sesion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SesionResource\Widgets\GraficaAnguloSesion;

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
                Forms\Components\Select::make('idPaciente')
                ->label('Paciente')
                ->required()
                ->options(Paciente::all()->pluck('nombre', 'idPaciente')),
                Forms\Components\Select::make('idDispositivo')
                ->label('Dispositivo')
                ->required()
                ->options(Dispositivo::all()->pluck('numero_serie', 'idDispositivo')),
                Forms\Components\DateTimePicker::make('inicio')
                ->label('Inicio de la sesión')
                ->required()
                ->seconds(false) // puedes habilitarlo si quieres precisión de segundos
                ->native(false) // muestra el datepicker de Filament, no el nativo del navegador
                ->maxDate(now()),
                Forms\Components\DateTimePicker::make('fin')
                ->label('Fin de la sesión')
                ->required()
                ->seconds(false) // puedes habilitarlo si quieres precisión de segundos
                ->native(false) // muestra el datepicker de Filament, no el nativo del navegador
                ->maxDate(now()),
                Forms\Components\Select::make('nivel_dolor')
                ->label('Nivel de dolor')
                ->options(array_combine(range(0, 10), range(0, 10)))
                ->required(),
                Forms\Components\Textarea::make('notas')
                ->label('Notas del fisioterapeuta')
                ->placeholder('Observaciones sobre el progreso del paciente...')
                ->rows(5)
                ->columnSpanFull()
                ->maxLength(1000) // opcional
                ->helperText('Puedes registrar molestias, progreso o cualquier observación clínica.')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('paciente.nombre')
                ->label('Paciente')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('dispositivo.numero_serie')
                ->label('Dispositivo')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('inicio')
                ->label('Inicio')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('fin')
                ->label('Fin')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(),
                Tables\Columns\BadgeColumn::make('nivel_dolor')
                ->label('Dolor')
                ->colors([
                    'success' => static fn ($state): bool => $state <= 3,
                    'warning' => static fn ($state): bool => $state >= 4 && $state <= 6,
                    'danger' => static fn ($state): bool => $state >= 7,
                ])
                ->sortable(),

                Tables\Columns\TextColumn::make('notas')
                ->label('Notas')
                ->limit(50)
                ->wrap()
                ->tooltip(fn ($record) => $record->notas)
                ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)->label('Creado'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)->label('Actualizado'),
                ])
                ->defaultSort('inicio', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->action(fn (Sesion $record) => $record->delete())
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
            \App\Filament\Resources\SesionResource\RelationManagers\EjerciciosSesionRelationManager::class,
            \App\Filament\Resources\SesionResource\RelationManagers\MetricasSesionRelationManager::class,
        ];
    }

    // public static function getWidgets(): array
    // {
    // return [
    //     GraficaAnguloSesion::class,
    //     ];
    // }

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
