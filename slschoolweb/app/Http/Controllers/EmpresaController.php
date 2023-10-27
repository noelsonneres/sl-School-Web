<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Http\Controllers\Rule;
use App\Http\Controllers\File;

class EmpresaController extends Controller
{

    const PATH = 'screens.empresa.';
    public $empresa;

    public function __construct()
    {
        $this->empresa = new Empresa();
    }

    public function index()
    {

        $empresa = $this->empresa->all();

        if ($empresa->count() >= 1) {
            return view(self::PATH . 'empresaEdit', ['empresa' => $empresa->first()]);
        } else {
            return view(self::PATH . 'empresaCreate');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $empresa = $this->empresa;

        $request->validate([
            'nome' => 'required|min:3|max:50',
            'cnpj' => 'required',
            'logo' => [
                'file',
                'image',
                'max:2048',
                'mimes:jpeg,jpg,png,gif',
            ],
        ]);


        $nome = $request->old('nome');
        $cnpj = $request->old('cnpj');

        try {

            $empresa->nome = $request->input('nome');
            $empresa->razao_social = $request->input('razao_social');
            $empresa->data_aberturra = $request->input('dataAbertura');
            $empresa->cnpj = $request->input('cnpj');
            $empresa->telefone = $request->input('telefone');
            $empresa->celular = $request->input('celular');
            $empresa->email = $request->input('email');
            $empresa->endereco = $request->input('endereco');
            $empresa->bairro = $request->input('bairro');
            $empresa->numero = $request->input('numero');
            $empresa->complemento = $request->input('complemento');
            $empresa->cep = $request->input('cep');
            $empresa->cidade = $request->input('cidade');
            $empresa->estado = $request->input('estado');
            $empresa->obs = $request->input('obs');
            $empresa->funcionario = $request->input('0');


            //upload da foto
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $requestImage = $request->file('logo');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/logo'), $imgName);

                $empresa->foto = $imgName;
            }

            $empresa->save();

            $empresa = $this->empresa->all();
            return view(self::PATH . 'empresaEdit', ['empresa' => $empresa->first()])
                ->with('msg', 'Informações da empresas cadastradas com sucesso!!!');

        } catch (\Throwable $th) {
            $empresa = $this->empresa->all();
            return view(self::PATH . 'empresaCreate', ['empresa' => $empresa->first()])
                ->with('msg', 'ERRO! Não foi posssível salvar as informações da empresa!!!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        
        $empresa = $this->empresa->find($id);

        $request->validate([
            'nome' => 'required|min:3|max:50',
            'cnpj' => 'required',
            'logo' => [
                'file',
                'image',
                'max:2048',
                'mimes:jpeg,jpg,png,gif',
            ],
        ]);

        try {

            $empresa->nome = $request->input('nome');
            $empresa->razao_social = $request->input('razao_social');
            $empresa->data_aberturra = $request->input('dataAbertura');
            $empresa->cnpj = $request->input('cnpj');
            $empresa->telefone = $request->input('telefone');
            $empresa->celular = $request->input('celular');
            $empresa->email = $request->input('email');
            $empresa->endereco = $request->input('endereco');
            $empresa->bairro = $request->input('bairro');
            $empresa->numero = $request->input('numero');
            $empresa->complemento = $request->input('complemento');
            $empresa->cep = $request->input('cep');
            $empresa->cidade = $request->input('cidade');
            $empresa->estado = $request->input('estado');
            $empresa->obs = $request->input('obs');
            $empresa->funcionario = $request->input('0');


            //upload da foto
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $requestImage = $request->file('logo');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/logo'), $imgName);

                $empresa->foto = $imgName;
            }

            $empresa->save();

            $empresa = $this->empresa->all();
            return view(self::PATH . 'empresaEdit', ['empresa' => $empresa->first()])
                ->with('msg', 'Informações da empresas autalizadas com sucesso!!!');

        } catch (\Throwable $th) {
            $empresa = $this->empresa->all();
            return view(self::PATH . 'empresaCreate', ['empresa' => $empresa->first()])
                ->with('msg', 'ERRO! Não foi posssível atualizar as informações da empresa!!');
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
