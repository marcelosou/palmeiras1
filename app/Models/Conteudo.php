<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conteudo extends Model
{
    protected $fillable = [
        'titulo', 'slug', 'resumo', 'tipo',
        'status', 'autor_id', 'categoria', 'publicado_em',
    ];

    protected $casts = [
        'publicado_em' => 'datetime',
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'autor_id');
    }

    public function blocos(): HasMany
    {
        return $this->hasMany(Bloco::class)->orderBy('ordem');
    }

    public function scopePublicados($query)
    {
        return $query->where('status', 'publicado');
    }
}
