<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PainelController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('painel');
    }
}
