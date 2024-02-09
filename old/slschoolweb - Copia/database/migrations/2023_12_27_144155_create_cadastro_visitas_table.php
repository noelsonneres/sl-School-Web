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
        Schema::create('cadastro_visitas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nome');
            $table->string('telefone')->nullable();
            $table->string('celular');
            $table->string('email')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('retorno')->nullable();
            $table->string('situacao')->nullable();
            $table->string('grau_interesse')->nullable();
            $table->string('curso_de_interesse')->nullable();
            $table->string('turno')->nullable();
            $table->string('dia')->nullable();
            $table->string('horario')->nullable();
            $table->integer('funcionario')->nullable();
            $table->string('observacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadastro_visitas');
    }
};
