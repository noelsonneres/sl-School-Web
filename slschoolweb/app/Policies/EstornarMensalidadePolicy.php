<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\NivelAcesso;

class EstornarMensalidadePolicy
{

    public function view(User $user): Response
    {

        $usuario = $user->id;
        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Estornar mensalidade')
            ->where('permitido', 'sim')
            ->get();

        return $nivelAcesso->count() >= 1
            ? Response::allow()
            : Response::deny('Você não possuir acesso a este recurso. Clique no botão voltar do seu navegador');
    }

    public function show(User $user): bool
    {
        $usuario = $user->id;
        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Estornar mensalidade')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return true;
        } else {
            return false;;
        }
    }    

}
