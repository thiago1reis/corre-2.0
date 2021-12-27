<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     /*--------------------------------------------------------------------------
    | Efetua o login
    |--------------------------------------------------------------------------*/
    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($credentials)){
            if(Auth::user()->status == 1){
                return redirect()->route('painel');
            }
            return redirect()->back()->with('attention', 'Seu usuário está desativado temporariamente.');
        }
        return redirect()->back()->withErrors(['Falha ao autenticar!']);
    }

    /*--------------------------------------------------------------------------
    | Verifica se foi feito o login e entra no painel administativo
    |--------------------------------------------------------------------------*/
    public function painel(){
        if(Auth::check() === true){
            return redirect()->route('painel');
        }
        return redirect()->route('home');
    }




}
