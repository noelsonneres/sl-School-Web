<?php

namespace App\Policies;

use App\Models\CadastroDia;
use App\Models\NivelAcesso;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Redirect;

class CadastroDiaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): Response
    {

        $usuario = $user->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Cad.Dias')
            ->where('permitido', 'sim')
            ->get();

            return $nivelAcesso->count() >= 1
                ? Response::allow()
                : Response::deny('Você não possuir acesso a este recurso. Clique no botão voltar do seu navegador');

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CadastroDia $cadastroDia): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CadastroDia $cadastroDia): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CadastroDia $cadastroDia): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CadastroDia $cadastroDia): bool
    {
        //
    }

    private function redirecionar()
    {
        return view('screens/acessoNegado/acessoNegado');
    }

}
