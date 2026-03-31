<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('estoques', function (Blueprint $table) {
            // Se o projeto estiver sendo migrado do zero, a coluna já existe.
            if (! Schema::hasColumn('estoques', 'nome')) {
                $table->string('nome')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estoques', function (Blueprint $table) {
            if (Schema::hasColumn('estoques', 'nome')) {
                $table->dropColumn('nome');
            }
        });
    }
};
