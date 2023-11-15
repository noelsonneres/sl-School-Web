<?php

namespace App\Http\Controllers;

use App\Models\ConfigMensalidade;
use App\Models\Matricula;
use App\Models\Mensalidade;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

use Carbon\Carbon;

class MensalidadesController extends Controller
{

    const PATH = 'screens.alunos.mensalidade.';
    private $mensalidade;

    public function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {

        $mensalidades = $this->mensalidade->where('matriculas_id', $id)->paginate();

        $matricula = Matricula::find($id);
        $aluno = $matricula->alunos()->first();

        return view(self::PATH . 'mensalidadesShow', ['mensalidades' => $mensalidades])
            ->with('matricula', $matricula)
            ->with('aluno', $aluno);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function selecionarPagamento(string $mensalidade, string $matricula)
    {

        $mensalidade = $this->mensalidade->find($mensalidade);
        $matricula = Matricula::find($matricula);
        $aluno = $matricula->alunos()->first();

        $vencimento = new DateTime($mensalidade->vencimento);

        $juros = $this->calcularJuros($mensalidade->valor_parcela, $vencimento);

        dd($juros);

        return view(self::PATH . 'mensalidadesPagamento', ['mensalidade' => $mensalidade])
            ->with('matricula', $matricula)
            ->with('aluno', $aluno);
    }

    public function gerarMensalidades($field)
    {

        dd($field);
    }

    private function calcularJuros(string $valor, DateTime $vencimento)
    {

        $confMensalidades = ConfigMensalidade::all()->first();

        $totalAPagar = $valor;

        $juros = $confMensalidades->juros;
        $multa = $confMensalidades->multa;

        $valorPagto = $valor;
        $dataVencimento = Carbon::parse($vencimento);

        $dataAtual = Carbon::now();

        if ($dataAtual > $dataVencimento) {

            $intervalo = $dataAtual->diffInMonths($dataVencimento);

            $intervalo = ($intervalo == 0) ? 1 : $intervalo;

            $valorJuros = ($valorPagto * $juros / 100) * $intervalo;
            $valorTotal = $valorPagto + $valorJuros + $multa;

            $totalAPagar = $valorTotal;

            $resultado = ['total'=>$totalAPagar, 'valorJuros'=>$valorJuros, 'taxaJuros'=>$juros, 'multa'=>$multa ];

        }else{
            $resultado = ['total'=>$totalAPagar, 'valorJuros'=>0, 'taxaJuros'=>$juros, 'multa'=>$multa ];
        }

        return $resultado;
    }
}
