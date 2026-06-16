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
        Schema::create('matricula_transportes', function (Blueprint $table) {

            $table->id();


            $table->foreignId('aluno_id')
            ->constrained('alunos')
            ->cascadeOnDelete();


            $table->foreignId('instituicao_id')
            ->constrained('instituicoes')
            ->cascadeOnDelete();


            $table->foreignId('veiculo_id')
            ->constrained('veiculos')
            ->cascadeOnDelete();


            $table->string('turno');

            $table->string('dias_semana');

            $table->integer('frequencia_semanal');

            $table->decimal('valor_subsidio', 8, 2);

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas_transportes');
    }
};