<?php

namespace App\Providers;

 use Illuminate\Support\Facades\Gate;
use App\Models\CadastroDia;
use App\Models\CadastroHorario;
use App\Models\Sala;
use App\Models\MeiosPagamento;
use App\Policies\CadastroDiaPolicy;
use App\Policies\CadastroHorarioPolicy;
use App\Policies\MeiosPagamentoPolicy;
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

    ];
    
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
