<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problema;
use App\Models\def_categoria;

class ProblemaController extends Controller
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
        if (auth()->user()->hierarquia == 3) {
            $categorias = def_categoria::select('name', 'id')->get();
            return view('problema.problema', ['categorias' => $categorias->toArray()]);
        } else {
            return redirect()->route('dashboard')->withErrors(['message' => 'Acesso negado.']);
        }        
    }
    public function cadastrarProblema(Request $data)
    {
        //return redirect()->back()->withErrors(['message' => 'Não foi possivel cadastrar Problema.']);

        Problema::create([
           'name' => $data['nome'],
           'codigo_categoria' => $data['categoria'],
        ]);

        return redirect()->back()->withSuccess('Problema cadastrado com sucesso.');
    }

}
