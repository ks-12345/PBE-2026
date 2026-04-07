<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];

<<<<<<< HEAD
    public function cliente()
=======
    public function cliente() 
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}

