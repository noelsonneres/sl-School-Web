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
        Schema::create('materiais_escolars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('material');
            $table->string('descricao')->nullable();
            $table->float('valor_un')->nullable();
            $table->integer('qtde')->default(0);
            $table->string('ativo')->default('sim');
            $table->string('obs')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiais_escolars');
    }
};
