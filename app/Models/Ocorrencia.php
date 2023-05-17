<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    use HasFactory;
    protected $table = 'ocorrencias';
    protected $fillable = [
        'tipo',
        'descricao',
        'medida_adotada',
        'observacao',
        'bolsa_aluno',
        'setor_encaminhado',
        'data',
        'usuario_id',
        'servidor_id',
        'disciplina_id',
        'aluno_id',
        'turma_id'
    ];
}
