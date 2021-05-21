<?php

    namespace App\Http\Controllers;

    use App\Models\Problema;
    use Hamcrest\Core\Set;
    use Illuminate\Http\Request;
    use App\Models\Chamado;
    use App\Models\Setor;
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


        public function index(Request $request)
        {
            $categorias = def_categoria::select('name', 'id')->get();            
            $editarChamado = null;
            $usuarioLogado = auth()->user()->id;
            if($request->chamadoid != null){                
                $editarChamado = Chamado::retornaDadosChamado($request->chamadoid,$usuarioLogado);
            }
            //dd($editarChamado);
            $setores = Setor::select('name', 'id')->get();
            return view('chamados.chamados', ['categorias' => $categorias->toArray(),'setores' => $setores->toArray(), 'editarChamado' => $editarChamado]);
        }
        public function criarChamado(Request $data)
        {
            //dd($data);            
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

            if($data['idChamado'] != null){
                //dd(intval($data['idChamado']));
                $updateChamado = Chamado::where('id', $data['idChamado'])->first();
                $updateChamado->titulo = $data['titulo'];
                $updateChamado->descricao = $data['descricao'];
                $updateChamado->save();
                return redirect()->route('acompanhar_chamados')->withSuccess('Chamado criado com sucesso.');
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

        public function searchCategoria(Request $data)
        {
            $categoria = $data->input('categoria');
            $problema = Problema::where('codigo_categoria', $categoria)->get();

            $dados = ['problemas' => $problema];
            return response()->json($dados,200);
        }

        public function gerenciarChamados()
        {
            $chamados = Chamado::gerenciarChamados(auth()->user()->id);
            //dd($chamados);
            return view('chamados.gerenciar', ['chamados' => $chamados->toArray()]);
        }
    }
