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
            $table->timestamps();

            $table->unsignedBigInteger('alunos_id');
            $table->date('data');
            $table->time('hora');
            $table->string('motivo');
            $table->string('status')->default('bloqueado');
            $table->date('data_desbloqueio')->nullable();
            $table->string('obs')->nullable();            

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
