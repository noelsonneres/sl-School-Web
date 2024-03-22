<?php

namespace App\Http\Controllers;

use App\Models\ConfigurarMensalidade;
use App\Models\FormasPagamento;
use App\Models\Matricula;
use App\Models\Mensalidade;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class MensalidadeController extends Controller
{

    const PATH = 'screens.matricula.mensalidade.';
    private $mensalidade;

    public function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {

        $mensalidades = $this->mensalidade->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->where('matriculas_id', $id)
            ->paginate();
        $matricula = Matricula::find($id);

        return view(self::PATH . 'MensalidadeShow', [
            'mensalidades' => $mensalidades,
            'matricula' => $matricula,
        ]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    function quitarMensalidade(string $mensalidadeId)
    {

        //CRIAR FUNÇÃO PARA VERIFICAR SE O CAIXA ESTA ABERTO

        $mensalidade = $this->mensalidade->find($mensalidadeId);

        $formasPagamentos = FormasPagamento::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->get();

        $vencimento = new DateTime($mensalidade->vencimento);
        $juros = $this->calcularJuros($mensalidade->valor_parcela, $vencimento);

        if ($mensalidade->count() >= 1) {
            return view(self::PATH . 'mensalidadeQuitar', [
                'mensalidade' => $mensalidade,
                'formasPagamentos' => $formasPagamentos,
                'juros' => $juros
            ]);
        }
    }

    private function calcularJuros(string $valor, DateTime $vencimento)
    {

        $confMensalidades = ConfigurarMensalidade::all()->first();

        $totalAPagar = $valor;

        $juros = $confMensalidades->juros;
        $multa = 0;

        $valorPagto = $valor;
        // $dataVencimento = $vencimento;
        $dataVencimento = Carbon::parse($vencimento);

        $dataAtual = Carbon::now();

        if ($dataAtual > $dataVencimento) {
            
            $multa = $confMensalidades->multa;

            $intervalo = $dataVencimento->diffInMonths($dataAtual);

            // if(number_format($intervalo, 0, '.', '') == 0){
            //     $multa = 0;                
            // }

            $intervalo = ($intervalo == 0) ? 1 : $intervalo;

            $valorJuros = ($valorPagto * $juros / 100) * $intervalo;
            $valorTotal = $valorPagto + $valorJuros + $multa;

            $totalAPagar = $valorTotal;

            $resultado = ['total' => $totalAPagar, 'valorJuros' => number_format($valorJuros, 2, '.', ''), 'taxaJuros' => $juros, 'multa' => $multa];
        } else {
            $resultado = ['total' => $totalAPagar, 'valorJuros' => 0, 'taxaJuros' => 0, 'multa' => 0];
        }

        return $resultado;
    }
}
