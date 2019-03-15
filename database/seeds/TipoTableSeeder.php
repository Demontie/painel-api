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
            'descricao' => 'Atendimento Normal'
        ]);

        Tipo::create([
            'prefixo' => 'P',
            'descricao' => 'Atendimento Prioridade'
        ]);

        Tipo::create([
            'prefixo' => 'E',
            'descricao' => 'Exame'
        ]);
    }
}
