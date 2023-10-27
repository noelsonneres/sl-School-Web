<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\CadastroDiasController;
use App\Http\Controllers\CadastroHorariosController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\MeiosPagamentosController;
use App\Http\Controllers\ConfigMenalidadesController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\ProfessoresController; 

Route::get('/', function () {
    return view('home');
});

Route::resource('dias', CadastroDiasController::class);
Route::get('/dia_pesquisar', [CadastroDiasController::class, 'find']);

Route::resource('horarios', CadastroHorariosController::class);

Route::resource('salas', SalasController::class);
Route::get('/sala_pesquisar', [SalasController::class, 'find']);

Route::resource('meios_pagamentos', MeiosPagamentosController::class);

Route::resource('config_mensalidades', ConfigMenalidadesController::class);

Route::resource('empresa', EmpresaController::class);

Route::resource('disciplinas', DisciplinasController::class);
Route::get('/disciplinas_pesquisar', [DisciplinasController::class, 'find']);

Route::resource('professores', ProfessoresController::class);