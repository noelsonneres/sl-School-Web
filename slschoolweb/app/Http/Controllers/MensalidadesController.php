<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\ConfigMensalidade;
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
        $responsavel = Responsavel::where('alunos_id', $aluno->id)->first();

        $formaPagamento = MeiosPagamento::all();

        $vencimento = new DateTime($mensalidade->vencimento);

        $juros = $this->calcularJuros($mensalidade->valor_parcela, $vencimento);

        return view(self::PATH . 'mensalidadesPagamento', ['mensalidade' => $mensalidade])
            ->with('matricula', $matricula)
            ->with('aluno', $aluno)
            ->with('juros', $juros)
            ->with('formas_pagamentos', $formaPagamento)
            ->with('responsavel', $responsavel);
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

            // $pdf = PDF::loadView(self::PATH.'mensalidadesRecibo', 
            //         ['mensalidade' => $mensalidade, 'empresa' => $empresa, 'aluno' => $aluno]);

            // return $pdf->download('recibo.pdf');

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
