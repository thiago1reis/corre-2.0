<?php

use App\Http\Controllers\Login\LoginController;
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
Route::view('/','login')->name('home');
Route::post('/login', [LoginController::class, 'login'])->name('login');



Route::get('/sistema',  [LoginController::class, 'painel'])->name('painel');