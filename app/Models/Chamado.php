<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [
        'id', 'codigo_solicitante', 'codigo_atendente', 'codigo_problema', 'codigo_setor', 'titulo', 'descricao', 'status', 'prioridade'
    ];

    public static function retornaChamadosSolicitante($codigo_usuario) {
        return Chamado::select('chamados.id as idChamado', 'chamados.titulo', 'chamados.descricao', 'chamados.created_at')
                ->join('problemas', 'problemas.id','=','chamados.codigo_problema')
                ->where('chamados.codigo_solicitante','=',$codigo_usuario)
                ->orderBy('chamados.created_at', 'desc')
                ->get();
    }
    public static function retornaDadosChamado($codigo_usuario) {
        return Chamado::select('chamados.id as idChamado','setors.name as setorNome','def_categorias.name as categoriaNome', 'problemas.name as problemaNome','chamados.*','def_categorias.*', 'problemas.*')->where('codigo_solicitante', $codigo_usuario)->join('problemas', 'problemas.id','chamados.codigo_problema')->join('def_categorias', 'def_categorias.id','problemas.codigo_categoria')->join('setors', 'setors.id','chamados.codigo_setor')->get();
    }
}