<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
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
        $disciplinas = Disciplina::query()
            ->when($busca, function ($query, $busca) {
                $query->where(function ($query) use ($busca) {
                    $query->where('nome', 'LIKE', '%' . $busca . '%')
                        ->orWhere('observacao', 'LIKE', '%' . $busca . '%');
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('disciplina.lista-disciplina', compact('disciplinas', 'busca'));
    }


    /**
     * destroy
     *
     * @param Disciplina $disciplina
     * @return void
     */
    public function destroy(Disciplina $disciplina)
    {
        $disciplina->delete();
        return redirect()->back()->with('success', 'Dados da disciplina foram excluídos com sucesso!');
    }
}
