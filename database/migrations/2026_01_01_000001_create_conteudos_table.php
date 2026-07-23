<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conteudos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('resumo')->nullable();
            $table->string('tipo');
            $table->string('status')->default('rascunho');
            $table->foreignId('autor_id')->constrained('users');
            $table->string('categoria')->nullable();
            $table->timestamp('publicado_em')->nullable();
            $table->unsignedBigInteger('visualizacoes')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conteudos');
    }
};
