<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Filament\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use App\Models\Usuario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Pacientes';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('idUsuario')
                ->label('Fisioterapeuta')
                ->required()
                ->options(Usuario::all()->pluck('nombre', 'idUsuario')),
                Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(100),
                Forms\Components\TextInput::make('correo')
                ->required()
                ->email()
                ->maxLength(100),
                Forms\Components\DatePicker::make('fecha_nacimiento')
                ->label('Fecha de nacimiento')
                ->required()
                ->native(false)
                ->closeOnDateSelection()
                ->maxDate(now()),
                Forms\Components\Select::make('genero')
                ->label('Genero')
                ->required()
                ->options([
                'masculino' => 'Masculino',
                'femenino' => 'Femenino',
                'otro' => 'Otro',
                ])
                ->native(false),
                Forms\Components\Textarea::make('diagnostico')
                ->label('Diagnóstico')
                ->required()
                ->rows(4)
                ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('idUsuario')
                ->label('Fisioterapeuta')
                ->formatStateUsing(fn ($state) => \App\Models\Usuario::find($state)?->nombre)
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('correo')
                ->label('Correo')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                ->date()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)->label('Fecha de Nacimiento'),
                Tables\Columns\TextColumn::make('genero')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)->label('Genero'),
                Tables\Columns\TextColumn::make('diagnostico')
                ->label('Diagnóstico')
                ->limit(50)
                ->tooltip(fn ($record) => $record->diagnostico)
                ->wrap()
                ->toggleable(isToggledHiddenByDefault: true)->label('Diagnostico'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)->label('Creado'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)->label('Actualizado'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->action(fn (Paciente $record) => $record->delete())
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
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
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
