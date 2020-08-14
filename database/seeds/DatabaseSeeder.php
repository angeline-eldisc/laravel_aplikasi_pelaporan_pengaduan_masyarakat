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
        $this->call(PetugasTableSeeder::class);
        $this->call(MasyarakatTableSeeder::class);
        $this->call(PengaduanTableSeeder::class);
        $this->call(TanggapanTableSeeder::class);
    }
}
