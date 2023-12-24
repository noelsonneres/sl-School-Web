<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\ConfigMensalidade;
use App\Models\ControleCaixa;
use App\Models\Empresa;
use App\Models\Matricula;
use App\Models\MeiosPagamento;
use App\Models\Mensalidade;
use App\Models\Responsavel;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $request->validate([
            'qtdeParcelas' => 'required',
            'valor' => 'required',
            'vencimento' => 'required',
        ],[
            'qtdeParcelas.required'=>'Informe a quantidade de parcelas que deseja inserir',
            'valor.required'=>'Informe um valor para o campos "Valor da parcela"', 
            'vencimento.required'=>'Você deve digitar uma data de vencimento valida', 
        ]);

        $qtdeParcelas = $request->old('qtdeParcelas');
        $valor = $request->old('valor');
        $vencimento = $request->old('vencimento');

        $dataVencimento = $request->old('vencimento');

        $qtdeParcela = $request->input('qtdeParcelas');

        try {
            
            for ($i = 0; $i < $qtdeParcela; $i++) {

                $mensalidade = new Mensalidade();
    
                $mensalidade->responsavels_id = $request->input('responsavel');
                $mensalidade->alunos_id = $request->input('aluno');
                $mensalidade->matriculas_id = $request->input('matricula');
                $mensalidade->qtde_mensalidades = $qtdeParcela;
                $mensalidade->valor_parcela = $request->input('valor');
    
                $dataVencimento = new DateTime($request->input('vencimento'));
                $dataVencimento->modify('+' . $i . ' months');
                $mensalidade->vencimento = $dataVencimento;
    
                $mensalidade->pago = 'nao';
                $mensalidade->observacao = $request->input('obs');
    
                $mensalidade->save();
            }

        } catch (\Throwable $th) {
            return $th;
        }       

    }

    public function show(string $id)
    {

        $matricula = Matricula::find($id);
        $aluno = $matricula->alunos()->first();


        $mensalidades = $this->mensalidade->where('matriculas_id', $id)->paginate(30);

        return view(self::PATH . 'mensalidadesShow', ['mensalidades' => $mensalidades])
            ->with('matricula', $matricula)
            ->with('aluno', $aluno);
    }

    public function edit(string $id)
    {
        
        $mensalidade = $this->mensalidade->find($id);
        $matriculaID = $mensalidade->matriculas_id;

        $matricula = Matricula::find($matriculaID);
        $aluno = $matricula->alunos()->first();    

        if($mensalidade->count() >= 1){
            if($mensalidade->pago === 'nao'){
                return view(self::PATH.'mensalidadeEdit', ['mensalidade'=>$mensalidade, 'aluno'=>$aluno]);
            }else{
                return back();
            }
            
        }

    }

    public function update(Request $request, string $id)
    {
        
        $mensalidade = $this->mensalidade->find($id);

        $request->validate([
            'valor' => 'required',
            'dataVencimento' => 'required',
        ],[
            'valor.required'=>'Você deve digitar um valor',
            'dataVencimento.required'=>'Você deve digitar uma data de vencimento valida', 
        ]);

        try {

            $matriculaID = $request->input('matricula');
            
            $mensalidade->valor_parcela = $request->input('valor');
            $mensalidade->vencimento = $request->input('dataVencimento');
            $mensalidade->observacao = $request->input('obs');

            $mensalidade->save();

            $mensalidade = $this->mensalidade->where('matriculas_id', $matriculaID)->paginate();

            $matricula = Matricula::find($matriculaID);
            $aluno = $matricula->alunos()->first();

            return view(self::PATH . 'mensalidadesShow', ['mensalidades' => $mensalidade])
            ->with('matricula', $matricula)
            ->with('aluno', $aluno)
            ->with('msg', 'Informações atualizadas com sucesso!!!');

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function destroy(string $id)
    {
        
        $mensalidade = $this->mensalidade->find($id);

        $matriculaID = $mensalidade->matriculas_id;
        $alunoID = $mensalidade->alunos_id;        

        if($mensalidade->count() >= 1){

            if($mensalidade->pago === 'nao'){

                try {

                    $mensalidade->delete();
                    $msg = "Mensalidade excluida com sucesso!!!";
        
                } catch (\Throwable $th) {
                    $msg = "ERRO! Não foi possível excluir a mensalidade!";
                }    

            }else{
                $msg = 'ERRO! Não é possível exluir uma mensalidade que já esteja paga';
            }


        }

        $mensalidade = $this->mensalidade->where('matriculas_id', $matriculaID)->paginate();

        $matricula = Matricula::find($matriculaID);
        $aluno = $matricula->alunos()->first();

        return view(self::PATH . 'mensalidadesShow', ['mensalidades' => $mensalidade])
        ->with('matricula', $matricula)
        ->with('aluno', $aluno)
        ->with('msg', $msg);        

    }

    public function selecionarPagamento(string $mensalidade, string $matricula)
    {

        $caixa = ControleCaixa::latest()->first();

        $dataAtual = Carbon::now();
        $dataAtual = $dataAtual->format('d/m/Y');

        $dataAberturaCaixa = Carbon::createFromFormat('Y-m-d', $caixa->data_abertura);
        $dataAberturaCaixa = $dataAberturaCaixa->format('d/m/Y');

        if($caixa->status == 'aberto' and $dataAberturaCaixa == $dataAtual){
           
            $mensalidade = $this->mensalidade->find($mensalidade);
            $matricula = Matricula::find($matricula);
            $aluno = $matricula->alunos()->first();
            $responsavel = Responsavel::where('alunos_id', $aluno->id)->first();
    
            if($mensalidade->pago === 'nao'){
    
                $formaPagamento = MeiosPagamento::all();
    
                $vencimento = new DateTime($mensalidade->vencimento);
        
                $juros = $this->calcularJuros($mensalidade->valor_parcela, $vencimento);
        
                return view(self::PATH . 'mensalidadesPagamento', ['mensalidade' => $mensalidade])
                    ->with('matricula', $matricula)
                    ->with('aluno', $aluno)
                    ->with('juros', $juros)
                    ->with('formas_pagamentos', $formaPagamento)
                    ->with('responsavel', $responsavel);
    
            }else{
                return back();
            }

        }else{

            $msg = '';

            if($caixa->status == 'aberto' and $dataAberturaCaixa != $dataAtual){
                $msg = 'ATENÇÃO! O caixa anterior não foi encerrado. Por favor, finalize o caixa anterior antes de realizar qualquer operação financeira.';
            }elseif($caixa->status == 'encerrado'){
                $msg = 'ATENÇÃO! O caixa está fechado. Para realizar qualquer operação financeira, é necessário criar um novo caixa.';
            }

            $caixa = ControleCaixa::orderBy('id', 'desc')->paginate();
            return view('screens.controleCaixa.caixaShow', ['caixas' => $caixa])
                ->with('msg', $msg);
        }        
        
    }

    public function quitar(Request $request)
    {

        $mensalidadeID = $request->input('menalidade');

        $mensalidade = $this->mensalidade->find($mensalidadeID);

        $request->validate([
            'codigo' => 'required',
            'matricula' => 'required',
            'menalidade' => 'required',
            'vencimento' => 'required',
            'valor' => 'required',
            'valorPago' => 'required',
            'dataPagamento' => 'required',
            'meioPagamento' => 'required',
        ]);

        try {;

            $mensalidade->juros = str_replace(['R$', ','], '', $request->input('juros'));
            $mensalidade->multa = str_replace(['R$', ','], '', $request->input('multa'));
            $mensalidade->desconto = $request->input('desconto');
            $mensalidade->acrescimo = $request->input('acrescimo');
            $mensalidade->valor_pago = $request->input('valorPago');
            $mensalidade->data_pagamento = $request->input('dataPagamento');
            $mensalidade->pago = 'sim';
            $mensalidade->responsavel_pagamento = $request->input('responsavelPgto');
            $mensalidade->forma_pagamento = $request->input('forma_pagamento');
            $mensalidade->observacao = $request->input('obs');

            $mensalidade->save();

            $empresa = Empresa::all()->first();
            $aluno = Aluno::find($mensalidade->alunos_id);

            return view(self::PATH . 'mensalidadesRecibo')
                ->with('empresa', $empresa)
                ->with('mensalidade', $mensalidade)
                ->with('aluno', $aluno);

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function impressao(string $matricula)
    {

        $mensalidades = $this->mensalidade->where('matriculas_id', $matricula)->get();

        $men = $mensalidades->first();

        $alunosID = $men->alunos_id;

        $aluno = Aluno::find($alunosID);

        $confMensalidades = ConfigMensalidade::all()->first();

        $empresa = Empresa::all()->first();

        return view(self::PATH . 'mensalidadesImpressao', ['mensalidades' => $mensalidades])
                        ->with('empresa', $empresa)
                        ->with('aluno', $aluno)
                        ->with('config', $confMensalidades);
    }

    public function adicionar(string $matricula){

        $matricula = Matricula::find($matricula);
        $aluno = $matricula->alunos()->first();

        if($matricula->count() >= 1){
            return view(self::PATH.'mensalidadesCreate', ['matricula'=>$matricula, 'aluno'=>$aluno ]);
        }       

    }

    public function capaCarne(){

        $empresa = Empresa::all()->first();
        return view(self::PATH.'mensalidadesCapa', ['empresa'=>$empresa]);

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

            $resultado = ['total' => $totalAPagar, 'valorJuros' => $valorJuros, 'taxaJuros' => $juros, 'multa' => $multa];
        } else {
            $resultado = ['total' => $totalAPagar, 'valorJuros' => 0, 'taxaJuros' => 0, 'multa' => 0];
        }

        return $resultado;
    }
}
