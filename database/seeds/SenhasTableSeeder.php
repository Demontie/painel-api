<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Senha;
use App\Classes\Utils\ConstantesPainel;

class SenhasTableSeeder extends Seeder
{
    private $constantesPainel;

    public function __construct(ConstantesPainel $constantesPainel)
    {
        $this->constantesPainel = $constantesPainel;
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
                        'tipo_senha_id' => 2,
                        'numero' => (10 + $x),
                        'grupo_sala_id' => 1,
                        'status' => $this->constantesPainel::AGUARDANDO_CHAMADA

                    ]);
                }else if($x <= 7){
                    Senha::create([
                        'tipo_senha_id' => 1,
                        'numero' => (10 + $x),
                        'grupo_sala_id' => 1,
                        'status' => $this->constantesPainel::CHAMADA_RECEPCAO
                    ]);
                }
            }else{
                Senha::create([
                    'tipo_senha_id' => 1,
                    'numero' => (10 + $x),
                    'grupo_sala_id' => 1,
                    'status' => $this->constantesPainel::AGUARDANDO_CHAMADA
                ]);
            }
        }
    }
}
