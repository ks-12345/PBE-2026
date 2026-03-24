<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'preco_custo' => 'decimal:2',
            'estoque' => 'decimal:2',
        ];
    }
}

