<?php

namespace App\Http\Controllers;

use App\Models\NivelAcesso;
use Illuminate\Http\Request;
use App\Models\ConfigMensalidade;

class ConfigMensalidadesController extends Controller
{

    const PATH = 'screens.configMensalidades.';
    public $config;

    public function __construct()
    {
        $this->config = new ConfigMensalidade();
    }

    public function index()
    {

        if($this->verificarAcesso() == 1){

            $config = $this->config->first();
            if ($config != null) {
                return view(self::PATH . 'configMensalidadesEdit', ['config' => $config]);

            } else {
                return view(self::PATH . 'configMensalidadesCreate');
            }
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $config = $this->config;

        $request->validate([
            'juros' => 'required',
            'multa' => 'required',
        ]);

        $juros = $request->old('juros');
        $multa = $request->old('multa');

        try {

            $config->juros = $request->input('juros');
            $config->multa = $request->input('multa');
            $config->mensagem = $request->input('mensagem');

            $config->save();

            $config = $this->config->first();
            return view(self::PATH . 'configMensalidadesEdit', ['config' => $config])
                ->with('msg', 'Configuração inserida com sucesso!!!');
        } catch (\Throwable $th) {
            $config = $this->config->first();
            return view(self::PATH . 'configMensalidadesCreate', ['config' => $config])
                ->with('msg', 'ERRO! Não possível incluir a nova configuração!!!');
        }
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

        $config = $this->config;

        $request->validate([
            'juros' => 'required',
            'multa' => 'required',
        ]);

        try {

            $config->juros = $request->input('juros');
            $config->multa = $request->input('multa');
            $config->mensagem = $request->input('mensagem');

            $config->save();

            $config = $this->config->first();
            return view(self::PATH . 'configMensalidadesEdit', ['config' => $config])
                ->with('msg', 'Configuração inserida com sucesso!!!');
        } catch (\Throwable $th) {
            $config = $this->config->first();
            return view(self::PATH . 'configMensalidadesEdit', ['config' => $config])
                ->with('msg', 'ERRO! Não possível incluir a nova configuração!!!');
        }

    }

    public function destroy(string $id)
    {
        //
    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Conf.Mensalidades')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
