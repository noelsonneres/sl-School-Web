<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\NivelAcesso;

class NivelAcessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nivel_acessos')->insert(
            [
                'users_id' => 1,
                'recurso' => 'Nível de acesso',
                'permitido' => 'sim',
            ]
        );

        DB::table('nivel_acessos')->insert(
            [
                'users_id' => 1,
                'recurso' => 'Cadastro de usuários',
                'permitido' => 'sim',
            ]
        );
    }
}
