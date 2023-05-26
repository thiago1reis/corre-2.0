<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';

    protected $fillable = ['etapa_modalidade', 'modulo_serie', 'curso', 'observacao'];

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class);
    }
}
