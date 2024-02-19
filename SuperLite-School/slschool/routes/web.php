<?php

use App\Http\Controllers\DiasAulasController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorariosAulasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalaAulasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('screens.login.login');
});

Route::post('/login', [LoginController::class, 'login'])->name('login.login');
Route::get('login_index', [LoginController::class, 'index'])->name('login.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('index', [HomeController::class, 'index']);

Route::resource('users', UserController::class);
Route::get('/user_search', [UserController::class, 'search']);

Route::resource('diasAula', DiasAulasController::class);
Route::get('/dias_search', [DiasAulasController::class, 'search']);

Route::resource('horarioAula', HorariosAulasController::class);

Route::resource('salasAulas', SalaAulasController::class);
Route::get('/salasAulas_search', [SalaAulasController::class, 'search']);

Route::resource('disciplinas', DisciplinasController::class);
Route::get('/disciplinas_search',[DisciplinasController::class, 'search']);
