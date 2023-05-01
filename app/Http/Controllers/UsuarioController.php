<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User as Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * Módulo de configuração
     *
     * edit
     *
     * @param  Usuario $usuario
     * @return void
     */
    public function edit(Usuario $usuario)
    {
        // Retorna ao painel caso tente passar id diferente do que está logado
        if ($usuario->id != auth()->user()->id) {
            return redirect()->route('usuario.edit', ['usuario' =>  auth()->user()->id]);
        }

        return view('configuracao', compact('usuario'));
    }


    /**
     * Módulo de configuração
     *
     * update
     *
     * @param  Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->id),
            ],
        ]);

        $usuario = Usuario::find($request->id);
        $usuario->name =  $request->name;
        $usuario->email =  $request->email;
        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();
        return redirect()->back()->with('success', 'Seus dados foram salvos com sucesso!');
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
