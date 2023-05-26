<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $table = 'disciplinas';

    protected $fillable = ['nome', 'observacao'];

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class);
    }
}
