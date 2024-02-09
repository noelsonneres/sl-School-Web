<?php

namespace App\Http\Controllers;

use App\Models\ContasPagar;
use App\Models\NivelAcesso;
use App\Models\PlanoContas;
use Illuminate\Http\Request;
use App\Models\ControleCaixa;
use Carbon\Carbon;

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

        if ($this->verificarAcesso() == 1){

            $caixa = ControleCaixa::latest()->first();

            if($caixa != Null){

                $dataAtual = Carbon::now();
                $dataAtual = $dataAtual->format('d/m/Y');

                $dataAberturaCaixa = Carbon::createFromFormat('Y-m-d', $caixa->data_abertura);
                $dataAberturaCaixa = $dataAberturaCaixa->format('d/m/Y');

                if($caixa->status == 'aberto' and $dataAberturaCaixa == $dataAtual){

                    $contas = $this->contas->orderBy('id', 'desc')->paginate();
                    return view(self::PATH.'contasPagarShow', ['contas'=>$contas]);

                }else{

                    $msg = '';

                    if($caixa->status == 'aberto' and $dataAberturaCaixa != $dataAtual){
                        $msg = 'ATENÇÃO! O caixa anterior não foi encerrado. Por favor, finalize o caixa anterior antes de realizar qualquer operação financeira.';
                    }elseif($caixa->status == 'encerrado'){
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

        if ($this->verificarAcesso() == 1){
            $planoContas = PlanoContas::all();
            return view(self::PATH.'contasCreate', ['planoContas'=>$planoContas]);
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

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

        $conta = $this->contas->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'contasPagarShow', ['contas'=>$conta])
                ->with('msg', $msg);


    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $conta = $this->contas->find($id);
        $planoContas = PlanoContas::all();
        return view(self::PATH.'contasEdit', ['conta'=>$conta, 'planoContas'=>$planoContas]);

    }

    public function update(Request $request, string $id)
    {

        $conta = $this->contas->find($id);

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

            $msg = 'Informações da conta atualizadas com sucesso!';

        }catch (\Throwable $th){
            $msg = 'ERRO! Não foi possível atualizar as informações da conta:'.$th->getMessage();
        }

        $conta = $this->contas->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'contasPagarShow', ['contas'=>$conta])
            ->with('msg', $msg);

    }

    public function destroy(string $id)
    {

        $conta = $this->contas->find($id);
        $msg = '';

        if ($conta->count() >= 1){

            if($conta->pago == 'nao'){
                try {
                    $conta->delete();
                    $msg = 'Conta deletada com sucesso!';
                }catch (\Throwable $th){
                    $msg = 'ERRO! Não foi possível deletar a conta: '.$th->getMessage();
                }
            }else{
                $msg = 'ATENÇÃO! Você não pode deletar uma conta que já esteja quitada';
            }

        }else{
            $msg = 'Não foi possível localizar a conta!';
        }

        $conta = $this->contas->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'contasPagarShow', ['contas'=>$conta])
            ->with('msg', $msg);

    }

    public function find(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if(empty($field)){
            $field = 'id';
        }

        $conta = ContasPagar::where($field, 'LIKE', $value.'%')->orderBy('id', 'desc')->paginate(15);

        return view(self::PATH.'contasPagarShow', ['contas'=>$conta]);

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Contas a pagar')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
