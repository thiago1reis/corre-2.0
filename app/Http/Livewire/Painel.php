<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Painel extends Component
{
    public $menssagem = "Bem vidos ao painel";

    public function render()
    {
        return view('livewire.painel');
    }
}
