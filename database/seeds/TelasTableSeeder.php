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
            'tela_grupo_id' => 1
        ]);

        Tela::create([
            'descricao' => 'Tela Odonto',
            'tela_grupo_id' => 1
        ]);

        Tela::create([
            'descricao' => 'Tela Superior',
            'tela_grupo_id' => 2
        ]);
    }
}
