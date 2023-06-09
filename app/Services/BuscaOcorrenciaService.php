<?php

namespace App\Services;

use App\Models\Ocorrencia;
use DateTime;

class BuscaOcorrenciaService
{
    protected Ocorrencia $ocorrencia;

    public function __construct(Ocorrencia $ocorrencia)
    {
        $this->ocorrencia = $ocorrencia;
    }


    /**
     * buscar
     *
     * @param  string $busca
     * @return \App\Models\Ocorrencia $ocorrencia
     */
    public function buscar($busca)
    {
        $data = isset($busca) ? DateTime::createFromFormat('d/m/Y', $busca) : null;

        return $this->ocorrencia
            ->when(
                $busca,
                function ($query) use ($busca, $data) {
                    $query->where(function ($query) use ($busca, $data) {
                        $query->whereHas('usuario', function ($query) use ($busca) {
                            $query->where('name', 'LIKE', '%' . $busca . '%');
                        })
                            ->orWhereHas('servidor', function ($query) use ($busca) {
                                $query->where('nome', 'LIKE', '%' . $busca . '%')
                                    ->orWhere('tipo', 'LIKE', '%' . $busca . '%');
                            })
                            ->orWhereHas('disciplina', function ($query) use ($busca) {
                                $query->where('nome', 'LIKE', '%' . $busca . '%');
                            })
                            ->orWhereHas('aluno', function ($query) use ($busca, $data) {
                                $query->where('nome', 'LIKE', '%' . $busca . '%')
                                    ->orWhere('matricula', 'LIKE', '%' . $busca . '%')
                                    ->orWhereDate('data_nascimento', $data)
                                    ->orWhere('sexo', 'LIKE', '%' . $busca . '%');
                            })
                            ->orWhereHas('turma', function ($query) use ($busca) {
                                $query->where('etapa_modalidade', 'LIKE', '%' . $busca . '%')
                                    ->orWhere('modulo_serie', 'LIKE', '%' . $busca . '%')
                                    ->orWhere('curso', 'LIKE', '%' . $busca . '%');
                            })
                            ->orWhere('tipo', 'LIKE', '%' . $busca . '%')
                            ->orWhere('descricao', 'LIKE', '%' . $busca . '%')
                            ->orWhere('medida_adotada', 'LIKE', '%' . $busca . '%')
                            ->orWhere('observacao', 'LIKE', '%' . $busca . '%')
                            ->orWhere('bolsa_aluno', 'LIKE', '%' . $busca . '%')
                            ->orWhere('setor_encaminhado', 'LIKE', '%' . $busca . '%')
                            ->orWhereDate('data', $data)
                            ->orWhereDate('created_at', $data);
                    });
                }
            )
            ->orderBy('created_at', 'DESC');
    }
}
