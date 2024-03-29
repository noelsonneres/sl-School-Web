<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\NivelAcesso;
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
        if ($this->verificarAcesso('Cadastro de alunos') == 1) {
            return view(self::PATH . 'alunosCreate');
        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    public function store(Request $request)
    {

        $alunos = $this->alunos;

        $request->validate([
            'aluno' => 'required|min:3'
        ], [
            'aluno.required' => 'O campo Aluno é obrigatório',
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
            $alunos->cidade = $request->input('cidade');
            $alunos->estado = $request->input('estado');
            $alunos->telefone = $request->input('telefone');
            $alunos->celular = $request->input('celular');
            $alunos->email = $request->input('email');
            $alunos->estado_civil = $request->input('estadoCivil');
            $alunos->profissao = $request->input('profissao');
            $alunos->nacionalidade = $request->input('nacionalidade');
            $alunos->nome_mae = $request->input('nomeMae');
            $alunos->rg_mae = $request->input('rgMae');
            $alunos->cpf_mae = $request->input('cpfMae');
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
            return view(self::PATH . 'alunosCreate')->with('msg', 'ERRO! Não foi possível salvar as informações do aluno. '
                . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        if ($this->verificarAcesso('Cadastro de alunos') == 1) {
            $aluno = $this->alunos->find($id);
        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    public function edit(string $id)
    {

        if ($this->verificarAcesso('Editar aluno') == 1) {
            $alunos = $this->alunos->find($id);
            if ($alunos->count() >= 1) {
                return view(self::PATH . 'alunosEdit', ['alunos' => $alunos]);
            }
        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    public function update(Request $request, string $id)
    {

        $alunos = $this->alunos->find($id);

        // dd($request->input('nacionalidade'));

        if ($alunos->count() >= 1) {

            $request->validate([
                'aluno' => 'required|min:3'
            ], [
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
                $alunos->cidade = $request->input('cidade');
                $alunos->estado = $request->input('estado');
                $alunos->telefone = $request->input('telefone');
                $alunos->celular = $request->input('celular');
                $alunos->email = $request->input('email');
                $alunos->estado_civil = $request->input('estadoCivil');
                $alunos->profissao = $request->input('profissao');
                $alunos->nacionalidade = $request->input('nacionalidade');
                $alunos->nome_mae = $request->input('nomeMae');
                $alunos->rg_mae = $request->input('rgMae');
                $alunos->cpf_mae = $request->input('cpfMae');
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

                return redirect()->route('home.alunos')->with('msg', 'As informações do aluno foram atualizadas com sucesso!');
            } catch (\Throwable $th) {
                return back()->with('msg', 'Não foi possível atualizar as informações do aluno');
            }
        } else {
            return redirect()->route('home.alunos')->with('msg', 'O aluno não foi encontrado na base de dados!');
        }
    }

    public function destroy(string $id)
    {

        if ($this->verificarAcesso('Excluir aluno') == 1) {
            $alunos = $this->alunos->find($id);

            if ($alunos->count() >= 1) {
                $alunos->delete();
                return redirect()->route('home.alunos')->with('msg', 'Aluno exluido com sucesso!');
            } else {
                return redirect()->route('home.alunos')->with('msg', 'Não foi possível excluir as informações do aluno!');
            }
        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    private function verificarAcesso(string $recurso)
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', $recurso)
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
}
