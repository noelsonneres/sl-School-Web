<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Consultor;
use App\Models\Curso;
use App\Models\Responsavel;

class MatriculasController extends Controller
{

    const PATH = 'screens.alunos.matricula.';
    public $matricula;

    public function __construct()
    {
        $this->matricula = new Matricula();
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

    public function store(Request $request)
    {

        $matricula = $this->matricula;

        $alunoID = $request->input('aluno');

        $request->validate([
            'aluno' => 'required',
            'curso' => 'required',
            'qtdeParcelas' => 'required',
            'valorAVista' => 'required',
            'valorComDesconto' => 'required',
            'valorParcelado' => 'required',
            'valorPorParcela' => 'required',
            'vencimento' => 'required',
            'dataInicio' => 'required',
            'dataTermino' => 'required',
            'qtdeDias' => 'required',
            'qtdeHoras' => 'required',
            'ativo' => 'required',
        ], [
            'aluno.required' => 'Voce deve selecionar um aluno antes de inserir a matrícula',
            'curso.required' => 'Selecione um curso antes de inserir a matriculas',
            'qtdeParcelas.required' => 'Informe uma quantidade de parcelas validas',
            'valorComDesconto.required' => 'Informe um valor valido para o campo Valor com Desconto',
            'valorParcelado.required' => 'Informe um valor valido para o campo Valor Parcelado',
            'vencimento.required' => 'Informe o vencimento das parcelas',
            'dataInicio.required' => 'Informe a data de início do curso',
            'dataTermino.required' => 'Informe a data de término do curso',
            'qtdeDias.required' => 'Informe a quantidade de dias',
            'qtdeHoras.required' => 'Informe o total de horas',
            'ativo.required' => 'Selecione uma opção para o campo Ativo',
            'valorAVista.required' => 'Informe o valor a vista',
        ]);

        try {

            $matricula->alunos_id = $request->input('aluno');
            $matricula->responsavels_id = $request->input('responsavel');
            $matricula->cursos_id = $request->input('curso');
            $matricula->qtde_parcela = $request->input('qtdeParcelas');
            $matricula->valor_a_vista = $request->input('valorAVista');
            $matricula->valor_com_desconto = $request->input('valorComDesconto');
            $matricula->valor_parcelado = $request->input('valorParcelado');
            $matricula->valor_por_parcela = $request->input('valorPorParcela');
            $matricula->vencimento = $request->input('vencimento');
            $matricula->valor_matricula = $request->input('valorMatricula');
            $matricula->vencimento_matricula = $request->input('vencimentoMatricula');
            $matricula->data_inicio = $request->input('dataInicio');
            $matricula->data_termino = $request->input('dataTermino');
            $matricula->qtde_dias = $request->input('qtdeDias');
            $matricula->horas_semana = $request->input('qtdeHoras');
            $matricula->consultors_id = $request->input('consultor');
            $matricula->status = 'sim';
            $matricula->obs = $request->input('obs');
            $matricula->deletado = 'nao';

            $matricula->save();

            $aluno = Aluno::find($alunoID);
            $responsavel = Responsavel::where('alunos_id', $alunoID);

            // $matricula = $this->matricula->where('alunos_id', $alunoID);

            return view(self::PATH . 'matriculaHome')
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel)
                ->with('matricula', $matricula)
                ->with('msg', 'Matrícula realizada com sucesso!!!');
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function show(string $id)
    {

        //Recebe o codigo de matrícula do aluno
        $matricula = $this->matricula->find($id);

        $alunoID = $matricula->alunos_id;

        $aluno = Aluno::find($alunoID);
        $responsavel = Responsavel::where('alunos_id', $alunoID);

        if ($matricula->count() >= 1) {

            return view(self::PATH . 'matriculaHome', ['matricula' => $matricula])
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel);
        } else {
            return back();
        }
    }


    public function edit(string $id)
    {

        $matricula = $this->matricula->with('cursos')->find($id);
        $listaCursos = Curso::all();
        $listaConsultores = Consultor::all();



        if ($matricula->count() >= 1) {

            $aluno = $matricula->alunos()->first();
            $alunoID = $aluno->id;
            $consultorID = $matricula->consultors_id;
            $nomeConsultor = Consultor::find($consultorID);
            $responsavel = Responsavel::where('alunos_id', $alunoID)->first();

            return view(self::PATH . 'matriculaEdit', ['matricula' => $matricula])
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel)
                ->with('cursos', $listaCursos)
                ->with('consultores', $listaConsultores)
                ->with('cons', $nomeConsultor);
        }
    }

