<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class UpdateService
{
    public function update(Model $model, $dados){
       return $model->update($dados);  
    }
}