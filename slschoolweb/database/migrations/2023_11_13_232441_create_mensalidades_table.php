<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\once;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('responsavels_id');
            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('matriculas_id');
            $table->float('valor_parcela');
            $table->date('vencimento');
            $table->float('juros');
            $table->float('multa');
            $table->float('desconto');
            $table->float('acrescimo');
            $table->float('valor_pago');
            $table->date('data_pagamento');
            $table->string('pago');
            $table->string(' responsavel_pagamento');
            $table->integer('funcionario');
            $table->string('observacao');

            $table->foreign('responsavels_id')->references('id')->on('responsavels');

            $table->foreign('alunos_id')
                    ->references('id')
                    ->on('alunos')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('matriculas_id')
                        ->references('id')
                        ->on('matriculas')
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
        Schema::dropIfExists('mensalidades');
    }
};
