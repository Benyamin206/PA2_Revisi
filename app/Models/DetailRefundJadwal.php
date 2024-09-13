<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRefundJadwal extends Model
{
    use HasFactory;

    protected $table = 'detail_refund_jadwal';

    protected $fillable = [
        'pemesanan_jadwal_id',
        'bank_tujuan',
        'nomor_rekening',
        'bukti_refund',
        'status',
        'harga',
        'nama_penerima'
    ];

    public function pemesanan_jadwal(){
        return $this->belongsTo(PemesananJadwal::class);
    }
}
