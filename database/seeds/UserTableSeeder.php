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
            'nome' => 'Admin',
            'email' => 'admin@teste.com',
            'password' => bcrypt('admin'),
            'perfil_id' => 1
        ]);

        User::create([
            'nome' => 'Guichê 1',
            'email' => 'guiche1@teste.com',
            'password' => bcrypt('admin'),
            'perfil_id' => 2
        ]);

        User::create([
            'nome' => 'Tela 1',
            'email' => 'tela1@teste.com',
            'password' => bcrypt('admin'),
            'perfil_id' => 3
        ]);
    }
}
