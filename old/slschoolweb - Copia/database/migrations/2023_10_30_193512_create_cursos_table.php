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
            $table->timestamps();

            $table->string('curso');
            $table->string('desscricao')->nullable();
            $table->float('valor_avista')->nullable();
            $table->float('valor_com_desconto')->nullable();
            $table->integer('qtde_parcelas')->nullable();
            $table->float('valor_parcelado')->nullable();
            $table->float('valor_por_parcela')->nullable();
            $table->integer('duracao_meses')->nullable();
            $table->integer('carga_horaria')->nullable();
            $table->string('ativo')->default('sim');
            $table->string('observacao')->nullable();

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
