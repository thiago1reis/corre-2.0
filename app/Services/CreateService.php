<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class CreateService
{
    public function create(Model $model, $dados){
       return $model->create($dados);  
    }
}