<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DispositivoResource\Pages;
use App\Filament\Resources\DispositivoResource\RelationManagers;
use App\Models\Dispositivo;
use App\Models\Paciente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DispositivoResource extends Resource
{
    protected static ?string $model = Dispositivo::class;

    protected static ?string $navigationIcon = 'heroicon-s-server';

    protected static ?string $navigationGroup = 'Dispositivos';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('numero_serie')
                ->label('Número de Serie')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('modelo')
                ->maxLength(100),
                Forms\Components\TextInput::make('version_firmware')
                ->label('Versión de Firmware')
                ->maxLength(100),
                Forms\Components\Select::make('estado')
                ->required()
                ->options([
                    'activo' => 'Activo',
                    'mantenimiento' => 'Mantenimiento',
                    'inactivo' => 'Inactivo'
                ]),
                Forms\Components\Select::make('idPaciente')
                ->label('Paciente')
                ->options(Paciente::all()->pluck('nombre', 'idPaciente')),
                // Forms\Components\DatePicker::make('ultima_sincronizacion')
                // ->label('Ultima sincronización')
                // ->required()
                // ->native(false)
                // ->closeOnDateSelection()
                // ->maxDate(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('numero_serie')
                ->label('Número de Serie')
                ->sortable()
                ->searchable()
                ->wrap(),
                Tables\Columns\TextColumn::make('modelo')
                ->sortable()
                ->searchable()
                ->wrap(),
                Tables\Columns\TextColumn::make('version_firmware')
                ->sortable()
                ->searchable()
                ->wrap(),
                Tables\Columns\TextColumn::make('idPaciente')
                ->label('Paciente')
                ->formatStateUsing(fn ($state) => \App\Models\Paciente::find($state)?->nombre)
                ->sortable()
                ->searchable()
                ->wrap()
                ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('ultima_sincronizacion')
                ->dateTime()
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)->label('Ultima sincronización')
                ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)->label('Creado')
                ->wrap(),
                Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)->label('Actualizado')
                ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->action(fn (Dispositivo $record) => $record->delete())
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
            'index' => Pages\ListDispositivos::route('/'),
            'create' => Pages\CreateDispositivo::route('/create'),
            'edit' => Pages\EditDispositivo::route('/{record}/edit'),
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
