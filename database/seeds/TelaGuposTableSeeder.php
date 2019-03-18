<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Tela_grupo;

class TelaGuposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tela_grupo::create([
            'descricao' => 'Recepção'
        ]);

        Tela_grupo::create([
            'descricao' => 'Odonto'
        ]);
    }
}
