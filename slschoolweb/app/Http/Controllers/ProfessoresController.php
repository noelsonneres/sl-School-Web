<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Nette\Utils\Finder;

class ProfessoresController extends Controller
{

    const PAHT = 'screens.professores.';
    public $professores;
    
    public function __construct()
    {
        $this->professores = new Professor();
    }

    public function index()
    {
        
        $professores = $this->professores->paginate();
        return view(self::PAHT.'professoresShow', ['professores'=>$professores]);

    }

    public function create()
    {
        
        return view(self::PAHT.'professoresCreate'); 

    }


    public function store(Request $request)
    {
        
        $professor = $this->professores;

        $request->validate([
            'nome' => 'required|min:3|max:100',
            'foto' => [
                'file',
                'image',
                'max:2048',
                'mimes:jpeg,jpg,png,gif',
            ],
        ]);

        $prof = $request->old('nome');

        try {
            
            $professor->nome = $request->input('nome');
            $professor->data_nascimento = $request->input('dataNascimento');
            $professor->cpf = $request->input('cpf');
            $professor->telefone = $request->input('telefone');
            $professor->celular = $request->input('celular');
            $professor->email = $request->input('email');
            $professor->endereco = $request->input('endereco');
            $professor->bairro = $request->input('bairro');
            $professor->numero = $request->input('numero');
            $professor->coplemento = $request->input('complemento');
            $professor->cep = $request->input('cep');
            $professor->cidade = $request->input('cidade');
            $professor->estado = $request->input('estado');            
            $professor->obs = $request->input('obs');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/professor'), $imgName);

                $professor->foto = $imgName;
            }            

            $professor->save();

            $professores = $this->professores->paginate();
            return view(self::PAHT.'professoresShow', ['professores'=>$professores])
                        ->with('msg', 'Professor cadastrado com sucesso!!!');


        } catch (\Throwable $th) {
            $professores = $this->professores->paginate();
            return view(self::PAHT.'professoresShow', ['professores'=>$professores])
                        ->with('msg', 'ERRO! Não foi pssível incluir as informações do professor!');
        }


    }

    public function show(string $id)
    {
        //        
    }

    public function edit(string $id)
    {
        
        $professor = $this->professores->find($id);
        return view(self::PAHT.'professoresEdit', ['professor'=>$professor]);        

    }

    public function update(Request $request, string $id)
    {
        
        $professor = $this->professores->find($id);

        if($professor->count() >= 1){

            $request->validate([
                'nome' => 'required|min:3|max:100',
                'foto' => [
                    'file',
                    'image',
                    'max:2048',
                    'mimes:jpeg,jpg,png,gif',
                ],
            ]);
    
            try {
                
                $professor->nome = $request->input('nome');
                $professor->data_nascimento = $request->input('dataNascimento');
                $professor->cpf = $request->input('cpf');
                $professor->telefone = $request->input('telefone');
                $professor->celular = $request->input('celular');
                $professor->email = $request->input('email');
                $professor->endereco = $request->input('endereco');
                $professor->bairro = $request->input('bairro');
                $professor->numero = $request->input('numero');
                $professor->coplemento = $request->input('complemento');
                $professor->cep = $request->input('cep');
                $professor->cidade = $request->input('cidade');
                $professor->estado = $request->input('estado');            
                $professor->obs = $request->input('obs');
    
                //upload da foto
                if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                    $requestImage = $request->file('foto');
                    $extension = $requestImage->getClientOriginalExtension();
                    $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
    
                    $requestImage->move(public_path('img/professor'), $imgName);
    
                    $professor->foto = $imgName;
                }            
    
                $professor->save();
    
                $professores = $this->professores->paginate();
                return view(self::PAHT.'professoresShow', ['professores'=>$professores])
                            ->with('msg', 'Informações do professor atualizadas com sucesso!!!');
    
    
            } catch (\Throwable $th) {
                $professores = $this->professores->paginate();
                return view(self::PAHT.'professoresShow', ['professores'=>$professores])
                            ->with('msg', 'ERRO! Não foi pssível atualizar as informações do professor!');
            }         

        }else{

            $professores = $this->professores->paginate();
            return view(self::PAHT.'professoresShow', ['professores'=>$professores])
                        ->with('msg', 'ERRO! Não foi pssível localizar o professorr!');
        }           


    }


    public function destroy(string $id)
    {
        
        $professor = $this->professores->find($id);

        if($professor->count() >= 1){
            $professor->delete();

            $professores = $this->professores->paginate();
            return view(self::PAHT.'professoresShow', ['professores'=>$professores])
                        ->with('msg', 'Professor excluido com sucesso!!!');            

        }else{
           
            $professores = $this->professores->paginate();
            return view(self::PAHT.'professoresShow', ['professores'=>$professores])
                        ->with('msg', 'ERRO! Não foi pssível localizar o professorr!');            
            
        }

    }

    public function find(Request $request){

    }

}
