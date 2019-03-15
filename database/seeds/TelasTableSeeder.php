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
            'descricao' => 'Tela recepção'
        ]);

        Tela::create([
            'descricao' => 'Tela Odonto'
        ]);

        Tela::create([
            'descricao' => 'Tela Superior'
        ]);
    }
}
