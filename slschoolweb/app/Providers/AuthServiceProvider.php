<?php

namespace App\Providers;

 use App\Models\ConfigMensalidade;
 use App\Policies\ConfigMensalidadePolicy;
 use Illuminate\Support\Facades\Gate;
use App\Models\CadastroDia;
use App\Models\CadastroHorario;
use App\Models\Consultor;
use App\Models\Disciplina;
use App\Models\Sala;
use App\Models\MeiosPagamento;
use App\Models\Empresa;
use App\Models\Professor;
use App\Models\ProfessorDisciplina;
use App\Policies\CadastroDiaPolicy;
use App\Policies\CadastroHorarioPolicy;
use App\Policies\ConsultorPolicy;
use App\Policies\DisciplinaPolicy;
use App\Policies\EmpresaPolicy;
use App\Policies\MeiosPagamentoPolicy;
use App\Policies\ProfessorDisciplinaPolicy;
use App\Policies\ProfessorPolicy;
use App\Policies\SalaPolicy;
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

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
