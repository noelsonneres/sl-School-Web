<?php

namespace App\Http\Controllers;

use App\Models\ConfCarteira;
use Illuminate\Http\Request;

class ConfCarteiraController extends Controller
{

    const PATH = 'screens.confCarteira.';
    private $conf;

    public function __construct()
    {
        $this->conf = new ConfCarteira();
    }

    public function index()
    {

        $confCarteira = $this->conf->all()->first();

        if ($confCarteira != null){
            return view(self::PATH.'configurarCarteiraEdit', ['conf'=>$confCarteira]);
        }else{
            return view(self::PATH.'configurarCarteiraCreate');
        }

    }

    public function create()
    {
        //
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
}
