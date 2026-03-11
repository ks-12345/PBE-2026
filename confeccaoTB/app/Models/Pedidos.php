<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedidos extends Model
{

    use HasFactory;
    protected $fillable = ['id','produto_id','quantidade','data_pedido','status','fornecedor_id'];
}
