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
        return view('setor.setor');
    }
    public function cadastrarSetor(Request $data)
    {
        //return redirect()->back()->withErrors(['message' => 'Não foi possivel cadastrar Setor.']);

        Setor::create([
           'name' => $data['nome'],
           'apelido' => $data['apelido'],
        ]);

        return redirect()->back()->withSuccess('Setor cadastrado com sucesso.');
    }

}
