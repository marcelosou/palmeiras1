<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blocos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conteudo_id')->constrained('conteudos')->cascadeOnDelete();
            $table->string('tipo');
            $table->unsignedInteger('ordem')->default(0);
            $table->json('conteudo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blocos');
    }
};
