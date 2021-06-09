<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

        $grafic_chamados_por_dia = Chamado::select(
                                        'chamados.*'
                                    )
                                    ->where('chamados.created_at', '>=', \Carbon\Carbon::now()->subWeek())
                                    ->get();

        $filteredArray = [
            0 => [],
            1 => [],
            2 => [],
            3 => [],
            4 => [],
            5 => [],
            6 => []
        ];
        
        foreach ($grafic_chamados_por_dia as $record) {

            switch (Carbon::parse($record->created_at)->dayOfWeek) {
                case Carbon::MONDAY:
                    array_push($filteredArray[0], $record);
                    break;
                case Carbon::TUESDAY:
                    array_push($filteredArray[1], $record);
                    break;
                case Carbon::WEDNESDAY:
                    array_push($filteredArray[2], $record);
                    break;
                case Carbon::THURSDAY:
                    array_push($filteredArray[3], $record);
                    break;
                case Carbon::FRIDAY:
                    array_push($filteredArray[4], $record);
                    break;
                case Carbon::SATURDAY:
                    array_push($filteredArray[5], $record);
                    break;
                case Carbon::SUNDAY:
                    array_push($filteredArray[6], $record);
                    break;
            }
        }
        
        $count_filteredArray = "";
        foreach ($filteredArray as $key => $value) {
            $count_filteredArray .= count($filteredArray[$key]) . ",";
        }

        $grafic_chamados_por_dia = $count_filteredArray;
        //$grafic_problemas_setors = 
        //$grafic_minhas_atribuicoes = 
        
        return view('welcome', 
            ['total_chamados' => $total_chamados, 'total_chamados_sem_atendente' => $total_chamados_sem_atendente,
             'total_chamados_hoje' => $total_chamados_hoje, 'total_chamados_encerrados' => $total_chamados_encerrados,
             'minhas_atribuicoes' => $minhas_atribuicoes, 'grafic_chamados_por_dia' => $grafic_chamados_por_dia]
        );
    }
}
