<?php

namespace App\Filament\Resources\Estoques;

use App\Filament\Resources\Estoques\Pages\CreateEstoque;
use App\Filament\Resources\Estoques\Pages\EditEstoque;
use App\Filament\Resources\Estoques\Pages\ListEstoques;
use App\Filament\Resources\Estoques\Pages\ViewEstoque;
use App\Models\Estoque;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class EstoqueResource extends Resource
{
    protected static ?string $model = Estoque::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Estoque';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            
            TextInput::make('nome')
                ->required()
                ->label('Nome do Estoque'),

            Repeater::make('produtos')
                ->relationship('produtos')
                ->schema([
                    Select::make('produto_id')
                        ->relationship('produto', 'nome')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Produto')
                        ->columnSpan(2),

                    TextInput::make('quantidade')
                        ->numeric()
                        ->required()
                        ->label('Quantidade')
                        ->columnSpan(1),
                ])
                ->columnSpanFull()
                ->label('Produtos no Estoque'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('nome')
                ->label('Estoque')
                ->searchable()
                ->sortable(),

            TextColumn::make('produtos_count')
                ->counts('produtos')
                ->label('Qtd. Produtos'),

            TextColumn::make('created_at')
                ->label('Criado em')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])
        ->recordActions([
            ViewAction::make(),
            EditAction::make(),
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
            'index' => ListEstoques::route('/'),
            'create' => CreateEstoque::route('/create'),
            'view' => ViewEstoque::route('/{record}'),
            'edit' => EditEstoque::route('/{record}/edit'),
        ];
    }
}