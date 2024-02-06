<?php

namespace App\Http\Controllers;

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
        return view(self::PATH.'relEntradaValores', ['entradas'=>$entrada]);
    }

    // relEntradaValores
}
