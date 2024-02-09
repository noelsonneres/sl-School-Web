<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EntradaValor;
use Illuminate\Http\Request;

class RelatorioEntradaValoresController extends Controller
{

    const PATH = 'screens.relatorios.financeiro.entradas.';
    private $entrada;

    public function __construct()
    {
        $this->entrada = new EntradaValor();
    }

    public function index()
    {
        $entrada = $this->entrada->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relEntradaValores', ['entradas' => $entrada]);
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

        $entrada = $this->entrada->whereBetween('data', [$dt1, $dt2])->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relEntradaValores', ['entradas' => $entrada]);
    }

    public function localizar(Request $request)
    {

        // $request->validate([
        //     'motivo'=>'required',
        // ],[
        //     'motivo.required'=>'Você deve digitar o motivo que deseja retornar',
        // ]);

        $motivo = $request->input('motivo');

        $entrada = $this->entrada->where('motivo', 'LIKE', '%' . $motivo . '%')->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'relEntradaValores', ['entradas' => $entrada]);
    }

    public function impressao(String $id)
    {

        $entrada = $this->entrada->find($id);
        $empresa = Empresa::first();

        return view(self::PATH.'relEntradasValoresImpressao', ['entrada'=>$entrada, 'empresa'=>$empresa]);

        // relEntradasValoresImpressao

    }
}
