<?php

namespace App\Http\Controllers;

use App\Models\MaterialEscolar;
use App\Models\Matricula;
use App\Models\MatriculaMaterial;
use DateTime;
use Illuminate\Http\Request;

class MatriculaMateriaisController extends Controller
{

    const PATH = 'screens.matricula.material.';
    private $material;

    public function __construct()
    {
        $this->material = new MatriculaMaterial();
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
        $materiais = $this->material;

        $request->validate([
            'material' => 'required',
            'valorUN' => 'required',
            'qtde' => 'required',
            'valorTotal' => 'required',
            'pago' => 'required',
        ], [
            'material.required' => 'O campoo material é obrigatório',
            'valorUN.required' => 'O campo Valor Unitário é obrigatório',
            'qtde.required' => 'O campo Quantidade é obrigatório',
            'valorTotal.required' => 'O campo Valor total é obrigatório',
            'pago.required' => 'o Campo Pago é obrigatório'
        ]);

        $material = $request->old('material');
        $valorUN = $request->old('valorUN');
        $valor = $request->old('qtde');
        $qtde = $request->old('valorTotal');
        $valorTotal = $request->old('pago');

        $matriculaID = $request->input('matricula');

        try {

            $materiais->empresas_id = auth()->user()->empresas_id;
            $materiais->matriculas_id = $request->input('matricula');
            $materiais->alunos_id = $request->input('aluno');
            $materiais->responsavel_alunos_id = $request->input('responsavel');
            $materiais->material_escolars_id = $request->input('material');
            $materiais->valor_un = $request->input('valorUN');
            $materiais->qtde = $request->input('qtde');
            $materiais->valor_total = $request->input('valorTotal');
            $materiais->pago = $request->input('pago');
            $materiais->observacao = $request->input('obs');
            $materiais->funcionario = auth()->user()->id;
            $materiais->deletado = 'nao';
            $materiais->auditoria = $this->operacao('Incluir o Material');

            $materiais->save();

            $material = $this->material
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->where('matriculas_id', $matriculaID)
                ->paginate();
            $matricula = Matricula::find($matriculaID);
            return view(self::PATH . 'materialShow', ['materiais' => $material, 'matricula' => $matricula])
                ->with('msg', 'Sucesso! O material foi incluido com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações da inclusão do material: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        $material = $this->material
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->where('matriculas_id', $id)
            ->paginate();
        $matricula = Matricula::find($id);
        return view(self::PATH . 'materialShow', ['materiais' => $material, 'matricula' => $matricula]);
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

    public function adicionarMaterial(string $matriculaID)
    {

        $matricula = Matricula::find($matriculaID);
        $listaMaterial = MaterialEscolar::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->get();

        return view(self::PATH . 'materialCreate', ['matricula' => $matricula, 'listaMaterial' => $listaMaterial]);
    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
