<?php

namespace App\Http\Livewire;

use App\Models\Aluno;
use Livewire\Component;

class Alunos extends Component
{
    public $nome; 
    public $matricula; 
    public $data_nascimento;
    public $sexo;
    public $telefone;
    public $email;
    public $responsavel;
    public $telefone_responsavel;
    public $observacao;

    protected $rules = [
        'nome' => 'required',
        'matricula' => 'required',
        'data_nascimento' => 'required',
        'sexo' => 'required'
    ];

    public function render()
    {
        $alunos = Aluno::get();
        return view('livewire.alunos', ['alunos' => $alunos]);
    }

    public function create()
    {
        $this->validate();
        Aluno::create([
            'nome' =>  $this->nome,
            'matricula' =>  $this->matricula,
            'data_nascimento' =>  $this->data_nascimento,
            'sexo' =>  $this->sexo,
            'telefone' =>  $this->telefone,
            'email' =>  $this->email,
            'responsavel' =>  $this->responsavel,
            'telefone_responsavel' =>  $this->telefone_responsavel,
            'observacao' =>  $this->observacao
        ]);  
        session()->flash('success', 'Aluno foi adicionado com sucesso.');
        return redirect()->to('/sistema/alunos');
    }
}
