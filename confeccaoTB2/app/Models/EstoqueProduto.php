<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

<<<<<<< HEAD
class EstoqueProduto extends Model
{
    use HasFactory;

    protected $table = 'estoque_produtos'; // ⚠️ importante bater com sua migration
=======
    class EstoqueProduto extends Model
{
    use HasFactory;

    protected $table = 'estoque_produtos'; 
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4

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
<<<<<<< HEAD
}
=======
}

>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
