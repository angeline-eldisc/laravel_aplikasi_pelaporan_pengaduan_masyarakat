<?php

use App\Masyarakat;
use Illuminate\Database\Seeder;

class MasyarakatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Masyarakat::truncate();

        Masyarakat::create([
            'nik' => 'user',
            'nama' => 'Masyarakat',
            'username' => 'user',
            'password' => bcrypt('user'),
            'telp' => '08192837490'
        ]);
    }
}
