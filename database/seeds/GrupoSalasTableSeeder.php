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
            'id_tela_grupo' => 1,
            'id_sala' => 1
        ]);

        Grupo_sala::create([
            'id_tela_grupo' => 2,
            'id_sala' => 2
        ]);
    }
}
