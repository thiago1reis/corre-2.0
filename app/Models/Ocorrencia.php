<?php

namespace App\Models;

use App\Models\User as Usuario;
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

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function servidor()
    {
        return $this->belongsTo(Servidor::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
