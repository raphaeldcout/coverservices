<?php

    namespace App\Http\Controllers;

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

            $usuarioLogado = auth()->user()->id;

            $usuarios = User::select('name', 'id')
            ->where('hierarquia', 3)
            ->orWhere('hierarquia', 2)
            ->get();

            if($request->chamadoid != null){                
                $editarChamado = Chamado::retornaDadosChamado($request->chamadoid, $usuarioLogado);
                $atribuido = Chamado::verificaAtribuicao($request->chamadoid);
            }
            //dd($atribuido);
            $setores = Setor::select('name', 'id')->get();
            return view('chamados.chamados', ['categorias' => $categorias->toArray(),'setores' => $setores->toArray(), 
                        'editarChamado' => $editarChamado, 'atendentes' => $usuarios, 'alterar' => $atribuido]);
        }


        public function criarChamado(Request $data)
        {             
            $validate = request()->validate([
                'titulo'    => ['required', 'string'],
                'descricao' => ['required', 'string'],
                'categoria' => ['required', 'string'],
                'problema'  => ['required', 'string'],
                'setor'     => ['required', 'string'],
            ]);

            if($validate['titulo'] == '' || $validate['descricao'] == '' || $validate['categoria'] == '-1' || $validate['problema'] == '-1'|| $validate['setor'] == '-1')
            {
                return redirect()->back()->withErrors('Ainda existem parâmetros a serem preenchidos');
            }

            if(count(explode('_',$data['problema']))>0){
                $problema = explode('_', $data['problema']);
                $data['problema'] = $problema[0];
            }
            if(count(explode('_',$data['setor']))>0){
                $setor = explode('_', $data['setor']);
                $data['setor'] = $setor[0];
            }
            if(count(explode('_',$data['categoria']))>0){
                $categoria = explode('_', $data['categoria']);
                $data['categoria'] = $categoria[0];
            }
            
            if($data['atendente'] == -1){
                $data['atendente'] = null;
            }

            if($data['idChamado'] != null){
                //dd(intval($data['idChamado']));
                $updateChamado = Chamado::where('id', $data['idChamado'])->first();
                //dd($updateChamado);
                $updateChamado->titulo = $data['titulo'];
                $updateChamado->descricao = $data['descricao'];
                $updateChamado->codigo_atendente = $data['atendente'];
                $updateChamado->save();
                return redirect()->back()->withSuccess('Chamado editado com sucesso.');
                //return redirect()->route('acompanhar_chamados')->withSuccess('Chamado criado com sucesso.');
            }else{
                Chamado::create([
                    'codigo_solicitante' => auth()->user()->id,
                    'codigo_atendente' => null,
                    'codigo_problema' => $data['problema'],
                    'codigo_setor' => $data['setor'],
                    'titulo' => $data['titulo'],
                    'descricao' => $data['descricao'],
                    'status' => 'Aberto',
                    'prioridade' => null,
                 ]);
                 return redirect()->back()->withSuccess('Chamado criado com sucesso.');
            }            
        }

        public function acompanharChamados()
        {
            $chamados = Chamado::retornaChamadosSolicitante(auth()->user()->id);
            //dd($chamados);
            return view('chamados.acompanhar', ['chamados' => $chamados->toArray()]);
        }

        public function gerenciarChamados()
        {
            $chamados = Chamado::retornaTodosOsChamados();
            //dd($chamados);
            return view('chamados.acompanhar', ['chamados' => $chamados->toArray()]);
        }

        public function searchCategoria(Request $data)
        {
            $categoria = $data->input('categoria');
            $problema = Problema::where('codigo_categoria', $categoria)->get();
            $dados = ['problemas' => $problema];
            return response()->json($dados,200);
        }

    }
