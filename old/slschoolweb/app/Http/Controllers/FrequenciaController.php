<?php

namespace App\Http\Controllers;

use App\Models\CursosDisciplina;
use App\Models\Disciplina;
use App\Models\Frequencia;
use App\Models\Matricula;
use App\Models\MatriculaDisciplina;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrequenciaController extends Controller
{

    const PATH = 'screens.frequencia.';
    private $frequencia;

    public function __construct()
    {
        $this->frequencia = new Frequencia();
    }

    public function index()
    {

        $matriculas = Matricula::orderBy('id', 'desc')->where('status', 'ativa')->paginate();
        return view(self::PATH.'localizarMatricula', ['matriculas'=>$matriculas]);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $frequencia = $this->frequencia;

        $request->validate([
            'disciplina' => 'required',
            'dataLancamento' => 'required',
            'horaLancamento' => 'required',
            'situacao' => 'required',
            'horaPresenca' => 'required',
            'dataPresenca' => 'required',
        ],
            [
                'disciplina.required' => 'Selecione uma disciplina',
                'dataLancamento.required' => 'Informe uma data de lançamento valida',
                'horaLancamento.required' => 'Informe um horário de lançamento valido',
                'situacao.required' => 'Selecione uma situação',
                'dataPresenca.required' => 'Informe uma data de presença',
                'horaPresenca.required' => 'Informe um horário de presença',
            ]);

        $disciplina = $request->old('disciplina');
        $dataLancamento = $request->old('dataLancamento');
        $horaLancamento = $request->old('horaLancamento');
        $situacao = $request->old('situacao');
        $dataPresenca = $request->old('dataPresenca');
        $horaPresenca = $request->old('horaPresenca');

        $matriculaID = $request->input('matricula');

        $msg = "";

        try {

            $frequencia->alunos_id = $request->input('aluno');
            $frequencia->matriculas_id = $request->input('matricula');
            $frequencia->disciplina_id = $request->input('disciplina');
            $frequencia->data_lancamento = $request->input('dataLancamento');
            $frequencia->hora_lancamento = $request->input('horaLancamento');
            $frequencia->situacao = $request->input('situacao');
            $frequencia->justificativa = $request->input('justificativa');
            $frequencia->conteudo = $request->input('conteudo');
            $frequencia->data_presenca = $request->input('dataPresenca');
            $frequencia->hora_presenca = $request->input('horaPresenca');
            $frequencia->observacao = $request->input('obs');

            $frequencia->save();

            $matricula = Matricula::find($matriculaID);

            $msg = "Frequência do aluno lançada com sucesso";

        } catch (\Throwable $th) {

            $msg = 'Não foi possível lançar a frequência do aluno: ' . $th->getMessage();

        }

        $frequencia = $this->frequencia->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();
        $matricula = Matricula::find($matriculaID);
        return view(self::PATH . 'frequenciaShow', ['frequencias' => $frequencia, 'matricula' => $matricula])
            ->with('msg', $msg);

    }

    public function show(string $id)
    {

        if ($this->verificarAcesso() == 1){
            $frequencia = $this->frequencia->where('matriculas_id', $id)->orderBy('id', 'desc')->paginate();
            $matricula = Matricula::find($id);
            return view(self::PATH . 'frequenciaShow', ['frequencias' => $frequencia, 'matricula' => $matricula]);
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function edit(string $id)
    {
        $frequencia = $this->frequencia->with('disciplinas')->find($id);

        $matriculaID = $frequencia->matriculas_id;

        $listaDisciplina = MatriculaDisciplina::where('matriculas_id', $matriculaID)->get();

        $matriculas = Matricula::find($matriculaID);

        if ($frequencia->count() >= 1) {
            return view(self::PATH . 'frequenciaEdit', ['frequencia' => $frequencia,
                'matricula' => $matriculas, 'listaDisciplinas' => $listaDisciplina]);
        } else {
            return back();
        }

    }

    public function update(Request $request, string $id)
    {
        $frequencia = $this->frequencia->find($id);

        $request->validate([
            'disciplina' => 'required',
            'dataLancamento' => 'required',
            'horaLancamento' => 'required',
            'situacao' => 'required',
            'horaPresenca' => 'required',
            'dataPresenca' => 'required',
        ],
            [
                'disciplina.required' => 'Selecione uma disciplina',
                'dataLancamento.required' => 'Informe uma data de lançamento valida',
                'horaLancamento.required' => 'Informe um horário de lançamento valido',
                'situacao.required' => 'Selecione uma situação',
                'dataPresenca.required' => 'Informe uma data de presença',
                'horaPresenca.required' => 'Informe um horário de presença',
            ]);

        $disciplina = $request->old('disciplina');
        $dataLancamento = $request->old('dataLancamento');
        $horaLancamento = $request->old('horaLancamento');
        $situacao = $request->old('situacao');
        $dataPresenca = $request->old('dataPresenca');
        $horaPresenca = $request->old('horaPresenca');

        $matriculaID = $request->input('matricula');

        try {

            $frequencia->disciplina_id = $request->input('disciplina');
            $frequencia->data_lancamento = $request->input('dataLancamento');
            $frequencia->hora_lancamento = $request->input('horaLancamento');
            $frequencia->situacao = $request->input('situacao');
            $frequencia->justificativa = $request->input('justificativa');
            $frequencia->conteudo = $request->input('conteudo');
            $frequencia->data_presenca = $request->input('dataPresenca');
            $frequencia->hora_presenca = $request->input('horaPresenca');
            $frequencia->observacao = $request->input('obs');

            $frequencia->save();

            $frequencia = $this->frequencia->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

            $matricula = Matricula::find($matriculaID);

            return view(self::PATH . 'frequenciaShow', ['frequencias' => $frequencia, 'matricula' => $matricula])
                ->with('msg', 'AS informções da frequência foram atualizadas com sucesso!');

        } catch (\Throwable $th) {

            $frequencia = $this->frequencia->where('matriculas_id', $matriculaID)->paginate();

            $matricula = Matricula::find($matriculaID);

            return view(self::PATH . 'frequenciaShow', ['frequencias' => $frequencia, 'matricula' => $matricula])
                ->with('msg', 'Não foi possível atualizar as informções da frequência: ' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {

        $frequencia = $this->frequencia->find($id);

        $matriculaID = $frequencia->matriculas_id;

        $msg = '';

        try {

            $frequencia->delete();
            $msg = 'Frequência excluida com sucesso!';

        }catch (\Throwable $th){
            $msg = 'ERRO! Não foi possível remover a presença do aluno';
        }

        $frequencia = $this->frequencia->where('matriculas_id', $matriculaID)->paginate();

        $matricula = Matricula::find($matriculaID);

        return view(self::PATH . 'frequenciaShow', ['frequencias' => $frequencia, 'matricula' => $matricula])
            ->with('msg', $msg);

    }

    public function adicionar(string $matricula)
    {

        $listaDisciplina = MatriculaDisciplina::where('matriculas_id', $matricula)->get();

        $matriculas = Matricula::find($matricula);

        if ($matriculas->count() >= 1) {
            return view(self::PATH . 'frequenciaCreate', ['matricula' => $matriculas, 'listaDisciplinas' => $listaDisciplina]);
        } else {
            return back();
        }
    }

    public function localizarFrequencias(Request $request)
    {
        $inicio = Carbon::parse($request->input('inicio'));
        $fim = Carbon::parse($request->input('fim'));
        $matriculaID = $request->input('matricula');

        $frequencia = $this->frequencia->whereBetween('data_presenca', [$inicio, $fim])
                    ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

        $matricula = Matricula::find($matriculaID);

        return view(self::PATH . 'frequenciaShow', ['frequencias' => $frequencia, 'matricula' => $matricula]);

    }

    public function selecionarMatricula(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        $matriculas = Matricula::where($field, 'LIKE', $value . '%')->orderBy('id', 'desc')->paginate(15);
        return view(self::PATH.'localizarMatricula', ['matriculas'=>$matriculas]);

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Frequencia do aluno')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
