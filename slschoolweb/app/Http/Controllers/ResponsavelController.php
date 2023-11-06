<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
use Illuminate\Http\Request;

class ResponsavelController extends Controller
{
  
    const PATH = 'screens.alunos.responsavel.';
    private $responsavel;
    public function __construct()
    {
        $this->responsavel = new Responsavel();
    }


    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        
        $responsavel = $this->responsavel->where('id_aluno', $id);

        if($responsavel->count() >= 1){
            //Caso já exista algum responsável cadastrado
        }else{
            return view(self::PATH.'responsavelCreate');
        }

    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id) 
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function adicionar(string $idAluno, string $nomeAluno){
     
        $responsavel = $this->responsavel->where('id_aluno', $idAluno);

        if($responsavel->count() >= 1){
            //Caso já exista algum responsável cadastrado
        }else{
            return view(self::PATH.'responsavelCreate')
                            ->with('idAluno', $idAluno)
                            ->with('nomeAluno', $nomeAluno);
        }        
        
    }

}
