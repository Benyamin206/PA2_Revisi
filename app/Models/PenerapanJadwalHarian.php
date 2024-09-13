<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerapanJadwalHarian extends Model
{
    use HasFactory;

    protected $table = 'penerapan_jadwal_harians';
    protected $fillable = [
        'tanggal_penerapan_jadwal_harians'
    ];
}
