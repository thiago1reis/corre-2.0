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
                'name' => 'Thiago Alexandre',
                'email' => 'thiagoalexandreis@gmail.com',
                'password' => bcrypt('123456789'),
                'tipo' => 1,
                'status' => 1,
            ]
        )->create();
    }
}
