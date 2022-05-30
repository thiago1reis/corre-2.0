<?php

use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{Alunos, Index, Painel};

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


Route::get('/', Index::class)->name('home');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['prefix' => 'sistema', 'middleware' => ['auth']], function(){
    Route::get('/',  Painel::class)->name('painel');
    Route::get('alunos', Alunos::class, 'render')->name('alunos');
});
 