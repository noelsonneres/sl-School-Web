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
        Schema::create('empresas', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();

            $table->string('nome');
            $table->date('data_nascimento');
            $table->string('cpf');
            $table->string('telefone');
            $table->string('celular');
            $table->string('email');
            $table->string('endereco');
            $table->string('bairro');
            $table->integer('numero');
            $table->string('complemento');
            $table->string('cep');
            $table->string('cidade');
            $table->string('estado');
            $table->string('obs');
            $table->string('foto');
            $table->string('funcionario');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
