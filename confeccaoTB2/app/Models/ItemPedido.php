<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemPedido extends Model
{
    protected $table = 'pedido_itens';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'quantidade' => 'integer',
            'preco_unitario' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (ItemPedido $item): void {
            $item->subtotal = round(
                (float) $item->quantidade * (float) $item->preco_unitario,
                2
            );
        });

        static::saved(function (ItemPedido $item): void {
            $item->pedido->recalcularTotal();
        });

        static::deleted(function (ItemPedido $item): void {
            if ($item->pedido) {
                $item->pedido->recalcularTotal();
            }
        });
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}
