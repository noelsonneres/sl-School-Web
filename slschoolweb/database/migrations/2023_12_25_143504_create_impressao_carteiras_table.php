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
        Schema::create('impressao_carteiras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('matriculas_id');
            $table->unsignedBigInteger('alunos_id');
            $table->date('data_impressao');
            $table->date('Validade')->nullable();
            $table->string('mensagem');
            $table->integer('funcionario')->nullable();
            $table->string('Observacao')->nullable();

            $table->foreign('matriculas_id')->references('id')->on('matriculas')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('alunos_id')->references('id')->on('alunos')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impressao_carteiras');
    }
};
