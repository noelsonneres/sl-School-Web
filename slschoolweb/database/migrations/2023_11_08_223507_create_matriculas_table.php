<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\once;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('alunos_id');
            $table->unsignedBigInteger('responsavels_id')->nullable();
            $table->unsignedBigInteger('cursos_id');
            $table->integer('qtde_parcela')->default(1);
            $table->float('valor_a_vista');
            $table->float('valor_com_desconto');
            $table->float('valor_parcelado');
            $table->float('valor_por_parcela');
            $table->date('vencimento');
            $table->float('valor_matricula');
            $table->date('vencimento_matricula');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->integer('qtde_dias');
            $table->integer('horas_semana');
            $table->integer('consultors_id');
            $table->string('status')->default('ativa');
            $table->integer('funcionario')->nullable();
            $table->string('obs')->nullable();
            $table->string('deletado')->default('nao');
            
            $table->foreign('alunos_id')
                    ->references('id')
                    ->on('alunos')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('responsavels_id')->references('id')->on('responsavels'); 
            $table->foreign('cursos_id')->references('id')->on('cursos');             

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
