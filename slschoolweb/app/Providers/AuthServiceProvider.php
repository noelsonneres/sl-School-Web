<?php

namespace App\Providers;

 use Illuminate\Support\Facades\Gate;
use App\Models\CadastroDia;
use App\Policies\CadastroDiaPolicy;
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
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
