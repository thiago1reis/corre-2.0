<?php

namespace App\Http\Livewire;

use App\Models\Servidor;
use Livewire\Component;

class Servidores extends Component
{

    public Servidor $servidor;
    public $acao;


    /**
     * rules
     *
     * @return array
     */
    protected  function rules()
    {
        return [
            'servidor.nome' => 'required',
            'servidor.tipo' => 'required',
            'servidor.observacao' => 'max:255',
        ];
    }


    /**
     * mount
     *
     * @param  Servidor $servidor
     * @return void
     */
    public function mount(Servidor $servidor)
    {
        $this->servidor = $servidor;
    }


    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $this->validate();
        $this->servidor->nome =  $this->servidor->nome;
        $this->servidor->tipo =  $this->servidor->tipo;
        $this->servidor->observacao =   $this->servidor->observacao;
        $this->servidor->save();
        return redirect()->route('servidor.index')->with('success', 'Dados do servidor foram salvos com sucesso!');
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        if ($this->servidor->id) {
            $this->acao = 'Editar Servidor';
        } else {
            $this->acao = 'Adicionar Servidor';
        }

        $tipos = $this->servidor->tipos();
        return view('servidor.modal-salvar-servidor', compact('tipos'));
    }
}
