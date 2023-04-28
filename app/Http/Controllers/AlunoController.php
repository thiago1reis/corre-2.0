<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller
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
        $alunos = Aluno::query()
            ->when($busca, function ($query, $busca) {
                $query->where(function ($query) use ($busca) {
                    $query->where('nome', 'LIKE', '%' . $busca . '%')
                        ->orWhere('matricula', 'LIKE', '%' . $busca . '%')
                        ->orWhere('data_nascimento', 'LIKE', '%' . $busca . '%')
                        ->orWhere('sexo', 'LIKE', '%' . $busca . '%')
                        ->orWhere('telefone', 'LIKE', '%' . $busca . '%')
                        ->orWhere('email', 'LIKE', '%' . $busca . '%')
                        ->orWhere('responsavel', 'LIKE', '%' . $busca . '%')
                        ->orWhere('telefone_responsavel', 'LIKE', '%' . $busca . '%')
                        ->orWhere('observacao', 'LIKE', '%' . $busca . '%');
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('aluno.lista-aluno', compact('alunos', 'busca'));
    }


    /**
     * destroy
     *
     * @param Aluno $aluno
     * @return void
     */
    public function destroy(Aluno $aluno)
    {
        if ($aluno->foto) {
            Storage::disk('public')->delete($aluno->foto);
        }

        $aluno->delete();
        return redirect()->back()->with('success', 'Dados do aluno foram excluídos com sucesso!');
    }
}
