<?php

use App\Tanggapan;
use Illuminate\Database\Seeder;

class TanggapanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tanggapan::truncate();
    }
}
