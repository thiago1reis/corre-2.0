<?php

namespace App\Http\Livewire;

use App\Models\Aluno;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Alunos extends Component
{
    use WithPagination;
    use WithFileUploads;

    public Aluno $aluno;
    public $acao;
    public $foto;


    /**
     * rules
     *
     * @return void
     */
    protected  function rules()
    {
        return [
            'foto' => [
                'nullable', 'mimes:jpg,bmp,png', 'max:1024',
                Rule::dimensions()
                    ->maxWidth(1000)
                    ->minWidth(800)
                    ->maxHeight(1000)
                    ->minHeight(800)
            ],
            'aluno.nome' => ['required', 'string', 'min:6', 'max:255'],
            'aluno.matricula' => ['required', 'min:14', 'max:14',  Rule::unique(Aluno::class, 'matricula')->ignore($this->aluno)],
            'aluno.data_nascimento' => ['required'],
            'aluno.sexo' => ['required'],
            'aluno.telefone' => '',
            'aluno.email' => ['nullable', 'email', 'min:6'],
            'aluno.responsavel' => '',
            'aluno.telefone_responsavel' => '',
            'aluno.observacao' => '',
        ];
    }


    /**
     * mount
     *
     * @param  \App\Models\Aluno $aluno
     * @return \App\Models\Aluno
     */
    public function mount(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }


    /**
     * save
     *
     * @return void
     */
    public function save()
    {
        $this->validate();
        if ($this->foto) {
            //Renomeia o arquivo.
            $nomeArquivo = $this->aluno->matricula . '.' . $this->foto->getClientOriginalExtension();
            //Faz o upload no diretório.
            $caminho = $this->foto->storeAS('Alunos', $nomeArquivo, 'public');
            //Adiciona o caminho da foto.
            $this->aluno->foto = $caminho;
            //Remove os arquivos temporarios
        }
        $this->aluno->nome = $this->aluno->nome;
        $this->aluno->matricula = $this->aluno->matricula;
        $this->aluno->data_nascimento = $this->aluno->data_nascimento;
        $this->aluno->sexo = $this->aluno->sexo;
        $this->aluno->telefone = $this->aluno->telefone;
        $this->aluno->telefone = $this->aluno->telefone;
        $this->aluno->responsavel = $this->aluno->responsavel;
        $this->aluno->telefone_responsavel = $this->aluno->telefone_responsavel;
        $this->aluno->observacao = $this->aluno->observacao;
        $this->aluno->save();
        return redirect()->route('aluno.index')->with('success', 'Dados do aluno foram salvos com sucesso!');
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        if ($this->aluno->id) {
            $this->acao = 'Editar Aluno';
        } else {
            $this->acao = 'Adicionar Aluno';
        }
        return view('aluno.modal-salvar-aluno');
    }


    /**
     * deleteFoto
     *
     * @return void
     */
    public function deleteFoto()
    {
        Storage::disk('public')->delete($this->aluno->foto);
        $this->aluno->foto = '';
        $this->aluno->save();
    }
}
