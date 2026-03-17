<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'name',
        'descricao',
        'preco',
        'fornecedor_id',
        'ativo',
    ];

    protected $casts = [
        'ativo'  => 'boolean',
        'preco'  => 'decimal:2',
    ];
}