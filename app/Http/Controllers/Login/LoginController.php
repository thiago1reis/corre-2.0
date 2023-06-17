<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('login');
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
