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
        Schema::create('matricula_disciplinas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('matriculas_id');
            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('cursos_id')->nullable();
            $table->unsignedBigInteger('disciplinas_id');
            $table->date('inicio')->nullable();
            $table->date('termino')->nullable();
            $table->string('concluido')->nullable();
            $table->string('obs')->nullable();

            $table->foreign('empresas_id')
                ->references('id')
                ->on('empresas')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

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

            $table->foreign('cursos_id')
                ->references('id')
                ->on('cursos')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('disciplinas_id')
                ->references('id')
                ->on('disciplinas')
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
        Schema::dropIfExists('matricula_disciplinas');
    }
};
