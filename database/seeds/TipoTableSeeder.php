<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Tipo;

class TipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create([
            'prefixo' => 'N',
            'descricao' => 'Atendimento Normal',
            'ordem' => 1
        ]);

        Tipo::create([
            'prefixo' => 'P',
            'descricao' => 'Atendimento Prioridade',
            'cor' => 'error darken-4',
            'ordem' => 2
        ]);

        Tipo::create([
            'prefixo' => 'E',
            'descricao' => 'Exame',
            'cor' => 'success darken-4',
            'ordem' => 3
        ]);
    }
}
