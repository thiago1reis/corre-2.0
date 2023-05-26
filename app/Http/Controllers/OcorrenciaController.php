<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ocorrencia;
use Illuminate\Http\Request;

class OcorrenciaController extends Controller
{

    /**
     * index
     *
     * @param  Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $busca = request()->input('busca');

        $ocorrencias = Ocorrencia::query()
            // ->when($busca, function ($query, $busca) {
            //     $query->where(function ($query) use ($busca) {
            //         $query->where('nome', 'LIKE', '%' . $busca . '%')
            //             ->orWhere('observacao', 'LIKE', '%' . $busca . '%');
            //     });
            // })

            ->orderBy('created_at', 'DESC')
            ->paginate(4);

        return view('ocorrencia.lista-ocorrencia',  compact('ocorrencias', 'busca'));
    }
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
