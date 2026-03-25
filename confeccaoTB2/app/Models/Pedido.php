<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];

    public function Clientes()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}

