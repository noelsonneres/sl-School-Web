<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ContratosController extends Controller
{

    const PATH = 'screens.editorContrato.';
    private $contrato;

    public function __construct()
    {
        $this->contrato = new Contrato();
    }

    public function index()
    {
        
        $contrato = $this->contrato->paginate();
        
        if($contrato->count() > 0){
            return view(self::PATH.'contratosShow', ['contratos'=>$contrato]);
        }else{
            return view(self::PATH.'editorContrato');
        }

    }

    public function create()
    {
        return view(self::PATH.'editorContrato');
    }

    public function store(Request $request)
    {
        
        $contrato = $this->contrato;
        $msg = '';

        $request->validate([
            'contrato'=>'required',
        ],[
           'contrato.required'=>'Digite ou cole o seu modelo de contato no editor', 
        ]);

        try {
            
            $contrato->descricao = $request->input('descricao');
            $contrato->contrato = $request->input('contrato');         
            
            $contrato->save();

            $msg = 'SUCESSO! Contrato incluido na base de dados';
            
        } catch (\Throwable $th) {
            $$msg = 'ERRO!, Não foi possível incluir o modelo de contrato na base de dados: '
                    .$th->getMessage();
        }

        $contrato = $this->contrato->paginate();
        return view(self::PATH.'contratosShow', ['contratos'=>$contrato]);        

    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
