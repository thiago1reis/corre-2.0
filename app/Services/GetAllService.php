<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class GetAllService
{
    public function getAll(Model $model, $fileds, $search){
        return $model->where("{$fileds[0]}", 'LIKE', "%{$search}%")->Orwhere("{$fileds[1]}", 'LIKE', "%{$search}%")->orderBy('id' , "DESC")->paginate(10);
    }
}