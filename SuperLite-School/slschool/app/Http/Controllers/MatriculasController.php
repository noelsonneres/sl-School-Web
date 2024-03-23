<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Consultor;
use App\Models\Curso;
use App\Models\CursosDisciplina;
use App\Models\Matricula;
use App\Models\MatriculaDisciplina;
use App\Models\MatriculaTurma;
use App\Models\Mensalidade;
use App\Models\ResponsavelAluno;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $matriculas = $this->matricula
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();
        return view('screens.matricula.dashboard.listarMatriculas', ['matriculas' => $matriculas]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $matricula = $this->matricula;

        $request->validate([
            'curso' => 'required',
            'qtdeParcelas' => 'required',
            'valorAVista' => 'required',
            'valorComDesconto' => 'required',
            'valorParcelado' => 'required',
            'valorPorParcela' => 'required',
            'vencimento' => 'required',
            'valorMatricula' => 'required',
            'vencimetoMatricula' => 'required',
            'dataInicio' => 'required',
            'dataPrevisaoTermino' => 'required',
        ], [
            'curso.required' => 'Selecione um curso para a matrícula',
            'qtdeParcelas' => 'Informe um valor valido para o campo Quantidade de parcelas',
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

            $vencimento = new DateTime($request->input('vencimento'));
            $vencimentoMatricula = new DateTime($request->input('vencimetoMatricula'));
            $responsavelID = $request->input('responsavel') ?? 0;

            $this->matriculasDisciplinas(
                $request->input('curso'),
                $request->input('aluno'),
                $matricula->id
            );

            if (!empty($request->input('valorMatricula')) && !empty($request->input('vencimetoMatricula'))) {
                $this->matriculasMensalidades(
                    $request->input('aluno'),
                    $responsavelID,
                    $matricula->id,
                    $matricula->valor_matricula,
                    '1',
                    $vencimentoMatricula,
                    'Mensalidade referente à matrícula do aluno'
                );
            }

            $this->matriculasMensalidades(
                $request->input('aluno'),
                $responsavelID,
                $matricula->id,
                $matricula->valor_por_parcela,
                $matricula->qtde_parcelas,
                $vencimento
            );

            $matricula = $this->matricula
                ->where('alunos_id', $id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();
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
        $matricula = $this->matricula
            ->where('alunos_id', $id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();

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
            'matricula' => $matricula,
            'listaCursos' => $listaCursos,
            'listaconsultores' => $listaConsultores
        ]);
    }

    public function update(Request $request, string $id)
    {

        // CRIAR UM PROCESSO PARA ALTERAR OS CURSOS E MENSALIDADES AO TROCAR DE CURSO

        $matricula = $this->matricula->find($id);

        $request->validate([
            'curso' => 'required',
            'qtdeParcelas' => 'required',
            'valorAVista' => 'required',
            'valorComDesconto' => 'required',
            'valorParcelado' => 'required',
            'valorPorParcela' => 'required',
            'vencimento' => 'required',
            'valorMatricula' => 'required',
            'vencimetoMatricula' => 'required',
            'dataInicio' => 'required',
            'dataPrevisaoTermino' => 'required',
        ], [
            'curso.required' => 'Selecione um curso para a matrícula',
            'qtdeParcelas' => 'Informe um valor valido para o campo Quantidade de parcelas',
        ]);


        try {

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
            $matricula->auditoria = $this->operacao('Atualizou as informações da matrícula');

            $id = $request->input('aluno');

            $matricula->save();

            $matricula = $this->matricula
                ->where('alunos_id', $id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();

            $aluno = Aluno::find($id);
            $responsavel = ResponsavelAluno::where('alunos_id', $id)->first();
            return view(self::PATH . 'matriculaShow', ['matriculas' => $matricula, 'aluno' => $aluno, 'responsavel' => $responsavel])
                ->with('msg', 'Sucessso! As informações da matrícula foram atualizadas com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar as informações da Matrícula: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {

        $matricula = $this->matricula->find($id);

        if ($matricula->count() >= 1) {

            try {

                $matricula->ativo = 'nao';
                $matricula->deletado = 'sim';
                $matricula->auditoria = $this->operacao('Exclusão das informações da matrícula');

                $matricula->save();

                $alunoID = $matricula->alunos_id;
                $matriculaID = $matricula->id;

                $matricula = $this->matricula
                    ->where('deletado', 'nao')
                    ->orderBy('id', 'desc')
                    ->paginate();

                $this->removerTurmas($matriculaID);

                $aluno = Aluno::find($alunoID);
                $responsavel = ResponsavelAluno::where('alunos_id', $alunoID)->first();
                return view(self::PATH . 'matriculaShow', ['matriculas' => $matricula, 'aluno' => $aluno, 'responsavel' => $responsavel])
                    ->with('msg', 'Sucesso! Matrícula deletada com sucesso!');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível excluir as informações da Matrícula: ' . $th->getMessage()]);
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível localizar as informações da Matrícula!']);
        }
    }

    public function novaMatricula(string $alunoID)
    {

        $aluno = Aluno::find($alunoID);
        $responsavel = ResponsavelAluno::where('alunos_id', $alunoID)->first();

        $responsavelID = $responsavel->id ?? null;

        $listaCursos = Curso::all();
        $listaConsultores = Consultor::all();
        return view(self::PATH . 'matriculaCreate', [
            'aluno' => $aluno,
            'responsavelID' => $responsavelID,
            'listaCursos' => $listaCursos,
            'listaconsultores' => $listaConsultores
        ]);
    }

    public function search(Request $request)
    {

        $request->validate([
            'criterio' => 'required',
            'pesquisa' => 'required',
        ], [
            'criterio.required' => 'Selecione um criterio de pesquisa',
            'pesquisa.required' => 'Digite o que deseja pesquisar',
        ]);

        $criterio = $request->input('criterio') ?? 'id';
        $pesquisa = $request->input('pesquisa');

        if ($criterio == 'nome') {
            $aluno = Aluno::where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->where('nome', 'LIKE', '%' . $pesquisa . '%')
                ->first();
            $criterio = 'alunos_id';
            $pesquisa = $aluno->id;
        } else if ($criterio == 'cpf') {
            $aluno = Aluno::where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->where('cpf', 'LIKE', '%' . $pesquisa . '%')
                ->first();
            $criterio = 'alunos_id';
            $pesquisa = $aluno->id;
        }

        $matricula = $this->matricula->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->paginate();
        return view('screens.matricula.dashboard.listarMatriculas', [
            'matriculas' => $matricula,
            'inputs' => $request->all()
        ]);
    }

    private function matriculasDisciplinas(string $curso, string $aluno, string $matricula)
    {

        $listaDisciplinas = CursosDisciplina::where('cursos_id', $curso)->get();

        foreach ($listaDisciplinas as $lista) {

            $matriculaDisciplinas = new MatriculaDisciplina();

            try {

                $matriculaDisciplinas->empresas_id = auth()->user()->empresas_id;
                $matriculaDisciplinas->matriculas_id = $matricula;
                $matriculaDisciplinas->alunos_id = $aluno;
                $matriculaDisciplinas->cursos_id = $curso;
                $matriculaDisciplinas->disciplinas_id = $lista->disciplinas_id;
                $matriculaDisciplinas->concluido = 'nao';
                $matriculaDisciplinas->obs = '';

                $matriculaDisciplinas->save();
            } catch (\Throwable $th) {
                return "ERRO! Não foi possível adicionar as disciplinas à matrícula!";
            }
        }
    }

    private function matriculasMensalidades(
        string $alunoID,
        string $responsavelID,
        string $matriculaID,
        string $valor,
        string $qtde,
        DateTime $vencimento,
        string $obs = ""
    ) {

        $dataVencimento = $vencimento;

        for ($i = 0; $i < $qtde; $i++) {

            $mensalidade = new Mensalidade();

            if ($responsavelID != 0) {
                $mensalidade->responsavel_alunos_id = $responsavelID;
            }

            $mensalidade->empresas_id = auth()->user()->empresas_id;
            $mensalidade->alunos_id = $alunoID;
            $mensalidade->matriculas_id = $matriculaID;
            $mensalidade->valor_parcela = $valor;
            $mensalidade->numero_mensalidade = $i + 1;
            $mensalidade->qtde_mensalidade = $qtde;
            $mensalidade->vencimento = $dataVencimento;
            $mensalidade->obs = $obs;
            $mensalidade->auditoria = $this->operacao('Inclusão de mensalidades');

            $mensalidade->save();

            $dataVencimento->modify('+' . 1 . 'months');
        }
    }

    private function removerTurmas(string $matriculaID)
    {
        $matriculaTurma = MatriculaTurma::where('matriculas_id', $matriculaID)->get();
        $matriculaTurma->each->delete();
    }

    private function operacao(string $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' Opereação: ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
