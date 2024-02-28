<?php

namespace App\Http\Controllers;

use App\Models\MaterialEscolar;
use DateTime;
use Illuminate\Http\Request;

class MateriaisEscolaresController extends Controller
{

    const PATH = 'screens.material.';
    private $material;

    public function __construct()
    {
        $this->material = new MaterialEscolar();
    }

    public function index()
    {
        $material = $this->material
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();
        return view(self::PATH . 'materialShow', ['materiais' => $material]);
    }

    public function create()
    {
        return view(self::PATH . 'materialCreate');
    }

    public function store(Request $request)
    {

        $materiais = $this->material;

        $request->validate([
            'material' => 'required|min:3|max:50',
            'valorUnitario' => 'required',
            'quantidade' => 'required',
            'ativo' => 'required',
        ], [
            'material.required' => 'O campo Material é obrigatório',
            'material.min' => 'O campo Material deve ter mais de três caracteres',
            'material.max' => 'O campo Material deve ter menos de 50 caracteres',
            'valorUnitario.required' => 'Informe um valor valido para o campo Valor unitário',
            'quantidade.required' => 'Informe um valor para o campo Quantidade',
            'ativo.required' => 'Informe se o material esta ativo ou não',
        ]);

        $material = $request->old('material');
        $valorUnitario = $request->old('valorUnitario');
        $quantidade = $request->old('quantidade');
        $ativo = $request->old('ativo');

        try {

            $materiais->empresas_id = auth()->user()->empresas_id;
            $materiais->material = $request->input('material');
            $materiais->descricao = $request->input('descricao');
            $materiais->valor_unitario = $request->input('valorUnitario');
            $materiais->qtde = $request->input('quantidade');
            $materiais->ativo = $request->input('ativo');
            $materiais->obs = $request->input('obs');
            $materiais->deletado = 'nao';
            $materiais->auditoria = $this->operacao('Cadatro Material');

            $materiais->save();

            $material = $this->material
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->paginate();
            return view(self::PATH . 'materialShow', ['materiais' => $material])
                        ->with('msg', 'Sucesso! Material cadastrado com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do Material']);
        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $material = $this->material->find($id);
        return view(self::PATH.'materialEdit', ['material'=>$material]);
    }

    public function update(Request $request, string $id)
    {
  $materiais = $this->material->find($id);

        $request->validate([
            'material' => 'required|min:3|max:50',
            'valorUnitario' => 'required',
            'quantidade' => 'required',
            'ativo' => 'required',
        ], [
            'material.required' => 'O campo Material é obrigatório',
            'material.min' => 'O campo Material deve ter mais de três caracteres',
            'material.max' => 'O campo Material deve ter menos de 50 caracteres',
            'valorUnitario.required' => 'Informe um valor valido para o campo Valor unitário',
            'quantidade.required' => 'Informe um valor para o campo Quantidade',
            'ativo.required' => 'Informe se o material esta ativo ou não',
        ]);

        $material = $request->old('material');
        $valorUnitario = $request->old('valorUnitario');
        $quantidade = $request->old('quantidade');
        $ativo = $request->old('ativo');

        try {

            $materiais->material = $request->input('material');
            $materiais->descricao = $request->input('descricao');
            $materiais->valor_unitario = $request->input('valorUnitario');
            $materiais->qtde = $request->input('quantidade');
            $materiais->ativo = $request->input('ativo');
            $materiais->obs = $request->input('obs');
            $materiais->deletado = 'nao';
            $materiais->auditoria = $this->operacao('Atualizou as informações');

            $materiais->save();

            $material = $this->material
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->paginate();
            return view(self::PATH . 'materialShow', ['materiais' => $material])
                        ->with('msg', 'Sucesso! As informações do material foram atualizadas com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar as informações do Material']);
        }
    }

    public function destroy(string $id)
    {
        //
    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
