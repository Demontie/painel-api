<?php

use App\Models\Painel\Perfil;
use Illuminate\Database\Seeder;

class PerfisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create([
           'descricao' => 'ADMINISTRADOR'
        ]);

        Perfil::create([
           'descricao' => 'GUICHE'
        ]);

        Perfil::create([
           'descricao' => 'TELA'
        ]);

        Perfil::create([
            'descricao' => 'MEDICO'
        ]);
    }
}
