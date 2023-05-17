<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('descricao');
            $table->string('medida_adotada');
            $table->string('observacao')->nullable();
            $table->string('bolsa_aluno')->nullable();
            $table->string('setor_encaminhado');
            $table->date('data');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('servidor_id')->constrained('servidores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('disciplina_id')->constrained('disciplinas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ocorrencias');
    }
};
