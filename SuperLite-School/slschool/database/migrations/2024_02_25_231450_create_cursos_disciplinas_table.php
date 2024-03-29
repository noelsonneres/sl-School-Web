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
        Schema::create('cursos_disciplinas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('cursos_id');
            $table->unsignedBigInteger('disciplinas_id');

            $table->foreign('empresas_id')
                ->references('id')
                ->on('empresas')
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
        Schema::dropIfExists('cursos_disciplinas');
    }
};
