<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('produtos')) {
            return;
        }

        Schema::table('produtos', function (Blueprint $table) {
            if (! Schema::hasColumn('produtos', 'nome')) {
                $table->string('nome')->after('id');
            }
            if (! Schema::hasColumn('produtos', 'referencia')) {
                $table->string('referencia')->nullable()->after('nome');
            }
            if (! Schema::hasColumn('produtos', 'preco_venda')) {
                $table->decimal('preco_venda', 10, 2)->nullable()->after('referencia');
            }
            if (! Schema::hasColumn('produtos', 'estoque')) {
                $table->integer('estoque')->default(0)->after('preco_venda');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('produtos')) {
            return;
        }

        Schema::table('produtos', function (Blueprint $table) {
            $columns = collect(['nome', 'referencia', 'preco_venda', 'estoque'])
                ->filter(fn (string $c) => Schema::hasColumn('produtos', $c))
                ->all();

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
