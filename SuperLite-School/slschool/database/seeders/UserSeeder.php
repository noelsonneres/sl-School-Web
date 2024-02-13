<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'admin',
            'user_name'=>'admin',
            'email'=>'admin@slschool.com.br',
            'password'=>bcrypt('123456'),
            'ativo'=>'1',
            'empresas_id'=>'1',
            'empresas_cnpj'=>'21.921.379/0001-42',
            'deletado'=>'nao',
        ]);        
    }
}
