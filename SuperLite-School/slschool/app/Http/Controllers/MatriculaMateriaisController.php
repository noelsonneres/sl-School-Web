<?php

namespace App\Http\Controllers;

use App\Models\MaterialEscolar;
use App\Models\Matricula;
use App\Models\MatriculaMaterial;
use App\Models\Mensalidade;
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
            $materiais->parcela_gerada = 'nao';
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

    public function gerarParcela(string $materialID)
    {
        $material = $this->material->find($materialID);
        if($material->parcela_gerada === 'sim'){
            return view(self::PATH . 'confirmarParcela', ['material' => $material]);
        }else{
            return redirect()->back()->withInput()->withErrors(['ERRO! A parcela para este material já foi gerada!']);            
        }
        
    }

    public function gerarParcelas(string $matriculaID)
    {
        // SOMAR TODOS OS VALORES DOS MATERIAIS E GERAR AS PARCELAS
    }

    public function incluirParcelas(Request $request)
    {

        $request->validate([
            'valor' => 'required',
            'qtde' => 'required',
            'vencimento' => 'required',
            'valorParcela' => 'required',
            'aluno' => 'required',
            'matricula' => 'required',
            'responsavel' => 'required',
        ], [
            'valor.required' => 'O campo Valor é obrigatório',
            'qtde.required' => 'O campo Quantidade parcelas é obrigatório',
            'vencimento.required' => 'O campo Vencimento é obrigatório',
            'valorParcela.required' => 'O campo Total por parcela é obrigatório',
            'aluno.required' => 'Selecione um aluno',
            'matricula.required' => 'Selecione uma matrícula',
            'responsavel.required' => 'Selecione um responsável',
        ]);

        $valor = $request->old('valor');
        $qtde = $request->old('qtde');
        $vencimento = $request->old('vencimento');
        $valorParcela = $request->old('valorParcela');

        $valorMaterial = $request->input('valor');
        $qtde = $request->input('qtde');
        $vencimentoMaterial = $request->input('vencimento');
        $valorParcelaMaterial = $request->input('valorParcela');
        $aluno = $request->input('aluno');
        $matricula = $request->input('matricula');
        $responsavel = $request->input('responsavel');
        $materialID = $request->input('material');

        $vencimento = new DateTime($vencimentoMaterial);

        // dd($request);

        try {

            for ($i = 0; $i < $qtde; $i++) {

                $mensalidade = new Mensalidade();

                $vencimentoMaterial = $vencimento;
                $vencimentoMaterial->modify('+' . $i . 'months');

                $mensalidade->empresas_id = auth()->user()->empresas_id;
                $mensalidade->alunos_id = $aluno;
                $mensalidade->responsavel_alunos_id = $responsavel;
                $mensalidade->matriculas_id = $matricula;
                $mensalidade->valor_parcela = $valorParcelaMaterial;
                $mensalidade->numero_mensalidade = $i + 1;
                $mensalidade->qtde_mensalidade = $qtde;
                $mensalidade->vencimento = $vencimentoMaterial;
                $mensalidade->obs = 'Mensalidade referente ao material do aluno';
                $mensalidade->auditoria = $this->operacao('Inclusão de mensalidades');

                $mensalidade->save();

            }

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível gerar as parcelas referentes aos materiais: ' . $th->getMessage()]);
        }

        $this->atualizarMateriaisEscolares($materialID);

        $material = $this->material
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->where('matriculas_id', $matricula)
            ->paginate();
        $matricula = Matricula::find($matricula);
        return view(self::PATH . 'materialShow', ['materiais' => $material, 'matricula' => $matricula])
            ->with('msg', 'parcela gerada com sucesso!');
    }

    public function atualizarMateriaisEscolares(string $materialID){
        
        $material = $this->material->find($materialID);

        try {
            $material->parcela_gerada = 'sim';
            $material->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar o status do material: ' . $th->getMessage()]);
        }

    }

}
