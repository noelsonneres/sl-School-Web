<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\MateriaisEscolar;
use App\Models\Matricula;
use Illuminate\Http\Request;
use App\Models\MatriculaMaterial;
use App\Models\Mensalidade;
use App\Models\Responsavel;
use DateTime;

class MatriculaMateriaisController extends Controller
{

    const PATH = 'screens.alunos.materiais.';
    private $material;

    public function __construct()
    {
        $this->material = new MatriculaMaterial();
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

        $material = $this->material;

        $request->validate([
            'material' => 'required',
            'valorUN' => 'required',
            'qtde' => 'required',
            'total' => 'required',
            'vencimento' => 'required',
        ], [
            'material.required' => 'Selecione um material',
            'valorUN.required' => 'Digite um valor valido para o campo Valor Unit[ario',
            'qtde.required' => 'Selecione um valor valido para o campo Quantidade',
            'total.required' => 'Digite um valor valido para o campo Total',
            'vencimento.required' => 'Selecione uma data para o vencimento',
        ]);

        $matriculaID = $request->input('matricula');

        try {

            $material->alunos_id = $request->input('aluno');
            $material->matriculas_id = $request->input('matricula');
            $material->materiais_escolars_id = $request->input('material');
            $material->valor_un = $request->input('valorUN');
            $material->qtde = $request->input('qtde');
            $material->valor_total = $request->input('total');

            $material->save();

            $msg = 'Material incluido com sucesso!!!';
        } catch (\Throwable $th) {
            $msg = 'ERRO! Não foi possível incluir o material!';
            return $th;
        }

        $matricula = Matricula::find($matriculaID);
        $aluno = $matricula->alunos()->first();

        $materiais = $this->material->with('material')->where('matriculas_id', $matriculaID)
            ->orderBy('id', 'desc')->paginate();

        return view(self::PATH . 'matriculaMateriais', [
            'materiais' => $materiais,
            'matricula' => $matricula, 'aluno' => $aluno
        ])
            ->with('msg', $msg);
    }

    public function show(string $id)
    {

        $matricula = Matricula::find($id);
        $aluno = $matricula->alunos()->first();

        $materiais = $this->material->with('material')->where('matriculas_id', $id)
            ->orderBy('id', 'desc')->paginate();

        return view(self::PATH . 'matriculaMateriais', [
            'materiais' => $materiais,
            'matricula' => $matricula, 'aluno' => $aluno
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

    public function adicionar(string $matricula)
    {

        $matricula = Matricula::find($matricula);
        $aluno = $matricula->alunos()->first();

        $listaMateriais = MateriaisEscolar::all();

        if ($matricula->count() >= 1) {
            return view(self::PATH . 'matriculaMateriaisCreate', [
                'matricula' => $matricula,
                'aluno' => $aluno, 'listaMaterias' => $listaMateriais
            ]);
        } else {
            return back();
        }
    }

    public function adicionarParcela(string $matricula, string $material)
    {

        $materiais = $this->material->with('alunos')
            ->where('matriculas_id', $matricula)
            ->where('id', $material)->first();

        $alunoID = $materiais->alunos_id;

        $responsavel = Responsavel::where('alunos_id', $alunoID)->first();

        return view(self::PATH . 'matriculaMaterialParcela', ['material' => $materiais])
            ->with('responsavelID', $responsavel->id);
    }

    public function adicionarParcelas(string $matricula)
    {

        $total = 0;
        $alunoID = 0;
        $matriculaID = 0;

        $materiais = $this->material->with('alunos')
            ->where('matriculas_id', $matricula)->get();

         foreach($materiais as $material){
            $total = $total + $material->valor_total;
            $alunoID = $material->alunos_id;
            $matriculaID = $material->matriculas_id;
         }    

        $responsavel = Responsavel::where('alunos_id', $alunoID)->first();
        $alunoNome = Aluno::find($alunoID)->first()->nome;

        $dadosAluno = ['matriculaID'=>$matriculaID, 'alunoID'=>$alunoID,
                        'alunoNome'=>$alunoNome, 
                        'responsavelID'=>$responsavel->id];

        return view(self::PATH . 'matriculaMaterialParcelas', ['material' => $materiais])
            ->with('dadosAluno', $dadosAluno)
            ->with('totalMateriais', $total);

    }


    public function parcela(Request $request)
    {

        $alunoID = $request->input('aluno');
        $responsavelID = $request->input('responsavel');
        $matriculaID = $request->input('matricula');
        $qtdeParcela = $request->input('qtde');
        $valorParcela = $request->input('valorParcela');
        $vencimento = new DateTime($request->input('vencimento'));
        $obs = $request->input('obs');

        try {

            for ($i = 0; $i < $qtdeParcela; $i++) {

                $mensalidade = new Mensalidade();

                $mensalidade->responsavels_id = $responsavelID;
                $mensalidade->alunos_id = $alunoID;
                $mensalidade->matriculas_id = $matriculaID;
                $mensalidade->qtde_mensalidades = $qtdeParcela;
                $mensalidade->valor_parcela = $valorParcela;

                $dataVencimento = clone $vencimento;
                $dataVencimento->modify('+' . $i . ' months');
                $mensalidade->vencimento = $dataVencimento;

                $mensalidade->pago = 'nao';
                $mensalidade->observacao = $obs;

                $mensalidade->save();

                $msg = 'A(s) parcela(s) foram incluidas na mensalidade com sucesso!!!';

            }

        } catch (\Throwable $th) {
            $msg = 'ERRO! Não foi possível gerar as parcelas!';
        }

        $matricula = Matricula::find($matriculaID);
        $aluno = $matricula->alunos()->first();

        $materiais = $this->material->with('material')->where('matriculas_id', $matriculaID)
            ->orderBy('id', 'desc')->paginate();

        return view(self::PATH . 'matriculaMateriais', [
            'materiais' => $materiais,
            'matricula' => $matricula, 'aluno' => $aluno
        ])
            ->with('msg', $msg);
    }










    public function gerarParcelas(
        string $alunoID,
        string $responsavelID,
        string $matriculaID,
        int $qtdeParcela,
        float $valorParcela,
        DateTime $vencimento,
        string $obs = " "
    ) {

        for ($i = 0; $i < $qtdeParcela; $i++) {

            $mensalidade = new Mensalidade();

            $mensalidade->responsavels_id = $responsavelID;
            $mensalidade->alunos_id = $alunoID;
            $mensalidade->matriculas_id = $matriculaID;
            $mensalidade->qtde_mensalidades = $qtdeParcela;
            $mensalidade->valor_parcela = $valorParcela;

            $dataVencimento = clone $vencimento;
            $dataVencimento->modify('+' . $i . ' months');
            $mensalidade->vencimento = $dataVencimento;

            $mensalidade->pago = 'nao';
            $mensalidade->observacao = $obs;

            $mensalidade->save();
        }
    }
}
