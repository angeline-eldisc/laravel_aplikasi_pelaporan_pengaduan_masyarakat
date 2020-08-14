<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = "tanggapan";

    protected $fillable = ['id', 'pengaduan_id', 'tgl_tanggapan', 'tanggapan', 'petugas_id', 'status'];

    public function pengaduan(){
        return $this->belongsTo('App\Pengaduan');
    }

    public function petugas(){
        return $this->belongsTo('App\Petugas');
    }
}
