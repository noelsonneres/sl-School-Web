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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresas_id');
            $table->string('nome');
            $table->string('apelido')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->date('data_cadastro')->nullable();
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('fobias')->nullable();
            $table->string('alergias')->nullable();
            $table->string('pcd')->nullable();
            $table->string('outros_aspectos')->nullable();
            $table->string('nacionalidades')->nullable();
            $table->string('naturalidade')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('profissao')->nullable();
            $table->string('nome_mae')->nullable();
            $table->string('rg_mae')->nullable();
            $table->string('cpf_mae')->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('rg_pai')->nullable();
            $table->string('cpf_pai')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('alunos');
    }
};
