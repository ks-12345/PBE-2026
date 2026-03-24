<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProdutosInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('referencia')->label('Código/Referência')->placeholder('-'),
                TextEntry::make('nome'),
                TextEntry::make('preco_venda')->money('BRL')->label('Preço de venda'),
                TextEntry::make('estoque'),
            ]);
    }
}
