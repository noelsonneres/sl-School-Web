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

        // UTILIZAR A DATA DE VENCIMENTO PARA GERAR AS PARCELAS
        
        $material = $this->material;

        $request->validate([
            'material' => 'required',
            'valorUN' => 'required',
            'qtde' => 'required',
            'total' => 'required',
            'vencimento' => 'required',
        ],[
            'material.required'=>'Selecione um material',
            'valorUN.required'=>'Digite um valor valido para o campo Valor Unit[ario',
            'qtde.required'=>'Selecione um valor valido para o campo Quantidade',
            'total.required'=>'Digite um valor valido para o campo Total',
            'vencimento.required'=>'Selecione uma data para o vencimento',
        ]);

        $matriculaID = $request->input('matricula');

        try {

            $material->alunos_id = $request->input('aluno');
            $material->matriculas_id = $request->input('matricula');
            $material->materiais_escolars_id = $request->input('material');
            $material->valor_un = $request->input('valorUN');
            $material->qtde = $request->input('qtde');
            $material->valor_total = $request->input('total');

            $material->save();

            $msg = 'Material incluido com sucesso!!!';
            
        } catch (\Throwable $th) {
            $msg = 'ERRO! Não foi possível incluir o material!';
            return $th;
        }

        $matricula = Matricula::find($matriculaID);
        $aluno = $matricula->alunos()->first();

        $materiais = $this->material->with('material')->where('matriculas_id', $matriculaID)
                                ->orderBy('id', 'desc')->paginate();

        return view(self::PATH.'matriculaMateriais', ['materiais'=>$materiais, 
                            'matricula'=>$matricula, 'aluno'=>$aluno])
                            ->with('msg', $msg);     

    }

    public function show(string $id)
    {
        
        $matricula = Matricula::find($id);
        $aluno = $matricula->alunos()->first();

        $materiais = $this->material->with('material')->where('matriculas_id', $id)
            ->orderBy('id', 'desc')->paginate();

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

    public function gerarParcelas(array $value){
        dd($value);
    }

}
