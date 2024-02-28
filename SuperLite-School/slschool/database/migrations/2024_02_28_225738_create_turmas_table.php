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

            $table->unsignedBigInteger('empresas_id');
            $table->string('turma');
            $table->string('descricao')->nullable();
            $table->unsignedBigInteger('dias_aulas_id');
            $table->unsignedBigInteger('horarios_aulas_id');
            $table->unsignedBigInteger('sala_aulas_id');
            $table->unsignedBigInteger('professors_id')->nullable();
            $table->string('turno');
            $table->string('ativa')->default('sim');
            $table->string('deletado')->default('nao');
            $table->string('auditoria');

            $table->foreign('empresas_id')
            ->references('id')
            ->on('empresas')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->foreign('dias_aulas_id')
            ->references('id')
            ->on('dias_aulas')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('horarios_aulas_id')
            ->references('id')
            ->on('horarios_aulas')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('sala_aulas_id')
            ->references('id')
            ->on('sala_aulas')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('professors_id')
            ->references('id')
            ->on('professors')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->timestamps();
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
