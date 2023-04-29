<?php

namespace App\Http\Livewire;

use App\Models\User as Usuario;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Usuarios extends Component
{
    public Usuario $usuario;
    public $senha;
    public $acao;

    /**
     * rules
     *
     * @return array
     */
    protected  function rules()
    {
        return [
            'usuario.name' => 'required',
            'usuario.email' => ['required', Rule::unique(Usuario::class, 'email')->ignore($this->usuario)],
            'senha' => $this->usuario->id ? 'nullable' : 'required',
            'usuario.tipo' => 'required',
            'usuario.status' => 'required',
        ];
    }

    /**
     * mount
     *
     * @param  Usuario $usuario
     * @return Usuario
     */
    public function mount(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }


    /**
     * save
     *
     * @return void
     */
    public function save()
    {

        $this->validate();
        $this->usuario->tipo =  $this->usuario->tipo;
        $this->usuario->name =  $this->usuario->name;
        $this->usuario->email =  $this->usuario->email;

        if ($this->senha) {
            $this->usuario->password = bcrypt($this->senha);
        }

        $this->usuario->status =  $this->usuario->status;
        $this->usuario->save();
        return redirect()->route('usuario.index')->with('success', 'Dados do usuário foram salvos com sucesso!');
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        if ($this->usuario->id) {
            $this->acao = 'Editar Usuário';
        } else {
            $this->acao = 'Adicionar Usuário';
        }
        return view('usuario.modal-salvar-usuario');
    }
}
