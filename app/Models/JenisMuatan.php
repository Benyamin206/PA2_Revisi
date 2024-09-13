<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMuatan extends Model
{
    use HasFactory;

    protected $table = 'jenis_muatan';
    protected $fillable = [
        'nama'
    ];

    public function muatans(){
        return $this->hasMany(Muatan::class);
    }
    
}
