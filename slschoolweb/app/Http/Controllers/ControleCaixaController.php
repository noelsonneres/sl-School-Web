<?php

namespace App\Http\Controllers;

use App\Models\ControleCaixa;
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

        $caixa = $this->caixa->count();

        if ($caixa === 0){
            return view(self::PATH.'caixaCreate');
        }else{

            $caixa = $this->caixa->latest()->first();
//            dd($caixa);
            $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'caixaShow', ['caixas'=>$caixa]);
        }

    }

    public function create()
    {
        $caixa = $this->caixa->latest()->first();

        if ($caixa->status == 'aberto'){
            $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'caixaShow', ['caixas'=>$caixa])
                ->with('msg', 'ATENÇÃO! Não é possível iniciar um novo caixa se o anterior estiver aberto!');
        }else{
            return view(self::PATH.'caixaCreate');
        }

    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $caixa = $this->caixa->find($id);

        if ($caixa->status == 'aberto'){

            $dataCaixa = $caixa->data_abertura;
            $valorCaixa = $caixa->saldo_informado;

            $valorMensalidade = $this->calcularMensalidades($dataCaixa);
            $valorEntrada = $this->calcularEntradas($dataCaixa);
            $valorSaida = $this->calcularSaias($dataCaixa);

            $total = ($valorCaixa + $valorMensalidade + $valorEntrada) - $valorSaida;

            return view(self::PATH.'caixaFinalizar', ['caixa'=>$caixa,
                'valorMensalidade'=>$valorMensalidade,
                'valorEntrada'=>$valorEntrada,
                'valorSaida'=>$valorSaida,
                'total'=>$total
            ]);

        }else{
            $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'caixaShow', ['caixas'=>$caixa])
                ->with('msg', 'O caixa não pode ser finalizado');
        }

    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function iniciarCaixa(Request $request){

        $caixa = $this->caixa;

        $request->validate([
            'dtAbetura'=>'required',
            'hrAbetura'=>'required',
            'saldoAnterior'=>'required',
            'valorInformado'=>'required',
        ],[
            'dtAbetura.required'=>'Selecione uma data de Abertura valida',
            'hrAbetura.required'=>'Selecione uma data de abertura valida',
            'saldoAnterior.required'=>'Informe um valor valido para o campo Saldo Anterior',
            'valorInformado.required'=>'Infomre um valor valido pra o campo Valor informado',
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

        }catch (\Throwable $th){
            return view(self::PATH.'caixaCreate')
                        ->with('msg', 'Não foi possível iniciar um novo caixa: '.$th->getMessage());
        }

        $caixa = $this->caixa->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'caixaShow', ['caixas'=>$caixa])
                ->with('msg', $msg);

    }

    private function calcularMensalidades(string $data){
//        RETORNAR O TOTAL DE MENSALIDADES PAGAS EM UM PERIODO
        return 0;
    }

    private function calcularEntradas(string $data)
    {
//        RETORNAR O TOTAL DE ENTRADAS DE UM PERIODO
        return 0;
    }

    private function calcularSaias(string $data){
//        RETORNAR O TOTAL DE SAIDAS DE UM DETERMINDO PERIODO
        return 0;
    }

    private function ultimoValor(string $data)
    {
//      RETORNAR O VALOR DO ULTIMO CAIXA
        return 0;
    }

}
