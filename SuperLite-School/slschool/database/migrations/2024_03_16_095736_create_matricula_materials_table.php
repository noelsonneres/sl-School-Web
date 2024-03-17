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
        Schema::create('matricula_materials', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('matriculas_id');
            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('responsavel_alunos_id')->nullable();
            $table->unsignedBigInteger('material_escolars_id');
            $table->float('valor_un');
            $table->integer('qtde');
            $table->float('valor_total');
            $table->string('pago')->default('nao');
            $table->string('parcela_gerada')->default('nao');
            $table->string('observacao')->nullable();
            $table->integer('funcionario')->nullable();
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
                
                $table->foreign('material_escolars_id')
                ->references('id')
                ->on('material_escolars');                   

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matricula_materials');
    }
};
