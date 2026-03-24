<?php

namespace App\Filament\Resources\Pedidos\RelationManagers;

use App\Models\Produto;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItensRelationManager extends RelationManager
{
    protected static string $relationship = 'itens';

    protected static ?string $title = 'Itens do pedido';

    protected static bool $shouldSkipAuthorization = true;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('produto_id')
                    ->label('Produto')
                    ->relationship('produto', 'nome')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set): void {
                        if (! $state) {
                            return;
                        }
                        $produto = Produto::query()->find($state);
                        if ($produto && $produto->preco_venda !== null) {
                            $set('preco_unitario', (string) $produto->preco_venda);
                        }
                    }),
                TextInput::make('quantidade')
                    ->numeric()
                    ->integer()
                    ->minValue(1)
                    ->default(1)
                    ->required()
                    ->live(onBlur: true),
                TextInput::make('preco_unitario')
                    ->label('Preço unitário')
                    ->numeric()
                    ->prefix('R$')
                    ->required()
                    ->live(onBlur: true),
            ]);
    }

    public function table(Table $table): Table
    {
        $afterItensChange = fn () => $this->dispatch('pedido-itens-atualizados');

        return $table
            ->columns([
                TextColumn::make('produto.nome')->label('Produto'),
                TextColumn::make('produto.referencia')->label('Ref.')->toggleable(),
                TextColumn::make('quantidade')->alignEnd(),
                TextColumn::make('preco_unitario')->money('BRL')->label('Unit.'),
                TextColumn::make('subtotal')
                    ->money('BRL')
                    ->summarize(Sum::make()->money('BRL')->label('Soma')),
            ])
            ->headerActions([
                CreateAction::make()
                    ->after($afterItensChange),
            ])
            ->recordActions([
                EditAction::make()
                    ->after($afterItensChange),
                DeleteAction::make()
                    ->after($afterItensChange),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->after($afterItensChange),
                ]),
            ]);
    }
}