    public function update(Request $request, string $id)
    {

        $matricula = $this->matricula->find($id);

        if ($matricula->count() >= 1) {


            $alunoID = $request->input('aluno');

            $request->validate([
                'aluno' => 'required',
                'curso' => 'required',
                'qtdeParcelas' => 'required',
                'valorAVista' => 'required',
                'valorComDesconto' => 'required',
                'valorParcelado' => 'required',
                'valorPorParcela' => 'required',
                'vencimento' => 'required',
                'dataInicio' => 'required',
                'dataTermino' => 'required',
                'qtdeDias' => 'required',
                'qtdeHoras' => 'required',
                'ativo' => 'required',
            ], [
                'aluno.required' => 'Voce deve selecionar um aluno antes de inserir a matrícula',
                'curso.required' => 'Selecione um curso antes de inserir a matriculas',
                'qtdeParcelas.required' => 'Informe uma quantidade de parcelas validas',
                'valorComDesconto.required' => 'Informe um valor valido para o campo Valor com Desconto',
                'valorParcelado.required' => 'Informe um valor valido para o campo Valor Parcelado',
                'vencimento.required' => 'Informe o vencimento das parcelas',
                'dataInicio.required' => 'Informe a data de início do curso',
                'dataTermino.required' => 'Informe a data de término do curso',
                'qtdeDias.required' => 'Informe a quantidade de dias',
                'qtdeHoras.required' => 'Informe o total de horas',
                'ativo.required' => 'Selecione uma opção para o campo Ativo',
                'valorAVista.required' => 'Informe o valor a vista',
            ]);

            try {

                $matricula->alunos_id = $request->input('aluno');
                $matricula->responsavels_id = $request->input('responsavel');
                $matricula->cursos_id = $request->input('curso');
                $matricula->qtde_parcela = $request->input('qtdeParcelas');
                $matricula->valor_a_vista = $request->input('valorAVista');
                $matricula->valor_com_desconto = $request->input('valorComDesconto');
                $matricula->valor_parcelado = $request->input('valorParcelado');
                $matricula->valor_por_parcela = $request->input('valorPorParcela');
                $matricula->vencimento = $request->input('vencimento');
                $matricula->valor_matricula = $request->input('valorMatricula');
                $matricula->vencimento_matricula = $request->input('vencimentoMatricula');
                $matricula->data_inicio = $request->input('dataInicio');
                $matricula->data_termino = $request->input('dataTermino');
                $matricula->qtde_dias = $request->input('qtdeDias');
                $matricula->horas_semana = $request->input('qtdeHoras');
                $matricula->consultors_id = $request->input('consultor');
                $matricula->status = 'sim';
                $matricula->obs = $request->input('obs');
                $matricula->deletado = 'nao';

                $matricula->save();

                $aluno = Aluno::find($alunoID);
                $responsavel = Responsavel::where('alunos_id', $alunoID);

                // $matricula = $this->matricula->where('alunos_id', $alunoID);

                return view(self::PATH . 'matriculaHome')
                    ->with('aluno', $aluno)
                    ->with('responsavel', $responsavel)
                    ->with('matricula', $matricula)
                    ->with('msg', 'Informações da matrícula atualizadas com sucesso!!!');
            } catch (\Throwable $th) {
                return $th;
            }
        } else {
            return back();
        }
    }

    public function destroy(string $id)
    {

        $matricula = $this->matricula->find($id);

        $idAluno = $matricula->alunos_id;

        if ($matricula->count() >= 1) {
            $matricula->delete();

            $aluno = Aluno::find($idAluno);
            $responsavel = Responsavel::where('alunos_id', $idAluno);

            $matricula = $this->matricula->with('cursos')->where('alunos_id', $idAluno)->paginate();

            return view(self::PATH . 'matriculaShow', ['matriculas' => $matricula])
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel->first())
                ->with('msg', 'Matrícula deletada com sucesso!!!');
        } else {
            return back()->with('msg', 'ERRO! Não foi possivel excluir a matrícula!');
        }
    }

    //PROCESSO PARA REDIRECIONAR DEPENDENDO DA QUANTIDADE DE MATRÍCULAS DO ALUNO

    public function homeMatricula(string $idAluno)
    {

        $aluno = Aluno::find($idAluno);
        $responsavel = Responsavel::where('alunos_id', $idAluno);
        $matricula = $this->matricula->where('alunos_id', $idAluno);

        if ($matricula->count() > 1) {

            $matricula = $this->matricula->with('cursos')->where('alunos_id', $idAluno)->paginate();

            return view(self::PATH . 'matriculaShow', ['matriculas' => $matricula])
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel->first());
        } else if ($matricula->count() == 1) { //Redireciona para a Home Matrículas

            return view(self::PATH . 'matriculaHome')
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel)
                ->with('matricula', $matricula->first());
        } else {

            $listaCursos = Curso::all();
            $listaConsultores = Consultor::all();

            return view(self::PATH . 'matriculaCreate')
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel->first())
                ->with('cursos', $listaCursos)
                ->with('consultores', $listaConsultores);
        }
    }

    public function adicionar(string $idAluno)
    {

        $responsavel = Responsavel::where('alunos_id', $idAluno);
        $aluno = Aluno::find($idAluno);

        $listaCursos = Curso::all();
        $listaConsultores = Consultor::all();

        return view(self::PATH . 'matriculaCreate')
            ->with('aluno', $aluno)
            ->with('responsavel', $responsavel->first())
            ->with('cursos', $listaCursos)
            ->with('consultores', $listaConsultores);
    }
}
