<?php

use App\Models\Painel\GuicheAtivo;
use Illuminate\Database\Seeder;

class GuicheAtivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GuicheAtivo::create([
            'user_id' => 1,
            'guiche_id' => 1
        ]);
    }
}
