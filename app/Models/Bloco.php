<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bloco extends Model
{
    protected $fillable = ['conteudo_id', 'tipo', 'ordem', 'conteudo'];

    protected $casts = [
        'conteudo' => 'array',
    ];

    public function conteudoPai(): BelongsTo
    {
        return $this->belongsTo(Conteudo::class, 'conteudo_id');
    }
}
