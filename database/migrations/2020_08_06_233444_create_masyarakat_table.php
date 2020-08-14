<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasyarakatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masyarakat', function (Blueprint $table) {
            $table->increments('id');
            $table->char('nik', 16);
            $table->string('nama', 35);
            $table->string('username', 25);
            $table->string('password');
            $table->string('telp', 13);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masyarakat');
    }
}
