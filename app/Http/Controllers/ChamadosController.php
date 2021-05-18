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
        public function index()
        {
            $categorias = def_categoria::select('name', 'id')->get();

            return view('chamados.chamados', ['categorias' => $categorias->toArray()]);
        }
        public function criarChamado(Request $data)
        {
            //return redirect()->back()->withErrors(['message' => 'Mensagem de teste para testar a modal de error.']);
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
            Chamado::create([
               'codigo_solicitante' => auth()->user()->id,
               'codigo_atendente' => null,
               'codigo_problema' => 1,
               'titulo' => $data['titulo'],
               'descricao' => $data['descricao'],
               'status' => 'Aberto',
               'prioridade' => 1,
            ]);

            return redirect()->back()->withSuccess('Chamado criado com sucesso.');
        }

        public function acompanharChamados()
        {
            $chamados = Chamado::retornaChamadosSolicitante(auth()->user()->id);
            dd($chamados);
        }
        public function searchCategoria(Request $data)
        {
            $categoria = $data->input('categoria');
            $categorias = def_categoria::where('id', $categoria)->first();
            $problema = Problema::where('codigo_categoria', $categoria)->get();
            $setor = Setor::where('id', $categorias->codigo_setor)->get();

            $dados = ['problemas' => $problema, 'setor'=>$setor];
            return response()->json($dados,200);
        }
    }
