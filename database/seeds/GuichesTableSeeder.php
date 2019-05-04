<?php

use App\Models\Painel\Guiche;
use Illuminate\Database\Seeder;

class GuichesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x= 0; $x < 5; $x++){
            Guiche::create([
                'descricao' => 'Guichê '.($x + 1),
                'grupo_tela_id' => 1
            ]);
        }
    }
}
