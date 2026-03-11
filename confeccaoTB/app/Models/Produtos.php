<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produtos extends Model
{
  use HasFactory;
    protected $fillable = ['id','name','descricao','preco','fornecedor_id','codigo_barras'];
}
