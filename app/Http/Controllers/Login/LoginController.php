<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Verifica se foi feito o login e entra no painel administativo
    public function checkAuth(){
        if(Auth::check() === true){
            return redirect()->route('painel');
        }
        return redirect()->route('login')->with('attention-login', 'Faça login para continuar.');
    }

    //Efetua o logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
