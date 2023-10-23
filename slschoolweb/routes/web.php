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
use App\Models\CadastroDia;

Route::get('/', function () {
    return view('home');
});

Route::resource('dias', CadastroDiasController::class);
Route::get('/dia_pesquisar', [CadastroDiasController::class, 'find']);