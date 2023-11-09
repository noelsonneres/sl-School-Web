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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    //PROCESSO PARA REDIRECIONAR DEPENDENDO DA QUANTIDADE DE MATRÍCULAS DO ALUNO

    public function homeMatricula(string $idAluno)
    {

        $aluno = Aluno::find($idAluno);
        $responsavel = Responsavel::where('alunos_id', $idAluno);

        $matricula = $this->matricula->where('alunos_id', $idAluno);

        if ($matricula->count() > 1) {
            //Redirecionar para a janela Lista de matrículas
        } else if ($matricula->count() == 1) { //Redireciona para a Home Matrículas
            return view(self::PATH . 'matriculaHome')
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel);
        }else{

            $listaCursos = Curso::all();
            $listaConsultores = Consultor::all();    

            return view(self::PATH . 'matriculaCreate')
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel->first())
                ->with('cursos', $listaCursos)
                ->with('consultores', $listaConsultores);

        }
    }
}
