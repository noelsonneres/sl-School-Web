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
        Schema::create('aluno_bloqueados', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('alunos_id');
            $table->date('data');
            $table->time('hora');
            $table->string('motivo');
            $table->string('status');
            $table->date('data_desbloqueio')->nullable();
            $table->string('obs')->nullable();
            $table->string('auditoria');

            $table->foreign('empresas_id')
                ->references('id')
                ->on('empresas')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('alunos_id')
                ->references('id')
                ->on('alunos')
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
        Schema::dropIfExists('aluno_bloqueados');
    }
};
