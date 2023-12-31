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

            $table->unsignedBigInteger('responsavels_id')->nullable();
            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('matriculas_id');
            $table->integer('qtde_mensalidades');
            $table->float('valor_parcela');
            $table->date('vencimento');
            $table->float('juros')->nullable();
            $table->float('multa')->nullable();
            $table->float('desconto')->nullable();
            $table->float('acrescimo')->nullable();
            $table->float('valor_pago')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->string('pago')->nullable();
            $table->string('responsavel_pagamento')->nullable();
            $table->string('forma_pagamento')->nullable();
            $table->integer('funcionario')->nullable();
            $table->string('observacao')->nullable();

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
