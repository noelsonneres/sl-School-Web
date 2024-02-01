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
        $mensalidades = $this->mensalidade->where('vencimento', '<=', $currentDate)->paginate();
        return view(self::PATH . 'relMensalidadesAtrasadas', ['mensalidades' => $mensalidades]);
    }

    public function localizarEntreData(Request $request)
    {
    }

    public function localizarApenasAtrasadas(Request $request)
    {
    }

    public function localizarPorMatrícula(Request $request)
    {
    }
}
