<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    use HasFactory;

    protected $table = 'kapals';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'user_id',
        'aktif',
        'kapasitas',
        'available_booking',
        'booking',
        'tanggal_tersedia_booking',
        'diizinkan'
    ];


    public function user(){

        return $this->belongsTo(User::class);

    }

    public function jadwals(){
        return $this->hasMany(Jadwal::class);
    }

    public function pemesanan_jadwal(){
        return $this->hasMany(PemesananJadwal::class);
    }

    public function lokasi_berangkat_rental_kapal(){
        return $this->hasMany(LokasiBerangkatRentalKapal::class);
    }

    public function rental_kapals(){
        return $this->hasMany(RentalKapal::class);
    }

    public function jadwal_harians(){
        return $this->hasMany(JadwalHarian::class);
    }

}
