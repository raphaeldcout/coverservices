<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;

class SetorController extends Controller
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
        if(auth()->user()->hierarquia == 3){
            return view('setor.setor');
        }else{
            return redirect()->route('dashboard')->withErrors(['message' => 'Acesso negado.']);
        }  
    }
    public function cadastrarSetor(Request $data)
    {
        Setor::create([
            'name' => $data['nome'],
            'apelido' => $data['apelido'],
        ]);

        return redirect()->back()->withSuccess('Setor cadastrado com sucesso.');
    }

    /*Lista de setor*/
    public function listasetSetor()
    {
        $setores = Setor::retornaSetores(auth()->user()->id);
     
        return view('setor.listaset', ['setores' => $setores->toArray()]);
    }
}
