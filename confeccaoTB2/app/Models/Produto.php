<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produto extends Model
{
    protected $guarded = [];

    public function estoques(): BelongsToMany
    {
        return $this->belongsToMany(Estoque::class, 'estoque_produtos')
            ->withPivot('quantidade')
            ->withTimestamps();
    }
}
