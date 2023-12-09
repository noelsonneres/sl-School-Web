<?php

namespace App\Http\Controllers;

use App\Models\CursosDisciplina;
use App\Models\Disciplina;
use App\Models\Frequencia;
use App\Models\Matricula;
use App\Models\MatriculaDisciplina;
use Illuminate\Http\Request;

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
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        dd($request);
    }

    public function show(string $id)
    {

        $frequencia = $this->frequencia->where('matriculas_id', $id)->paginate();
        
        return view(self::PATH.'frequenciaShow', ['frequencias'=>$frequencia, 'matricula'=>$id]);

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

        $listaDisciplina = MatriculaDisciplina::where('matriculas_id', $matricula)->get();

        $matriculas = Matricula::find($matricula);

        if($matriculas->count() >= 1){
            return view(self::PATH.'frequenciaCreate', ['matricula'=>$matriculas, 'listaDisciplinas'=>$listaDisciplina]);
        }else{
            return back();
        }

    }

}
