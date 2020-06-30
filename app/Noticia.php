<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    public $table = "noticia";
    public $timestamps = false;

    protected $fillable = [
        'titulo_noticia',
        'descricao_noticia',
        'data_noticia',
        'prioridade_noticia',
        'url_imagem ',
        'legenda_imagem'
    ];
}
