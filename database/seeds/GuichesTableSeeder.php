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
        Guiche::create([
            'descricao' => 'Guichê 1'
        ]);
    }
}
