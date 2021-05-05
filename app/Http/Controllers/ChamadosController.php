<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\Request;

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
        return view('chamados');
    }
    public function criarChamado(Request $data)
    {
        Chamado::create([
           'titulo' => $data['titulo'],
           'status' => $data['status'],
           'urgencia' => $data['urgencia'],
           'prioridade' => $data['prioridade'],
           'descricao' => $data['descricao'],
           'resumo' => $data['resumo'],
           'anexo' => $data['anexo']
        ]);
    }
}
