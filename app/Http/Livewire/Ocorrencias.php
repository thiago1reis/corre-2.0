<?php

namespace App\Http\Livewire;

use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Ocorrencia;
use App\Models\Servidor;
use App\Models\Turma;
use Livewire\Component;

class Ocorrencias extends Component
{
    public Ocorrencia $ocorrencia;
    public $aluno;
    public $matricula;
    public bool $disabled = false;
    public $turmas;
    public $disciplinas;
    public $servidores;


    /**
     * rules
     *
     * @return void
     */
    protected  function rules()
    {
        return [
            'matricula' => 'required|min:14|max:14',
            'ocorrencia.turma_id' => 'required',
            'ocorrencia.bolsa_aluno' => '',
            'ocorrencia.disciplina_id' => 'required',
            'ocorrencia.data' => 'required',
            'ocorrencia.tipo' => 'required',
            'ocorrencia.servidor_id' => 'required',
            'ocorrencia.setor_encaminhado' => 'required',
            'ocorrencia.descricao' => 'required|max:255',
            'ocorrencia.medida_adotada' => 'required|max:255',
            'ocorrencia.observacao' => 'max:255',
        ];
    }

    /**
     * mount
     *
     * @param  Ocorrencia $ocorrencia
     * @return Ocorrencia
     */
    public function mount(Ocorrencia $ocorrencia)
    {
        $this->ocorrencia = $ocorrencia;
        $this->turmas = Turma::all();
        $this->disciplinas = Disciplina::all();
        $this->servidores = Servidor::all();
    }


    /**
     * updatedMatricula
     *
     * @return void
     */
    public function updatedMatricula()
    {
        $this->validate([
            'matricula' => 'required|min:14|max:14',
        ]);

        $this->aluno = Aluno::where('matricula', $this->matricula)->first();

        if (!$this->aluno) {
            $this->addError('matricula', 'Matricula não encontrada.');
        } else {
            $this->disabled = true;
        }
    }


    public function save()
    {
        $this->validate();
        $this->ocorrencia->tipo = $this->ocorrencia->tipo;
        $this->ocorrencia->descricao = $this->ocorrencia->descricao;
        $this->ocorrencia->medida_adotada = $this->ocorrencia->medida_adotada;
        $this->ocorrencia->observacao = $this->ocorrencia->observacao;
        $this->ocorrencia->bolsa_aluno = $this->ocorrencia->bolsa_aluno;
        $this->ocorrencia->setor_encaminhado = $this->ocorrencia->setor_encaminhado;
        $this->ocorrencia->data = $this->ocorrencia->data;

        if (!$this->ocorrencia->usuario_id) {
            //Na hora de editar não pode alterar
            $this->ocorrencia->usuario_id = auth()->user()->id;
        }

        $this->ocorrencia->servidor_id = $this->ocorrencia->servidor_id;
        $this->ocorrencia->disciplina_id = $this->ocorrencia->disciplina_id;
        $this->ocorrencia->aluno_id = $this->aluno->id;
        $this->ocorrencia->turma_id = $this->ocorrencia->turma_id;
        $this->ocorrencia->save();
        return redirect()->route('ocorrencia.create')->with('success', 'Ocorrência cadastrada com sucesso!');
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('ocorrencia.formulario-ocorrencia');
    }
}
