<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Tela;

class TelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tela::create([
            'descricao' => 'Tela recepção',
            'id_tela_grupo' => 1
        ]);

        Tela::create([
            'descricao' => 'Tela Odonto',
            'id_tela_grupo' => 2
        ]);

        Tela::create([
            'descricao' => 'Tela Superior',
            'id_tela_grupo' => 1
        ]);
    }
}
