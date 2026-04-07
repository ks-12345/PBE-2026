<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
=======
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoques';

    protected $fillable = [
        'nome',
    ];

<<<<<<< HEAD
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
=======
    /**
     * Produtos dentro do estoque
     */
    public function produtos()
    {
        return $this->hasMany(EstoqueProduto::class);
    }
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
}