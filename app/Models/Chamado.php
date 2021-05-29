<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [
        'id', 'codigo_solicitante', 'codigo_atendente', 'codigo_problema', 'codigo_setor', 'titulo', 'descricao', 'status', 'prioridade'
    ];

    public static function retornaTodosOsChamados() {
        return Chamado::select(
                'chamados.id as idChamado', 
                'chamados.titulo', 
                'chamados.status', 
                'chamados.descricao', 
                'chamados.created_at',
                'chamados.codigo_atendente',
                'users.name'
                )
                ->join('problemas', 'problemas.id', '=', 'chamados.codigo_problema')
                ->leftJoin('users', 'users.id', '=', 'chamados.codigo_atendente')
                ->orderBy('chamados.created_at', 'desc')
                ->get();
    }

    public static function retornaChamadosSolicitante($codigo_usuario) {
        return Chamado::select(
                'chamados.id as idChamado',
                'chamados.titulo', 
                'chamados.status', 
                'chamados.descricao', 
                'chamados.created_at',
                'chamados.codigo_atendente',
                'users.name'
                )
                ->join('problemas', 'problemas.id', '=', 'chamados.codigo_problema')
                ->leftJoin('users', 'users.id', '=', 'chamados.codigo_atendente')
                ->where('chamados.codigo_solicitante', '=', $codigo_usuario)
                ->orderBy('chamados.created_at', 'desc')
                ->get();
    }

    public static function retornaDadosChamado($idChamado, $usuarioLogado) {
        return Chamado::select(
                'chamados.id as idChamado',
                'setors.name as setorNome',
                'def_categorias.name as categoriaNome', 
                'problemas.name as problemaNome',
                'chamados.*',
                'def_categorias.*', 
                'problemas.*'
                )
                ->join('problemas', 'chamados.codigo_problema', '=', 'problemas.id')
                ->join('def_categorias','problemas.codigo_categoria', '=', 'def_categorias.id')
                ->join('setors', 'chamados.codigo_setor', '=', 'setors.id')
                ->where([
                    ['chamados.id', $idChamado]
                ])
                ->get();
    }

    public static function gerenciarChamados($idChamado) {
        return Chamado::select(
                'chamados.id as idChamado',
                'setors.name as setorNome', 
                'chamados.status',
                'def_categorias.name as categoriaNome', 
                'problemas.name as problemaNome',
                'chamados.*',
                'def_categorias.*', 
                'problemas.*'
                )
                ->join('problemas', 'chamados.codigo_problema','=','problemas.id')
                ->join('def_categorias','problemas.codigo_categoria','=', 'def_categorias.id')
                ->join('setors', 'chamados.codigo_setor', '=', 'setors.id')
                ->where('chamados.id', $idChamado)
                ->get();
    }

    public static function verificaAtribuicao($idChamado) {
        return Chamado::select(
                'codigo_atendente'
                )
                ->where('id', $idChamado)
                ->first();
    }

}