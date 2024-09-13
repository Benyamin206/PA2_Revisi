<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalKapal extends Model
{
    use HasFactory;

    protected $table = 'rental_kapal';
    protected $fillable = [
        'user_id',
        'kapal_id',
        'waktu_berangkat',
        'status_pembayaran',
        'bukti_pembayaran',
        'harga',
        'pemilik_kapal_id',
        'lokasi_berangkat',
        'jenis_rental_kapal_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kapal(){
        return $this->belongsTo(Kapal::class);
    }

    public function jenisRentalKapal()
    {
        return $this->belongsTo(JenisRentalKapal::class);
    }
    
}
