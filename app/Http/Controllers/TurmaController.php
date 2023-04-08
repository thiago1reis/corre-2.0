<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Services\GetAllService;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    private GetAllService $getAllService;

    public function __construct(GetAllService $getAllService)
    {
        $this->getAllService = $getAllService;
    }

    public function index()
    {

        //Campos que irão como parâmetro para retornar os dados
        $turmas = Turma::paginate();
        return view('turma.lista-turma', ['turmas' => $turmas]);
    }
}
