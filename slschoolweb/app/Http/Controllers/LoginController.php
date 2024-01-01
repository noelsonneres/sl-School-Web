<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){

        if (Auth::viaRemember()) {
            return redirect()->intended('/home');
        }else{
            return view('screens.login.login');
        }

    }

    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['user_name' => $username, 'password' => $password, 'ativo' => 1])) {
            $request->session()->regenerate();
            return redirect()->intended('/home', ['teste'=>'teste']);
            // return view('/home');
        }else{
            return redirect()->back()->withErrors([
                'error' => 'Usuário ou Senha incorretos. Tente novamente!',
            ])->onlyInput('email');      
        }

        return redirect()->back()->withErrors([
            'error' => 'Não foram encontrados registros. Verifique o nome de usuário e senha!',
        ])->onlyInput('email');        

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');

    }
}
