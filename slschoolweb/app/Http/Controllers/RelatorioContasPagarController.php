<?php

namespace App\Http\Controllers;

use App\Models\ContasPagar;
use App\Models\PlanoContas;
use Illuminate\Http\Request;

class RelatorioContasPagarController extends Controller
{

    const PATH = 'screens.relatorios.financeiro.';
    private $contasPagar;

    public function __construct()
    {
        $this->contasPagar = new ContasPagar();
    }

    public function index()
    {
        $contas = $this->contasPagar->orderBy('id', 'desc')->paginate();

        $planoContas = PlanoContas::all();

        return view(self::PATH . 'relContasPagar', ['contas' => $contas, 'planoContas' => $planoContas]);
    }

    public function localizar(Request $request)
    {

        $request->validate([
            'planoContas' => 'required',
            'criterio' => 'required',
            'dt1' => 'required|date',
            'dt2' => 'required|date',
            'pago' => 'required',
        ], [
            'planoContas.required' => 'Selecione um plano de contas',
            'criterio.required' => 'Selecione o critério de pesquisa',
            'dt1.required' => 'Informe a data de início da pesquisa',
            'dt1.date' => 'Digite uma data valida no campo início',
            'dt2.required' => 'Informe a data de término da pesquisa',
            'dt2.date' => 'Digite uma data valida no campo término',
        ]);

        $planoID = $request->input('planoContas');
        $criterio = $request->input('criterio');
        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');
        $pago = $request->input('pago');

        $contas = $this->contasPagar
            ->whereBetween($criterio, [$dt1, $dt2])
            ->where('plano_contas_id', $planoID)
            ->where('pago', $pago)
            ->paginate();

        $planoContas = PlanoContas::all();
        return view(self::PATH . 'relContasPagar', ['contas' => $contas, 'planoContas' => $planoContas]);

    }

    public function localizarSimples(Request $request){

    }


    // relContasPagar

}
