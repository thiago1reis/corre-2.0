<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\TurmaController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{Alunos, Disciplinas, Login, Painel, Servidores};

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

    Route::get('servidores', Servidores::class, 'render')->name('servidores');

    /*Turma*/
    Route::get('turma', [TurmaController::class, 'index'])->name('turma.index');
    Route::delete('turma/deletar/{turma}', [TurmaController::class, 'destroy'])->name('turma.destroy');
});
