<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiMuatan extends Model
{
    use HasFactory;

    protected $table = 'informasi_muatan';

    protected $fillable = [
        'detail_pesan_jadwal_id',
        'nama',
        'alamat',
        'umur',
        'nomor_plat',
        'merk',
    ];

    public function detailPesanJadwal()
    {
        return $this->belongsTo(DetailPesanJadwal::class);
    }

}

