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
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('responsavel_alunos_id')->nullable();
            $table->unsignedBigInteger('matriculas_id');
            $table->float('valor_parcela');
            $table->integer('numero_mensalidade');
            $table->integer('qtde_mensalidade');
            $table->date('vencimento');
            $table->float('juros')->nullable();
            $table->float('multa')->nullable();
            $table->float('desconto')->nullable();
            $table->float('acrescimo')->nullable();
            $table->float('valor_pago')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->string('pago')->default('nao');
            $table->string('responsavel_pagamento')->nullable();
            $table->integer('funcionario')->nullable();
            $table->string('obs')->nullable();
            $table->string('deletado')->default('nao');
            $table->string('auditoria')->nullable();

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
                
                $table->foreign('responsavel_alunos_id')
                ->references('id')
                ->on('responsavel_alunos');                 

            $table->timestamps();
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
