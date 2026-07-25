<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConteudoResource\Pages;
use App\Filament\Resources\ConteudoResource\RelationManagers;
use App\Models\Conteudo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConteudoResource extends Resource
{
    protected static ?string $model = Conteudo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Conteúdos';
    protected static ?string $modelLabel = 'Conteúdo';
    protected static ?string $pluralModelLabel = 'Conteúdos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titulo')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str($state)->slug())),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\Textarea::make('resumo')
                    ->maxLength(500)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('imagem_capa')
                    ->label('Imagem de capa')
                    ->image()
                    ->directory('capas')
                    ->imageEditor()
                    ->columnSpanFull(),
                Forms\Components\Select::make('tipo')
                    ->options([
                        'noticia' => 'Notícia',
                        'evento' => 'Evento',
                        'turismo' => 'Turismo',
                        'guia' => 'Guia',
                    ])
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'rascunho' => 'Rascunho',
                        'publicado' => 'Publicado',
                    ])
                    ->default('rascunho')
                    ->required(),

                Forms\Components\TextInput::make('categoria')
                    ->maxLength(255),

                Forms\Components\Select::make('autor_id')
                    ->relationship('autor', 'name')
                    ->required(),

                Forms\Components\DateTimePicker::make('publicado_em'),

                Forms\Components\Select::make('relacionadas')
                    ->label('Matérias relacionadas')
                    ->relationship('relacionadas', 'titulo')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
            ]);
    }
        
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titulo')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tipo')
                    ->badge(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'publicado' => 'success',
                        'rascunho' => 'gray',
                    }),

                Tables\Columns\TextColumn::make('autor.name')
                    ->label('Autor')
                    ->sortable(),

                Tables\Columns\TextColumn::make('publicado_em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('visualizacoes')
                    ->sortable(),
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
            'index' => Pages\ListConteudos::route('/'),
            'create' => Pages\CreateConteudo::route('/create'),
            'edit' => Pages\EditConteudo::route('/{record}/edit'),
        ];
    }
}
