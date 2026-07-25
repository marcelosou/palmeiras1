<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    protected $table = 'lugares';

    protected $fillable = [
        'nome', 'descricao', 'latitude', 'longitude',
        'tipo', 'endereco', 'imagem_capa',
    ];

    public function conteudosRelacionados()
    {
        return $this->belongsToMany(Conteudo::class, 'conteudo_lugar');
    }
}
