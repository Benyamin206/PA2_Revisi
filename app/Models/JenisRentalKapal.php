<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRentalKapal extends Model
{
    use HasFactory;

    protected $table = 'jenis_rental_kapal';

    protected $fillable = [
        'jenis'
    ];

    public function rental_kapal(){
        return $this->hasMany(RentalKapal::class);
    }
}
