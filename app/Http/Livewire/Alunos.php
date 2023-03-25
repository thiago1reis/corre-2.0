<?php

namespace App\Http\Livewire;

use App\Models\Aluno;
use App\Services\CreateService;
use App\Services\DeleteService;
use App\Services\GetAllService;
use App\Services\UpdateService;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class Alunos extends Component
{
    use WithPagination;
    use WithFileUploads;

    private CreateService $createService;
    private UpdateService $updateService;
    private DeleteService $deleteService;
    private GetAllService $getAllService;
    public Aluno $aluno;
    public $foto;
    public $modulo;
    public $modal;
    public $busca;
    protected $paginationTheme = 'bootstrap';

    //Valida os campos obrigatórios
    protected  function rules() {
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
            'aluno.email' => '',
            'aluno.responsavel' => '',
            'aluno.telefone_responsavel' => '',
            'aluno.observacao' => '',
        ];
    }

    //Limpa os campos
    protected function clearFields(){

        $this->foto = '';
        $this->aluno->foto = '';
        $this->aluno->nome = '';
        $this->aluno->matricula = '';
        $this->aluno->data_nascimento = '';
        $this->aluno->sexo = '';
        $this->aluno->telefone = '';
        $this->aluno->email = '';
        $this->aluno->responsavel = '';
        $this->aluno->telefone_responsavel = '';
        $this->aluno->observacao = '';
    }

    //Inicializa as services
    public function boot(
        CreateService $createService,
        UpdateService $updateService,
        DeleteService $deleteService,
        GetAllService $getAllService,
        Aluno $aluno,
        )
    {
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->getAllService = $getAllService;
        $this->aluno = $aluno;
    }

    //Monta o componente
    public function mount(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }

    //Abre modal
    public function showModal($modal, $id = null){
        $this->modal = $modal;
        if($this->modal == 'Editar'){
            $this->aluno = $this->aluno->find($id);
            $this->dispatchBrowserEvent('show-save-modal');
        }
        elseif($this->modal == 'Deletar'){
            $this->aluno = $this->aluno->find($id);
            $this->modulo = 'Aluno';
            $this->dispatchBrowserEvent('show-delete-modal');
        }
        else{
            $this->aluno->id = null;
            $this->dispatchBrowserEvent('show-save-modal');
       }
    }

    //Fecha modal
    public function closeModal(){
        $this->clearFields();
        $this->dispatchBrowserEvent('close-modal');
    }

    //Adiciona ou atualiza aluno
    public function save(){

        $this->validate();

        if ($this->foto) {
            //Renomeia o arquivo.
            $nomeArquivo = $this->aluno->matricula . '.' . $this->foto->getClientOriginalExtension();
            //Faz o upload no diretório.
            $upload = $this->foto->storeAS('Alunos', $nomeArquivo, 'public');
        }

        $dados = [
            'nome' => $this->aluno->nome,
            'matricula' => $this->aluno->matricula,
            'data_nascimento' => $this->aluno->data_nascimento,
            'sexo' => $this->aluno->sexo,
            'telefone' => $this->aluno->telefone,
            'email' => $this->aluno->email,
            'responsavel' => $this->aluno->responsavel,
            'matritelefone_responsavelcula' => $this->aluno->telefone_responsavel,
            'observacao' => $this->aluno->observacao,
        ];

        if (isset($upload)) {
            $dados['foto'] = $upload;
        }

        try{
            if($this->aluno->id){
                $this->updateService->update($this->aluno, $dados);
            }else{
                $this->createService->create($this->aluno, $dados);
            }
            $this->closeModal();
            session()->flash('success', 'Dados do aluno salvos com sucesso.');
        }catch(Exception $e){
            //dd($e);
            $this->closeModal();
            session()->flash('error', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }

    //Renderiza a página
    public function render()
    {
        //Campos que irão como parâmetro para retornar os dados
        $campos = [
            'nome',
            'matricula',
        ];
        //Numero de páginas
        $paginas = 10;
        $alunos = $this->getAllService->getAll($this->aluno, $campos, $this->busca, $paginas);
        return view('livewire.alunos.alunos', ['alunos' => $alunos ]);
    }


    /*--------------------------------------------------------------------------
    | Importa dados de alunos para o banco de dados
    |--------------------------------------------------------------------------*/
    // public function import(){
    //     //Valida os campos Obrigatórios.
    //     $this->validate([
    //         'arquivo' => 'required|mimes:csv,txt',
    //     ]);
    //     try{
    //         //coloca o arquivo em uma pasta temporaria e trasforma em array sting
    //         $alunos = file($this->arquivo->path());
    //         $addAluno = '';
    //         foreach($alunos as $aluno){
    //             //Retira os espaços e os ";" da string
    //             $valor = explode(';', $aluno = trim($aluno));
    //             //Elimina os dado do aluno caso ele ja esteja cadastrado.
    //             if($verificaMat = Aluno::where('matricula', $valor[1])->exists()){
    //                 unset($aluno);
    //             }
    //             //Salva dados do aluno no banco caso seu cadastro não tenha sido feito anteriormente.
    //             if(!$verificaMat){
    //                 $addAluno = Aluno::create([
    //                     'nome' => $valor[0],
    //                     'matricula' => $valor[1],
    //                     'data_nascimento' => $valor[2],
    //                     'sexo' => $valor[3],
    //                 ]);
    //             }
    //         }
    //         //Retorna caso nenhum aluno vindo do arquivo exista antes no banco.
    //         if(!$verificaMat && $addAluno){
    //             return session()->flash('successModal', 'Dados dos alunos foram importados com sucesso.');
    //             $this->arquivo = '';
    //         }
    //         //Retorna caso todos os alunos do arquivo existam no banco
    //         if($verificaMat && !$addAluno){
    //             return session()->flash('errorModal', 'Esses alunos já foram adicionados.');
    //             $this->arquivo = '';
    //         }
    //         //Retorna caso alguns alunos do arquivo existam no banco e outros não.
    //         if($verificaMat &&  $addAluno){
    //             return session()->flash('attentionModal', 'Dados dos alunos importados com sucesso, alguns alunos foram ingnorados pois seus dados já havim sido adicionado anteriormente.');
    //             $this->arquivo = '';
    //         }
    //     }catch(Exception $e){
    //         session()->flash('errorModal', $e);
    //     }
    // }


    //Deleta dados do banco
    public function delete()
    {
        try {
            Storage::disk('public')->delete($this->aluno->foto);
            $this->deleteService->delete($this->aluno);
            $this->clearFields();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('success', 'Aluno deletado com sucesso!');
        } catch (Exception $e) {
            //dd($e);
            session()->flash('error', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }


    public function deleteFoto(){
        Storage::disk('public')->delete($this->aluno->foto);

        $dados = [
            'foto' => "",
        ];

        $this->updateService->update($this->aluno, $dados);

    }
}

    //398 linhas de código !------>> diminuir 50%.
