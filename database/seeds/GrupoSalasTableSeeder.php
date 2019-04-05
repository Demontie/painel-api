<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Grupo_sala;

class GrupoSalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo_sala::create([
            'grupo_tela_id' => 1,
            'sala_id' => 1
        ]);

        Grupo_sala::create([
            'grupo_tela_id' => 1,
            'sala_id' => 3
        ]);

        Grupo_sala::create([
            'grupo_tela_id' => 1,
            'sala_id' => 4
        ]);

        Grupo_sala::create([
            'grupo_tela_id' => 2,
            'sala_id' => 2
        ]);
    }
}
