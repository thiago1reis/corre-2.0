<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;

    protected $table = 'servidores';

    protected $fillable = ['nome', 'tipo', 'observacao'];

    public static function tipos()
    {
      return collect([
        'Professor' => 'Professor',
        'Tec. Admin. Educacional' => 'Tec. Admin. Educacional',
      ]);
    }

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class);
    }

}
