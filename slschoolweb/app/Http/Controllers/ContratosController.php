<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ContratosController extends Controller
{

    const PATH = 'screens.editorContrato.';
    private $contrato;

    public function __construct()
    {
        $this->contrato = new Contrato();
    }

    public function index()
    {

        $contrato = $this->contrato->paginate();

        if ($contrato->count() > 0) {
            return view(self::PATH . 'contratosShow', ['contratos' => $contrato]);
        } else {
            return view(self::PATH . 'editorContrato');
        }
    }

    public function create()
    {
        return view(self::PATH . 'editorContrato');
    }

    public function store(Request $request)
    {

        $contrato = $this->contrato;
        $msg = '';

        $request->validate([
            'contrato' => 'required',
            'descricao' => 'required|min:3|max:100',
        ], [
            'contrato.required' => 'Digite ou cole o seu modelo de contato no editor',
            'descricao.required' => 'Digite um valor valido para o campo Descrição',
            'descricao.min' => 'O campo Descrição deve ter no minímo de três caracteres',
            'descricao.max' => 'O campo Descrição deve ter no máximo três caracteres',
        ]);

        try {

            $contrato->descricao = $request->input('descricao');
            $contrato->contrato = $request->input('contrato');

            $contrato->save();

            $msg = 'SUCESSO! Contrato incluido na base de dados';
        } catch (\Throwable $th) {
            $$msg = 'ERRO!, Não foi possível incluir o modelo de contrato na base de dados: '
                . $th->getMessage();
        }

        $contrato = $this->contrato->paginate();
        return view(self::PATH . 'contratosShow', ['contratos' => $contrato])
            ->with('msg', $msg);;
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $contrato = $this->contrato->find($id);
        return view(self::PATH . 'contratosEdit', ['contrato' => $contrato]);
    }

    public function update(Request $request, string $id)
    {

        $contrato = $this->contrato->find($id);
        $msg = '';

        $request->validate([
            'contrato' => 'required',
            'descricao' => 'required|min:3|max:100',
        ], [
            'contrato.required' => 'Digite ou cole o seu modelo de contato no editor',
            'descricao.required' => 'Digite um valor valido para o campo Descrição',
            'descricao.min' => 'O campo Descrição deve ter no minímo de três caracteres',
            'descricao.max' => 'O campo Descrição deve ter no máximo três caracteres',
        ]);

        try {

            $contrato->descricao = $request->input('descricao');
            $contrato->contrato = $request->input('contrato');

            $contrato->save();

            $msg = 'SUCESSO! Informações do contrato atualizadas com sucesso!';
        } catch (\Throwable $th) {
            $$msg = 'ERRO!, Não foi possível atualizar as informações do contrato: '
                . $th->getMessage();
        }

        $contrato = $this->contrato->paginate();
        return view(self::PATH . 'contratosShow', ['contratos' => $contrato])
            ->with('msg', $msg);
    }

    public function destroy(string $id)
    {

        $contrato = $this->contrato->find($id);
        $msg = '';

        if ($contrato != null) {

            try {
                $contrato->delete();
                $msg = 'SUCESSO! Contrato excluido com sucesso!';
            } catch (\Throwable $th) {
                $msg = 'ATENÇÃO! Não foi possível exluir o contrato selecionado: ' . $th->getMessage();
            }
        } else {
            $msg = 'ERRO! Não foi possível localzar o contrato par exclusão';
        }

        $contrato = $this->contrato->paginate();
        return view(self::PATH . 'contratosShow', ['contratos' => $contrato])
            ->with('msg', $msg);
    }

    private function recuperarDadosAluno(string $alunoID){

    }

    private function recuperarDadosResponsavel(string $alunoID){

    }

    private function recuperarDadosMatrícula(string $matriculaID){
        
    }

}
