<?php

namespace App\Http\Livewire;

use App\Models\Disciplina;
use Livewire\Component;

class Disciplinas extends Component
{
    /*--------------------------------------------------------------------------
    | Definição de atributos
    |--------------------------------------------------------------------------*/
    public $nome, $observacao;

    public $search;
    
    public function render()
    {
        $disciplinas = Disciplina::where('nome', 'LIKE', "%{$this->search}%")->Orwhere('observacao', 'LIKE', "%{$this->search}%")->orderBy('id' , "DESC")->paginate(5); 
        return view('livewire.disciplinas', ['disciplinas' => $disciplinas]);
    }
}
