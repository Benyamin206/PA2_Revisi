<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muatan extends Model
{
    use HasFactory;


    protected $table = 'muatans';

    protected $fillable = [
        'nama',
        'harga_per_item',
        'maksimal',
        'aktif',
        'jenis_muatan_id'
    ];

    // public function pemesanan_jadwal(){
    //     return $this->belongsTo(PemesananJadwal::class);
    // }

    public function detail_pesan_jadwal(){
        return $this->hasMany(DetailPesanJadwal::class);
    }

    public function jenis_muatan(){
        return $this->belongsTo(JenisMuatan::class);
    }
    

}

