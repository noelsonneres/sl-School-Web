<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Contrato;
use App\Models\CursosDisciplina;
use App\Models\Matricula;
use App\Models\MatriculaTurma;
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

    public function iniciarContrato(string $matriculaID)
    {

        $matriculaInfo = $this->recuperarDadosMatrícula($matriculaID);
        $matriculaTurmaInfo = $this->recuperarDadosTurmas($matriculaID);

        $contrato = $this->listaDeTags($matriculaInfo);

        return view(self::PATH . 'iniciarContrato', ['contrato' => $contrato]);
    }

    private function recuperarDadosMatrícula(string $matriculaID)
    {
        $matriculaInfo = Matricula::find($matriculaID);
        return $matriculaInfo;
    }

    private function recuperarDadosTurmas(string $matriculaID)
    {
        $matriculaTurmaInfo = MatriculaTurma::where('matriculas_id', $matriculaID)->get();
        return $matriculaTurmaInfo;
    }

    private function retornarContrato()
    {
        $contrato = $this->contrato->first();
        return $contrato;
    }

    // Procedimento para a geração do Contrato
    private function listaDeTags(Matricula $matricula)
    {

        $contrato = $this->contrato->first();

        $listadisciplinas = CursosDisciplina::with('disciplinas')->where('cursos_id', $matricula->cursos_id)->get();

        $disciplinasDoCurso = '';

        foreach ($listadisciplinas as $lista) {
            if($disciplinasDoCurso === ''){
                $disciplinasDoCurso .= $lista->disciplinas->disciplina;
            }else{
                $disciplinasDoCurso .= ', ' . $lista->disciplinas->disciplina;
            }
            
        }

        // dd($disciplinasDoCurso);

        if (!$contrato) {
            return 'Contrato não encontrado';
        }

        $modeloContrato = $contrato->contrato;

        // Define um array associativo com as variáveis e seus valores
        $variaveis = [
            '%nome_aluno%' => $matricula->alunos->nome ?? ' ',
            '%apelido_aluno%' => $matricula->alunos->apelido ?? ' ',
            '%codigo_aluno%' => $matricula->alunos->id ?? ' ',
            '%nacionalidade_aluno%' => $matricula->alunos->nacionalidade ?? ' ',
            '%rg_aluno%' => $matricula->alunos->rg ?? ' ',
            '%cpf_aluno%' => $matricula->alunos->cpf ?? ' ',
            '%data_nascimento_aluno%' => $matricula->alunos->ata_nascimento ?? ' ',
            '%data_cadastro_aluno%' => $matricula->alunos->data_cadastro ?? ' ',
            '%fobias_aluno%' => $matricula->alunos->fobias ?? ' ',
            '%alergias_aluno%' => $matricula->alunos->alergias ?? ' ',
            '%deficiencias_aluno%' => $matricula->alunos->deficiencias ?? ' ',
            '%outros_aspectos_aluno%' => $matricula->alunos->outros_aspectos ?? ' ',
            '%endereco_aluno%' => $matricula->alunos->endereco ?? ' ',
            '%bairro_aluno%' => $matricula->alunos->bairro ?? ' ',
            '%numero_aluno%' => $matricula->alunos->numero ?? ' ',
            '%complemento_aluno%' => $matricula->alunos->complemento ?? ' ',
            '%cep_aluno%' => $matricula->alunos->cep ?? ' ',
            '%cidade_aluno%' => $matricula->alunos->cidade ?? ' ',
            '%estado_aluno%' => $matricula->alunos->estado ?? ' ',
            '%telefone_aluno%' => $matricula->alunos->telefone ?? ' ',
            '%celular_aluno%' => $matricula->alunos->celular ?? ' ',
            '%email_aluno%' => $matricula->alunos->email ?? ' ',
            '%estado_civil_aluno%' => $matricula->alunos->estado_civil ?? ' ',
            '%profissao_aluno%' => $matricula->alunos->profissao ?? ' ',
            '%nome_mae_aluno%' => $matricula->alunos->nome_mae ?? ' ',
            '%rg_mae_aluno%' => $matricula->alunos->rg_mae ?? ' ',
            '%cpf_mae_aluno%' => $matricula->alunos->cpf_mae ?? ' ',
            '%nome_pai_aluno%' => $matricula->alunos->nome_pai ?? ' ',
            '%rg_pai_aluno%' => $matricula->alunos->rg_pai ?? ' ',
            '%cpf_pai_aluno%' => $matricula->alunos->cpf_pai ?? ' ',

            '%nome_responsavel%' => $matricula->responsaveis->nome ?? ' ',
            '%codigo_responsavel%' => $matricula->responsaveis->id ?? ' ',
            '%apelido_responsavel%' => $matricula->responsaveis->apelido ?? ' ',
            '%data_nascimento_responsavel%' => $matricula->responsaveis->data_nascimento ?? ' ',
            '%data_cadastro_responsavel%' => $matricula->responsaveis->data_cadastro ?? ' ',
            '%rg_responsavel%' => $matricula->responsaveis->rg ?? ' ',
            '%cpf_responsavel%' => $matricula->responsaveis->cpf ?? ' ',
            '%endereco_responsavel%' => $matricula->responsaveis->endereco ?? ' ',
            '%bairro_responsavel%' => $matricula->responsaveis->bairro ?? ' ',
            '%numero_responsavel%' => $matricula->responsaveis->numero ?? ' ',
            '%complemento_responsavel%' => $matricula->responsaveis->complemento ?? ' ',
            '%cep_responsavel%' => $matricula->responsaveis->cep ?? ' ',
            '%cidade_responsavel%' => $matricula->responsaveis->cidade ?? ' ',
            '%estado_responsavel%' => $matricula->responsaveis->estado ?? ' ',
            '%telefone_responsavel%' => $matricula->responsaveis->telefone ?? ' ',
            '%celular_responsavel%' => $matricula->responsaveis->celular ?? ' ',
            '%email_responsavel%' => $matricula->responsaveis->email ?? ' ',
            '%estado_civil_responsavel%' => $matricula->responsaveis->estado_civil ?? ' ',
            '%profissao_responsavel%' => $matricula->responsaveis->profissao ?? ' ',

            '%matricula%' => $matricula->id ?? ' ',
            '%curso_matricula%' => $matricula->cursos->curso ?? ' ',
            '%curso_codigo%'=>$matricula->cursos->id ?? ' ',
            '%curso_duracao_matricula%' => $matricula->cursos->duracao_meses ?? ' ',
            '%curso_carga_horaria_matricula%' => $matricula->cursos->carga_horaria ?? ' ',
            '%curso_disciplinas_matricula%'=>$disciplinasDoCurso ?? ' ',
            '%qtde_parcelas_matricula%'=>$matricula->qtde_parcela ?? ' ',
            '%valor_a_vista_matricula%'=>'R$ '.number_format($matricula->valor_a_vista, 2, ',', '.') ?? ' ',
            '%valor_com_desconto_matricula%'=>'R$ '.number_format($matricula->valor_com_desconto, 2, ',', '.') ?? ' ',
            '%valor_parcelado_matricula%'=>'R$ '.number_format($matricula->valor_parcelado, 2, ',', '.') ?? ' ',
            '%valor_por_parcela_matricula%'=>'R$ '.number_format($matricula->valor_por_parcela, 2, ',', '.') ?? ' ',
            '%vencimento_matricula%'=>$matricula->vencimento ?? ' ',
            '%valor_matricula_matricula%'=>'R$ '.number_format($matricula->valor_matricula, 2, ',', '.') ?? ' ',
            '%vencimento_matricula_matricula%'=>$matricula->vencimento_matricula ?? ' ',
            '%data_inicio_matricula%'=>$matricula->data_inicio ?? ' ',
            '%data_termino_matricula%'=>$matricula->data_termino ?? ' ',
            '%horas_semana_matricula%'=>$matricula->horas_semana ?? ' ',
            '%status_matricula%'=>$matricula->status ?? ' ',



            // ... Adicione outras variáveis aqui
        ];

        // Substitui as variáveis no modelo de contrato
        $contratoAluno = str_replace(array_keys($variaveis), array_values($variaveis), $modeloContrato);

        return $contratoAluno;
    }
}
