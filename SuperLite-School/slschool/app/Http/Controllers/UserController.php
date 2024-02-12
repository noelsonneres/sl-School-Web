<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    const PATH = 'screens.user.';
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $user = $this->user->paginate();
        return view(self::PATH . 'userShow', ['users' => $user]);
    }

    public function create()
    {
        $estados = $this->listaEstados();
        return view(self::PATH . 'userCreate', ['estados'=>$estados]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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

    private function listaEstados()
    {
        return $estados = array(
            "Acre" => "AC",
            "Alagoas" => "AL",
            "Amapá" => "AP",
            "Amazonas" => "AM",
            "Bahia" => "BA",
            "Ceará" => "CE",
            "Distrito Federal" => "DF",
            "Espírito Santo" => "ES",
            "Goiás" => "GO",
            "Maranhão" => "MA",
            "Mato Grosso" => "MT",
            "Mato Grosso do Sul" => "MS",
            "Minas Gerais" => "MG",
            "Pará" => "PA",
            "Paraíba" => "PB",
            "Paraná" => "PR",
            "Pernambuco" => "PE",
            "Piauí" => "PI",
            "Rio de Janeiro" => "RJ",
            "Rio Grande do Norte" => "RN",
            "Rio Grande do Sul" => "RS",
            "Rondônia" => "RO",
            "Roraima" => "RR",
            "Santa Catarina" => "SC",
            "São Paulo" => "SP",
            "Sergipe" => "SE",
            "Tocantins" => "TO"
        );
    }
}
