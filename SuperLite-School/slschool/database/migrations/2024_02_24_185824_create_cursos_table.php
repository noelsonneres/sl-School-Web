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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->string('curso');
            $table->string('descricao')->nullable();
            $table->float('valor_avista')->nullable();
            $table->float('valor_com_desconto')->nullable();
            $table->integer('qtde_parcelas');
            $table->float('valor_por_parcela')->nullable();
            $table->integer('duracao');
            $table->integer('carga_horaria');
            $table->string('ativo')->default('sim');
            $table->string('obs')->nullable();
            $table->string('deletado')->default('nao');
            $table->string('auditoria');

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
        Schema::dropIfExists('cursos');
    }
};
