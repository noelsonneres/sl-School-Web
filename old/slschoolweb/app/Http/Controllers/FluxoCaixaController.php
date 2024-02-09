<?php

namespace App\Http\Controllers;

use App\Models\ContasPagar;
use App\Models\ControleCaixa;
use App\Models\EntradaValor;
use App\Models\Mensalidade;
use App\Models\Saidavalor;
use Illuminate\Http\Request;

class FluxoCaixaController extends Controller
{
    
    const PATH = 'screens.relatorios.financeiro.fluxoCaixa.';
    private $mensalidades;
    private $entradas;
    private $saidas;
    private $contas;
    private $controleCaixa;

    public function __construct()
    {
        $this->mensalidades = new Mensalidade();
        $this->entradas = new EntradaValor();
        $this->saidas = new Saidavalor();
        $this->contas = new ContasPagar();
        $this->controleCaixa = new ControleCaixa();
    }

}
