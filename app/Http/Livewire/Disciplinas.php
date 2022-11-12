<?php

namespace App\Http\Livewire;

use App\Models\Disciplina;
use App\Services\CreateService;
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
    public $nome;
    public $observacao;
    public $search;
    protected $paginationTheme = 'bootstrap';

    //Limpa os campos
    protected function clearFields(){
        $this->nome = '';
        $this->observacao = '';
        $this->editar_id = '';
        $this->editar_nome = '';
        $this->editar_observacao = '';
    }

    //Monta o componente
    public function mount(Disciplina $disciplina){
        $this->disciplina = $disciplina;
    }

    //Inicializa a service
    public function boot(CreateService $createService, UpdateService $updateService)
    {
        $this->createService = $createService;
        $this->updateService = $updateService;
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
        //Valida campos obirgatórios
        $this->validate([
            'nome' => ['required', Rule::unique(Disciplina::class, 'nome')]
        ]);
        
        $dados = [
            'nome' => $this->nome,
            'observacao' => $this->observacao
        ];

        try{
            $this->createService->create($this->disciplina, $dados);
            $this->clearFields();
            session()->flash('success', 'Disciplina foi adicionada com sucesso.');
        }catch(Exception $e){
            //dd($e); 
            session()->flash('error', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }

    //Seleciona disciplina a ser editada
    public function selectEdit($id)
    {
        $this->disciplina = $this->disciplina->find($id);
        $this->editar_id = $this->disciplina->id;
        $this->editar_nome = $this->disciplina->nome;
        $this->editar_observacao = $this->disciplina->observacao;
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    //Edita os dados.
    public function edit(){
        
        //Valida campos obirgatórios
        $this->validate([
            'editar_nome' => ['required', Rule::unique(Disciplina::class, 'nome')->ignore($this->editar_id)]
        ]);

        $dados = [
            'nome' => $this->editar_nome,
            'observacao' => $this->editar_observacao
        ];
         
        try{
            $this->updateService->update($this->disciplina, $dados);
            session()->flash('successList', 'Dados da disciplina editado com sucesso!');
            $this->clearFields();
            $this->dispatchBrowserEvent('close-modal');
        }catch(Exception $e){
            //dd($e); 
            session()->flash('errorModal', 'Algo saiu errado, tente novamente mais tarde.');
        }
    }

    //Cancela edição
    public function cancelEdit()
    {
        $this->clearFields();
        $this->dispatchBrowserEvent('close-modal');
    }

    //Seleciona disciplina para ser deletada
    public function deleteConfirm($id)
    {
        $this->deletar_id = $id; 
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    //Deleta disciplina
    public function destroy()
    {
        $this->disciplina = $this->disciplina->find($this->deletar_id); //Fazer Service para deletar
        $this->disciplina->delete();
        $this->clearFields();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('successList', 'Disciplina deletada com sucesso!');
    }

    //Cancela a seleção da disciplina que ia ter os dados deletados
    public function cancelDelete()
    {
        $this->clearFields();
        $this->dispatchBrowserEvent('close-modal');
    }
}
