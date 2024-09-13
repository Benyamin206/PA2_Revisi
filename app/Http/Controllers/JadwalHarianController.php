<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PenerapanJadwalHarian;
use App\Models\Rute;

class JadwalHarianController extends Controller
{

    //
    public function index(){
        $jadwal_harians = JadwalHarian::all();
        return view('Jadwal_Harian.index', compact('jadwal_harians'));
    }

    public function tambah(){
        $rutes = Rute::where('aktif', true)->get();
        return view('Jadwal_Harian.tambah', compact('rutes'));
    }

    public function edit(JadwalHarian $jh){
        $rutes = Rute::where('id', '!=', 21)->get();
        return view('Jadwal_Harian.edit', compact('jh', 'rutes'));
    }

    public function update(JadwalHarian $jh, Request $request){
        $request->validate([
            'jam_berangkat' =>'required',
            'rute_id' =>'required'
        ]);

        $jh->update([
            'jam_berangkat' => $request->jam_berangkat,
            'rute_id' => $request->rute_id,
        ]);

        return redirect()->back()->with('success', 'Jadwal harian berhasil diubah.');
    }

    public function delete(JadwalHarian $jh){
        $jh->delete();
        return redirect()->back()->with('success', 'Jadwal harian berhasil dihapus.');
    }


    public function store(Request $request){
        $request->validate([
            'jam_berangkat' => 'required',
            'rute_id' => 'required'
        ]);

        JadwalHarian::create([
            'jam_berangkat' => $request->jam_berangkat,
            'rute_id' => $request->rute_id,
        ]);

        return redirect()->back()->with('success', 'Jadwal harian berhasil ditambahkan.');
    }

    public function terapkan(Request $request){
        $request->validate([
            'tanggal_jadwal_harian' => 'required|date|after:today',
        ]);

        $tanggal = $request->input('tanggal_jadwal_harian');

        // Cek apakah tanggal sudah diterapkan
        $existing = PenerapanJadwalHarian::where('tanggal_penerapan_jadwal_harians', $tanggal)->first();
        if ($existing) {
            return redirect()->back()->withErrors(['Jadwal harian sudah diterapkan pada tanggal tersebut']);
        }

        DB::beginTransaction();
        try {
            $jadwal_harians = JadwalHarian::all();

            foreach ($jadwal_harians as $jh) {
                Jadwal::create([
                    'waktu_berangkat' => $tanggal . ' ' . $jh->jam_berangkat,
                    'rute_id' => $jh->rute_id,
                    'kapal_id' => $jh->kapal_id,
                    'supir_id' => $jh->nahkoda_id,
                ]);
            }

            PenerapanJadwalHarian::create([
                'tanggal_penerapan_jadwal_harians' => $tanggal,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Jadwal harian berhasil diterapkan.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat menerapkan jadwal harian: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Terjadi kesalahan saat menerapkan jadwal harian.'. $e->getMessage()]);
        }
    }

}
