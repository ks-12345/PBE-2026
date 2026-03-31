<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoques';

    protected $fillable = [
        'nome',
    ];

    public function produtos(): HasMany
    {
        return $this->hasMany(EstoqueProduto::class);
    }

    public function produtosRelacionados(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'estoque_produtos')
            ->withPivot('quantidade')
            ->withTimestamps();
    }
}