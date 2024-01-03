<?php

namespace App\Http\Controllers;

use App\Models\ControleCaixa;
use App\Models\EntradaValor;
use App\Models\Mensalidade;
use App\Models\NivelAcesso;
use App\Models\Saidavalor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaidaValoresController extends Controller
{

    const PATH = 'screens.saidaValores.';
    private $saidas;

    public function __construct()
    {
        $this->saidas = new Saidavalor();
    }

    public function index()
    {

        if ($this->verificarAcesso() == 1){

            $caixa = ControleCaixa::latest()->first();

            $msg = '';

            if ($caixa != null) {

                $dataAtual = Carbon::now();
                $dataAtual = $dataAtual->format('d/m/Y');

                $dataAberturaCaixa = Carbon::createFromFormat('Y-m-d', $caixa->data_abertura);
                $dataAberturaCaixa = $dataAberturaCaixa->format('d/m/Y');

                if ($caixa->status == 'aberto' and $dataAberturaCaixa == $dataAtual) {

                    $saidas = $this->saidas->paginate();
                    return view(self::PATH . 'saidaValoresShow', ['saidaValores' => $saidas]);

                } else {

                    if ($caixa->status == 'aberto' and $dataAberturaCaixa != $dataAtual) {
                        $msg = 'ATENÇÃO! O caixa anterior não foi encerrado. Por favor, finalize o caixa anterior antes de realizar qualquer operação financeira.';
                    } elseif ($caixa->status == 'encerrado') {
                        $msg = 'ATENÇÃO! O caixa está fechado. Para realizar qualquer operação financeira, é necessário criar um novo caixa.';
                    }
                }

            }else{
                $msg = 'ATENÇÃO! O caixa anterior não foi encerrado. Por favor, finalize o caixa anterior antes de realizar qualquer operação financeira.';
            }

            $caixa = ControleCaixa::orderBy('id', 'desc')->paginate();
            return view('screens.controleCaixa.caixaShow', ['caixas' => $caixa])
                ->with('msg', $msg);

        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

        }


    public function create()
    {

        return view(self::PATH . 'saidaValoresCreate');

    }

    public function store(Request $request)
    {

        $saida = $this->saidas;

        $request->validate([
            'motivo' => 'required|min:3|max:50',
            'data' => 'required',
            'hora' => 'required',
            'valor' => 'required',
        ], [
            'motivo.required' => 'Informe um valor para o campo Motivo',
            'motivo.min' => 'O motivo da motivo deve ter mais de três caracteres',
            'motivo.max' => 'O motivo da motivo deve ter mens de 50 caracteres',
            'data.required' => 'Selecione uma data valida para a saída',
            'hora.required' => 'Informe um horário valido',
            'valor.required' => 'Digite o valor da saída',
        ]);

        $motivo = $request->old('motivo');
        $data = $request->old('data');
        $hora = $request->old('hora');
        $valor = $request->old('valor');

        $msg = '';

        try {

            $valorCaixa = $this->verificarCaixa();
            $valorSaida = $request->input('valor');

            if ($valorSaida < $valorCaixa) {
                $saida->motivo = $request->input('motivo');
                $saida->data = $request->input('data');
                $saida->hora = $request->input('hora');
                $saida->valor = $request->input('valor');
                $saida->observacao = $request->input('obs');

                $saida->save();

                $msg = 'SUCESSO! Saída efetuada com sucesso!';
            }else{
                $msg = 'ATENÇÃO! Não há saldo suficiente para esta saída!';
            }

        } catch (\Throwable $th) {
            $msg = 'ERRO! Não foi possível realizar a Saída dos valores: ' . $th->getMessage();
        }

        $saidas = $this->saidas->paginate();
        return view(self::PATH . 'saidaValoresShow', ['saidaValores' => $saidas])
            ->with('msg', $msg);
    }

    public function show(string $id)
    {
        //
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

        $saida = $this->saidas->find($id);
        $msg = '';

        if ($saida->count() >= 1){

            try {
                $saida->delete();
                $msg = 'SUCESSO! Saída removida com sucesso!';
            }catch (\Throwable $th){
                $msg = 'ERRO! Não foi possível deletar a saida: '.$th->getMessage();
            }

        }else{
            $msg = 'ATENÇÃO! Não foi possível localizar a saída!';
        }

        $saidas = $this->saidas->paginate();
        return view(self::PATH . 'saidaValoresShow', ['saidaValores' => $saidas])
            ->with('msg', $msg);

    }

    public function find(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if(empty($field)){
            $field = 'id';
        }

        $saidas = Saidavalor::where($field, 'LIKE', $value.'%')->orderBy('id', 'desc')->paginate(15);

        return view(self::PATH . 'saidaValoresShow', ['saidaValores' => $saidas]);

    }

    private function verificarCaixa()
    {

        $dataAtual = Carbon::now();
        $data = $dataAtual->format('d/m/Y');

        $dataCaixa = Carbon::now();
        $dataCaixa = $dataCaixa->format('Y-m-d');

        $totalMensalidades = Mensalidade::where('data_pagamento', $dataCaixa)->sum('valor_pago');
        $totalEntrada = EntradaValor::where('data', $dataCaixa)->sum('valor');
        $totalSaida = Saidavalor::where('data', $dataCaixa)->sum('valor');
        $Caixa = ControleCaixa::where('data_abertura', $dataCaixa)->first();

        if ($Caixa != null){
            $tCaixa = $Caixa->saldo_informado;
        }else{
            $tCaixa = 0;
        }

        $total = ($totalMensalidades + $totalEntrada + $tCaixa) - $totalSaida;

        return $total;

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Cad.Salas')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
