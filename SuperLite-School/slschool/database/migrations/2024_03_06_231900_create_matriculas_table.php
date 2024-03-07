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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('responsavel_alunos_id')->nullable();
            $table->unsignedBigInteger('cursos_id');
            $table->integer('qtde_parcelas');
            $table->float('valor_a_vista');
            $table->float('valor_com_desconto');
            $table->float('valor_parcelado');
            $table->float('valor_por_parcela');
            $table->date('vencimento');
            $table->float('valor_matricula');
            $table->date('vencimento_matricula');
            $table->date('data_inicio');
            $table->date('previsao_termino')->nullable();
            $table->date('data_conclusao')->nullable();
            $table->integer('qtde_dias')->nullable();
            $table->integer('horas_semana')->nullable();
            $table->unsignedBigInteger('consultores_id')->nullable();
            $table->string('ativo')->default('sim');
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

            $table->foreign('alunos_id')
                ->references('id')
                ->on('alunos')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');          
                
                $table->foreign('responsavel_alunos_id')
                ->references('id')
                ->on('responsavel_alunos')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');         
                
                $table->foreign('cursos_id')
                ->references('id')
                ->on('cursos')
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
        Schema::dropIfExists('matriculas');
    }
};
