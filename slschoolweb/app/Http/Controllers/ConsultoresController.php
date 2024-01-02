<?php

namespace App\Http\Controllers;

use App\Models\NivelAcesso;
use Illuminate\Http\Request;
use App\Models\Consultor;

class ConsultoresController extends Controller
{

    const PATH = 'screens.consultores.';
    public $consultores;

    public function __construct()
    {
        $this->consultores = new Consultor();
    }

    public function index()
    {

        if($this->verificarAcesso() == 1){
            $consultores = $this->consultores->paginate();
            return view(self::PATH . 'consultoresShow', ['consultores' => $consultores]);
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function create()
    {

        return view(self::PATH . 'consultoresCreate');
    }

    public function store(Request $request)
    {

        $consultores = $this->consultores;

        $request->validate([
            'nome' => 'required|min:3|max:100',
            'foto' => [
                'file',
                'image',
                'max:2048',
                'mimes:jpeg,jpg,png,gif',
            ],
        ]);

        try {

            $consultores->nome = $request->input('nome');
            $consultores->data_nascimento = $request->input('dataNascimento');
            $consultores->cpf = $request->input('cpf');
            $consultores->telefone = $request->input('telefone');
            $consultores->celular = $request->input('celular');
            $consultores->email = $request->input('email');
            $consultores->endereco = $request->input('endereco');
            $consultores->bairro = $request->input('bairro');
            $consultores->numero = $request->input('numero');
            $consultores->complemento = $request->input('complemento');
            $consultores->cep = $request->input('cep');
            $consultores->cidade = $request->input('cidade');
            $consultores->estado = $request->input('estado');
            $consultores->obs = $request->input('obs');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/consultor'), $imgName);

                $consultores->foto = $imgName;
            }

            $consultores->save();

            $consultores = $this->consultores->paginate();
            return view(self::PATH . 'consultoresShow', ['consultores' => $consultores])
                ->with('msg', 'Consultor cadastrado com sucesso!!!');
        } catch (\Throwable $th) {
            $consultores = $this->consultores->paginate();
            return view(self::PATH . 'consultoresShow', ['consultores' => $consultores])
                ->with('msg', 'ERRO! Não foi possível salvar as informações no banco de dados');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $consultores = $this->consultores->find($id);

        return view(self::PATH . 'consultoresEdit', ['consultor' => $consultores]);
    }

    public function update(Request $request, string $id)
    {

        $consultores = $this->consultores->find($id);

        $request->validate([
            'nome' => 'required|min:3|max:100',
            'foto' => [
                'file',
                'image',
                'max:2048',
                'mimes:jpeg,jpg,png,gif',
            ],
        ]);

        try {

            $consultores->nome = $request->input('nome');
            $consultores->data_nascimento = $request->input('dataNascimento');
            $consultores->cpf = $request->input('cpf');
            $consultores->telefone = $request->input('telefone');
            $consultores->celular = $request->input('celular');
            $consultores->email = $request->input('email');
            $consultores->endereco = $request->input('endereco');
            $consultores->bairro = $request->input('bairro');
            $consultores->numero = $request->input('numero');
            $consultores->complemento = $request->input('complemento');
            $consultores->cep = $request->input('cep');
            $consultores->cidade = $request->input('cidade');
            $consultores->estado = $request->input('estado');
            $consultores->obs = $request->input('obs');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/consultor'), $imgName);

                $consultores->foto = $imgName;
            }

            $consultores->save();

            $consultores = $this->consultores->paginate();
            return view(self::PATH . 'consultoresShow', ['consultores' => $consultores])
                ->with('msg', 'Informações do consultor atualizadas com sucesso!');
        } catch (\Throwable $th) {
            $consultores = $this->consultores->paginate();
            return view(self::PATH . 'consultoresShow', ['consultores' => $consultores])
                ->with('msg', 'ERRO! Não foi possível atualizar as informaçẽos do consultor');
        }
    }

    public function destroy(string $id)
    {

        $consultores = $this->consultores->find($id);

        if ($consultores->count() >= 1) {
            $consultores->delete();

            $consultores = $this->consultores->paginate();
            return view(self::PATH . 'consultoresShow', ['consultores' => $consultores])
                ->with('msg', 'Consultor deletado com sucesso!!!');
        } else {
            $consultores = $this->consultores->paginate();
            return view(self::PATH . 'consultoresShow', ['consultores' => $consultores])
                ->with('msg', 'ERRO! Não foi posssível deletar o consultor selecionado!');
        }
    }

    public function find(Request $request)
    {
        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        $consultores = Consultor::where($field, 'LIKE', $value . '%')->paginate(15);

        return view(self::PATH . 'consultoresShow', ['consultores' => $consultores]);
    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Consultores')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }

    }

}
