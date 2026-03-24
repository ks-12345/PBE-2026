<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InsumosInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome'),
                TextEntry::make('unidade_medida')->label('Unidade'),
                TextEntry::make('preco_custo')->money('BRL')->label('Preço de custo'),
                TextEntry::make('estoque'),
            ]);
    }
}
