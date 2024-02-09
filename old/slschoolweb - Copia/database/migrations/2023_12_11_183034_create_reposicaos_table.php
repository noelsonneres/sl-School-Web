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
        Schema::create('reposicaos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('matriculas_id');
            $table->unsignedBigInteger('turmas_id');
            $table->date('data_marcacao');
            $table->time('hora_marcacao');
            $table->date('data_reposicao');
            $table->time('hora_reposicao');
            $table->string('status');
            $table->integer('funcionario')->nullable();
            $table->string('obsrvacao')->nullable();

            $table->foreign('matriculas_id')->references('id')->on('matriculas')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('alunos_id')->references('id')->on('alunos')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('turmas_id')->references('id')->on('turmas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reposicaos');
    }
};
