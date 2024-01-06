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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('turma');
            $table->string('descricao')->nullable();
            $table->unsignedBigInteger('cadastro_dias_id');
            $table->unsignedBigInteger('cadastro_horarios_id');
            $table->unsignedBigInteger('salas_id');
            $table->unsignedBigInteger('professors_id')->nullable();
            $table->string('turno');
            $table->string('ativa')->default('sim');
            $table->string('obs')->nullable();     
            
            $table->foreign('cadastro_dias_id')->references('id')->on('cadastro_dias');
            $table->foreign('cadastro_horarios_id')->references('id')->on('cadastro_horarios');
            $table->foreign('salas_id')->references('id')->on('salas');
            $table->foreign('professors_id')->references('id')->on('professors');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
