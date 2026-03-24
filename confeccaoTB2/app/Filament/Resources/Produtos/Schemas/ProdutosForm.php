<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProdutosForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('nome')->required()->label('Nome do Produto'),
                TextInput::make('referencia')->label('Código/Referência'),
                TextInput::make('preco_venda')->numeric()->prefix('R$')->label('Preço de Venda'),
                TextInput::make('estoque')->numeric()->default(0),
            ]);
    }
}
