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
        Schema::create('config_mensalidades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('juros');
            $table->float('multa');
            $table->string('mensagem')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_mensalidades');
    }
};
