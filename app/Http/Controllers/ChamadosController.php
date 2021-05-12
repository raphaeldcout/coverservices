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
           'codigo_solicitante' => 1,
           'codigo_atendente' => 1,
           'codigo_problema' => 1,
           'titulo' => $data['titulo'],
           'descricao' => $data['descricao'],
           'status' => 'Ativo',
           'prioridade' => 1,
        ]);
    }
}
