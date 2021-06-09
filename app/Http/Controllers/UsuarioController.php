<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
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
            return view('usuario.usuario');
        } else {
            return redirect()->route('dashboard')->withErrors(['message' => 'Acesso negado.']);
        }        
    }
    public function cadastrarUsuario(Request $data)
    {
        //return redirect()->back()->withErrors(['message' => 'Não foi possivel cadastrar Usuário.']);
        User::create([
           'name' => $data['nome'],
           'email' => $data['email'],
           'password' => Hash::make($data['password']),
           'hierarquia' => $data['hierarquia'],
        ]);

        return redirect()->back()->withSuccess('Usuário cadastrado com sucesso.');
    }

    /*Lista de Usuario*/
    public function listausuUsuario()
    {
        $usuarios = User::retornaUser(auth()->user()->id);
     
        return view('usuario.listausu', ['usuarios' => $usuarios->toArray()]);
    }
}
