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

            $table->string('nome');
            $table->string('nome_login');
            $table->string('razao_social')->nullable();     
            $table->string('cnpj');
            $table->string('insc_estadual')->nullable();
            $table->string('data_abertura')->nullable();
            $table->string('cep')->nullable(); 
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('ativo')->nullable();
            $table->string('auditoria')->nullable();
            $table->string('obs')->nullable();      

            $table->timestamps();

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
