<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('controle_caixas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->date('data_abertura');
            $table->time('hora_abertura');
            $table->integer('funcionario_abertura')->nullable();
            $table->float('saldo_anterior');
            $table->float('saldo_informado');
            $table->date('data_encerramento')->nullable();
            $table->time('hora_encerramento')->nullable();
            $table->float('saldo_encerramento')->nullable();
            $table->integer('funcionario_encerramento')->nullable();
            $table->string('status')->default('aberto');
            $table->string('observacao')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('controle_caixas');
    }
};
