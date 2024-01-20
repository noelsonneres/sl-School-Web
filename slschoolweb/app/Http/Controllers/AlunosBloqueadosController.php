<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\AlunoBloqueado;
use App\Models\Matricula;
use App\Models\Responsavel;
use Illuminate\Http\Request;

class AlunosBloqueadosController extends Controller
{

    const PATH = 'screens.alunos.bloqueados.';
    private $bloqueados;

    public function __construct()
    {
        $this->bloqueados = new AlunoBloqueado();
    }

    public function index()
    {

        $bloqueados = $this->bloqueados->paginate();
        return view(self::PATH . 'alunosBloqueadosShow', ['bloqueados' => $bloqueados]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $bloqueados = $this->bloqueados;

        $request->validate(
            [
                'data' => 'required',
                'hora' => 'required',
                'motivo' => 'required|min:3|max:50',
            ],
            [
                'data.required' => 'Informe uma data valida',
                'hora.required' => 'Informe um horário valido',
                'motivo.required' => 'informe o motivo do bloqueio',
                'motivo.min' => 'O motivo do bloqueio deve ter no minímo três caracteres',
                'motivo.max' => 'O motivo do bloqueio deve ter no máximo 50 caracteres',
            ]
        );

        $data = $request->old('data');
        $hora = $request->old('hora');
        $motivo = $request->old('motivo');
        $msg = '';

        try {

            $bloqueados->alunos_id = $request->input('codigoAluno');
            $bloqueados->data = $request->input('data');
            $bloqueados->hora = $request->input('hora');
            $bloqueados->motivo = $request->input('motivo');
            $bloqueados->status = 'bloqueado';
            $bloqueados->obs = $request->input('obs');

            $bloqueados->save();            

            $this->atualizarStatusMatricula($request->input('matricula'));
            $this->atualizarStatusAluno($request->input('codigoAluno'));

            $msg = 'SUCESSO! Aluno bloqueado com sucesso!';

        } catch (\Throwable $th) {
            $msg = 'ERRO! Não foi possível atualizar as informações do aluno: ' . $th->getMessage();
        }

        $matricula = Matricula::find($request->input('matricula'));
        $alunoID = $matricula->alunos_id;
        $aluno = Aluno::find($alunoID);
        $responsavel = Responsavel::where('alunos_id', $alunoID);

        return view('screens.alunos.matricula.matriculaHome')
            ->with('aluno', $aluno)
            ->with('responsavel', $responsavel)
            ->with('matricula', $matricula)
            ->with('msg', $msg);

    }

    public function show(string $id)
    {

        $matriculaInfo = Matricula::find($id);

        if ($matriculaInfo->status == 'ativa') {
            return view(self::PATH . 'bloquearAluno', ['matricula' => $matriculaInfo]);
        } else if (($matriculaInfo->status == 'bloqueado')) {
            $bloqueado = $this->bloqueados->where('alunos_id', $matriculaInfo->alunos->id)->first();
            return view(self::PATH . 'alunoBloqueadoInfo', ['matricula' => $matriculaInfo, 'bloqueado'=>$bloqueado]);
        }
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

    private function atualizarStatusMatricula(string $matriculaID)
    {
        
        $matricula = Matricula::find($matriculaID);

        if($matricula != null){
            $matricula->status = 'bloqueado';
            $matricula->save();
        }

    }

    private function atualizarStatusAluno(string $alunoID)
    {

        $aluno = Aluno::find($alunoID);
        
        if($aluno != null){
            $aluno->ativo = 'bloqueado';
            $aluno->save();
        }

    }
}
