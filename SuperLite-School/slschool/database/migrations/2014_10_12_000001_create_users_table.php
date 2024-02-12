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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresas_id');
            $table->string('empresas_cnpj');
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ativo')->default('nao');
            $table->string('root')->default('nao');
            $table->date('data_adminssao')->nullable();
            $table->date('data_desligamento')->nullable();
            $table->string('cpf')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('apelido')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();
            $table->string('numero')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf')->nullable();
            $table->string('foto')->nullable();
            $table->string('obs')->nullable();
            $table->string('deletado')->default('nao');
            $table->string('auditoria')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('empresas_id')
                ->references('id')
                ->on('empresas')
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
        Schema::dropIfExists('users');
    }
};
