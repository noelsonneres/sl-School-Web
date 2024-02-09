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
        Schema::create('frequencias', function (Blueprint $table) {

            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('matriculas_id');
            $table->unsignedBigInteger('disciplina_id');
            $table->date('data_lancamento');
            $table->time('hora_lancamento');
            $table->string('situacao');
            $table->string('justificativa')->nullable();
            $table->string('conteudo')->nullable();
            $table->date('data_presenca');
            $table->time('hora_presenca');
            $table->string('funcionario')->nullable();
            $table->string('observacao')->nullable();

            $table->foreign('matriculas_id')->references('id')->on('matriculas')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('alunos_id')->references('id')->on('alunos')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('disciplina_id')->references('id')->on('disciplinas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequencias');
    }
};
