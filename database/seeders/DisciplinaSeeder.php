<?php

namespace Database\Seeders;

use App\Models\Disciplina;
use Illuminate\Database\Seeder;

class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //Define os valores
       $disciplinas = collect([
        [
           'nome' => 'Língua Portuguesa',
           'observacao' => '',
        ],
        [
            'nome' => 'Tópicos Especiais',
            'observacao' => 'Disciplina complementar',
        ],
        [
            'nome' => 'Matemática',
            'observacao' => '',
        ],
        [
            'nome' => 'Geografia',
            'observacao' => '',
        ],
        [
            'nome' => 'Sociologia',
            'observacao' => '',
        ],
        [
            'nome' => 'Matemática Avançada',
            'observacao' => '',
        ],
        [
            'nome' => 'Educação Física',
            'observacao' => '',
        ],
        [
            'nome' => 'Gramática',
            'observacao' => 'Disciplina complementar',
        ],
        [
            'nome' => 'Geografia Regional',
            'observacao' => 'Disciplina complementar',
        ],
        [
            'nome' => 'Banco de Dados',
            'observacao' => 'Discplina do curso técnico em infomática',
        ],
        [
            'nome' => 'Banco de Dados II',
            'observacao' => 'Discplina do curso técnico em infomática',
        ],
        [
            'nome' => 'Programação',
            'observacao' => 'Discplina do curso técnico em infomática',
        ],
        [
            'nome' => 'Biologia',
            'observacao' => '',
        ],
        [
            'nome' => 'Redação',
            'observacao' => 'Disciplina complementar',
        ],
        [
            'nome' => 'Química',
            'observacao' => '',
        ],
        [
            'nome' => 'Física',
            'observacao' => '',
        ],
        [
            'nome' => 'Gestão Administrativa',
            'observacao' => 'Discplina do curso técnico em administração',
        ],
        [
            'nome' => 'Introdução aos Biomas',
            'observacao' => 'Discplina do curso técnico em meio ambiente',
        ],
        [
            'nome' => 'Lógica Matemática',
            'observacao' => 'Disciplina complementar',
        ],
        [
            'nome' => 'Tópicos Especiais II',
            'observacao' => 'Disciplina complementar',
        ],
    ]);

        //Insere os dados no banco
        foreach ($disciplinas as $valor) {
            Disciplina::create([
                'nome' => $valor['nome'],
                'observacao' => $valor['observacao'],
            ]);
        }
    }
}
