<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananJadwal;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    //
    public function riwayat_jadwal(){
        $pemesanans = PemesananJadwal::where('user_id', Auth::id())
                    ->where('status_pembayaran', 'Paid')
                    ->get();

        return view('Riwayat.jadwal', compact('pemesanans'));
        }
}
