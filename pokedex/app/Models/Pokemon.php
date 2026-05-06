<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';
    protected $fillable = [
        'nome',
        'tipo',
        'nivel',
        'estagio',
        'evolui_de',
        'hp',
        'imagem',

        'ataque1_nome',
        'ataque1_dano',
        'ataque1_descricao',

        'ataque2_nome',
        'ataque2_dano',
        'ataque2_descricao',

        'fraqueza',
        'resistencia',
        'recuo',

        'ilustrador',
        'numero_card',
        'raridade',
        'habilidade_especial',
    ];
}