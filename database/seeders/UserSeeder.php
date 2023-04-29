<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(
            [
                'name' => 'Usuário Administrador',
                'email' => 'adm@corre.com',
                'password' => bcrypt('4a6d3m'),
                'tipo' => 1,
                'status' => 1,
            ]
        )->create();

        User::factory(
            [
                'name' => 'Usuário Padrão',
                'email' => 'pdr@corre.com',
                'password' => bcrypt('9p6d2r'),
                'tipo' => 0,
                'status' => 1,
            ]
        )->create();

        User::factory(
            [
                'name' => 'Thiago Alexandre Reis',
                'email' => 'thiagoalexandreis@gmail.com',
                'password' => bcrypt('usu2217th'),
                'tipo' => 1,
                'status' => 1,
            ]
        )->create();
    }
}
