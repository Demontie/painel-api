<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Tela_sala;

class TelaSalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tela_sala::create([
            'sala_id' => 1,
            'id_tela' => 1
        ]);

        Tela_sala::create([
            'sala_id' => 1,
            'id_tela' => 2
        ]);

        Tela_sala::create([
            'sala_id' => 1,
            'id_tela' => 3
        ]);

//        Tela_sala::create([
//            'id_sala' => 102,
//            'id_tela' => 1
//        ]);
    }
}
