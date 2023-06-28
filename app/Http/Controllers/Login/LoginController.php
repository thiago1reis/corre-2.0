<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * index
     *
     * @param  Request $request
     * @return void
     */
    public function logar(Request $request)
    {

        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {

            if (Auth::user()->status == 1) {
                return redirect()->route('painel');
            }

            Auth::logout();

            return redirect()->back()->withInput()->with('attention', 'Seu usuário está desativado temporariamente.');
        }

        return redirect()->back()->withInput()->with('error', 'Usuário não encontrado');
    }


    /**
     * checkAuth
     *
     * @return void
     */
    public function checkAuth()
    {
        if(Auth::check() === true){
            return redirect()->route('painel');
        }
        return redirect()->route('login')->with('attention', 'Faça login para continuar.');
    }


    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
