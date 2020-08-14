<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table ="pengaduan";

    protected $fillable = ['tgl_pengaduan', 'masyarakat_id', 'isi_laporan', 'foto', 'status'];

    public function masyarakat(){
        return $this->belongsTo('App\Masyarakat');
    }

    public function tanggapan(){
        return $this->hasMany('App\Tanggapan');
    }
}
