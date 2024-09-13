<?php

namespace App\Http\Controllers;
use App\Models\Rute;
use Illuminate\Support\Facades\Redirect;



use Illuminate\Http\Request;

class RuteController extends Controller
{
    //
    public function index_rute(){
        $rutes = Rute::all();

        $stoks = [
            ["id" => 1, "total" => ["stok1" => 10, "stok2" => 12]],
            ["id" => 2, "total" => ["stok1" => 20, "stok2" => 30]]
        ];


        return view('Rute.index', compact('rutes', 'stoks'));
    }

    public function edit_rute(Rute $rute){
        return view('Rute.edit', compact('rute'));
    }

    // public function update_rute(Request $request, Rute $rute){
    //     $request->validate([
    //         'lokasi_berangkat' => 'required',
    //         'lokasi_tujuan' => 'required',
    //         'aktif' => 'required|in:0,1',
    //     ], [
    //         'aktif.in' => 'Status harus berisi nilai 0 atau 1 atau nilai boolean.',
    //     ]);
        

    //     $rute->update([
    //         'lokasi_berangkat' => $request->lokasi_berangkat,
    //         'lokasi_tujuan' => $request->lokasi_tujuan,
    //         'aktif' => $request->aktif,
    //     ]);

    //     return Redirect::route('index_rute');
    // }

    public function update_rute(Request $request, Rute $rute)
    {
        $request->validate([
            'lokasi_berangkat' => 'required',
            'lokasi_tujuan' => 'required',
            'aktif' => 'required|in:0,1',
        ], [
            'aktif.in' => 'Status harus berisi nilai 0 atau 1 atau nilai boolean.',
        ]);
    
        // Check if the combination of lokasi_berangkat and lokasi_tujuan already exists
        $existingRute = Rute::where('lokasi_berangkat', $request->lokasi_berangkat)
                            ->where('lokasi_tujuan', $request->lokasi_tujuan)
                            ->where('id', '!=', $rute->id) // Exclude the current route being updated
                            ->first();
    
        if ($existingRute) {
            return redirect()->back()->withErrors(['error' => 'Rute dengan kombinasi lokasi berangkat dan lokasi tujuan ini sudah ada!'])->withInput();
        }
    
        $rute->update([
            'lokasi_berangkat' => $request->lokasi_berangkat,
            'lokasi_tujuan' => $request->lokasi_tujuan,
            'aktif' => $request->aktif,
        ]);
    
        return Redirect::route('index_rute')->with('success', 'Berhasil Mengupdate Rute!');
    }
    

    public function tambah_rute(){
        return view('Rute.tambah');
    }

    // public function store_rute(Request $request){
    //     $request->validate([
    //         'lokasi_berangkat' => 'required',
    //         'lokasi_tujuan' => 'required',
    //     ]);

    //     Rute::create([
    //         'lokasi_berangkat' => $request->lokasi_berangkat,
    //         'lokasi_tujuan' => $request->lokasi_tujuan,
    //     ]);

    //     return Redirect::route('index_rute')->with('success', 'Berhasil Menambah Rute!');
    // }

    public function store_rute(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'lokasi_berangkat' => 'required',
            'lokasi_tujuan' => 'required',
        ]);
    
        // Check if the combination of lokasi_berangkat and lokasi_tujuan already exists
        $existingRute = Rute::where('lokasi_berangkat', $request->lokasi_berangkat)
                            ->where('lokasi_tujuan', $request->lokasi_tujuan)
                            ->first();
    
        // If such a route already exists, redirect back with an error message
        if ($existingRute) {
            return redirect()->back()->withErrors(['error' => 'Rute dengan kombinasi lokasi berangkat dan lokasi tujuan ini sudah ada!'])->withInput();
        }
    
        // If the combination is unique, create a new Rute record
        Rute::create([
            'lokasi_berangkat' => $request->lokasi_berangkat,
            'lokasi_tujuan' => $request->lokasi_tujuan,
        ]);
    
        // Redirect to the index route with a success message
        return Redirect::route('index_rute')->with('success', 'Berhasil Menambah Rute!');
    }
    
    

    public function hapus_rute(Rute $rute){
        $rute->delete();
        return Redirect::route('index_rute')->with('delete', 'Berhasil Menghapus Rute!');
    }

}
