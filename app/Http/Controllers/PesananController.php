<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Jadwal;
use App\Models\Rute;
use App\Models\Muatan;
use App\Models\Kapal;
use App\Models\Supir;
use App\Models\PemesananJadwal;
use App\Models\DetailPesanJadwal;
use DateTimeZone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Midtrans;
use GuzzleHttp\Client;


class PesananController extends Controller
{
    //
    public function pesanan_jadwal_paid(){
        $user_id = Auth::id();

        $pesanans = PemesananJadwal::where('user_id', $user_id)->where('status_pembayaran', 'Paid')->get();
        
        return view('Pesanan.pesanan_jadwal', compact('pesanans'));
    }

    public function pesanan_jadwal_unpaid(){

        $user_id = Auth::id();
    
        $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $pesanans = PemesananJadwal::where('user_id', $user_id)
            ->where('status_pembayaran', 'Unpaid')
            ->get();
    
        // Filter pesanan berdasarkan selisih waktu
        // $pesanans = $pesanans->filter(function ($pemesanan) use ($now) {
        //     $ditambahkanTime = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $pemesanan->ditambahkan_pada);
        //     $selisihWaktu = $now->diffInSeconds($ditambahkanTime);
        //     return $selisihWaktu < 600;
        // });
    
        return view('Pesanan.pesanan_jadwal_unpaid', compact('pesanans'));
    }

    public function bayar_jadwal($orderId){
        $order = PemesananJadwal::findOrFail($orderId);
        return view('Pesanan.bayar', compact('order'));
    }
    

    
}
