<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Deletar extends Component
{
    public $modulo;
    public $rota;


    /**
     * mount
     *
     * @param  string $modulo
     * @param  string $rota
     * @return string
     */
    public function mount($modulo, $rota)
    {
        $this->modulo = $modulo;
        $this->rota = $rota;
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('layouts.modal-confirmar-deletar');
    }
}
