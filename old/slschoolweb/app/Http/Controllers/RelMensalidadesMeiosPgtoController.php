<?php

namespace App\Http\Controllers;

use App\Models\MeiosPagamento;
use App\Models\Mensalidade;
use Illuminate\Http\Request;

class RelMensalidadesMeiosPgtoController extends Controller
{

    const PATH = 'screens.relatorios.mensalidade.';
    private $mensalidade;

    public function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public function index()
    {

        $mensalidade = $this->mensalidade->where('matriculas_id', 0)->paginate();
        $meiosPgto = MeiosPagamento::all();

        return view(self::PATH . 'relMensalidadesMeiosPgto', ['mensalidades' => $mensalidade, 'meios' => $meiosPgto]);
    }

    public function localizarEntreDatas(Request $request)
    {

        $request->validate([
            'meio' => 'required',
            'dt1' => 'required|date',
            'dt2' => 'required|date',
            'filtro' => 'required',
        ], [
            'meio.required' => 'Selecione por qual meio de pagamento deseja realizar a pesquisa',
            'dt1.required' => 'Você deve informar uma data de início para a pesquisa',
            'dt1.date' => 'Digite uma data valida para o início da pesquisa',
            'dt2.required' => 'Você deve informar uma data de término para a pesquisa',
            'dt2.date' => 'Digite uma data valida para o término da pesquisa',
            'filtro.required' => 'Selecione o tipo do filtro',
        ]);

        $meio = $request->input('meio');
        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');
        $filtro = $request->input('filtro');

        $mensalidade = $this->mensalidade
            ->whereBetween($filtro, [$dt1, $dt2])
            ->where('forma_pagamento', $meio)
            ->paginate();

        $meiosPgto = MeiosPagamento::all();

        return view(self::PATH . 'relMensalidadesMeiosPgto', ['mensalidades' => $mensalidade, 'meios' => $meiosPgto]);

    }

    public function localizarPorMeios(Request $request)
    {

        $request->validate([
            'meio' => 'required',
        ],[
            'filtro.required' => 'Selecione o tipo do filtro',            
        ]);

        $meio = $request->input('meio');

        $mensalidade = $this->mensalidade->where('forma_pagamento', $meio)->paginate();

        $meiosPgto = MeiosPagamento::all();

        return view(self::PATH . 'relMensalidadesMeiosPgto', ['mensalidades' => $mensalidade, 'meios' => $meiosPgto]);

    }

    // relMensalidadesMeiosPgto

}
