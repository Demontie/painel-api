<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Senha;

class SenhasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Senha::create([
            'tipo_id' => 1,
            'numero' => 10
        ]);

        Senha::create([
            'tipo_id' => 2,
            'numero' => 3
        ]);

        Senha::create([
            'tipo_id' => 1,
            'numero' => 11
        ]);
    }
}
