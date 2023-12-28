<?php

namespace App\Http\Controllers;

use App\Models\CadastroDia;
use App\Models\CadastroHorario;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\CadastroVisita;

class CadastroVisitaController extends Controller
{

    const PATH = 'screens.visitas.';
    private $visitas;

    public function __construct()
    {
        $this->visitas = new CadastroVisita();
    }

    public function index()
    {
        $visitas = $this->visitas->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'visitasShow', ['visitas'=>$visitas]);
    }

    public function create()
    {
        $cursos = Curso::all();
        $dias = CadastroDia::all();
        $horarios = CadastroHorario::all();

        return view(self::PATH.'visitasCreate', ['cursos'=>$cursos, 'dias'=>$dias, 'horarios'=>$horarios]);
    }

    public function store(Request $request)
    {

        $vistas = $this->visitas;

        $request->validate([
            'nome'=>'required|min:3|max:100',
            'celular'=>'required',
        ],[
            'nome.required'=>'Informe um valor valido para o campo Nome Completo',
            'nome.min'=>'O campo Nome Completo deve ter no mínimo três caracateres',
            'nome.max'=>'O campo Nome Completo deve ter no máximo 100 caracateres',
        ]);

        $nome = $request->old('nome');
        $celular = $request->old('celular');

//        dd($request);

        try {

            $vistas->nome = $request->input('nome');
            $vistas->telefone = $request->input('telefone');
            $vistas->celular = $request->input('celular');
            $vistas->email = $request->input('email');
            $vistas->endereco = $request->input('endereco');
            $vistas->bairro = $request->input('bairro');
            $vistas->numero = $request->input('numero');
            $vistas->complemento = $request->input('complemento');
            $vistas->cep = $request->input('cep');
            $vistas->cidade = $request->input('cidade');
            $vistas->estado = $request->input('estado');
            $vistas->retorno = $request->input('retorno');
            $vistas->situacao = $request->input('situacao');
            $vistas->grau_interesse = $request->input('grauInteresse');
            $vistas->curso_de_interesse = $request->input('curso');
            $vistas->turno = $request->input('turno');
            $vistas->dia = $request->input('dia');
            $vistas->horario = $request->input('horarios');
            $vistas->observacao = $request->input('obs');

            $vistas->save();

            $visitas = $this->visitas->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'visitasShow', ['visitas'=>$visitas])
                                        ->with('msg', 'SUCESSO! Registro cadastrado com sucesso!');

        }catch (\Throwable $th){
            $cursos = Curso::all();
            $dias = CadastroDia::all();
            $horarios = CadastroHorario::all();
            return view(self::PATH.'visitasCreate', ['cursos'=>$cursos, 'dias'=>$dias, 'horarios'=>$horarios])
                                            ->with('msg', 'ERRO! Não foi possível salvar as informações: '.$th->getMessage());
        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $visitas = $this->visitas->find($id);

        $cursos = Curso::all();
        $dias = CadastroDia::all();
        $horarios = CadastroHorario::all();

        return view(self::PATH.'visitasEdit', ['visitas'=>$visitas, 'cursos'=>$cursos, 'dias'=>$dias, 'horarios'=>$horarios]);


    }

    public function update(Request $request, string $id)
    {

        $vistas = $this->visitas->find($id);

        $request->validate([
            'nome'=>'required|min:3|max:100',
            'celular'=>'required',
        ],[
            'nome.required'=>'Informe um valor valido para o campo Nome Completo',
            'nome.min'=>'O campo Nome Completo deve ter no mínimo três caracateres',
            'nome.max'=>'O campo Nome Completo deve ter no máximo 100 caracateres',
        ]);

        $nome = $request->old('nome');
        $celular = $request->old('celular');

//        dd($request);

        try {

            $vistas->nome = $request->input('nome');
            $vistas->telefone = $request->input('telefone');
            $vistas->celular = $request->input('celular');
            $vistas->email = $request->input('email');
            $vistas->endereco = $request->input('endereco');
            $vistas->bairro = $request->input('bairro');
            $vistas->numero = $request->input('numero');
            $vistas->complemento = $request->input('complemento');
            $vistas->cep = $request->input('cep');
            $vistas->cidade = $request->input('cidade');
            $vistas->estado = $request->input('estado');
            $vistas->retorno = $request->input('retorno');
            $vistas->situacao = $request->input('situacao');
            $vistas->grau_interesse = $request->input('grauInteresse');
            $vistas->curso_de_interesse = $request->input('curso');
            $vistas->turno = $request->input('turno');
            $vistas->dia = $request->input('dia');
            $vistas->horario = $request->input('horarios');
            $vistas->observacao = $request->input('obs');

            $vistas->save();

            $visitas = $this->visitas->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'visitasShow', ['visitas'=>$visitas])
                                        ->with('msg', 'SUCESSO! Registro atualizado com sucesso!');

        }catch (\Throwable $th){
            $cursos = Curso::all();
            $dias = CadastroDia::all();
            $horarios = CadastroHorario::all();
            return view(self::PATH.'visitasEdit', ['cursos'=>$cursos, 'dias'=>$dias, 'horarios'=>$horarios])
                                            ->with('msg', 'ERRO! Não foi possível atualizar as informações: '.$th->getMessage());
        }

    }


    public function destroy(string $id)
    {
        //
    }
}
