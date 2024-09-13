<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PemesananJadwal;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    //
    public function index()
    {
        // Ambil data penghasilan berdasarkan waktu berangkat dan kondisi refund
        $incomes = DB::table('pemesanan_jadwal')
            ->join('jadwals', 'pemesanan_jadwal.jadwal_id', '=', 'jadwals.id')
            ->select(DB::raw('DATE(jadwals.waktu_berangkat) as date'), DB::raw('SUM(pemesanan_jadwal.total_harga) as total_income'))
            ->where('pemesanan_jadwal.status_pembayaran', 'Paid')
            ->where('pemesanan_jadwal.refund', false)
            ->groupBy(DB::raw('DATE(jadwals.waktu_berangkat)'))
            ->orderBy('date', 'desc')
            ->get();

            
        // Return view dengan data penghasilan
        return view('Jadwal.pemasukan', compact('incomes'));
    }

    public function show($date)
    {
        // Konversi tanggal ke format Y-m-d
        $formattedDate = Carbon::parse($date)->format('Y-m-d');

        // Ambil data penghasilan per jadwal pada tanggal tertentu
        $schedules = DB::table('pemesanan_jadwal')
            ->join('jadwals', 'pemesanan_jadwal.jadwal_id', '=', 'jadwals.id')
            ->select('jadwals.waktu_berangkat', DB::raw('SUM(pemesanan_jadwal.total_harga) as total_income'))
            ->where('pemesanan_jadwal.status_pembayaran', 'Paid')
            ->where('pemesanan_jadwal.refund', false)
            ->whereDate('jadwals.waktu_berangkat', $formattedDate)
            ->groupBy('jadwals.waktu_berangkat')
            ->orderBy('jadwals.waktu_berangkat', 'asc')
            ->get();

        // Return view dengan data jadwal dan penghasilan
        return view('Jadwal.detail_pemasukan', compact('schedules', 'date'));
    }

    public function index2(Request $request) {
        $query = PemesananJadwal::query()
            ->where('refund', false)
            ->where('status_pembayaran', 'Paid');

        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('ditambahkan_pada', [
                Carbon::parse($request->input('from_date'))->startOfDay(),
                Carbon::parse($request->input('to_date'))->endOfDay(),
            ]);
        }

        $pemesananJadwals = $query->orderBy('ditambahkan_pada', 'asc')->get();

        // Calculate total income
        $totalIncome = $pemesananJadwals->sum('total_harga');

        return view('Income.index2', compact('pemesananJadwals', 'totalIncome')); 
    }
    
}