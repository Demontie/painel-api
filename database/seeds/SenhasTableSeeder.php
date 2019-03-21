<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Senha;
use App\Classes\Utils\Status_Senha;

class SenhasTableSeeder extends Seeder
{
    private $status;

    public function __construct(Status_Senha $status)
    {
        $this->status = $status;
    }

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
                        'tipo_id' => 2,
                        'numero' => (10 + $x),
                        'grupo_sala_id' => 1,
                        'status' => $this->status::AGUARDANDO_CHAMADA

                    ]);
                }else if($x <= 7){
                    Senha::create([
                        'tipo_id' => 1,
                        'numero' => (10 + $x),
                        'grupo_sala_id' => 1,
                        'status' => $this->status::CHAMADA_RECEPCAO
                    ]);
                }
            }else{
                Senha::create([
                    'tipo_id' => 1,
                    'numero' => (10 + $x),
                    'grupo_sala_id' => 1,
                    'status' => $this->status::AGUARDANDO_CHAMADA
                ]);
            }
        }
    }
}
