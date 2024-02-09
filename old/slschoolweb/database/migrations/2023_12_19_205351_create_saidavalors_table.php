<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('saidavalors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('motivo');
            $table->date('data');
            $table->time('hora');
            $table->float('valor');
            $table->string('observacao')->nullable();
            $table->string('funcionario')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saidavalors');
    }
};
