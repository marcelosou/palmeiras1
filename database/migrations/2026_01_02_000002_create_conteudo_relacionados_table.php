<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conteudo_relacionados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conteudo_id')->constrained('conteudos')->cascadeOnDelete();
            $table->foreignId('relacionado_id')->constrained('conteudos')->cascadeOnDelete();
            $table->unsignedInteger('ordem')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conteudo_relacionados');
    }
};
