<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PedidosInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('cliente.name')->label('Cliente')->placeholder('-'),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'confirmado' => 'Confirmado',
                        'cancelado' => 'Cancelado',
                        'entregue' => 'Entregue',
                        default => 'Pendente',
                    }),
                TextEntry::make('data_pedido')->date('d/m/Y')->label('Data'),
                TextEntry::make('total')->money('BRL')->label('Total'),
                TextEntry::make('observacoes')->placeholder('-')->columnSpanFull(),
            ]);
    }
}
