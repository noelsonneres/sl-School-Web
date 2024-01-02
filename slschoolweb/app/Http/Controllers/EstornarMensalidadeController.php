<?php

namespace App\Http\Controllers;

use App\Models\NivelAcesso;
use Illuminate\Http\Request;
use App\Models\Mensalidade;
use App\Models\ControleCaixa;
use Carbon\Carbon;

class EstornarMensalidadeController extends Controller
{

    const PATH = 'screens.estornarMensalidade.';
    private $mensalidade;

    public  function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public  function index()
    {

        if ($this->verificarAcesso() == 1){

            $caixa = ControleCaixa::latest()->first();

            $dataAtual = Carbon::now();
            $dataAtual = $dataAtual->format('d/m/Y');

            $dataAberturaCaixa = Carbon::createFromFormat('Y-m-d', $caixa->data_abertura);
            $dataAberturaCaixa = $dataAberturaCaixa->format('d/m/Y');

            if ($caixa->status == 'aberto' and $dataAberturaCaixa == $dataAtual) {

                $mensalidade = Mensalidade::where('id', '0')->paginate();
                return view(self::PATH . 'estornarShow', ['mensalidades' => $mensalidade]);

            } else {

                $msg = '';

                if ($caixa->status == 'aberto' and $dataAberturaCaixa != $dataAtual) {
                    $msg = 'ATENÇÃO! O caixa anterior não foi encerrado. Por favor, finalize o caixa anterior antes de realizar qualquer operação financeira.';
                } elseif ($caixa->status == 'encerrado') {
                    $msg = 'ATENÇÃO! O caixa está fechado. Para realizar qualquer operação financeira, é necessário criar um novo caixa.';
                }

                $caixa = ControleCaixa::orderBy('id', 'desc')->paginate();
                return view('screens.controleCaixa.caixaShow', ['caixas' => $caixa])
                    ->with('msg', $msg);
            }

        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function localizarMensalidade(Request $request)
    {

        $campo = $request->input('opt');
        $valor = $request->input('find');

        if (empty($campo)) {
            $mensalidade = Mensalidade::where('id', '0')->paginate();
            return view(self::PATH . 'estornarShow', ['mensalidades' => $mensalidade])
                ->with('msg', 'ATENÇÃO! Selecione o criterio de pesquisa!');
        }

        if (empty($valor)) {
            $valor = 0;
        }

        $mensalidade = Mensalidade::where($campo, 'LIKE', $valor . '%')
            ->where('pago', 'sim')
            ->paginate(15);

        return view(self::PATH . 'estornarShow', ['mensalidades' => $mensalidade]);
    }

    public function estornar(string $mensalidade)
    {

        $mensalidade = $this->mensalidade->find($mensalidade);

        $matriculaID = $mensalidade->matriculas_id;

        $msg = '';

        try {

            $mensalidade->valor_pago = $mensalidade->valor_parcela;
            $mensalidade->data_pagamento = null;
            $mensalidade->pago = 'nao';
            $mensalidade->responsavel_pagamento = '';
            $mensalidade->forma_pagamento = '';

            $mensalidade->save();

            $msg = 'Sucesso! Mensalidade estornada com sucesso!';
        } catch (\Throwable $th) {
            $msg = 'ERRO! Não foi possível estornar a mensalidade!';
        }

        $mensalidade = Mensalidade::where('matriculas_id', $matriculaID)
            ->where('pago', 'sim')
            ->paginate(15);

        return view(self::PATH . 'estornarShow', ['mensalidades' => $mensalidade])
            ->with('msg', $msg);
    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Estornar mensalidade')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
