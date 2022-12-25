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

    public $_id;
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

    public $previaFoto;
    public $modulo;
    public $modal;
    public $busca;
    protected $paginationTheme = 'bootstrap';



    //Valida os campos obrigatórios 


    protected  function rules() {
        return [
            'nome' => 'required|min:6',
            'matricula' => ['required', Rule::unique('alunos')->ignore($this->aluno)],
            'data_nascimento' => 'required',
            'sexo' => 'required',
            //'foto' => ['required', Rule::unique('alunos')->ignore($this->aluno)],
        ];
    }

    //Limpa os campos
    protected function clearFields(){

        $this->_id = '';
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
    }
 
    //Inicializa as services
    public function boot(
        CreateService $createService, 
        UpdateService $updateService,
        DeleteService $deleteService,
        GetAllService $getAllService,
        //Aluno $aluno
        )
    {
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->getAllService = $getAllService;
        //$this->aluno = $aluno;
    }

    //Monta o componente
    public function mount(Aluno $aluno){
        $this->aluno = $aluno;
    }

    public function selectAluno($id){
         $this->aluno = Aluno::find($id);
         $this->_id = $this->aluno->id;
         $this->foto = $this->aluno->foto;
         $this->nome = $this->aluno->nome;
         $this->matricula = $this->aluno->matricula;
         $this->data_nascimento = $this->aluno->data_nascimento;
         $this->sexo = $this->aluno->sexo;
         $this->telefone = $this->aluno->telefone;
         $this->email = $this->aluno->email;
         $this->responsavel = $this->aluno->responsavel;
         $this->telefone_responsavel = $this->aluno->fotelefone_responsavelto;
         $this->observacao = $this->aluno->observacao;
    }

    //Abre modal
    public function showModal($modal, $id = null){
        
        $this->modal = $modal;
        
        if($this->modal == 'Editar'){
            $this->selectAluno($id);
            $this->dispatchBrowserEvent('show-save-modal');
        }
        
        elseif($this->modal == 'Deletar'){
            $this->selectAluno($id);
            $this->modulo = 'Disciplina';
            $this->dispatchBrowserEvent('show-delete-modal');
        }
        
        else{
            $this->id = null;
            $this->dispatchBrowserEvent('show-save-modal');
       }
    }

    //Fecha modal
    public function closeModal(){
        $this->clearFields();
        $this->dispatchBrowserEvent('close-modal');
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
       //$alunos = Aluno::paginate();
    
        return view('livewire.alunos.alunos', ['alunos' => $alunos ]);
       
    }


    public function updatedFoto()
    {
        // dd($this->foto->temporaryUrl());
        // dd($this->foto->path());
            
            // if(!$this->_id){
                   
                
                // }
              
                
        if($this->foto && !$this->_id){

            $this->validate([
                'foto' => [ 
                    'required' => 'mimes:jpg,png', 'dimensions:max_width=1000,max_height=1000', 'dimensions:min_width=700,min_height=700'
                ]
            ]);
            dd('1');
            $this->previaFoto = true;
        }   

        elseif($this->foto && $this->_id && $this->novaFoto){
            dd('2');
           return true;
        }

        elseif($this->foto && $this->_id){

            dd('3');
            $this->validate([
                'foto' => [ 
                    'required' => 'mimes:jpg,png', 'dimensions:max_width=1000,max_height=1000', 'dimensions:min_width=700,min_height=700'
                ]
            ]);

            $this->previaFoto = true;

        }

       
        
       
           
            
    }

    //Adiciona ou atualiza disciplina
    public function save(){
        $this->validate();
        
        $this->updatedFoto();

       dd('passei');
    }
   

    public function store()
    { 


    
       

        //Valida os campos Obrigatórios.
        $this->validate([ 
            'nome' => ['required', 'max:120'],
            'matricula' => ['required', Rule::unique(Aluno::class, 'matricula')],
            'data_nascimento' => ['required'],
            'sexo' => ['required'],
        ]);


        //Faz o upload da foto do 
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


    public function destroy()
    {
        $aluno = Aluno::find($this->aluno_delete_id);
        Storage::disk('public')->delete($aluno->foto);
        $aluno->delete();
        session()->flash('successList', 'Aluno deletado com sucesso!');
        $this->dispatchBrowserEvent('close-modal');
        $this->aluno_delete_id = '';
    }


    public function deleteFoto(){
        
    }
}    

    //398 linhas de código !------>> diminuir 50%.