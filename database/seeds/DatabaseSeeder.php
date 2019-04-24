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
            UserTableSeeder::class,

            GrupoTelasTableSeeder::class,
            TipoSenhaTableSeeder::class,
            /*
             * 2
             */
            //GrupoSalasTableSeeder::class,
            GuichesTableSeeder::class,
            /*
             * 3
             */
            SalasTableSeeder::class,
            TelasTableSeeder::class,
            //SenhasTableSeeder::class,
        ]);
    }
}
