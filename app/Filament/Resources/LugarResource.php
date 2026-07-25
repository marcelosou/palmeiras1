<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LugarResource\Pages;
use App\Filament\Resources\LugarResource\RelationManagers;
use App\Models\Lugar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LugarResource extends Resource
{
    protected static ?string $model = Lugar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Lugares';
    protected static ?string $modelLabel = 'Lugar';
    protected static ?string $pluralModelLabel = 'Lugares';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('descricao')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->numeric()
                    ->helperText('Ex: -13.0158234'),

                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->numeric()
                    ->helperText('Ex: -41.4922145'),

                Forms\Components\Select::make('tipo')
                    ->options([
                        'cachoeira' => 'Cachoeira',
                        'trilha' => 'Trilha',
                        'restaurante' => 'Restaurante',
                        'pousada' => 'Pousada',
                        'atracao' => 'Atração',
                    ]),

                Forms\Components\TextInput::make('endereco')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tipo')
                    ->badge(),

                Tables\Columns\TextColumn::make('endereco')
                    ->limit(40),

                Tables\Columns\TextColumn::make('latitude'),
                Tables\Columns\TextColumn::make('longitude'),
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
            'index' => Pages\ListLugars::route('/'),
            'create' => Pages\CreateLugar::route('/create'),
            'edit' => Pages\EditLugar::route('/{record}/edit'),
        ];
    }
}
