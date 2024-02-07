<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Saidavalor;
use Illuminate\Http\Request;

class RelatorioSaidaValoresController extends Controller
{

    const PATH = 'screens.relatorios.financeiro.saidas.';
    private $saidas;

    public function __construct()
    {
        $this->saidas = new Saidavalor();
    }

    public function index()
    {
        $saidas = $this->saidas->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relSaidaValoresShow', ['saidas' => $saidas]);
    }

    public function localizarEntreDatas(Request $request)
    {

        $request->validate([
            'dt1' => 'required|date',
            'dt2' => 'required|date',
        ], [
            'dt1.required' => 'Informe uma data de início para a pesquisa',
            'dt1.date' => 'Informe uma data de início valida',
            'dt2.required' => 'Informe uma data de término para a pesquisa',
            'dt2.date' => 'Informe uma data de término valida',
        ]);

        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');

        $saidas = $this->saidas->whereBetween('data', [$dt1, $dt2])->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relSaidaValoresShow', ['saidas' => $saidas]);
    }

    public function localizar(Request $request)
    {
        $motivo = $request->input('motivo');
        $saidas = $this->saidas->where('motivo', 'LIKE', '%' . $motivo . '%')->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relSaidaValoresShow', ['saidas' => $saidas]);
    }

    public function impressao(String $id)
    {
        $saida = $this->saidas->find($id);
        $empresa = Empresa::first();
        return view(self::PATH.'relSaidaValoresImpressao', ['saida'=>$saida, 'empresa'=>$empresa]);
    }
}
