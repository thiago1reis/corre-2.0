<?php

namespace App\Http\Livewire;

use App\Models\Turma;
use Livewire\Component;

class Turmas extends Component
{
    public Turma $turma;
    public $acao;

    public function mount(Turma $turma)
    {
        $this->turma = $turma;
    }


    public function render()
    {

        return view('turma.modal-salvar-turma');
    }
}
