<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [
        'id', 'codigo_solicitante', 'codigo_atendente', 'codigo_problema', 'titulo', 'descricao', 'status', 'prioridade'
    ];
}