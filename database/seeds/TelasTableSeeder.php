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
            'grupo_tela_id' => 1
        ]);

        Tela::create([
            'descricao' => 'Tela Odonto',
            'grupo_tela_id' => 1
        ]);

        Tela::create([
            'descricao' => 'Tela Superior',
            'grupo_tela_id' => 2
        ]);
    }
}
