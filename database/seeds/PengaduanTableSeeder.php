<?php

use App\Pengaduan;
use Illuminate\Database\Seeder;

class PengaduanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaduan::truncate();
    }
}
