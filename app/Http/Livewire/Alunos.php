<?php

namespace App\Http\Livewire;

use App\Models\Aluno;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Manny;


class Alunos extends Component
{   
    use WithPagination; 
    use WithFileUploads;

    /*--------------------------------------------------------------------------
    | Definição de atributos
    |--------------------------------------------------------------------------*/
    public $foto; 
    public $nome; 
    public $matricula; 
    public $data_nascimento;
    public $sexo;
    public $telefone;
    public $email;
    public $responsavel;
    public $telefone_responsavel;
    public $observacao;
    public $aluno_delete_id;
    public $search  = '';
    protected $paginationTheme = 'bootstrap';
   

    /*--------------------------------------------------------------------------
    | Definição das validações
    |--------------------------------------------------------------------------*/
    protected $rules = [  
        'nome' => 'required',
        'matricula' => 'required',
        'data_nascimento' => 'required',
        'sexo' => 'required',
    ];
    

    /*--------------------------------------------------------------------------
    | Adiciona mascara nos campos dos formulários
    |--------------------------------------------------------------------------*/
    public function updated($field)
	{ 
        //Campo Telefone
		if ($field == 'telefone')
		{
			$this->telefone = Manny::mask($this->telefone, "(11) 11111-1111");
		}
        //Campo Telefone do responsável
        if ($field == 'telefone_responsavel')
		{
			$this->telefone_responsavel = Manny::mask($this->telefone_responsavel, "(11) 11111-1111");
		}
	}

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
        $alunos = Aluno::where('nome', 'LIKE', "%{$this->search}%")->Orwhere('matricula', 'LIKE', "%{$this->search}%")->orderBy('id' , "DESC")->paginate(5); 
        return view('livewire.alunos', ['alunos' => $alunos]);
    }

    /*--------------------------------------------------------------------------
    | Adiciona aluno no banco de dados
    |--------------------------------------------------------------------------*/
    public function store()
    { 
        //Valida os campos Obrigatórios.
        $this->validate();

        //Verifica se a matrícula informada já existe.
        if(Aluno::where('matricula', $this->matricula)->exists()){
            return session()->flash('attention', 'Essa matrícula já pertence a outro aluno.');     
        }

        //Faz o upload da foto do aluno.
        if($this->foto){
            //Valida a extensão da foto.
            $this->validate([
                'foto' => 'image|mimes:jpg,jpeg,png'
            ]);
            //Renomeia o arquivo.
            $nomeArquivo = $this->matricula.'.'.$this->foto->getClientOriginalExtension();
            //Faz o upload no diretório.
            $upload = $this->foto->storeAS('Alunos', $nomeArquivo, 'public');
            //Verifica se o upload da foto foi feito.
            if(!$upload){
                return session()->flash('error', 'Não foi possível fazer o upload da foto.'); 
            }
        }
        else{
            $upload = '';
        }
       
        //Salva os dados.
        try{
            Aluno::create([
                'foto' => $upload,
                'nome' => $this->nome,
                'matricula' => $this->matricula,
                'data_nascimento' => $this->data_nascimento,
                'sexo' => $this->sexo,
                'telefone' => $this->telefone,
                'email' => $this->email,
                'responsavel' => $this->responsavel,
                'telefone_responsavel' => $this->telefone_responsavel,
                'observacao' => $this->observacao
            ]);  
            session()->flash('success', 'Aluno foi adicionado com sucesso.');
            //Limpa os campos
            $this->foto = '';
            $this->nome = '';
            $this->matricula = '';
            $this->data_nascimento = '';
            $this->sexo = '';
            $this->telefone = '';
            $this->email = '';
            $this->responsavel = '';
            $this->telefone_responsavel = '';
            $this->observacao = '';
         }catch(Exception $e){
           session()->flash('error', $e);
         }
    }

    /*--------------------------------------------------------------------------
    | Adiciona aluno no banco de dados
    |--------------------------------------------------------------------------*/
    public function deleteConfirm($id)
    {
        $this->aluno_delete_id = $id; //student id
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    /*--------------------------------------------------------------------------
    | Adiciona aluno no banco de dados
    |--------------------------------------------------------------------------*/
    public function destroy()
    {
        $aluno = Aluno::where('id', $this->aluno_delete_id)->first();
        $aluno->delete();
        session()->flash('successList', 'Aluno deletado com sucesso!');
        $this->dispatchBrowserEvent('close-modal');
        $this->aluno_delete_id = '';
    }

    /*--------------------------------------------------------------------------
    | Cancela aluno selecionado e fecha a modal
    |--------------------------------------------------------------------------*/
    public function cancel()
    {
        $this->aluno_delete_id = '';
        $this->dispatchBrowserEvent('close-modal');
    }

}
