<?php

namespace App\Http\Controllers;

use App\Models\ContasPagar;
use App\Models\PlanoContas;
use Illuminate\Http\Request;

class ContasPagarController extends Controller
{

    const PATH = 'screens.contasPagar.';
    private $contas;

    public function __construct()
    {
        $this->contas = new ContasPagar();
    }

    public function index()
    {
        $contas = $this->contas->paginate();
        return view(self::PATH.'contasPagarShow', ['contas'=>$contas]);

    }

    public function create()
    {
        $planoContas = PlanoContas::all();
        return view(self::PATH.'planoContasCreate', ['planoContas'=>$planoContas]);
    }

    public function store(Request $request)
    {

        $conta = $this->contas;

        $request->validate([
            'conta'=>'required|min:2|max:50',
            'tipo'=>'required',
            'valor'=>'required',
            'vencimento'=>'required',
            'pago'=>'required',
            'total'=>'required',
        ],[
            'conta.required'=>'Informe a conta que deseja cadastrar',
            'conta.min'=>'O campo conta deve ter no minímo dois caracteres',
            'conta.max'=>'O compo conta deve ter no máximo 50 caracteres',
            'tipo.required'=>'Selecione um valor para o campo Tipo',
            'valor.required'=>'Informe um valor para o campo Valor',
            'vencimento.required'=>'Informe a data de vencimento',
            'pago.required'=>'Informe se a conta esta paga ou não',
            'total.required'=>'Informe o total para pagamento',
        ]);

        $contas = $request->old('conta');
        $tipo = $request->old('tipo');
        $valor = $request->old('valor');
        $vencimento = $request->input('vencimento');
        $pago = $request->input('pago');

        $msg = '';

//        dd($request);

        try {

            $conta->conta = $request->input('conta');
            $conta->descricao = $request->input('descricao');
            $conta->plano_contas_id = $request->input('tipo');
            $conta->valor = $request->input('valor');
            $conta->vencimento = $request->input('vencimento');
            $conta->juros = $request->input('juros');
            $conta->multa = $request->input('multa');
            $conta->desconto = $request->input('desconto');
            $conta->acrescimo = $request->input('acrescimo');
            $conta->data_pagametno = $request->input('dtPagamento');
            $conta->pago = $request->input('pago');
            $conta->total = $request->input('total');
            $conta->observacao = $request->input('obs');

            $conta->save();

            $msg = 'Conta adicionada com sucesso!';

        }catch (\Throwable $th){
            $msg = 'ERRO! Não foi possível salvar as informações da conta:'.$th->getMessage();
        }

        $conta = $this->contas->paginate();
        return view(self::PATH.'contasPagarShow', ['contas'=>$conta])
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
        //
    }
}
