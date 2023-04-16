<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    //Efetua login do usuário
    public function login(){

        //Valida campos obirgatórios
         $this->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        //Inicia a seção se existir o usuário
        if(Auth::attempt(['email' => $this->email,'password' => $this->password]))
        {
            //Redireciona ao painel se usuário estiver ativo
            if(Auth::user()->status == 1){
                return redirect()->route('painel');
            }

            //Encerra seção se usuário não estiver ativo
            Auth::logout();
            $this->addError('email', 'Seu usuário está desativado temporariamente.');
            return false;
        }

        $this->addError('email', 'Usuário não encontrado');
        return false;
    }

    //Renderiza a página de login
    public function render()
    {
        return view('login.fomulario-login');
    }
}
