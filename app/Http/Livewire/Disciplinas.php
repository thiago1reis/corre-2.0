<?php

namespace App\Http\Livewire;

use App\Models\Disciplina;
use App\Services\CreateService;
use App\Services\DeleteService;
use App\Services\GetAllService;
use App\Services\UpdateService;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Disciplinas extends Component
{
    use WithPagination; 

    private CreateService $createService;
    private UpdateService $updateService;
    private DeleteService $deleteService;
    private GetAllService $getAllService;
    public Disciplina $disciplina;
    public $modulo;
    public $modal;
    public $busca;
    protected $paginationTheme = 'bootstrap';

    //Valida os campos obrigatórios 
    protected  function rules() {
        return [
            'disciplina.nome' => ['required', Rule::unique(Disciplina::class, 'nome')->ignore($this->disciplina)],
            'disciplina.observacao' => '',
        ];
    }

    //Limpa os campos
    protected function clearFields(){
        $this->disciplina->nome = '';
        $this->disciplina->observacao = '';
    }
    
    //Inicializa as services
    public function boot(
        CreateService $createService, 
        UpdateService $updateService,
        DeleteService $deleteService,
        GetAllService $getAllService
        )
    {
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->getAllService = $getAllService;
    }

    //Monta o componente
    public function mount(Disciplina $disciplina){
        $this->disciplina = $disciplina;
    }

    //Abre modal
    public function showModal($modal, $id = null){
        $this->modal = $modal;
        if($this->modal == 'Editar'){
            $this->disciplina = $this->disciplina->find($id);
            $this->dispatchBrowserEvent('show-save-modal');
        }
        elseif($this->modal == 'Deletar'){
            $this->disciplina = $this->disciplina->find($id);
            $this->modulo = 'Disciplina';
            $this->dispatchBrowserEvent('show-delete-modal');
        }
        else{
            $this->disciplina->id = null;
            $this->dispatchBrowserEvent('show-save-modal');
       }
    }

    //Fecha modal
    public function closeModal(){
        $this->clearFields();
        $this->dispatchBrowserEvent('close-modal');
    }

    //Adiciona ou atualiza disciplina
    public function save(){
        $this->validate();
        $dados = [
            'nome' => $this->disciplina->nome,
            'observacao' => $this->disciplina->observacao
        ];
        try{
            if($this->disciplina->id){
                $this->updateService->update($this->disciplina, $dados);
            }else{
                $this->createService->create($this->disciplina, $dados);
            }
            $this->closeModal();
            session()->flash('success', 'Dados da disciplina salvos com sucesso.');
        }catch(Exception $e){
            //dd($e); 
            $this->closeModal();
            session()->flash('error', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }

    //Redefine a páginação
    public function updatingBusca()
    {
        $this->resetPage();
    }

    //Deleta dados do banco
    public function delete(){
        try{
            $this->deleteService->delete($this->disciplina);
            $this->clearFields();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('success', 'Disciplina deletada com sucesso!');
        }catch(Exception $e){
            //dd($e); 
            session()->flash('error', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }

    //Renderiza a página
    public function render()
    {
        //Campos que irão como parâmetro para retornar os dados
        $campos = [
            'nome',
            'observacao',
        ];
        //Numero de páginas
        $paginas = 10;
        $disciplinas = $this->getAllService->getAll($this->disciplina, $campos, $this->busca, $paginas);
        return view('livewire.disciplinas.disciplinas', ['disciplinas' => $disciplinas ]);
    }
}
