<?php

use App\Petugas;
use Illuminate\Database\Seeder;

class PetugasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Petugas::truncate();

        Petugas::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'telp' => '08192839480',
            'level' => 'Admin',
            'status' => '1'
        ]);

        Petugas::create([
            'nama' => 'Angeline Eldisc',
            'username' => 'angel',
            'password' => bcrypt('angel'),
            'telp' => '08192738420',
            'level' => 'Admin',
            'status' => '0'
        ]);

        Petugas::create([
            'nama' => 'Petugas',
            'username' => 'petugas',
            'password' => bcrypt('petugas'),
            'telp' => '08128374850',
            'level' => 'Petugas',
            'status' => '1'
        ]);
    }
}
