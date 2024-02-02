<?php

namespace App\Http\Controllers;

use App\Models\Mensalidade;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RelatorioMensalidadesAtrasadasController extends Controller
{

    const PATH = 'screens.relatorios.mensalidade.';
    private $mensalidade;

    public function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public function index()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $mensalidades = $this->mensalidade
            ->where('vencimento', '<=', $currentDate)
            ->where('pago', '=', 'nao')
            ->paginate();
        return view(self::PATH . 'relMensalidadesAtrasadas', ['mensalidades' => $mensalidades]);
    }

    public function localizarEntreData(Request $request)
    {

        $request->validate([
            'dt1' => 'required',
            'dt2' => 'required',
        ], [
            'dt1.required' => 'Informe a primeira data de vencimento para localizar as mensalidades',
            'dt2.required' => 'Informe a segunda data de vencimento para localizar as mensalidades',
        ]);

        $dt1 = $request->old('dt1');

        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');

        $mensalidades = $this->mensalidade->whereBetween('vencimento', [$dt1, $dt2])->where('pago', '=', 'nao')->paginate();
        return view(self::PATH . 'relMensalidadesAtrasadas', ['mensalidades' => $mensalidades]);
    }

    public function localizarApenasAtrasadas(Request $request)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $mensalidades = $this->mensalidade->where('vencimento', '<=', $currentDate)->where('pago', '=', 'nao')->paginate();
        return view(self::PATH . 'relMensalidadesAtrasadas', ['mensalidades' => $mensalidades]);
    }

    public function localizarPorMatrícula(Request $request)
    {

        $request->validate([
            'dt1'=>'required',
            'dt2'=>'required',
            'matricula'=>'required',
        ],[
            'dt1.required'=>'Digite a primeira data para pesquisar'
        ]);

    }
}
