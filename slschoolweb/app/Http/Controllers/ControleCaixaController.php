<?php

namespace App\Http\Controllers;

use App\Models\ControleCaixa;
use App\Models\EntradaValor;
use App\Models\Mensalidade;
use App\Models\NivelAcesso;
use App\Models\Saidavalor;
use Illuminate\Http\Request;

class ControleCaixaController extends Controller
{

    const PATH =  'screens.controleCaixa.';
    private $caixa;

    public function __construct()
    {
        $this->caixa = new ControleCaixa();
    }

    public function index()
    {

        if ($this->verificarAcesso('Caixa') == 1){

            $caixa = $this->caixa->count();

            if ($caixa === 0) {
                return view(self::PATH . 'caixaCreate');
            } else {
                $caixa = $this->caixa->latest()->first();
                //            dd($caixa);
                $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
                return view(self::PATH . 'caixaShow', ['caixas' => $caixa]);
            }

        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function create()
    {

        if ($this->verificarAcesso('Caixa') == 1) {

            $caixa = $this->caixa->latest()->first();

            if ($caixa->status == 'aberto') {
                $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
                return view(self::PATH . 'caixaShow', ['caixas' => $caixa])
                    ->with('msg', 'ATENÇÃO! Não é possível iniciar um novo caixa se o anterior estiver aberto!');
            } else {
                return view(self::PATH . 'caixaCreate');
            }

        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function store(Request $request)
    {

        $caixa = $this->caixa;

        $request->validate([
            'dtAberturaAtual' => 'required',
            'hrAberturaAtual' => 'required',
            'valorAnteriorAtual' => 'required',
            'valorInformadoAtual' => 'required',
        ], [
            'dtAberturaAtual.required' => 'Selecione uma data de Abertura valida',
            'hrAberturaAtual.required' => 'Selecione um horário de abertura valida',
            'valorAnteriorAtual.required' => 'Informe um valor valido para o campo Saldo Anterior',
            'valorInformadoAtual.required' => 'Informe um valor valido pra o campo Valor informado',
        ]);

        $msg = '';

        try {

            $caixa->data_abertura = $request->input('dtAberturaAtual');
            $caixa->hora_abertura = $request->input('hrAberturaAtual');
            $caixa->saldo_anterior = $request->input('valorAnteriorAtual');
            $caixa->saldo_informado = $request->input('valorInformadoAtual');
            $caixa->status = 'aberto';

            $caixa->save();

            $msg = 'Caixa iniciando com sucesso!';
        } catch (\Throwable $th) {
            return view(self::PATH . 'caixaNovo')
                ->with('msg', 'Não foi possível iniciar um novo caixa: ' . $th->getMessage());
        }

        $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'caixaShow', ['caixas' => $caixa])
            ->with('msg', $msg);

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $caixa = $this->caixa->find($id);

        if ($caixa->status == 'aberto') {

            $dataCaixa = $caixa->data_abertura;
            $valorCaixa = $caixa->saldo_informado;

            $valorMensalidade = $this->calcularMensalidades($dataCaixa);
            $valorEntrada = $this->calcularEntradas($dataCaixa);
            $valorSaida = $this->calcularSaias($dataCaixa);

            $total = ($valorCaixa + $valorMensalidade + $valorEntrada) - $valorSaida;

            return view(self::PATH . 'caixaFinalizar', [
                'caixa' => $caixa,
                'valorMensalidade' => $valorMensalidade,
                'valorEntrada' => $valorEntrada,
                'valorSaida' => $valorSaida,
                'total' => $total
            ]);
        } else {
            $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'caixaShow', ['caixas' => $caixa])
                ->with('msg', 'O caixa não pode ser finalizado');
        }
    }

    public function update(Request $request, string $id)
    {

        $caixa = $this->caixa->find($id);

        $msg = '';

        if ($caixa != null) {

            $request->validate([
                'dtEncerramento' => 'required',
                'hrEncerramento' => 'required',
                'saldoEncerramento' => 'required',
            ], [
                'dtEncerramento.required' => 'Informe um data de encerramento valida',
                'hrEncerramento.required' => 'Informe um horário de encerramento valido',
                'saldoEncerramento.required' => 'Você deve informar um valor valido para o campo encerramento do caixa',
            ]);

            try {

                $caixa->data_encerramento = $request->input('dtEncerramento');
                $caixa->hora_encerramento = $request->input('hrEncerramento');
                $caixa->saldo_encerramento = $request->input('saldoEncerramento');
                $caixa->status = 'encerrado';
                $caixa->observacao = $request->input('obs');

                $caixa->save();

                $msg = 'SUCESSO! Caixa finalizado com sucesso!';
            } catch (\Throwable $th) {
                $msg = 'ERRO! O caixa não pode ser finalizado';
            }
        } else {
            $msg = 'ATENÇÃO! Não foi possível localizar o caixa!';
        }

        $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'caixaShow', ['caixas' => $caixa])
            ->with('msg', $msg);
    }

    public function destroy(string $id)
    {
        //
    }

    public function iniciarCaixa(Request $request)
    {

        if ($this->verificarAcesso('Caixa') == 1) {

            $caixa = $this->caixa;

            $request->validate([
                'dtAbetura' => 'required',
                'hrAbetura' => 'required',
                'saldoAnterior' => 'required',
                'valorInformado' => 'required',
            ], [
                'dtAbetura.required' => 'Selecione uma data de Abertura valida',
                'hrAbetura.required' => 'Selecione um horário de abertura valida',
                'saldoAnterior.required' => 'Informe um valor valido para o campo Saldo Anterior',
                'valorInformado.required' => 'Infomre um valor valido pra o campo Valor informado',
            ]);

            $msg = '';

            try {

                $caixa->data_abertura = $request->input('dtAbetura');
                $caixa->hora_abertura = $request->input('hrAbetura');
                $caixa->saldo_anterior = $request->input('saldoAnterior');
                $caixa->saldo_informado = $request->input('valorInformado');
                $caixa->status = 'aberto';

                $caixa->save();

                $msg = 'Caixa iniciando com sucesso!';
            } catch (\Throwable $th) {
                return view(self::PATH . 'caixaCreate')
                    ->with('msg', 'Não foi possível iniciar um novo caixa: ' . $th->getMessage());
            }

            $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'caixaShow', ['caixas' => $caixa])
                ->with('msg', $msg);

        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function novoCaixa(){

        if ($this->verificarAcesso('Caixa') == 1) {

            $caixa = $this->caixa->latest()->first();

            if ($caixa != null) {

                if ($caixa->status == 'encerrado') {

                    return view(self::PATH . 'caixaNovo', ['caixa' => $caixa]);

                } else {
                    $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
                    return view(self::PATH . 'caixaShow', ['caixas' => $caixa])
                        ->with('msg', 'Não é possível iniciar um novo! Finalize o caixa anterior antes de iniciar um novo caixa!');
                }

            } else {
                return view(self::PATH . 'caixaCreate', ['caixa' => $caixa]);
            }

        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }




    }

    private function calcularMensalidades(string $data)
    {

        $total = Mensalidade::where('data_pagamento', $data)->sum('valor_pago');
        return $total;
    }

    private function calcularEntradas(string $data)
    {
        $total = EntradaValor::where('data', $data)->sum('valor');
        return $total;
    }

    private function calcularSaias(string $data)
    {
        $total = Saidavalor::where('data', $data)->sum('valor');
        return $total;
    }

    private function ultimoValor(string $data)
    {
        //      RETORNAR O VALOR DO ULTIMO CAIXA
        return 0;
    }

    private function verificarAcesso(string $recurso)
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', $recurso)
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
