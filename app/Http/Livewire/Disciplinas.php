<?php

namespace App\Http\Livewire;

use Illuminate\Validation\Rule;
use App\Models\Disciplina;
use Livewire\Component;

class Disciplinas extends Component
{
    public Disciplina $disciplina;
    public $acao;

    /**
     * rules
     *
     * @return array
     */
    protected  function rules()
    {
        return [
            'disciplina.nome' => ['required', Rule::unique(Disciplina::class, 'nome')->ignore($this->disciplina)],
            'disciplina.observacao' => 'max:255',
        ];
    }


    /**
     * mount
     *
     * @param  Disciplina $turma
     * @return Disciplina
     */
    public function mount(Disciplina $disciplina)
    {
        $this->disciplina = $disciplina;
    }


    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $this->validate();
        $this->disciplina->nome =  $this->disciplina->nome;
        $this->disciplina->observacao =  $this->disciplina->observacao;
        $this->disciplina->save();
        return redirect()->route('disciplina.index')->with('success', 'Dados da disciplina foram salvos com sucesso!');
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        if ($this->disciplina->id) {
            $this->acao = 'Editar Disciplina';
        } else {
            $this->acao = 'Adicionar Disciplina';
        }
        return view('disciplina.modal-salvar-disciplina');
    }
}
