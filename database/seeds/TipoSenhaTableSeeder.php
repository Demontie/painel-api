<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\TipoSenha;

class TipoSenhaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoSenha::create([
            'prefixo' => 'N',
            'descricao' => 'Atendimento Normal',
            'ordem' => 1,
            'grupo_tela_id' => 1
        ]);

        TipoSenha::create([
            'prefixo' => 'P',
            'descricao' => 'Atendimento Prioridade',
            'cor' => 'error darken-4',
            'ordem' => 2,
            'grupo_tela_id' => 1
        ]);

        TipoSenha::create([
            'prefixo' => 'E',
            'descricao' => 'Exame',
            'cor' => 'success darken-4',
            'ordem' => 3,
            'grupo_tela_id' => 1
        ]);
    }
}
