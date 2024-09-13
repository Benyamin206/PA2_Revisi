<?php

namespace App\Http\Controllers;

use App\Models\JenisMuatan;
use App\Models\Muatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class MuatanController extends Controller
{
    //
    public function index_muatan(){
        $muatans = Muatan::all();
        
        return view('Muatan.index', compact('muatans'));
    }

    public function tambah_muatan(){
        $jenisMuatans = JenisMuatan::all();
        return view('Muatan.tambah', compact('jenisMuatans'));
    }

    public function store_muatan(Request $request){

        $request->validate([
            'nama' => 'required',
            'harga_per_item' => 'required|numeric|min:500',
            'maksimal' => 'required|numeric|min:1',
            'jenis_muatan_id' => 'required'
        ]);
        

        Muatan::create([
            'nama' => $request->nama,
            'harga_per_item' => $request->harga_per_item,
            'maksimal' => $request->maksimal,
            'jenis_muatan_id' => $request->jenis_muatan_id
        ]);

        return Redirect::route('index_muatan');
    }

    public function edit_muatan(Muatan $muatan){
        return view('Muatan.edit', compact('muatan'));
    }

    public function update_muatan(Request $request, Muatan $muatan){
        $request->validate([
            'nama' => 'required',
            'harga_per_item' => 'required|numeric|min:500',
            'maksimal' => 'required|numeric|min:1',
            'aktif' => 'required|in:0,1',
        ], [
            'aktif.in' => 'Status harus berisi nilai 0 atau 1 atau nilai boolean.',
        ]);

        $muatan->update([
            'nama' => $request->nama,
            'harga_per_item' => $request->harga_per_item,
            'maksimal' => $request->maksimal,
            'aktif' => $request->aktif
        ]);
        return Redirect::route('index_muatan');
        
    }

}
