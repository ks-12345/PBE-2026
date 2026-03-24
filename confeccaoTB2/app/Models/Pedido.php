<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'data_pedido' => 'date',
            'total' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Pedido $pedido): void {
            if ($pedido->total === null) {
                $pedido->total = 0;
            }
        });
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * @return HasMany<ItemPedido, $this>
     */
    public function itens(): HasMany
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function recalcularTotal(): void
    {
        $sum = $this->itens()->sum('subtotal');

        $this->forceFill([
            'total' => round((float) $sum, 2),
        ])->saveQuietly();
    }
}
