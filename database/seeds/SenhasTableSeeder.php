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
        for($x = 0; $x < 15; $x++){
            if($x < 8){
                if($x%2 == 0){

                    Senha::create([
                        'id_tipo' => 2,
                        'numero' => (10 + $x),
                        'id_tela_grupo' => 1

                    ]);
                }else if($x <= 7){
                    Senha::create([
                        'id_tipo' => 1,
                        'numero' => (10 + $x),
                        'id_tela_grupo' => 1

                    ]);
                }
            }else{
                Senha::create([
                    'id_tipo' => 1,
                    'numero' => (10 + $x),
                    'id_tela_grupo' => 1

                ]);
            }
        }
    }
}
