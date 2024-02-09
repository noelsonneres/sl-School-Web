<?php

namespace App\Http\Controllers;

use App\Models\ConfCarteira;
use Illuminate\Http\Request;

class ConfCarteiraController extends Controller
{

    const PATH = 'screens.confCarteira.';
    private $conf;

    public function __construct()
    {
        $this->conf = new ConfCarteira();
    }

    public function index()
    {

        $confCarteira = $this->conf->all()->first();

        if ($confCarteira != null){
            return view(self::PATH.'configurarCarteiraEdit', ['conf'=>$confCarteira]);
        }else{
            return view(self::PATH.'configurarCarteiraCreate');
        }

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $conf = $this->conf;

        $request->validate([
            'mensagem'=>'required',
        ]);

        try {

            $conf->mensagem = $request->input('mensagem');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {

                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/carteira'), $imgName);

                $conf->logo = $imgName;

            }

            $conf->save();

            $confCarteira = $this->conf->all()->first();
            return view(self::PATH.'configurarCarteiraEdit', ['conf'=>$confCarteira])
                ->with('msg', 'SUCESSO! Configurações da carteira salvas com sucesso!');

        }catch (\Throwable $th){
            return view(self::PATH.'configurarCarteiraCreate')
                    ->with('msg', 'ERRO! Não foi possível atualizar as informações da carteira: '.$th->getMessage());
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

        $conf = $this->conf->find($id);

        $request->validate([
            'mensagem'=>'required',
        ]);

        try {

            $conf->mensagem = $request->input('mensagem');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {

                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/carteira'), $imgName);

                $conf->logo = $imgName;

            }

            $conf->save();

            $confCarteira = $this->conf->all()->first();
            return view(self::PATH.'configurarCarteiraEdit', ['conf'=>$confCarteira])
                ->with('msg', 'SUCESSO! Configurações da carteira atualizadas com sucesso!');

        }catch (\Throwable $th){
            return view(self::PATH.'configurarCarteiraCreate')
                ->with('msg', 'ERRO! Não foi possível atualizar as informações da carteira: '.$th->getMessage());
        }

    }

    public function destroy(string $id)
    {
        //
    }
}
