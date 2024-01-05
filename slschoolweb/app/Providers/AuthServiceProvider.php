<?php

namespace App\Providers;

use App\Models\Aluno;
use App\Models\ConfigMensalidade;
 use App\Policies\ConfigMensalidadePolicy;
 use Illuminate\Support\Facades\Gate;
use App\Models\CadastroDia;
use App\Models\CadastroHorario;
use App\Models\Consultor;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Sala;
use App\Models\MeiosPagamento;
use App\Models\Empresa;
use App\Models\Frequencia;
use App\Models\MateriaisEscolar;
use App\Models\MatriculaCancelamento;
use App\Models\MatriculaFinalizar;
use App\Models\MatriculaReativar;
use App\Models\MatriculaTrancamento;
use App\Models\MotivoCancelamento;
use App\Models\Professor;
use App\Models\ProfessorDisciplina;
use App\Models\Reposicao;
use App\Models\Turma;
use App\Policies\AlunoPolicy;
use App\Policies\CadastroDiaPolicy;
use App\Policies\CadastroHorarioPolicy;
use App\Policies\ConsultorPolicy;
use App\Policies\CursoPolicy;
use App\Policies\DisciplinaPolicy;
use App\Policies\EmpresaPolicy;
use App\Policies\FrequenciaPolicy;
use App\Policies\MateriaisEscolarPolicy;
use App\Policies\MatriculaCancelamentoPolicy;
use App\Policies\MatriculaFinalizarPolicy;
use App\Policies\MatriculaReativarPolicy;
use App\Policies\MatriculaTrancamentoPolicy;
use App\Policies\MeiosPagamentoPolicy;
use App\Policies\MotivoCancelamentoPolicy;
use App\Policies\ProfessorDisciplinaPolicy;
use App\Policies\ProfessorPolicy;
use App\Policies\ReposicaoPolicy;
use App\Policies\SalaPolicy;
use App\Policies\TurmaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        CadastroDia::class => CadastroDiaPolicy::class,
        CadastroHorario::class => CadastroHorarioPolicy::class,
        Sala::class => SalaPolicy::class,
        MeiosPagamento::class => MeiosPagamentoPolicy::class,
        ConfigMensalidade::class => ConfigMensalidadePolicy::class,
        Empresa::class => EmpresaPolicy::class,
        Disciplina::class => DisciplinaPolicy::class,
        Professor::class => ProfessorPolicy::class,
        ProfessorDisciplina::class => ProfessorDisciplinaPolicy::class,
        Consultor::class => ConsultorPolicy::class,
        Curso::class => CursoPolicy::class,
        MateriaisEscolar::class => MateriaisEscolarPolicy::class,
        Turma::class => TurmaPolicy::class,
        MotivoCancelamento::class => MotivoCancelamentoPolicy::class,
        Aluno::class => AlunoPolicy::class,
        Frequencia::class => FrequenciaPolicy::class,
        Reposicao::class => ReposicaoPolicy::class,
        MatriculaTrancamento::class => MatriculaTrancamentoPolicy::class,
        MatriculaCancelamento::class => MatriculaCancelamentoPolicy::class,
        MatriculaFinalizar::class => MatriculaFinalizarPolicy::class,
        MatriculaReativar::class => MatriculaReativarPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
