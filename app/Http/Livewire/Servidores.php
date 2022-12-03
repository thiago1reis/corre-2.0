<?php

namespace App\Http\Livewire;

use App\Models\Servidor;
use App\Services\CreateService;
use App\Services\DeleteService;
use App\Services\GetAllService;
use App\Services\UpdateService;
use Livewire\Component;

class Servidores extends Component
{
    private CreateService $createService;
    private UpdateService $updateService;
    private DeleteService $deleteService;
    private GetAllService $getAllService;
    public $search;
    protected $paginationTheme = 'bootstrap';

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
    

    public function render(Servidor $servidor)
    {

         //Campos que irão como parâmetro para retornar os dados
         $fields = [
            'nome',
            'tipo',
        ];
     
        $servidores = $this->getAllService->getAll($servidor, $fields, $this->search); 
        return view('livewire.servidores.servidores', ['servidores' => $servidores ]);
    }
}
 