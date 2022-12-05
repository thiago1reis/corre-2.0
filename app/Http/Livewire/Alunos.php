<?php

namespace App\Http\Livewire;

use App\Models\Aluno;
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

    /*--------------------------------------------------------------------------
    | Definição de atributos
    |--------------------------------------------------------------------------*/
    public $foto, $nome, $matricula, $data_nascimento, $sexo, $telefone , $email, $responsavel, $telefone_responsavel, $observacao;
    
    public $arquivo; 

    public $show_foto, $show_nome, $show_matricula, $show_data_nascimento, $show_sexo, $show_telefone, $show_email, $show_responsavel, 
    $show_telefone_responsavel, $show_observacao;

    public $edit_id, $edit_foto, $edit_nome, $edit_matricula, $edit_data_nascimento, $edit_sexo, $edit_telefone,
    $edit_email, $edit_responsavel, $edit_telefone_responsavel, $edit_observacao;

    public $aluno_delete_id;

    public $search;

    public $previaFotoNova, $previaFoto; 

    protected $paginationTheme = 'bootstrap';

    /*--------------------------------------------------------------------------
    | Atualiza formularios
    |--------------------------------------------------------------------------*/
    // public function updated($field)
	// { 
    //     //Adiciona mascara aos campos dos formularios
	// 	if ($field == 'telefone')
	// 	{
	// 		$this->telefone = Manny::mask($this->telefone, "(11) 11111-1111");
	// 	}    
    //     if ($field == 'telefone_responsavel')
	// 	{
	// 		$this->telefone_responsavel = Manny::mask($this->telefone_responsavel, "(11) 11111-1111");
	// 	}
    //     if ($field == 'edit_telefone')
	// 	{
	// 		$this->edit_telefone = Manny::mask($this->edit_telefone, "(11) 11111-1111");
	// 	}
    //     if ($field == 'edit_telefone_responsavel')
	// 	{
	// 		$this->edit_telefone_responsavel = Manny::mask($this->edit_telefone_responsavel, "(11) 11111-1111");
	// 	}
    //     //Cria previa da foto nos campos de imagens
    //     // if($field == 'edit_foto'){
    //     //     $this->previaFotoNova = $this->edit_foto->temporaryUrl();
    //     // }
    //     // if($field == 'foto'){
    //     //     $this->previaFoto = $this->foto->temporaryUrl();
    //     // }
        
	// }
 
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

    public function updatedFoto()
    {
        try{
            if($this->foto){
                $this->previaFoto = $this->foto->temporaryUrl();
                }
        }catch(Exception $e){
                $this->addError('foto', '');
        }

        $this->validate([
            'foto' => [ 
                ($this->foto ? 'mimes:jpg,png' : 'nullable'),  
                'dimensions:max_width=1000,max_height=1000',
                'dimensions:min_width=700,min_height=700',
             ],
        ]);
    }

    /*--------------------------------------------------------------------------
    | Adiciona aluno no banco de dados
    |--------------------------------------------------------------------------*/
    public function store()
    { 

        $this->updatedFoto();
       
        //Valida os campos Obrigatórios.
        $this->validate([ 
            'nome' => ['required', 'max:120'],
            'matricula' => ['required', Rule::unique(Aluno::class, 'matricula')],
            'data_nascimento' => ['required'],
            'sexo' => ['required'],
        ]);

        //Faz o upload da foto do aluno.
        if($this->foto){
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
            $this->previaFoto = '';
         }catch(Exception $e){
           session()->flash('error', $e);
         }
    }

    /*--------------------------------------------------------------------------
    | Importa dados de alunos para o banco de dados
    |--------------------------------------------------------------------------*/
    public function import(){
        //Valida os campos Obrigatórios.
        $this->validate([ 
            'arquivo' => 'required|mimes:csv,txt',
        ]);
        try{
            //coloca o arquivo em uma pasta temporaria e trasforma em array sting 
            $alunos = file($this->arquivo->path());
            $addAluno = '';
            foreach($alunos as $aluno){
                //Retira os espaços e os ";" da string 
                $valor = explode(';', $aluno = trim($aluno));
                //Elimina os dado do aluno caso ele ja esteja cadastrado.
                if($verificaMat = Aluno::where('matricula', $valor[1])->exists()){
                    unset($aluno);
                }
                //Salva dados do aluno no banco caso seu cadastro não tenha sido feito anteriormente. 
                if(!$verificaMat){
                    $addAluno = Aluno::create([
                        'nome' => $valor[0],
                        'matricula' => $valor[1],
                        'data_nascimento' => $valor[2],
                        'sexo' => $valor[3],
                    ]);
                }
            }
            //Retorna caso nenhum aluno vindo do arquivo exista antes no banco. 
            if(!$verificaMat && $addAluno){
                return session()->flash('successModal', 'Dados dos alunos foram importados com sucesso.'); 
                $this->arquivo = '';
            }
            //Retorna caso todos os alunos do arquivo existam no banco
            if($verificaMat && !$addAluno){
                return session()->flash('errorModal', 'Esses alunos já foram adicionados.'); 
                $this->arquivo = '';
            }
            //Retorna caso alguns alunos do arquivo existam no banco e outros não.
            if($verificaMat &&  $addAluno){
                return session()->flash('attentionModal', 'Dados dos alunos importados com sucesso, alguns alunos foram ingnorados pois seus dados já havim sido adicionado anteriormente.'); 
                $this->arquivo = '';
            }
        }catch(Exception $e){
            session()->flash('errorModal', $e);
        }
    }

    /*--------------------------------------------------------------------------
    | Abre modal para mostrar dados do aluno 
    |--------------------------------------------------------------------------*/
    public function show($id)
    {
        $aluno = Aluno::find($id);
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
        $this->dispatchBrowserEvent('show-view-modal');
    }

    /*--------------------------------------------------------------------------
    | Fecha modal que exibe dados do aluno
    |--------------------------------------------------------------------------*/
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

    /*--------------------------------------------------------------------------
    | Seleciona aluno que vai ter dados editado e abre a modal de edição
    |--------------------------------------------------------------------------*/
    public function selectEdit($id)
    {
        $aluno = Aluno::find($id);
        $this->edit_id = $aluno->id;
        $this->edit_foto = $aluno->foto;
        $this->edit_nome = $aluno->nome; 
        $this->edit_matricula = $aluno->matricula;
        $this->edit_data_nascimento = $aluno->data_nascimento; 
        $this->edit_sexo = $aluno->sexo; 
        $this->edit_telefone = $aluno->telefone; 
        $this->edit_email = $aluno->email; 
        $this->edit_responsavel = $aluno->responsavel; 
        $this->edit_telefone_responsavel = $aluno->telefone_responsavel;
        $this->edit_observacao = $aluno->observacao;
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    /*--------------------------------------------------------------------------
    | Edita os dados do aluno no banco e fecha modal de edição
    |--------------------------------------------------------------------------*/
    public function edit(){
       //Valida os campos Obrigatórios.
       $this->validate([ 
            'edit_nome' => 'required',
            'edit_matricula' => 'required',
            'edit_data_nascimento' => 'required',
            'edit_sexo' => 'required',
        ]);
        $aluno = Aluno::find($this->edit_id);
        //Verifica se a matrícula informada já existe.
        if($this->edit_matricula == $aluno->matricula){
            ##continua código## 
        }elseif(Aluno::where('matricula', $this->edit_matricula)->exists()){
             return session()->flash('attentionModal', 'Essa matrícula já pertence a outro aluno.');   
        }
        //Faz o upload da foto do aluno.
        if($this->previaFotoNova){
            //Valida a extensão da foto.
            $this->validate([
                'edit_foto' => 'image|mimes:jpg,jpeg,png'
            ]);
            //Remove foto atual 
            Storage::disk('public')->delete($aluno->foto);
            //Renomeia o arquivo.
            $nomeArquivo = $this->edit_matricula.'.'.$this->edit_foto->getClientOriginalExtension();
            //Faz o upload no diretório.
            $upload = $this->edit_foto->storeAS('Alunos', $nomeArquivo, 'public');
            //Verifica se o upload da foto foi feito.
            if(!$upload){
                return session()->flash('errorModal', 'Não foi possível fazer o upload da foto.'); 
            }
        }
        else{
            //Se não foi selecionado uma nova foto para o aluno, a foto atual permanecerá
            $upload =  $aluno->foto;
        }
        //Edita os dados.
        try{
            $aluno->update([
                'foto' => $upload,
                'nome' => $this->edit_nome,
                'matricula' => $this->edit_matricula,
                'data_nascimento' => $this->edit_data_nascimento,
                'sexo' => $this->edit_sexo,
                'telefone' => $this->edit_telefone,
                'email' => $this->edit_email,
                'responsavel' => $this->edit_responsavel,
                'telefone_responsavel' => $this->edit_telefone_responsavel,
                'observacao' => $this->edit_observacao
            ]);
            session()->flash('successList', 'Dados do aluno editado com sucesso!');
            //Limpa os campos
            $this->edit_foto = '';
            $this->edit_nome = '';
            $this->edit_matricula = '';
            $this->edit_data_nascimento = '';
            $this->edit_sexo = '';
            $this->edit_telefone = '';
            $this->edit_email = '';
            $this->edit_responsavel = '';
            $this->edit_telefone_responsavel = '';
            $this->edit_observacao = '';
            $this->previaFotoNova = '';
            $this->dispatchBrowserEvent('close-modal');
        }catch(Exception $e){
            session()->flash('errorModal', $e);
        }
    }

    /*--------------------------------------------------------------------------
    | Cancela edição do dados do aluno
    |--------------------------------------------------------------------------*/
    public function cancelEdit()
    {
        $this->edit_foto = '';
        $this->edit_nome = ''; 
        $this->edit_matricula = '';
        $this->edit_data_nascimento = ''; 
        $this->edit_sexo = ''; 
        $this->edit_telefone = ''; 
        $this->edit_email = ''; 
        $this->edit_responsavel = ''; 
        $this->edit_telefone_responsavel = '';
        $this->edit_observacao = '';
        $this->previaFotoNova = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    /*--------------------------------------------------------------------------
    | Abre modal para confirmar exclusão dos dados do aluno
    |--------------------------------------------------------------------------*/
    public function deleteConfirm($id)
    {
        $this->aluno_delete_id = $id; 
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    /*--------------------------------------------------------------------------
    | Deleta os dados do aluno do banco de dados
    |--------------------------------------------------------------------------*/
    public function destroy()
    {
        $aluno = Aluno::find($this->aluno_delete_id);
        Storage::disk('public')->delete($aluno->foto);
        $aluno->delete();
        session()->flash('successList', 'Aluno deletado com sucesso!');
        $this->dispatchBrowserEvent('close-modal');
        $this->aluno_delete_id = '';
    }

    /*--------------------------------------------------------------------------
    | Cancela a seleção do aluno que ia ter os dados deletados
    |--------------------------------------------------------------------------*/
    public function cancelDelete()
    {
        $this->aluno_delete_id = '';
        $this->dispatchBrowserEvent('close-modal');
    }
}

//398 linhas de código !------>> diminuir 50%.