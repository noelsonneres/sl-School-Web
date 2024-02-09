<?php

namespace App\Http\Controllers;

use App\Models\Mensalidade;
use Illuminate\Http\Request;

class RelatorioMensalidadesPeriodoController extends Controller
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
        return view(self::PATH . 'relMensalidadesPeriodo', ['mensalidades' => $mensalidade]);
    }

    public function localizar(Request $request)
    {

        $request->validate([
            'status' => 'required',
            'dt1' => 'required|date',
            'dt2' => 'required|date',
            'filtro'=>'required',
        ], [
            'status.required' => 'Selecione uma opção para a pesquisa',
            'dt1.required' => 'Informe uma data valida',
            'dt1.date' => 'A data deve estar em um formato valido',
            'dt2.required' => 'Informe uma data valida',
            'dt2.date' => 'A data deve estar em um formato valido',
            'filtro.required'=>'Selecione um filtro para a pesquisa',
        ]);

        $status = $request->input('status');
        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');
        $filtro = $request->input('filtro');

        $mensalidades = $this->mensalidade
            ->whereBetween($filtro, [$dt1, $dt2])
            ->where('pago', '=', $status)
            ->paginate();

            return view(self::PATH . 'relMensalidadesPeriodo', ['mensalidades' => $mensalidades]);            

    }
}
