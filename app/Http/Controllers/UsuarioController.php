<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User as Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
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
        $usuarios = Usuario::query()
            ->when($busca, function ($query, $busca) {
                $query->where(function ($query) use ($busca) {
                    $query->where('name', 'LIKE', '%' . $busca . '%')
                        ->orWhere('email', 'LIKE', '%' . $busca . '%');
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('usuario.lista-usuario', compact('usuarios', 'busca'));
    }


    /**
     * destroy
     *
     * @param Usuario $usuario
     * @return void
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->back()->with('success', 'Dados do usuário foram excluídos com sucesso!');
    }
}
