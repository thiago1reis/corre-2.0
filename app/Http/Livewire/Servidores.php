<?php

namespace App\Http\Livewire;

use App\Models\Servidor;
use App\Services\CreateService;
use App\Services\DeleteService;
use App\Services\GetAllService;
use App\Services\UpdateService;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Servidores extends Component
{
    use WithPagination; 
    
    private CreateService $createService;
    private UpdateService $updateService;
    private DeleteService $deleteService;
    private GetAllService $getAllService;
    public Servidor $servidor;
    public $modulo;
    public $modal;
    public $search;
    protected $paginationTheme = 'bootstrap';

    //Valida os campos obrigatórios 
    protected  function rules() {
        return [
            'servidor.nome' => 'required|min:6',
            'servidor.tipo' => 'required',
            'servidor.observacao' => '',
        ];
    }

    //Limpa os campos
    protected function clearFields(){
        $this->servidor->nome = '';
        $this->servidor->tipo = '';
        $this->servidor->observacao = '';
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
    public function mount(Servidor $servidor){
        $this->servidor = $servidor;
    }

    //Abre modal
    public function showModal($modal, $id = null){
        $this->modal = $modal;
        if($this->modal == 'Editar'){
            $this->servidor = $this->servidor->find($id);
            $this->dispatchBrowserEvent('show-edit-modal');
        }
        elseif($this->modal == 'Deletar'){
            $this->servidor = $this->servidor->find($id);
            $this->modulo = 'Servidor';
            $this->dispatchBrowserEvent('show-delete-modal');
        }
        else{
            $this->dispatchBrowserEvent('show-create-modal');
       }
    }

    //Fecha modal
    public function closeModal(){
        $this->clearFields();
        $this->dispatchBrowserEvent('close-modal');
    }

    //Salva dados no banco
    public function store(){
        $this->validate();
        $dados = [
            'nome' => $this->servidor->nome,
            'tipo' => $this->servidor->tipo,
            'observacao' => $this->servidor->observacao
        ];
        try{
            $this->createService->create($this->servidor, $dados);
            $this->clearFields();
            $this->closeModal();
            session()->flash('success', 'Servidor foi adicionada com sucesso.');
        }catch(Exception $e){
            //dd($e); 
            $this->closeModal();
            session()->flash('error', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }

    //Edita daos no banco
    public function update(){
        $this->validate();
        $dados = [
            'nome' => $this->servidor->nome,
            'tipo' => $this->servidor->tipo,
            'observacao' => $this->servidor->observacao
        ];
        try{
            $this->updateService->update($this->servidor, $dados);
            $this->clearFields();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('success', 'Dados da servidor editados com sucesso!');
        }catch(Exception $e){
            //dd($e); 
            session()->flash('error', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }

    public function delete(){

    }

    //Renderiza componente
    public function render()
    {
         //Campos que irão como parâmetro para retornar os dados
         $fields = [
            'nome',
            'tipo',
        ];
        $servidores = $this->getAllService->getAll($this->servidor, $fields, $this->search); 
        return view('livewire.servidores.servidores', ['servidores' => $servidores ]);
    }
}
 