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
         return view(self::PATH, ['configurarMensalidadeEdit'=>$configurar]);
        }else{
            return view(self::PATH.'configurarMensalidadeCreate');
        }
    }

    public function store(Request $request)
    {
        
        $configurar = $this->configurar;

        $request->validate([
            'juros'=>'required|numeric',
            'multa'=>'required|numeric'
        ]);

        //contiunuar deste ponto em diante

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
