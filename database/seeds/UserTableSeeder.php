<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@teste.com',
            'password' => bcrypt('admin'),
            'perfil_id' => 1
        ]);

        User::create([
            'name' => 'Guichê 1',
            'email' => 'guiche1@teste.com',
            'password' => bcrypt('guiche1'),
            'perfil_id' => 2
        ]);

        User::create([
            'name' => 'Tela 1',
            'email' => 'tela1@teste.com',
            'password' => bcrypt('tela1'),
            'perfil_id' => 3
        ]);
    }
}
