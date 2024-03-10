<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    const PAHT = 'screens.matricula.dashboard.';
    private $matriculas;

    public function __construct()
    {
        $this->matriculas = new Matricula();
    }

    public function index(string $matriculaID)
    {
        $matricula = $this->matriculas
                            ->where('empresas_id', auth()->user()->empresas_id)
                            ->where('deletado', 'nao')
                            ->find($matriculaID);
        return view(self::PAHT.'dashboardShow', ['matricula'=>$matricula]);
    }
}
