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
            $table->float('saldo informado');
            $table->date('data_encerramento');
            $table->time('hora_encerramento');
            $table->float('saldo_encerramento');
            $table->integer('funcionario_encerramento')->nullable();
            $table->string('status');
            $table->string('observacao')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('controle_caixas');
    }
};
