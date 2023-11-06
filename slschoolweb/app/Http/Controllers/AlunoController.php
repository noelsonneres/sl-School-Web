<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{

    const PATH = 'screens.alunos.aluno.';
    private $alunos;

    public function __construct()
    {
        $this->alunos = new Aluno();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        
        return view(self::PATH.'alunosCreate');

    }

    public function store(Request $request)
    {
        
        $alunos = $this->alunos;

        $request->validate([
            'aluno' => 'required|min:3'
        ],[
            'aluno.required' => 'Nome requirido',
            'aluno.min' => 'O nome deve ter no mínimo três letras',
        ]);

        $aluno = $request->old('aluno');

        try {
        
            $alunos->nome = $request->input('aluno');
            $alunos->apelido = $request->input('apelido');
            $alunos->data_nascimento = $request->input('dataNascimento');
            $alunos->data_cadastro = $request->input('dataCadastro');
            $alunos->rg = $request->input('rg');
            $alunos->cpf = $request->input('cpf');
            $alunos->fobias = $request->input('fobias');
            $alunos->alergias = $request->input('alergias');
            $alunos->deficiencias = $request->input('deficiencias');
            $alunos->outros_aspectos = $request->input('outrosAspectos');
            $alunos->endereco = $request->input('endereco');
            $alunos->bairro = $request->input('bairro');
            $alunos->numero = $request->input('numero');
            $alunos->complemento = $request->input('complemento');
            $alunos->cep = $request->input('cep');
            $alunos-> cidade = $request->input('cidade');
            $alunos->estado = $request->input('estado');
            $alunos->telefone = $request->input('telefone');
            $alunos->celular = $request->input('celular');
            $alunos->email = $request->input('email');
            $alunos->estado_civil = $request->input('estadoCivil');
            $alunos->profissao = $request->input('profissao');
            $alunos->nome_mae = $request->input('nomeMae');
            $alunos->rg_mae = $request->input('rgMae');
            $alunos->cep_mae = $request->input('cpfMae');
            $alunos->nome_pai = $request->input('nomePai');
            $alunos->rg_pai = $request->input('rgPai');
            $alunos->cpf_pai = $request->input('cpfPai');
            $alunos->observacao = $request->input('obs');
            $alunos->deletado = 'nao';

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/aluno'), $imgName);

                $alunos->foto = $imgName;
            }                
            
            $alunos->save();   

            return redirect()->route('home.alunos')->with('msg', 'Aluno incluído com sucesso!!!');

        } catch (\Throwable $th) {
            return back();
        }


    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        
        $alunos = $this->alunos->find($id);

        if($alunos->count() >= 1){
            return view(self::PATH.'alunosEdit', ['alunos'=>$alunos]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
