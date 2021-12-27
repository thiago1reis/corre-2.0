<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Alunos extends Component
{

    public $menssagem = "Pagina do aluno";

    public function render()
    {
        return view('livewire.alunos');
    }
}
