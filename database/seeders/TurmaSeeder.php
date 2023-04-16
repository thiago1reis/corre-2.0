<?php

namespace Database\Seeders;

use App\Models\Turma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Define os valores
        $turmas = collect([
            //Técnico Integrado Ensino Médio(Técnico em Informática para Internet)
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '1º ano',
                'curso' => 'Técnico em Informática para Internet',
                'observacao' =>  'Período integral',
            ],
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '2º ano',
                'curso' => 'Técnico em Informática para Internet',
                'observacao' =>  'Período integral',
            ],
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '3º ano',
                'curso' => 'Técnico em Informática para Internet',
                'observacao' =>  'Período vespertino',
            ],

            //Técnico Integrado Ensino Médio(Técnico em Meio Ambiente)
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '1º ano',
                'curso' => 'Técnico em Meio Ambiente',
                'observacao' =>  'Período integral',
            ],
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '2º ano',
                'curso' => 'Técnico em Meio Ambiente',
                'observacao' =>  'Período integral',
            ],
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '3º ano',
                'curso' => 'Técnico em Meio Ambiente',
                'observacao' =>  'Período vespertino',
            ],

            //Técnico Integrado Ensino Médio(Técnico em Administração)
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '1º ano',
                'curso' => 'Técnico em Administração',
                'observacao' =>  'Período integral',
            ],
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '2º ano',
                'curso' => 'Técnico em Administração',
                'observacao' =>  'Período integral',
            ],
            [
                'etapa_modalidade' => 'Técnico Integrado Ensino Médio',
                'modulo_serie' => '3º ano',
                'curso' => 'Técnico em Administração',
                'observacao' =>  'Período vespertino',
            ],

            //Técnico Subsequente(Técnico em Informática)
            [
                'etapa_modalidade' => 'Técnico Subsequente',
                'modulo_serie' => '1º módulo',
                'curso' => 'Técnico em Informática',
                'observacao' =>  'Período vespertino',
            ],
            [
                'etapa_modalidade' => 'Técnico Subsequente',
                'modulo_serie' => '2º módulo',
                'curso' => 'Técnico em Informática',
                'observacao' =>  'Período vespertino',
            ],
            [
                'etapa_modalidade' => 'Técnico Subsequente',
                'modulo_serie' => '3º módulo',
                'curso' => 'Técnico em Informática',
                'observacao' =>  'Período vespertino',
            ],

            //Técnico Subsequente(Técnico em Logística)
            [
                'etapa_modalidade' => 'Técnico Subsequente',
                'modulo_serie' => '1º módulo',
                'curso' => 'Técnico em Logística',
                'observacao' =>  'Período vespertino',
            ],
            [
                'etapa_modalidade' => 'Técnico Subsequente',
                'modulo_serie' => '2º módulo',
                'curso' => 'Técnico em Logística',
                'observacao' =>  'Período vespertino',
            ],
            [
                'etapa_modalidade' => 'Técnico Subsequente',
                'modulo_serie' => '3º módulo',
                'curso' => 'Técnico em Logística',
                'observacao' =>  'Período vespertino',
            ],

            //Proeja(Técnico em Vendas)
            [
                'etapa_modalidade' => 'Proeja',
                'modulo_serie' => '1º ano',
                'curso' => 'Técnico em Vendas',
                'observacao' =>  'Período noturno',
            ],
            [
                'etapa_modalidade' => 'Proeja',
                'modulo_serie' => '2º ano',
                'curso' => 'Técnico em Vendas',
                'observacao' =>  'Período noturno',
            ],
            [
                'etapa_modalidade' => 'Proeja',
                'modulo_serie' => '3º ano',
                'curso' => 'Técnico em Vendas',
                'observacao' =>  'Período noturno',
            ],
        ]);

        //Insere os dados no banco
        foreach ($turmas as $valor) {
            Turma::create([
                'etapa_modalidade' => $valor['etapa_modalidade'],
                'modulo_serie' => $valor['modulo_serie'],
                'curso' => $valor['curso'],
                'observacao' =>  $valor['observacao']
            ]);
        }
    }
}
