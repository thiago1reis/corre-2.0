<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class GetAllService
{
    public function getAll(Model $model, $campos, $busca, $paginas){
        return $model->where("{$campos[0]}", 'LIKE', "%{$busca}%")->Orwhere("{$campos[1]}", 'LIKE', "%{$busca}%")->orderBy('id' , "DESC")->paginate($paginas);
    }
}