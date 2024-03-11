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

            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('matriculas_id');
            $table->unsignedBigInteger('turmas_id');

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

            $table->foreign('turmas_id')
            ->references('id')
            ->on('turmas')
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
        Schema::dropIfExists('matricula_turmas');
    }
};
