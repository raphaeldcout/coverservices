<?php

namespace App\Http\Controllers;

use App\Models\Acompanhamento;
use App\Models\Problema;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App\Models\Chamado;
use App\Models\Setor;
use App\Models\def_categoria;
use App\User;

class ChamadosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $categorias = def_categoria::select('name', 'id')->get();

        $editarChamado = null;

        $atribuido = null;

        $acoes = null;

        $usuarioLogado = auth()->user()->id;

        $usuarios = User::select('name', 'id')
            ->where('hierarquia', 3)
            ->orWhere('hierarquia', 2)
            ->get();
        
        $setores = Setor::select('name', 'id')->get();

        if ($request->chamadoid != null) {
            $editarChamado = Chamado::retornaDadosChamado($request->chamadoid, $usuarioLogado);
            $atribuido = Chamado::verificaAtribuicao($request->chamadoid);
            $acoes = Acompanhamento::retornaAcompanhamentosChamado($request->chamadoid);
        }

        return view('chamados.chamados', [
            'categorias' => $categorias->toArray(), 'setores' => $setores->toArray(),
            'editarChamado' => $editarChamado, 'atendentes' => $usuarios, 'alterar' => $atribuido, 'acoes' => $acoes
        ]);
    }

    /*Criação do Chamado*/
    public function criarChamado(Request $data)
    {
        //dd($data->input());

        $validate = request()->validate([
            'titulo'    => ['required', 'string'],
            'descricao' => ['required', 'string'],
            'categoria' => ['required', 'string'],
            'problema'  => ['required', 'string'],
            'setor'     => ['required', 'string'],
        ]);

        if($data->input('status') == "Finalizado" || $data->input('status') == "Encerrado"){
            request()->validate([
                'tituloAcao'    => ['required', 'string'],
                'descricaoAcao' => ['required', 'string']
            ]);
        }

        /*Filtra os dados para salvar*/
        if (count(explode('_', $data['problema'])) > 0) {
            $problema = explode('_', $data['problema']);
            $data['problema'] = $problema[0];
        }
        if (count(explode('_', $data['setor'])) > 0) {
            $setor = explode('_', $data['setor']);
            $data['setor'] = $setor[0];
        }
        if (count(explode('_', $data['categoria'])) > 0) {
            $categoria = explode('_', $data['categoria']);
            $data['categoria'] = $categoria[0];
        }

        if ($data['atendente'] == -1) {
            $data['atendente'] = null;
        }

        if ($data['prioridade'] == -1) {
            $data['prioridade'] = null;
        }
        /*Atualiza os dados do chamado cadastrado*/
        if ($data['idChamado'] != null) {
            $updateChamado = Chamado::where('id', $data['idChamado'])->first();
            
            if(is_null($updateChamado->codigo_atendente) && $data['atendente']){
                Acompanhamento::create([
                    'autor' => $data['atendente'],
                    'codigo_solicitante' => $updateChamado->codigo_solicitante,
                    'codigo_atendente' => $data['atendente'],
                    'codigo_chamado' => $data['idChamado'],
                    'titulo' => "Registro de atribuição",
                    'descricao' => "Seu chamado foi atribuído para um técnico."
                ]);
            }else if($updateChamado->codigo_atendente && $data['atendente']){
                if($updateChamado->codigo_atendente != (int)$data['atendente']){
                    Acompanhamento::create([
                        'autor' => auth()->user()->id,
                        'codigo_solicitante' => $updateChamado->codigo_solicitante,
                        'codigo_atendente' => $data['atendente'],
                        'codigo_chamado' => $data['idChamado'],
                        'titulo' => "Registro de transferência de chamado",
                        'descricao' => "Seu chamado foi transferido para outro técnico."
                    ]);
                }
            }
            
            if($updateChamado->prioridade && $data['prioridade']){
                if($updateChamado->prioridade != $data['prioridade']){
                    $updateChamado->prioridade = $data['prioridade'];
                    $updateChamado->codigo_atendente =  auth()->user()->id;
                }
            }
            $updateChamado->status = $data['status'];
            if($data['atendente']){
                $updateChamado->codigo_atendente = $data['atendente'];
            }
            $updateChamado->save();

            if($data['tituloAcao'] != ""){
                Acompanhamento::create([
                    'autor' => auth()->user()->id,
                    'codigo_solicitante' => $updateChamado->codigo_solicitante,
                    'codigo_atendente' => $updateChamado->codigo_atendente??'',
                    'codigo_chamado' => $data['idChamado'],
                    'titulo' => $data['tituloAcao'],
                    'descricao' => $data['descricaoAcao']
                ]);
            }
            
            return redirect()->back()->withSuccess('Chamado editado com sucesso.');
        } else {
            if ($validate['titulo'] == '' || $validate['descricao'] == '' || $validate['categoria'] == '-1' || $validate['problema'] == '-1' || $validate['setor'] == '-1') {
                return redirect()->back()->withErrors('Ainda existem parâmetros a serem preenchidos');
            }
            /*Criação de um Chamado*/
            Chamado::create([
                'codigo_solicitante' => auth()->user()->id,
                'codigo_atendente' => null,
                'codigo_problema' => $data['problema'],
                'codigo_setor' => $data['setor'],
                'titulo' => $data['titulo'],
                'descricao' => $data['descricao'],
                'status' => 'Aberto',
                'prioridade' => $data['prioridade']
            ]);
            return redirect()->back()->withSuccess('Chamado criado com sucesso.');
        }
    }

    /*Monta tela de acompanhamento de chamados*/
    public function acompanharChamados()
    {
        $chamados = Chamado::retornaChamadosSolicitante(auth()->user()->id);
       
        return view('chamados.acompanhar', ['chamados' => $chamados->toArray()]);
    }

    /*Monta tela de gerenciamento de chamados*/
    public function gerenciarChamados()
    {
        $chamados = Chamado::retornaTodosOsChamados();
        
        return view('chamados.acompanhar', ['chamados' => $chamados->toArray()]);
    }

    /*Filtra o select responsável por trazer as categorias*/
    public function searchCategoria(Request $data)
    {
        $categoria = $data->input('categoria');
        $problema = Problema::where('codigo_categoria', $categoria)->get();
        $dados = ['problemas' => $problema];
        return response()->json($dados, 200);
    }
}
