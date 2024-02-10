<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        DB::table('empresas')->insert([
           'nome'=>'Sl-School',
           'nome_login'=>'Sl-School Matriz',
           'cnpj'=>'21.921.379/0001-42',
        ]);
    }
}
