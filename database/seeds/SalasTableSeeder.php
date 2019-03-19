<?php

use Illuminate\Database\Seeder;
use App\Models\Painel\Sala;

class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sala::create([
            'descricao' => 'Sala 01',
            'sala_id_stg' => 101,
        ]);

        Sala::create([
            'descricao' => 'Sala 02',
            'sala_id_stg' => 102,
        ]);

        Sala::create([
            'descricao' => 'Sala 03',
            'sala_id_stg' => 103,
        ]);

        Sala::create([
            'descricao' => 'Sala 04',
            'sala_id_stg' => 104,
        ]);
    }
}
