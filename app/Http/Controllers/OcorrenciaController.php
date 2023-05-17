<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OcorrenciaController extends Controller
{
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('ocorrencia.cadastro-ocorrencia');
    }
}
