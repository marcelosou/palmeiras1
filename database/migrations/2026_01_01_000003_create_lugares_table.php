<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lugares', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('tipo')->nullable();
            $table->string('endereco')->nullable();
            $table->string('imagem_capa')->nullable();
            $table->timestamps();
        });

        Schema::create('conteudo_lugar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conteudo_id')->constrained('conteudos')->cascadeOnDelete();
            $table->foreignId('lugar_id')->constrained('lugares')->cascadeOnDelete();
            $table->string('relacao')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conteudo_lugar');
        Schema::dropIfExists('lugares');
    }
};
