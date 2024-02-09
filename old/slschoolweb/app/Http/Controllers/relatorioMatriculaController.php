<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Matricula;
use Illuminate\Http\Request;

class relatorioMatriculaController extends Controller
{

    const PATH = 'screens.relatorios.matricula.';
    private $matricula;

    public function __construct()
    {
        $this->matricula = new Matricula();
    }

    public function index()
    {
        $matricula = $this->matricula->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relatorioMatriculasShow', ['matriculas' => $matricula]);
    }

    public function localizarMatriculaAlunos(string $alunoID)
    {
        $matricula = $this->matricula->where('alunos_id', $alunoID)->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relatorioMatriculasShow', ['matriculas' => $matricula]);
    }

    public function impressao(string $matriculaID)
    {

        $matricula = $this->matricula->find($matriculaID);
        $empresa = Empresa::first();
        return view(self::PATH . 'relMatriculaImpressao', ['matricula' => $matricula, 'empresa' => $empresa]);
    }

    public function localizarEntreDatas(Request $request)
    {

        $request->validate([
            'dtTipo' => 'required',
            'dt1' => 'required',
            'dt2' => 'required',
        ], [
            'dtTipo.required' => 'Selecione o tipo de pesquisa para as datas',
            'dt1.required' => 'Infome uma data valida para o campo "Primeira data',
            'dt2.requied' => 'Infomre uma data valida pra o campo "Segunda data" ',
        ]);

        $valorPesquisa = "";

        switch ($request->input('dtTipo')) {
            case "incio":
                $valorPesquisa = 'data_inicio';
                break;
            case "termino":
                $valorPesquisa = 'data_termino';
                break;
        }

        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');

        $matricula = $this->matricula->whereBetween($valorPesquisa, [$dt1, $dt2])->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relatorioMatriculasShow', ['matriculas' => $matricula]);
    }

    public function localizar(Request $request)
    {

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        $matricula = $this->matricula::where($field, 'LIKE', $value . '%')->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relatorioMatriculasShow', ['matriculas' => $matricula]);

    }

    public function localizarPorStatus(Request $request){

        $request->validate([
            'ativo'=>'required',
        ],[
            'ativo.required'=>'Selecione o status de matrícula',
        ]);

        $valorPesquisa = $request->input('ativo');

        $matricula = $this->matricula->where('status', $valorPesquisa)->paginate();
        return view(self::PATH . 'relatorioMatriculasShow', ['matriculas' => $matricula]);

    }
}
