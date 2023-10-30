<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursosController extends Controller
{

    const PATH = 'screens.cursos.';
    public $cursos;

    public function __construct()
    {
        $this->cursos = new Curso();
    }

    public function index()
    {
        $cursos = $this->cursos->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'cursosShow', ['cursos'=>$cursos]);

    }

    public function create()
    {
        return view(self::PATH.'cursosCreate');
    }

    public function store(Request $request)
    {
        
        $cursos = $this->cursos;

        $request->validate([
            'curso' => 'required|min:3|max:100',
        ]);

        try {
        
            $cursos->curso = $request->input('curso');
            $cursos->desscricao = $request->input('descricao');
            $cursos->valor_avista = $request->input('valorAvista');
            $cursos->valor_com_desconto = $request->input('valorComDesconto');
            $cursos->qtde_parcelas = $request->input('qtdeParcelas');
            $cursos->valor_parcelado = $request->input('valorParcelado');
            $cursos->valor_por_parcela = $request->input('valorPorParcela');
            $cursos->duracao_meses = $request->input('duracaoMeses');
            $cursos->carga_horaria = $request->input('cargaHoraria');
            $cursos->ativo = $request->input('opt');
            $cursos->observacao = $request->input('obs');

            $cursos->save();

            $cursos = $this->cursos->paginate();
            return view(self::PATH.'cursosShow', ['cursos'=>$cursos])->with('msg', 'Curso cadastrado com sucesso!');

        } catch (\Throwable $th) {
            $cursos = $this->cursos->paginate();
            return view(self::PATH.'cursosShow', ['cursos'=>$cursos])->with('msg', 'ERRO! Não foi possível cadastrar o curso!');
        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        
        $cursos = $this->cursos->find($id);
        return view(self::PATH.'cursosEdit', ['cursos'=>$cursos]);


    }

    public function update(Request $request, string $id)
    {
        
        $cursos = $this->cursos->find($id);

        $request->validate([
            'curso' => 'required|min:3|max:100',
        ]);

        try {
        
            $cursos->curso = $request->input('curso');
            $cursos->desscricao = $request->input('descricao');
            $cursos->valor_avista = $request->input('valorAvista');
            $cursos->valor_com_desconto = $request->input('valorComDesconto');
            $cursos->qtde_parcelas = $request->input('qtdeParcelas');
            $cursos->valor_parcelado = $request->input('valorParcelado');
            $cursos->valor_por_parcela = $request->input('valorPorParcela');
            $cursos->duracao_meses = $request->input('duracaoMeses');
            $cursos->carga_horaria = $request->input('cargaHoraria');
            $cursos->ativo = $request->input('opt');
            $cursos->observacao = $request->input('obs');

            $cursos->save();

            $cursos = $this->cursos->paginate();
            return view(self::PATH.'cursosShow', ['cursos'=>$cursos])
                ->with('msg', 'Informações do curso atualizadas com sucesso!');

        } catch (\Throwable $th) {
            $cursos = $this->cursos->paginate();
            return view(self::PATH.'cursosShow', ['cursos'=>$cursos])
                ->with('msg', 'ERRO! Não foi possível atualizar as informações do curso!');
        }

    }

    public function destroy(string $id)
    {
        
        $cursos = $this->cursos->find($id);

        if($cursos->count() >= 1){
            $cursos->delete();
            $cursos = $this->cursos->paginate();
            return view(self::PATH.'cursosShow', ['cursos'=>$cursos])
                ->with('msg', 'Curso deletado com sucesso!');
        }else{
            $cursos = $this->cursos->paginate();
            return view(self::PATH.'cursosShow', ['cursos'=>$cursos])
                ->with('msg', 'ERRO! Não foi possível deletar as informações do curso!');
        }

    }

    public function find(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        $cursos = Curso::where($field, 'LIKE', $value . '%')->paginate(15);
        return view(self::PATH.'cursosShow', ['cursos'=>$cursos]);
    }

}
