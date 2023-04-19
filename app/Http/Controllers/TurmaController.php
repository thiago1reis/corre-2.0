<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
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
        $turmas = Turma::query()
            ->when($busca, function ($query, $busca) {
                $query->where(function ($query) use ($busca) {
                    $query->where('etapa_modalidade', 'LIKE', '%' . $busca . '%')
                        ->orWhere('modulo_serie', 'LIKE', '%' . $busca . '%')
                        ->orWhere('curso', 'LIKE', '%' . $busca . '%')
                        ->orWhere('observacao', 'LIKE', '%' . $busca . '%');
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('turma.lista-turma', compact('turmas', 'busca'));
    }


    /**
     * destroy
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect()->back()->with('success', 'Dados da turma foram excluídos com sucesso!');
    }
}
