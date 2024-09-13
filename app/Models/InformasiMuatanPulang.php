<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiMuatanPulang extends Model
{
    use HasFactory;

    protected $table = 'informasi_muatan_pulang';

    protected $fillable = [
        'detail_pesan_jadwal_pulang_id',
        'nama',
        'alamat',
        'umur',
        'nomor_plat',
        'merk',
    ];
    
    public function detailPesanJadwal()
    {
        return $this->belongsTo(DetailPesanJadwalPulang::class);
    }
}
