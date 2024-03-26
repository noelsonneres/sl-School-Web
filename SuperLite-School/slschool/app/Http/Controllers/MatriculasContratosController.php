<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Empresa;
use App\Models\Matricula;
use App\Models\MatriculaDisciplina;
use App\Models\MatriculaTurma;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;

class MatriculasContratosController extends Controller
{
    const PATH = 'screens.matricula.contrato.';
    private $contratos;

    public function __construct()
    {
        $this->contratos = new Contrato();
    }

    public function index(string $matriculaID)
    {
        $contrato = $this->contratos->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();
        $matricula = Matricula::find($matriculaID);
        return view(self::PATH . 'contratosLista', ['contratos' => $contrato, 'matricula' => $matricula]);
    }

    public function gerarContrato(string $matriculaID, string $contratoID)
    {

        $turmas = $this->retornarTurmas($matriculaID);
        $contrato = $this->retornarContrato($contratoID);
        $disciplinas = $this->retornarDsiciplinas($matriculaID);

        $empresa = Empresa::find(auth()->user()->empresas_id);

        $matricula = Matricula::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->where('id', $matriculaID)
            ->first();

        $informacoesTurmas = '';
        $turma = '';
        $dias = '';
        $horarios = '';
        $salas = '';
        $sala = '';
        $turnos = '';
        $professores = '';
        $disciplinasDoCurso = '';

        foreach ($turmas as $lista) {

            $turmas .= $lista->turmas->turma . ', ';
            $dias .= $lista->turmas->dias_aulas->dia . ', ';
            $horarios .= $lista->turmas->horarios_aulas->entrada . ' ' . $lista->turmas->horarios_aulas->saida . ', ';
            $salas .= $lista->turmas->salas_aulas->sala . ', ';
            $turnos .= $lista->turmas->turno;
            $professores .= $lista->turmas->professor->nome ?? '';

            $informacoesTurmas .= ' Turma: ' . $lista->turmas->turma . ', ';
            $informacoesTurmas .= 'Dias de aulas: ' . $lista->turmas->dias_aulas->dia . ', ';
            $informacoesTurmas .= 'Horários: ' . $lista->turmas->horarios_aulas->entrada . ' ' . $lista->turmas->horarios_aulas->saida . ', ';
            $informacoesTurmas .= 'Sala: ' . $lista->turmas->salas_aulas->sala . ', ';
            $informacoesTurmas .= 'Turno: ' . $lista->turmas->turno . ';';
        }

        foreach ($disciplinas as $lista) {
            if ($disciplinasDoCurso === '') {
                $disciplinasDoCurso .= $lista->disciplinas->disciplina;
            } else {
                $disciplinasDoCurso .= ', ' . $lista->disciplinas->disciplina;
            }
        }

        if (!$contrato) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Contrato não localizado!']);
        }

        $modeloContrato = $contrato->contrato;

        // prepara as informações do contrato
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
            '%curso_codigo%' => $matricula->cursos->id ?? ' ',
            '%curso_duracao_matricula%' => $matricula->cursos->duracao ?? ' ',
            '%curso_carga_horaria_matricula%' => $matricula->cursos->carga_horaria ?? ' ',
            '%curso_disciplinas_matricula%' => $disciplinasDoCurso ?? ' ',
            '%qtde_parcelas_matricula%' => $matricula->qtde_parcelas ?? ' ',
            '%valor_a_vista_matricula%' => 'R$ ' . number_format($matricula->valor_a_vista, 2, ',', '.') ?? ' ',
            '%valor_com_desconto_matricula%' => 'R$ ' . number_format($matricula->valor_com_desconto, 2, ',', '.') ?? ' ',
            '%valor_parcelado_matricula%' => 'R$ ' . number_format($matricula->valor_parcelado, 2, ',', '.') ?? ' ',
            '%valor_por_parcela_matricula%' => 'R$ ' . number_format($matricula->valor_por_parcela, 2, ',', '.') ?? ' ',
            '%vencimento_matricula%' => $matricula->vencimento ?? ' ',
            '%valor_matricula_matricula%' => 'R$ ' . number_format($matricula->valor_matricula, 2, ',', '.') ?? ' ',
            '%vencimento_matricula_matricula%' => $matricula->vencimento_matricula ?? ' ',
            '%data_inicio_matricula%' => $matricula->data_inicio ?? ' ',
            '%data_termino_matricula%' => $matricula->data_termino ?? ' ',
            '%previsao_termino_matricula%' => $matricula->previsao_termino,
            '%horas_semana_matricula%' => $matricula->horas_semana ?? ' ',
            '%status_matricula%' => $matricula->ativo ?? ' ',

            '%informacoes_turna%' => $informacoesTurmas,
            '%turma_matricula%' => $turmas,
            '%turma_dias_matricula%' => $dias,
            '%Turma_horarios_matricula%' => $horarios,
            '%Turma_sala_matricula%' => $salas,
            '%turma_turno_matricula%' => $turnos,
            '%turma_professor_matricula%' => $professores,

            '%nome_empresa%' => $empresa->nome,
            '%razao_social%' => $empresa->razao_social,
            '%cnpj%' => $empresa->cnpj,
            '%telefone_empresa%' => $empresa->telefone,
            '%celular_empresa%' => $empresa->celular,
            '%email_empresa%' => $empresa->email,
            '%endereco_empresa%' => $empresa->endereco,
            '%bairro_empresa%' => $empresa->bairro,
            '%numero_empresa%' => $empresa->numero,
            '%complemento_empresa%' => $empresa->complemento,
            '%cep_empersa%' => $empresa->cep,
            '%cidade_empresa%' => $empresa->cidade,
            '%estado_empresa%' => $empresa->estado,

        ];

        $contratoAluno = str_replace(array_keys($variaveis), array_values($variaveis), $modeloContrato);

        return view(self::PATH . 'impressaoContrato', ['contratoAluno' => $contratoAluno, 'matricula'=>$matricula]);
    }

    // ========================================================================
    // Metodos private
    private function retornarContrato(string $contratoID)
    {
        $contrato = $this->contratos->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->where('id', $contratoID)
            ->first();
        return $contrato;
    }

    private function retornarTurmas(string $matricula)
    {

        $turmas = MatriculaTurma::where('matriculas_id', $matricula)->get();
        return $turmas;
    }

    private function retornarDsiciplinas(string $matriculaID)
    {
        return $disciplinas = MatriculaDisciplina::where('Matriculas_id', $matriculaID)->get();
    }
}
