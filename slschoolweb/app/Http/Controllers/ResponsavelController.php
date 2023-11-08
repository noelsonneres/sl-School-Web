<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
use Illuminate\Http\Request;

class ResponsavelController extends Controller
{
  
    const PATH = 'screens.alunos.responsavel.';
    private $responsavel;
    public function __construct()
    {
        $this->responsavel = new Responsavel();
    }


    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        $responsavel = $this->responsavel;

        $request->validate([
            'nome' => 'required|min:3|max:100',
            'idAluno' => 'required',
            'foto' => [
                'file',
                'image',
                'max:2048',
                'mimes:jpeg,jpg,png,gif',
            ],
        ],
    [
        'nome.required' => 'Informe o nome do responsável',
    ]);  
    
    try {
    
        $responsavel->nome = $request->input('nome');
        $responsavel->alunos_id = $request->input('idAluno');
        $responsavel->apelido = $request->input('apelido');
        $responsavel->data_nascimento = $request->input('dataNascimento');
        $responsavel->data_cadastro = $request->input('dataCadatro');
        $responsavel->rg = $request->input('rg');
        $responsavel->cpf = $request->input('cpf');
        $responsavel->endereco = $request->input('endereco');
        $responsavel->bairro = $request->input('bairro');
        $responsavel->numero = $request->input('numero');
        $responsavel->complemento = $request->input('complemento');
        $responsavel->cep = $request->input('cep');
        $responsavel->cidade = $request->input('cidade');
        $responsavel->estado = $request->input('estado');
        $responsavel->telefone = $request->input('telefone');
        $responsavel->celular = $request->input('celular');
        $responsavel->email = $request->input('email');
        $responsavel->estado_civil = $request->input('estadoCivil');
        $responsavel->profissao = $request->input('profissao');
        $responsavel->observacao = $request->input('obs');
        $responsavel->deletado = 'nao';

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $requestImage = $request->file('foto');
            $extension = $requestImage->getClientOriginalExtension();
            $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/responsavel'), $imgName);

            $responsavel->foto = $imgName;
        }      

        $responsavel->save();

        $responsavel = $this->responsavel->where('id_aluno',  $request->input('idAluno'))->first();
        return view(self::PATH.'responsavelEdit', ['responsavel'=>$responsavel]);

    } catch (\Throwable $th) {
        //throw $th;
    }

    }

    public function show(string $id)
    {
        
        $responsavel = $this->responsavel->where('id_aluno', $id);

        if($responsavel->count() >= 1){
            //Caso já exista algum responsável cadastrado
        }else{
            return view(self::PATH.'responsavelCreate');
        }

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

    public function adicionar(string $idAluno, string $nomeAluno){
     
        $responsavel = $this->responsavel->where('alunos_id', $idAluno)->first();

        if($responsavel->count() >= 1){
            $alunos = $responsavel->alunos()->first();
            return view(self::PATH.'responsavelEdit', ['responsavel'=>$responsavel])->with('aluno', $alunos);
        }else{
            return view(self::PATH.'responsavelCreate')
                            ->with('idAluno', $idAluno)
                            ->with('nomeAluno', $nomeAluno);
        }        
        
    }

}
