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
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('disciplina');
            $table->string('descricao')->nullable();
            $table->float('valor')->nullable();
            $table->integer('duracao_meses')->nullable();
            $table->integer('carga_horaria')->nullable();
            $table->string('observacao')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplinas');
    }
};
