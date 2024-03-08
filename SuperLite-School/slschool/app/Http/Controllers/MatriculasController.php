<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Consultor;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\ResponsavelAluno;
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
        ]);

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
}
