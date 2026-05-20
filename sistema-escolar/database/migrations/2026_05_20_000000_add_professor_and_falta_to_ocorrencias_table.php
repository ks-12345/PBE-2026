<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->foreignId('professor_id')->nullable()->after('aqv_id')->constrained('users');
            $table->boolean('tera_falta')->default(false)->after('status');
            $table->unsignedTinyInteger('aulas_falta')->nullable()->after('tera_falta');
        });
    }

    public function down(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropForeign(['professor_id']);
            $table->dropColumn(['professor_id', 'tera_falta', 'aulas_falta']);
        });
    }
};
