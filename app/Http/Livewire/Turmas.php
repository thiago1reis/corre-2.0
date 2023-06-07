<?php

namespace App\Http\Livewire;

use App\Models\Turma;
use Livewire\Component;

class Turmas extends Component
{
    public Turma $turma;
    public $acao;


    /**
     * rules
     *
     * @return array As regras de validação para o formulário de cadastar turmas.
     */
    protected  function rules()
    {
        return [
            'turma.etapa_modalidade' => 'required',
            'turma.modulo_serie' => 'required',
            'turma.curso' => 'required',
            'turma.observacao' => 'max:255',
        ];
    }


    /**
     * mount
     *
     * @param  Turma $turma
     * @return void
     */
    public function mount(Turma $turma)
    {
        $this->turma = $turma;
    }


    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $this->validate();
        $this->turma->etapa_modalidade =  $this->turma->etapa_modalidade;
        $this->turma->modulo_serie =  $this->turma->modulo_serie;
        $this->turma->curso =  $this->turma->curso;
        $this->turma->observacao =  $this->turma->observacao;
        $this->turma->save();
        return redirect()->route('turma.index')->with('success', 'Dados da turma foram salvos com sucesso!');
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        if ($this->turma->id) {
            $this->acao = 'Editar Turma';
        } else {
            $this->acao = 'Adicionar Turma';
        }
        return view('turma.modal-salvar-turma');
    }
}
