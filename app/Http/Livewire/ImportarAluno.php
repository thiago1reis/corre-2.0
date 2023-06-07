<?php

namespace App\Http\Livewire;

use App\Models\Aluno;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportarAluno extends Component
{
    use WithFileUploads;

    public Aluno $aluno;
    public $arquivo;


    /**
     * mount
     *
     * @param  Aluno $aluno
     * @return void
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
        $this->validate([
            'arquivo' => 'required|mimes:csv,txt',
        ]);

        //coloca o arquivo em uma pasta temporaria e transforma em array
        $alunos = file($this->arquivo->path());

        $save = '';
        foreach ($alunos as $aluno) {

            //Retira os espaços e os ";" dos valores
            $valor = explode(';', $aluno = trim($aluno));

            //Converte a data de nascimento para o formato SQL
            $valor[2] = implode("-", array_reverse(explode("/", $valor[2])));

            //Elimina os dado do aluno caso ele já tenha sido adicionado anteriormente.
            if ($verificaMat = Aluno::where('matricula', $valor[1])->exists()) {
                unset($aluno);
            }

            //Salva dados do aluno no banco caso ele não tenha sido adicionado anteriormente.
            if (!$verificaMat) {
                try {
                    $save = $this->aluno->create([
                        'nome' => $valor[0],
                        'matricula' => $valor[1],
                        'data_nascimento' => $valor[2],
                        'sexo' => $valor[3],
                    ]);
                } catch (Exception $e) {
                    return redirect()->route('aluno.index')->with('error', 'Algo saiu errado, verifique se seu arquivo contém os dados necessários e tente novamente!');
                }
            }
        }
        if ($verificaMat && !$save) {
            $this->addError('arquivo', 'Os dados desses alunos já foram adicionados!');
        } elseif ($save) {
            return redirect()->route('aluno.index')->with('success', 'Dados dos alunos foram importados com sucesso!');
        }
    }


    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('aluno.modal-importar-aluno');
    }
}
