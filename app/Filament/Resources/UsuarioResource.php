<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuarioResource\Pages;
use App\Filament\Resources\UsuarioResource\RelationManagers;
use App\Models\Usuario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsuarioResource extends Resource
{
    protected static ?string $model = Usuario::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?string $navigationGroup = 'Usuarios';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(100),
                Forms\Components\TextInput::make('correo')
                ->required()
                ->email()
                ->maxLength(100),
                Forms\Components\TextInput::make('contrasena')
                ->required()
                ->password()
                ->revealable()
                ->maxLength(100),
                Forms\Components\Select::make('rol')
                ->required()
                ->options([
                    'admin' => 'Administrador',
                    'fisioterapeuta' => 'Fisioterapeuta',
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nombre')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('correo')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('contrasena')
                //->password()
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false)->label('Contrasena'),
                Tables\Columns\TextColumn::make('rol')
                ->searchable()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false)->label('Rol'),
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
                ->action(fn (Usuario $record) => $record->delete())
                ->requiresConfirmation()
                ->modalIcon('heroicon-o-trash')
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
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuario::route('/create'),
            'edit' => Pages\EditUsuario::route('/{record}/edit'),
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
