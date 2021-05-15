<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use App\Models\def_categoria;

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
    public function index()
    {   
        $categorias = def_categoria::select('name', 'id')->get();
        
        return view('chamados.chamados', ['categorias' => $categorias->toArray()]);
    }
    public function criarChamado(Request $data)
    {
        //return redirect()->back()->withErrors(['message' => 'Mensagem de teste para testar a modal de error.']);

        Chamado::create([
           'codigo_solicitante' => auth()->user()->id,
           'codigo_atendente' => null,
           'codigo_problema' => 1,
           'titulo' => $data['titulo'],
           'descricao' => $data['descricao'],
           'status' => 'Aberto',
           'prioridade' => 1,
        ]);

        return redirect()->back()->withSuccess('Chamado criado com sucesso.');
    }
    public function acompanharChamados()
    {
        $chamados = Chamado::retornaChamadosSolicitante(auth()->user()->id);
        dd($chamados);
    }
}
