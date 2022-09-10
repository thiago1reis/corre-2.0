<?php

namespace App\Http\Livewire;

use App\Models\Disciplina;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Disciplinas extends Component
{
    use WithPagination; 

    /*--------------------------------------------------------------------------
    | Definição de atributos
    |--------------------------------------------------------------------------*/
    public $nome, $observacao;

    public $edit_id, $edit_observacao;

    public $search;

    protected $paginationTheme = 'bootstrap';

    /*--------------------------------------------------------------------------
    | Redefine a página para pagina 1 apos uma consulta apos acesser os elementos de outra página
    |--------------------------------------------------------------------------*/
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /*--------------------------------------------------------------------------
    | Renderiza a página
    |--------------------------------------------------------------------------*/
    public function render()
    {
        $disciplinas = Disciplina::where('nome', 'LIKE', "%{$this->search}%")->Orwhere('observacao', 'LIKE', "%{$this->search}%")->orderBy('id' , "DESC")->paginate(5); 
        return view('livewire.disciplinas', ['disciplinas' => $disciplinas]);
    }

    /*--------------------------------------------------------------------------
    | Adiciona disciplina no banco de dados
    |--------------------------------------------------------------------------*/
    public function store()
    { 
        //Valida os campos Obrigatórios.
        $this->validate([ 
            'nome' => 'required',
        ]);
        //Verifica se a disciplina informada já existe.
        if(Disciplina::where('nome', $this->nome)->exists()){
            return session()->flash('attention', 'Essa disciplina já foi adicionada.');     
        }
        
        //Salva os dados.
        try{
            Disciplina::create([
                'nome' => $this->nome,
                'observacao' => $this->observacao
            ]);  
            session()->flash('success', 'Disciplina foi adicionada com sucesso.');
            //Limpa os campos
            $this->nome = '';
            $this->observacao = '';
         }catch(Exception $e){
           session()->flash('error', $e);
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




}
