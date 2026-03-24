<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InsumosForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('nome')->required(),
                TextInput::make('unidade_medida')->required()->label('Unidade (Kg, Metros, Un...)'),
                TextInput::make('preco_custo')->numeric()->prefix('R$')->label('Preço de Custo'),
                TextInput::make('estoque')->numeric()->default(0),
            ]);
    }
}
