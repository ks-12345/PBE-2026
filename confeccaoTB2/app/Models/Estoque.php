<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoques';

    protected $fillable = [
        'nome',
    ];

    /**
     * Produtos dentro do estoque
     */
    public function produtos()
    {
        return $this->hasMany(EstoqueProduto::class);
    }
}