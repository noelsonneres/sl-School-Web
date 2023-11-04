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
            $table->timestamps();

            $table->string('nome');
            $table->string('apelido')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->date('data_cadastro')->nullable();
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('fobias')->nullable();
            $table->string('alergias')->nullable();
            $table->string('deficiencias')->nullable();
            $table->string('outros_aspectos')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('profissao')->nullable();
            $table->string('nome_mae')->nullable();
            $table->string('rg_mae')->nullable();
            $table->string('cep_mae')->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('rg_pai')->nullable();
            $table->string('cpf_pai')->nullable();
            $table->string('foto')->nullable();
            $table->string('observacao')->nullable();
            $table->string('deletado')->nullable();            

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
