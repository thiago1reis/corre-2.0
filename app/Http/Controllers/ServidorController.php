<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Servidor;
use Illuminate\Http\Request;

class ServidorController extends Controller
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
        $servidores = Servidor::query()
            ->when($busca, function ($query, $busca) {
                $query->where(function ($query) use ($busca) {
                    $query->where('nome', 'LIKE', '%' . $busca . '%')
                        ->orWhere('tipo', 'LIKE', '%' . $busca . '%')
                        ->orWhere('observacao', 'LIKE', '%' . $busca . '%');
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('servidor.lista-servidor', compact('servidores', 'busca'));
    }


    /**
     * destroy
     *
     * @param Servidor $servidor
     * @return void
     */
    public function destroy(Servidor $servidor)
    {
        $servidor->delete();
        return redirect()->back()->with('success', 'Dados do servidor foram excluídos com sucesso!');
    }
}
