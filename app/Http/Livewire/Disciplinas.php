<?php

namespace App\Http\Livewire;

use App\Models\Disciplina;
use App\Services\CreateService;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Disciplinas extends Component
{
    use WithPagination; 

    private CreateService $createService;
    public Disciplina $disciplina;
    public $nome, $observacao;
    public $edit_id, $edit_observacao;
    public $delete_id;
    public $search;
    public $readyToLoad = false;
    protected $paginationTheme = 'bootstrap';

    //Valida campos obirgatórios
    protected function rules(){
        return [
            'nome' => 'required',
        ];
    }

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    //Limpa os campos
    protected function clearFields(){
        $this->nome = '';
        $this->observacao = '';
    }

    //Monta o componente
    public function mount(Disciplina $disciplina){
        $this->disciplina = $disciplina;
    }

    //Inicializa a service
    public function boot(CreateService $createService)
    {
        $this->createService = $createService;
    }

    //Redefine a página para pagina 1 usuario acessar os elementos de outra página
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //Renderiza a página
    public function render()
    {
        $disciplinas = Disciplina::where('nome', 'LIKE', "%{$this->search}%")->Orwhere('observacao', 'LIKE', "%{$this->search}%")->orderBy('id' , "DESC")->paginate(5); 
        return view('livewire.disciplinas', ['disciplinas' => $disciplinas ]);
    }

    //Salva os dados
    public function store()
    { 
        $this->validate();

        ## Verifica se a disciplina informada já existe ## //transformar em service
        if($this->disciplina->where('nome', $this->nome)->exists()){
            $this->addError('nome', 'Essa disciplina já foi adicionada.');   
            return false;
        }
        
        $dados = [
            'nome' => $this->nome,
            'observacao' => $this->observacao
        ];

        try{
            $this->createService->create($this->disciplina, $dados);
            $this->clearFields();//Ver o hook
            session()->flash('success', 'Disciplina foi adicionada com sucesso.');
        }catch(Exception $e){
            //dd($e); 
            session()->flash('error', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }

    /*--------------------------------------------------------------------------
    | Seleciona disciplina que vai ter dados editado e abre a modal de edição
    |--------------------------------------------------------------------------*/
    public function selectEdit($id)
    {
        $disciplina = Disciplina::find($id);
        $this->edit_id = $disciplina->id;
        $this->edit_nome = $disciplina->nome;
        $this->edit_observacao = $disciplina->observacao;
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    /*--------------------------------------------------------------------------
    | Edita os dados da disciplina no banco e fecha modal de edição
    |--------------------------------------------------------------------------*/
    public function edit(){
        //Valida os campos Obrigatórios.
        $this->validate([ 
             'edit_nome' => 'required',
         ]);
         $disciplina = Disciplina::find($this->edit_id);
         //Verifica se a disciplina informada já existe.
         if($this->edit_nome == $disciplina->nome){
             ##continua código## 
         }elseif(Disciplina::where('nome', $this->edit_nome)->exists()){
              return session()->flash('attentionModal', 'Essa disciplina já foi adicionada.');   
         }
         //Edita os dados.
         try{
             $disciplina->update([
                 'nome' => $this->edit_nome,
                 'observacao' => $this->edit_observacao
             ]);
             session()->flash('successList', 'Dados da disciplina editado com sucesso!');
             //Limpa os campos
             $this->edit_nome = '';
             $this->edit_observacao = '';
             $this->dispatchBrowserEvent('close-modal');
         }catch(Exception $e){
             session()->flash('errorModal', $e);
         }
    }

    /*--------------------------------------------------------------------------
    | Cancela edição do dados da disciplina
    |--------------------------------------------------------------------------*/
    public function cancelEdit()
    {
        $this->edit_nome = ''; 
        $this->edit_observacao = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    /*--------------------------------------------------------------------------
    | Abre modal para confirmar exclusão dos dados da disciplina
    |--------------------------------------------------------------------------*/
    public function deleteConfirm($id)
    {
        $this->delete_id = $id; 
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    /*--------------------------------------------------------------------------
    | Deleta os dados da disciplina do banco de dados
    |--------------------------------------------------------------------------*/
    public function destroy()
    {
        $disciplina = Disciplina::find($this->delete_id);
        $disciplina->delete();
        session()->flash('successList', 'Disciplina deletada com sucesso!');
        $this->dispatchBrowserEvent('close-modal');
        $this->delete_id = '';
    }

    /*--------------------------------------------------------------------------
    | Cancela a seleção da disciplina que ia ter os dados deletados
    |--------------------------------------------------------------------------*/
    public function cancelDelete()
    {
        $this->delete_id = '';
        $this->dispatchBrowserEvent('close-modal');
    }
}
