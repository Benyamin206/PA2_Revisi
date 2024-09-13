<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiBerangkatRentalKapal extends Model
{
    use HasFactory;

    protected $table = 'lokasi_berangkat_rental_kapal.php';

    protected $fillable = [
        'nama_lokasi',
        'kapal_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
