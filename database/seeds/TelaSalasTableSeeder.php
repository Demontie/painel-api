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
            'sala_id_stg' => 101
        ]);

        Tela_sala::create([
            'sala_id_stg' => 101
        ]);

        Tela_sala::create([
            'sala_id_stg' => 101
        ]);

//        Tela_sala::create([
//            'id_sala' => 102,
//            'id_tela' => 1
//        ]);
    }
}
