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
            TelasTableSeeder::class,
            TipoTableSeeder::class,
            /*
             * 2
             */
            TelaSalasTableSeeder::class,
            /*
             * 3
             */
            SenhasTableSeeder::class,
        ]);
    }
}
