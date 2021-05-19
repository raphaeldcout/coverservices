<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [
        'id', 'codigo_solicitante', 'codigo_atendente', 'codigo_problema', 'codigo_setor', 'titulo', 'descricao', 'status', 'prioridade'
    ];

    public static function retornaChamadosSolicitante($codigo_usuario) {
        return Chamado::where('codigo_solicitante', $codigo_usuario)->get();
    }
}