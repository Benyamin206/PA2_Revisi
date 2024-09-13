<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\Kapal;
use Illuminate\Support\Facades\File;


class PemilikKapalController extends Controller
{
    public function index_kapal(){
        $user = Auth::user();
        $kapals = $user->kapals()->where('diizinkan', true)->get();
        return view('Kapal.index', compact('kapals'));
    }
    

    public function tambah_kapal(){
        return view('Kapal.tambah');
    }

    public function izin_kapal(){
        $user = Auth::user();
        $kapals = $user->kapals()
                       ->orderBy('updated_at', 'desc')
                       ->orderBy('created_at', 'desc')
                       ->get();
        return view('Kapal.izin', compact('kapals'));
    }
    
    public function store_kapal(Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'kapasitas' => 'required|min:1',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],[
            'kapasitas.min' => 'Kapasitas harus minimal 1.',
        ]);
        
        $file = $request->file('gambar');
    
        // Menggunakan public_path() untuk menunjuk ke direktori publik
        $path =  time() . $request->nama . '.' . $file->getClientOriginalExtension(); 
        
        // Menggunakan move() untuk memindahkan file ke direktori publik
        $file->move(public_path('storage/Kapal_Image/'), $path);
    
        Kapal::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kapasitas' => $request->kapasitas,
            'gambar' => $path,
            'user_id' => Auth::user()->id,
            'aktif' => false,
            'available_booking' => false,
            'booking' => false
        ]);
    
        return redirect()->route('kapal.izin');
    }
    

    // public function store_kapal(Request $request){
    //     $request->validate([
    //         'nama' => 'required',
    //         'deskripsi' => 'required',
    //         'kapasitas' => 'required|min:1',
    //         'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ],[
    //         'kapasitas.min' => 'Kapasitas harus minimal 1.',
    //     ]);

    //     $file = $request->file('gambar');

    //     $path = time() . $request->nama . '.' . $file->getClientOriginalExtension(); 
        
    //     Storage::disk('local')->put('public/Kapal_Image/'. $path, file_get_contents($file));

    //     Kapal::create([
    //         'nama' => $request->nama,
    //         'deskripsi' => $request->deskripsi,
    //         'kapasitas' => $request->kapasitas,
    //         'gambar' => $path,
    //         'user_id' => Auth::user()->id,
    //         'aktif' => false,
    //         'available_booking' => false,
    //         'booking' => false
    //     ]);

    //     return Redirect::route('index_kapal');
    // }


    public function edit_kapal(Kapal $kapal){
        return view('Kapal.edit', compact('kapal'));
    }

    public function update_kapal(Request $request, Kapal $kapal)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'kapasitas' => 'required|min:1',
            'aktif' => 'required|in:0,1',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'kapasitas.min' => 'Kapasitas harus minimal 1.',
        ]);
    
        // Jika ada file gambar yang diunggah
        if($request->hasFile('gambar')){
            // Hapus file gambar lama
            if($kapal->gambar){
                $oldImagePath = 'storage/Kapal_Image/' . $kapal->gambar;
                if(File::exists(public_path($oldImagePath))){
                    File::delete(public_path($oldImagePath));
                }
            }
    
            // Simpan file gambar baru
            $file = $request->file('gambar');
            $path = time(). '_' . $request->nama . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/Kapal_Image/'), $path);
    
            // Update record Kapal dengan data baru, termasuk path gambar yang baru
            $kapal->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'kapasitas' => $request->kapasitas,
                'gambar' =>  $path,
                'aktif' => $request->aktif,
                'booking' => $request->booking,
                'available_booking' => $request->available_booking,
                'tanggal_tersedia_booking' => $request->tanggal_tersedia_booking
            ]);
        } else {
            // Jika tidak ada file gambar yang diunggah, update data Kapal tanpa mengubah path gambar
            $kapal->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'kapasitas' => $request->kapasitas,
                'aktif' => $request->aktif,
                'booking' => $request->booking,
                'available_booking' => $request->available_booking,
                'tanggal_tersedia_booking' => $request->tanggal_tersedia_booking
            ]);
        }
    
        return Redirect::route('index_kapal');
    }
    
    

    
}
//1717516167_Kapal Frans.jpeg	