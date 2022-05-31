<?php

namespace App\Http\Livewire;

use App\Models\Aluno;
use Exception;
use Livewire\Component;

class Alunos extends Component
{
    /*--------------------------------------------------------------------------
    | Definição de atributos
    |--------------------------------------------------------------------------*/
    public $nome; 
    public $matricula; 
    public $data_nascimento;
    public $sexo;
    public $telefone;
    public $email;
    public $responsavel;
    public $telefone_responsavel;
    public $observacao;

    /*--------------------------------------------------------------------------
    | Definição das validações
    |--------------------------------------------------------------------------*/
    protected $rules = [
        'nome' => 'required',
        'matricula' => 'required',
        'data_nascimento' => 'required',
        'sexo' => 'required'
    ];

    /*--------------------------------------------------------------------------
    | Renderiza a página
    |--------------------------------------------------------------------------*/
    public function render()
    {
        $alunos = Aluno::get();
        return view('livewire.alunos', ['alunos' => $alunos]);
    }

    /*--------------------------------------------------------------------------
    | Adiciona aluno no banco de dados
    |--------------------------------------------------------------------------*/
    public function store()
    {
        //Valida os campos Obrigatórios
        $this->validate();
       
        //Verifica se a matrícula informada já existe.
        if(Aluno::where('matricula', $this->matricula)->exists()){
            return session()->flash('attention', 'Essa matrícula já pertence a outro aluno.');     
        }

        //Salva os dados.
        try{
            Aluno::create([
                'nome' => $this->nome,
                'matricula' => $this->matricula,
                'data_nascimento' => $this->data_nascimento,
                'sexo' => $this->sexo,
                'telefone' => $this->telefone,
                'email' => $this->email,
                'responsavel' => $this->responsavel,
                'telefone_responsavel' => $this->telefone_responsavel,
                'observacao' => $this->observacao
            ]);  
            session()->flash('success', 'Aluno foi adicionado com sucesso.');
            //Limpa os campos
            $this->nome = "";
            $this->matricula = '';
            $this->data_nascimento = '';
            $this->sexo = '';
            $this->telefone = '';
            $this->email = '';
            $this->responsavel = '';
            $this->telefone_responsavel = '';
            $this->observacao = '';
         }catch(Exception $e){
           session()->flash('error', 'Não foi possível salvar os dados.');
         }
    }
}
