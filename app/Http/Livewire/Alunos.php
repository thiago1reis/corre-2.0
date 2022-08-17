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
    public $foto, $nome, $matricula, $data_nascimento, $sexo, $telefone , $email, $responsavel, $telefone_responsavel, $observacao;

    public $show_foto, $show_nome, $show_matricula, $show_data_nascimento, $show_sexo, $show_telefone, $show_email, $show_responsavel, 
    $show_telefone_responsavel, $show_observacao;

    public $aluno_edit_foto, $aluno_edit_nome, $aluno_edit_matricula, $aluno_edit_data_nascimento, $aluno_edit_sexo, $aluno_edit_telefone,
    $aluno_edit_email, $aluno_edit_responsavel, $aluno_edit_telefone_responsavel, $aluno_edit_observacao;

    public $aluno_delete_id;

    public $search  = '';

    protected $paginationTheme = 'bootstrap';

    public $novaFoto;

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
        if($this->aluno_edit_foto){
            $this->previaFotoNova = $this->aluno_edit_foto->temporaryUrl();
        }
        if($this->foto){
            $this->previaFoto = $this->foto->temporaryUrl();
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
        $this->nomePagina = 'Alunos'; 
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

    public function show($id)
    {
        $aluno = Aluno::where('id', $id)->first();
        $this->show_foto = $aluno->foto;
        $this->show_nome = $aluno->nome; 
        $this->show_matricula = $aluno->matricula;
        $this->show_data_nascimento = $aluno->data_nascimento; 
        $this->show_sexo = $aluno->sexo; 
        $this->show_telefone = $aluno->telefone; 
        $this->show_email = $aluno->email; 
        $this->show_responsavel = $aluno->responsavel; 
        $this->show_telefone_responsavel = $aluno->telefone_responsavel;
        $this->show_observacao = $aluno->observacao;
        $this->dispatchBrowserEvent('show-view-student-modal');
    }

    public function closeShow()
    {
        $this->show_foto = '';
        $this->show_nome = ''; 
        $this->show_matricula = '';
        $this->show_data_nascimento = ''; 
        $this->show_sexo = ''; 
        $this->show_telefone = ''; 
        $this->show_email = ''; 
        $this->show_responsavel = ''; 
        $this->show_telefone_responsavel = '';
        $this->show_observacao = '';
        $this->dispatchBrowserEvent('close-modal');
    }


    public function selectEdit($id)
    {
       
        // dd('to aquui');
        $aluno = Aluno::where('id', $id)->first();
        // $this->aluno_edit_id = $aluno->id;
        $this->aluno_edit_foto = $aluno->foto;
        $this->aluno_edit_nome = $aluno->nome; 
        $this->aluno_edit_matricula = $aluno->matricula;
        $this->aluno_edit_data_nascimento = $aluno->data_nascimento; 
        $this->aluno_edit_sexo = $aluno->sexo; 
        $this->aluno_edit_telefone = $aluno->telefone; 
        $this->aluno_edit_email = $aluno->email; 
        $this->aluno_edit_responsavel = $aluno->responsavel; 
        $this->aluno_edit_telefone_responsavel = $aluno->telefone_responsavel;
        $this->aluno_edit_observacao = $aluno->observacao;
        $this->dispatchBrowserEvent('show-edit-student-modal');
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
    public function cancelDelete()
    {
        $this->aluno_delete_id = '';
        $this->dispatchBrowserEvent('close-modal');
    }

}
