<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Sala;

class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sala::create([
            'descricao' => 'Sala 01',
            'sala_id_stg' => 101,
            'grupo_tela_id' => 1
        ]);

        Sala::create([
            'descricao' => 'Sala 02',
            'sala_id_stg' => 102,
            'grupo_tela_id' => 1
        ]);

        Sala::create([
            'descricao' => 'Sala 03 - Odontologia',
            'sala_id_stg' => 103,
            'grupo_tela_id' => 2
        ]);

        Sala::create([
            'descricao' => 'Sala 04',
            'sala_id_stg' => 104,
            'grupo_tela_id' => 1
        ]);
    }
}
