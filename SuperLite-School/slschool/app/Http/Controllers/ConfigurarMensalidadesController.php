<?php

namespace App\Http\Controllers;

use App\Models\ConfigurarMensalidade;
use Illuminate\Http\Request;

class ConfigurarMensalidadesController extends Controller
{

    const PATH = 'screens.configurarMensalidades.';
    private $configurar;

    public function __construct()
    {
        $this->configurar = new ConfigurarMensalidade();                
    }
    public function index()
    {
        $configurar = $this->configurar->paginate();
        return view(self::PATH.'configurarMensalidadeShow', ['configurar'=>$configurar]);
    }

    public function create()
    {
        $configurar = $this->configurar->all();

        if($configurar->count() >= 1){
            return redirect()->back()->withInput()->withErrors(['ERRO! Não é possível ter mais de uma configuração cadastrada']);
        }else{
            return view(self::PATH.'configurarMensalidadeCreate');
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
