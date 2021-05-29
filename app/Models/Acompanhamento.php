<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acompanhamento extends Model
{
    protected $fillable = [
        'id', 'autor', 'codigo_solicitante', 'codigo_atendente', 'codigo_chamado', 'titulo', 'descricao'
    ];

    public static function retornaAcompanhamentosChamado($codigo_chamado) {
        return Acompanhamento::select(
                'acompanhamentos.*',
                'users.name'
                )
                ->join('users', 'users.id', '=', 'acompanhamentos.autor')
                ->where('codigo_chamado', '=', $codigo_chamado)
                ->orderBy('created_at', 'desc')
                ->get();
    }
}
