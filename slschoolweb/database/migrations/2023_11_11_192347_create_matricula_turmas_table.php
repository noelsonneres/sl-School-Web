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
        Schema::create('matricula_turmas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('matriculas_id');
            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('turmas_id');
            $table->unsignedBigInteger('cadastro_dias_id');
            $table->unsignedBigInteger('cadastro_horarios_id');
            $table->unsignedBigInteger('salas_id');

            $table->foreign('matriculas_id')
                ->references('id')
                ->on('matriculas')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('alunos_id')
                ->references('id')
                ->on('alunos')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('turmas_id')->references('id')->on('turmas');
            $table->foreign('cadastro_dias_id')->references('id')->on('cadastro_dias');
            $table->foreign('cadastro_horarios_id')->references('id')->on('cadastro_horarios');
            $table->foreign('salas_id')->references('id')->on('salas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matricula_turmas');
    }
};
