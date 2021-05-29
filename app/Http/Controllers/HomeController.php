<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;

class HomeController extends Controller
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
        return view('home');
    }

    public function dashboard()
    {
        if(auth()->user()->hierarquia == 1){
            return redirect('/chamados');
        }

        $chamados = Chamado::all();

        $total_chamados = count($chamados);
        $total_chamados_sem_atendente = count($chamados->where('codigo_atendente', ' = ', null));
        $total_chamados_hoje = count($chamados->where('created_at', '>=', \Carbon\Carbon::today()));
        $total_chamados_encerrados = count($chamados->where('status', ' = ', 'Encerrado'));
        $minhas_atribuicoes = count($chamados->where('codigo_atendente', ' = ', auth()->user()->id));
        
        return view('welcome', 
            ['total_chamados' => $total_chamados, 'total_chamados_sem_atendente' => $total_chamados_sem_atendente,
             'total_chamados_hoje' => $total_chamados_hoje, 'total_chamados_encerrados' => $total_chamados_encerrados,
             'minhas_atribuicoes' => $minhas_atribuicoes]
        );
    }
}
