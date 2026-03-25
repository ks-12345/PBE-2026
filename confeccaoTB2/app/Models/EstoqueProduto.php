<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstoqueProduto extends Model
{
    use HasFactory;

    protected $table = 'estoque_produtos'; // ⚠️ importante bater com sua migration

    protected $fillable = [
        'estoque_id',
        'produto_id',
        'quantidade',
    ];

    /**
     * Relacionamento com estoque
     */
    public function estoque()
    {
        return $this->belongsTo(Estoque::class);
    }

    /**
     * Relacionamento com produto
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}