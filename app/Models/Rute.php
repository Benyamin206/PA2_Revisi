<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;

    protected $table = 'rutes';

    protected $fillable = [
        'lokasi_berangkat',
        'lokasi_tujuan',
        'aktif'
    ];

    public function jadwals(){
        return $this->hasMany(Jadwal::class);
    }

    public function jadwal_harians(){
        return $this->hasMany(JadwalHarian::class);
    }
    
}
