<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();

            // Identidade
            $table->string('nome');
            $table->string('tipo');
            $table->integer('nivel');
            $table->string('estagio')->default('Básico'); // Básico, Estágio 1, Estágio 2, EX, GX, V, VMAX
            $table->string('evolui_de')->nullable();
            $table->integer('hp')->default(100);
            $table->string('imagem')->nullable();

            // Ataque 1
            $table->string('ataque1_nome')->nullable();
            $table->string('ataque1_dano')->nullable();
            $table->text('ataque1_descricao')->nullable();

            // Ataque 2
            $table->string('ataque2_nome')->nullable();
            $table->string('ataque2_dano')->nullable();
            $table->text('ataque2_descricao')->nullable();

            // Estatísticas de batalha
            $table->string('fraqueza')->nullable();
            $table->string('resistencia')->nullable();
            $table->string('recuo')->nullable();

            // Informações do card
            $table->string('ilustrador')->nullable();
            $table->string('numero_card')->nullable();
            $table->string('raridade')->default('Comum');
            $table->text('habilidade_especial')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemons');
    }
};