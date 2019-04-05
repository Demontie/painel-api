<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\GrupoTela;

class GrupoTelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GrupoTela::create([
            'descricao' => 'Recepção',
            'ativo' => true
        ]);

        GrupoTela::create([
            'descricao' => 'Odonto',
            'ativo' => true
        ]);
    }
}
