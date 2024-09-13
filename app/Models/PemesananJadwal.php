<?php

namespace App\Models;
use App\Traits\UUIDAsPrimaryKeyJadwal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananJadwal extends Model
{
    use HasFactory, UUIDAsPrimaryKeyJadwal;

    protected $table = 'pemesanan_jadwal';

    protected $fillable = [
        'status_pembayaran',
        'total_harga', 'snap_token', 'refund', 'user_id', 'jadwal_id',
        'jadwal_pulang_id',
        'ditambahkan_pada'
    ];



    public function detail_pesan_jadwal(){
        return $this->hasMany(DetailPesanJadwal::class);
    }

    public function detail_pesan_jadwal_pulang(){
        return $this->hasMany(DetailPesanJadwalPulang::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function muatans(){
        return $this->hasMany(Muatan::class);
    }
    
    public function jadwal(){
        return $this->belongsTo(Jadwal::class);
    }

    public function jadwalPulang()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_pulang_id');
    }

    public function kapal(){
        return $this->belongsTo(Kapal::class);
    }

    public function detail_refund_jadwal(){
        return $this->hasOne(DetailRefundJadwal::class);
    }

}


