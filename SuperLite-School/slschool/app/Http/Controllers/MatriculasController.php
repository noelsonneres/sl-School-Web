<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Consultor;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\ResponsavelAluno;
use DateTime;
use Illuminate\Http\Request;

class MatriculasController extends Controller
{

    const PATH = 'screens.matricula.matricula.';
    private $matricula;

    public function __construct()
    {
        $this->matricula = new Matricula();
    }

    public function index()
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        $matricula = $this->matricula;

        $request->validate([
            'curso'=>'required',
            'qtdeParcelas'=>'required',
            'valorAVista'=>'required',
            'valorComDesconto'=>'required',
            'valorParcelado'=>'required',
            'valorPorParcela'=>'required',
            'vencimento'=>'required',
            'valorMatricula'=>'required',
            'vencimetoMatricula'=>'required',
            'dataInicio'=>'required',
            'dataPrevisaoTermino'=>'required',
        ],[
            'curso.required'=>'Selecione um curso para a matrícula',
            'qtdeParcelas'=>'Informe um valor valido para o campo Quantidade de parcelas',
        ]);

        $curso = $request->old('curso');
        $qtdeParcelas = $request->old('qtdeParcelas');
        $valorAVista = $request->old('valorAVista');
        $valorComDesconto = $request->old('valorComDesconto');
        $valorParcelado = $request->old('valorParcelado');
        $valorPorParcela = $request->old('valorPorParcela');
        $vencimento = $request->old('vencimento');
        $valorMatricula = $request->old('valorMatricula');
        $vencimetoMatricula = $request->old('vencimetoMatricula');
        $dataInicio = $request->old('dataInicio');
        $dataPrevisaoTermino = $request->old('dataPrevisaoTermino');

        try {

            $matricula->empresas_id = auth()->user()->empresas_id;
            $matricula->alunos_id = $request->input('aluno');
            $matricula->responsavel_alunos_id = $request->input('responsavel');
            $matricula->cursos_id = $request->input('curso');
            $matricula->qtde_parcelas = $request->input('qtdeParcelas');
            $matricula->valor_a_vista = $request->input('valorAVista');
            $matricula->valor_com_desconto = $request->input('valorComDesconto');
            $matricula->valor_parcelado = $request->input('valorParcelado');
            $matricula->valor_por_parcela = $request->input('valorPorParcela');
            $matricula->vencimento = $request->input('vencimento');
            $matricula->valor_matricula = $request->input('valorMatricula');
            $matricula->vencimento_matricula = $request->input('vencimetoMatricula');
            $matricula->data_inicio = $request->input('dataInicio');
            $matricula->previsao_termino = $request->input('dataPrevisaoTermino');
            // $matricula->data_conclusao
            $matricula->qtde_dias = $request->input('qtdeDias');
            $matricula->horas_semana = $request->input('horasSemana');
            $matricula->consultores_id = $request->input('consultor');
            $matricula->ativo = 'sim';
            $matricula->funcionario = auth()->user()->empresas_id;
            $matricula->obs = $request->input('obs');
            $matricula->deletado = 'nao';
            $matricula->auditoria = $this->operacao('Matrículou o aluno');

            $id = $request->input('aluno');

            $matricula->save();

            $matricula = $this->matricula->where('alunos_id', $id)->paginate();
            $aluno = Aluno::find($id);
            $responsavel = ResponsavelAluno::where('alunos_id', $id)->first();
            return view(self::PATH . 'matriculaShow', ['matriculas' => $matricula, 'aluno' => $aluno, 'responsavel' => $responsavel])
                            ->with('msg', 'Matrícula realizada com sucesso!');
                        
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações da Matrícula: ' . $th->getMessage()]);
        }


    }

    public function show(string $id)
    {
        $matricula = $this->matricula->where('alunos_id', $id)->paginate();
        $aluno = Aluno::find($id);
        $responsavel = ResponsavelAluno::where('alunos_id', $id)->first();
        return view(self::PATH . 'matriculaShow', ['matriculas' => $matricula, 'aluno' => $aluno, 'responsavel' => $responsavel]);
    }

    public function edit(string $id)
    {

        $matricula = $this->matricula->find($id);

        $listaCursos = Curso::all();
        $listaConsultores = Consultor::all();
        return view(self::PATH . 'matriculaEdit', [
            'matricula'=>$matricula,
            'listaCursos' => $listaCursos,
            'listaconsultores' => $listaConsultores
        ]);

    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function novaMatricula(string $alunoID, string $responsavelID)
    {
        $aluno = Aluno::find($alunoID);
        $listaCursos = Curso::all();
        $listaConsultores = Consultor::all();
        return view(self::PATH . 'matriculaCreate', [
            'aluno' => $aluno,
            'responsavelID' => $responsavelID,
            'listaCursos' => $listaCursos,
            'listaconsultores' => $listaConsultores
        ]);
    }

    private function matriculasDisciplinas(string $curso)
    {
    }

    private function matriculasMensalidades()
    {
    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }    

}
