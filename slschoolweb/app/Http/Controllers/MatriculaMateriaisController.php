<?php

namespace App\Http\Controllers;

use App\Models\MateriaisEscolar;
use App\Models\Matricula;
use Illuminate\Http\Request;
use App\Models\MatriculaMaterial;

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
        //
    }

    public function show(string $id)
    {
        
        $matricula = Matricula::find($id);
        $aluno = $matricula->alunos()->first();

        $materiais = $this->material->with('material')->where('matriculas_id', $id)->paginate();

        return view(self::PATH.'matriculaMateriais', ['materiais'=>$materiais, 
                            'matricula'=>$matricula, 'aluno'=>$aluno]);

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

    public function adicionar(string $matricula){

        $matricula = Matricula::find($matricula);
        $aluno = $matricula->alunos()->first();

        $listaMateriais = MateriaisEscolar::all();

        if($matricula->count() >= 1){
            return view(self::PATH.'matriculaMateriaisCreate', ['matricula'=>$matricula,
                             'aluno'=>$aluno, 'listaMaterias'=>$listaMateriais]);
        }else{
            return back();
        }

    }

}
