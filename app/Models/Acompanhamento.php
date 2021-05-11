<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acompanhamento extends Model
{
    protected $fillable = [
        'id', 'codigo_solicitante', 'codigo_atendente', 'codigo_chamado', 'titulo', 'descricao'
    ];
}
