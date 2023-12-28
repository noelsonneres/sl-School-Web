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
        Schema::create('contas_pagars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('conta');
            $table->unsignedBigInteger('plano_contas_id');
            $table->string('descricao')->nullable();
            $table->float('valor');
            $table->date('vencimento');
            $table->float('juros')->nullable();
            $table->float('multa')->nullable();
            $table->float('desconto')->nullable();
            $table->float('acrescimo')->nullable();
            $table->date('data_pagametno')->nullable();
            $table->string('pago')->default('nao');
            $table->float('total');
            $table->string('observacao')->nullable();
            $table->integer('funcionario')->nullable();     
            
            $table->foreign('plano_contas_id')->references('id')->on('plano_contas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_pagars');
    }
};
