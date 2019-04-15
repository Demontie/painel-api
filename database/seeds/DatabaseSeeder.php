<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            /*
             * 1
             */
            SalasTableSeeder::class,
            GrupoTelasTableSeeder::class,
            TipoSenhaTableSeeder::class,
            GuichesTableSeeder::class,
            /*
             * 2
             */
            TelasTableSeeder::class,
            /*
             * 3
             */
            GrupoSalasTableSeeder::class,
            //SenhasTableSeeder::class,
        ]);
    }
}
