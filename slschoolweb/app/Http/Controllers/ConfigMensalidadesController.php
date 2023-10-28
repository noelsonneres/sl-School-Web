<?php

namespace App\Http\Controllers;

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

        $config = $this->config->first();

        if ($config->count() >= 1) {
            return view(self::PATH . 'configMensalidadesEdit', ['config' => $config]);
        } else {
            return view(self::PATH . 'configMensalidadesCreate');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
