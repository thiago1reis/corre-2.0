<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class DeleteService
{
    public function delete(Model $model){
        return $model->delete();  
    }
}