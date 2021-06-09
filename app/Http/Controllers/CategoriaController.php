<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\def_categoria;

class CategoriaController extends Controller
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
            return view('categoria.categoria');
        } else {
            return redirect()->route('dashboard')->withErrors(['message' => 'Acesso negado.']);
        }         
    }
    public function cadastrarCategoria(Request $data)
    {
        //return redirect()->back()->withErrors(['message' => 'Não foi possivel cadastrar Categoria.']);

        def_categoria::create([
           'name' => $data['nome'],
           'apelido' => $data['apelido'],
        ]);

        return redirect()->back()->withSuccess('Categoria cadastrado com sucesso.');
    }
    
    /*Lista de Categoria*/
    public function listacatCategoria()
    {
        $categorias = def_categoria::retornaCategoria(auth()->user()->id);
     
        return view('categoria.listacat', ['categorias' => $categorias->toArray()]);
    }

}
