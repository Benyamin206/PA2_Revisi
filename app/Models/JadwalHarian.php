<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalHarian extends Model
{
    use HasFactory;

    protected $table = 'jadwal_harians';

    protected $fillable = [
        'jam_berangkat',
        'rute_id',
        'kapal_id',
        'nahkoda_id'
    ];


    public function rute(){
        return $this->belongsTo(Rute::class);
    }

    public function kapal(){
        return $this->belongsTo(Kapal::class);
    }

    public function nahkoda(){
        return $this->belongsTo(Supir::class);
    }


}
