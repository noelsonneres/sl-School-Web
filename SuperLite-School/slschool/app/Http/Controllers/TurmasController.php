<?php

namespace App\Http\Controllers;

use App\Models\DiasAula;
use App\Models\HorariosAula;
use App\Models\Professor;
use App\Models\SalaAula;
use App\Models\Turma;
use DateTime;
use Illuminate\Http\Request;

class TurmasController extends Controller
{

    const PATH = 'screens.turma.';
    private $turma;

    public function __construct()
    {
        $this->turma = new Turma();
    }

    public function index()
    {
        $turmas = $this->turma
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();
        return view(self::PATH . 'turmaShow', ['turmas' => $turmas]);
    }

    public function create()
    {

        $listaDias = DiasAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaHorarios = HorariosAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaSala = SalaAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaProfessor = Professor::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')->get();

        return view(self::PATH . 'turmaCreate', [
            'listaDias' => $listaDias,
            'listaHorarios' => $listaHorarios,
            'listaSala' => $listaSala,
            'listaProfessores' => $listaProfessor
        ]);
    }

    public function store(Request $request)
    {

        $turmas = $this->turma;

        $request->validate([
            'turma' => 'required|min:3|max:50',
            'dias' => 'required',
            'horario' => 'required',
            'sala' => 'required',
            'turno' => 'required',
            'ativa' => 'required',
        ], [
            'turma.required' => 'O campo Turma é obrigatório',
            'turma.min' => 'O campo turma deve ter mais de três caracteres',
            'turma.max' => 'O campo turma deve menos de 50 caracteres',
            'dias.required' => 'O campo Dias de aulas é obrigatório',
            'horario.required' => 'O campo Horários de aulas é obrigatório',
            'sala.required' => 'O campo Sala é obrigatório',
            'turno.required' => 'Selecione uma opção no campo Turno',
            'ativa.required' => 'Selecione uma opção para o campo Ativa',
        ]);

        $turma = $request->input('turma');
        $dias = $request->input('dias');
        $horario = $request->input('horario');
        $sala = $request->input('sala');
        $turno = $request->input('turno');
        $ativa = $request->input('ativa');

        try {

            $turmas->empresas_id = auth()->user()->empresas_id;
            $turmas->turma = $request->input('turma');
            $turmas->descricao = $request->input('descricao');
            $turmas->dias_aulas_id = $request->input('dias');
            $turmas->horarios_aulas_id = $request->input('horario');
            $turmas->sala_aulas_id = $request->input('sala');
            $turmas->professors_id = $request->input('professor');
            $turmas->turno = $request->input('turno');
            $turmas->ativa = $request->input('ativa');
            $turmas->obs = $request->input('obs');
            $turmas->deletado = 'nao';
            $turmas->auditoria = $this->operacao('Cadastro da Turma');

            $turmas->save();

            $turmas = $this->turma
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();
            return view(self::PATH . 'turmaShow', ['turmas' => $turmas])
                ->with('msg', 'Sucesso! Turma inserida com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações da turma: ' . $th->getMessage()]);
        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $turma = $this->turma->find($id);

        $listaDias = DiasAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaHorarios = HorariosAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaSala = SalaAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaProfessor = Professor::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')->get();

        return view(self::PATH . 'turmaEdit', [
            'turma' => $turma,
            'listaDias' => $listaDias,
            'listaHorarios' => $listaHorarios,
            'listaSala' => $listaSala,
            'listaProfessores' => $listaProfessor
        ]);
    }

    public function update(Request $request, string $id)
    {
        $turmas = $this->turma->find($id);

        $request->validate([
            'turma' => 'required|min:3|max:50',
            'dias' => 'required',
            'horario' => 'required',
            'sala' => 'required',
            'turno' => 'required',
            'ativa' => 'required',
        ], [
            'turma.required' => 'O campo Turma é obrigatório',
            'turma.min' => 'O campo turma deve ter mais de três caracteres',
            'turma.max' => 'O campo turma deve menos de 50 caracteres',
            'dias.required' => 'O campo Dias de aulas é obrigatório',
            'horario.required' => 'O campo Horários de aulas é obrigatório',
            'sala.required' => 'O campo Sala é obrigatório',
            'turno.required' => 'Selecione uma opção no campo Turno',
            'ativa.required' => 'Selecione uma opção para o campo Ativa',
        ]);

        $turma = $request->input('turma');
        $dias = $request->input('dias');
        $horario = $request->input('horario');
        $sala = $request->input('sala');
        $turno = $request->input('turno');
        $ativa = $request->input('ativa');

        try {

            $turmas->turma = $request->input('turma');
            $turmas->descricao = $request->input('descricao');
            $turmas->dias_aulas_id = $request->input('dias');
            $turmas->horarios_aulas_id = $request->input('horario');
            $turmas->sala_aulas_id = $request->input('sala');
            $turmas->professors_id = $request->input('professor');
            $turmas->turno = $request->input('turno');
            $turmas->ativa = $request->input('ativa');
            $turmas->obs = $request->input('obs');
            $turmas->deletado = 'nao';
            $turmas->auditoria = $this->operacao('Atualizar informações da turma');

            $turmas->save();

            $turmas = $this->turma
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();
            return view(self::PATH . 'turmaShow', ['turmas' => $turmas])
                ->with('msg', 'Sucesso! Informações da turma atualizadas com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar as informações da turma: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $turma = $this->turma->find($id);

        if ($turma->count() >= 1) {

            try {

                $turma->deletado = 'sim';
                $turma->auditoria = $this->operacao('Excluiu as informações da turma');
                $turma->save();
                $turmas = $this->turma
                    ->where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->orderBy('id', 'desc')
                    ->paginate();
                return view(self::PATH . 'turmaShow', ['turmas' => $turmas])
                    ->with('msg', 'Sucesso! As informações da turma foram excluidas com sucesso!');

            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível excluir as informações da turma: ' . $th->getMessage()]);
            }

        } else {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível localizar a turma!']);
        }
    }

    private function operacao(string $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
