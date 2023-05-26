<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    protected $fillable = ['foto', 'nome', 'matricula', 'data_nascimento', 'sexo', 'telefone', 'email', 'responsavel', 'telefone_responsavel', 'observacao'];

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class);
    }
}
