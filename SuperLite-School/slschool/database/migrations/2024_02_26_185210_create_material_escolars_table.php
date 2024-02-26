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
        Schema::create('material_escolars', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->string('material');
            $table->string('descricao')->nullable();
            $table->float('valor_unitario');
            $table->integer('qtde');
            $table->string('ativo')->default('sim');
            $table->string('obs')->nullable();
            $table->string('deletado')->default('nao');
            $table->string('auditoria')->nullable();

            $table->foreign('empresas_id')
                ->references('id')
                ->on('empresas')
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
        Schema::dropIfExists('material_escolars');
    }
};
