<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\MatriculaReativar;
use Illuminate\Http\Request;

class RelatorioMatriculaReativadasController extends Controller
{

    const PATH = 'screens.relatorios.reativada.';
    private $reativada;

    public function __construct()
    {
        $this->reativada = new MatriculaReativar();
    }

    public function index()
    {
        $reativada = $this->reativada->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relMatriculasReativadasShow', ['reativadas' => $reativada]);
    }

    public function impressao(String $id)
    {
        $reativada = $this->reativada->find($id);
        $empresa = Empresa::first();
        return view(self::PATH . 'relMatriculaReativadaImpressao', ['reativada' => $reativada, 'empresa' => $empresa]);
    }

    public function localizarEntreDatas(Request $request)
    {

        $request->validate([
            'dt1' => 'required',
            'dt2' => 'required',
        ], [
            'dt1.required' => 'Infome uma data valida para o campo "Primeira data',
            'dt2.requied' => 'Infomre uma data valida pra o campo "Segunda data" ',
        ]);

        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');

        $reativada = $this->reativada->whereBetween('data', [$dt1, $dt2])->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relMatriculasReativadasShow', ['reativadas' => $reativada]);

    }

    public function localizar(Request $request)
    {

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'matriculas_id';
        }

        $reativada = $this->reativada::where($field, 'LIKE', $value . '%')->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relMatriculasReativadasShow', ['reativadas' => $reativada]);        
        
    }
}
