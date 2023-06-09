<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\OcorrenciaController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/check-auth', [LoginController::class, 'checkAuth'])->name('checkAuth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'sistema', 'middleware' => ['auth']], function(){
    /*Painel*/
    Route::get('/',  [PainelController::class, 'index'])->name('painel');

    /*Aluno*/
    Route::get('aluno', [AlunoController::class, 'index'])->name('aluno.index');
    Route::delete('aluno/deletar/{aluno}', [AlunoController::class, 'destroy'])->name('aluno.destroy');

    /*Disciplina*/
    Route::get('disciplina', [DisciplinaController::class, 'index'])->name('disciplina.index');
    Route::delete('disciplina/deletar/{disciplina}', [DisciplinaController::class, 'destroy'])->name('disciplina.destroy');

    /*Servidor*/
    Route::get('servidor', [ServidorController::class, 'index'])->name('servidor.index');
    Route::delete('servidor/deletar/{servidor}', [ServidorController::class, 'destroy'])->name('servidor.destroy');

    /*Turma*/
    Route::get('turma', [TurmaController::class, 'index'])->name('turma.index');
    Route::delete('turma/deletar/{turma}', [TurmaController::class, 'destroy'])->name('turma.destroy');

    /*Usuário*/
    Route::get('usuario', [UsuarioController::class, 'index'])->name('usuario.index');
    Route::delete('usuario/deletar/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

    /*Configuração*/
    Route::get('/configuracao/{usuario}',  [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::put('/configuracao/atualizar',  [UsuarioController::class, 'update'])->name('usuario.update');

    /*Ocorrência*/
    Route::get('cadastrar-ocorrencia', [OcorrenciaController::class, 'create'])->name('ocorrencia.create');
    Route::get('consultar-ocorrencia', [OcorrenciaController::class, 'index'])->name('ocorrencia.index');
    Route::get('relatorio-ocorrencia/{ocorrenciaIdOrBusca?}', [OcorrenciaController::class, 'gerarPDF'])->name('ocorrencia.pdf');

});
