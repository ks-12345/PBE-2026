<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PedidosForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('cliente_id')
                    ->label('Cliente')
                    ->relationship('cliente', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('status')
                    ->options([
                        'pendente' => 'Pendente',
                        'confirmado' => 'Confirmado',
                        'cancelado' => 'Cancelado',
                        'entregue' => 'Entregue',
                    ])
                    ->default('pendente')
                    ->required(),
                DatePicker::make('data_pedido')
                    ->label('Data do pedido')
                    ->default(now()),
                Textarea::make('observacoes')
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('total')
                    ->label('Total (calculado pelos itens)')
                    ->prefix('R$')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }
}
