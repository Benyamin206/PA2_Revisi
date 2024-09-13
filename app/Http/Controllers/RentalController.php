<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rute;
use App\Models\User;
use App\Models\Kapal;
use App\Models\RentalKapal;
use Illuminate\Http\Request;
use App\Models\JenisRentalKapal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RentalController extends Controller
{
    //

    protected function generateRandomString($length = 10) {
        // Define the characters that you want to include in the string
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        // Loop to create the random string
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }

    public function kapal_booking_available(){
        $kapals = Kapal::where('available_booking', true)->get();
        $LB = Rute::all();
        return view('Booking_Kapal.available', compact('kapals','LB'));
    }

    public function kapal_booking_index_pesan(){
        $rk = RentalKapal::where('pemilik_kapal_id', Auth::id())->get();
        return view('Booking_Kapal.index_pesan', compact('rk'));
    }

    public function tambah_booking(){
       $kapals =  Kapal::where('user_id', Auth::id())->where('diizinkan', true)->get();
       $users = User::where('role_id', 1)->get();
       $tujuans = JenisRentalKapal::all();
    // dd($kapals);
        return view('Booking_Kapal.tambah', compact('kapals', 'users', 'tujuans'));
    }



    public function store_booking(Request $request){
        $request->validate([
            'user_id' => 'required',
            'kapal_id' => 'required',
            'harga' => 'required|numeric',
            'lokasi_berangkat' => 'required',
            'pki' => 'required',
            'jenis_rental_kapal_id' => 'required'
        ]);

        $kapal = Kapal::find($request->kapal_id);
        $tanggal_berangkat = $kapal->tanggal_tersedia_booking;

        RentalKapal::create([
            'user_id' => $request->user_id,
            'kapal_id' => $request->kapal_id,
            'pemilik_kapal_id' => $request->pki,
            'waktu_berangkat' => $tanggal_berangkat,
            'lokasi_berangkat' => $request->lokasi_berangkat,
            'harga' => $request->harga,
            'jenis_rental_kapal_id' => $request->jenis_rental_kapal_id,
            'status_pembayaran' => 'Belum Dibayar'
        ]);

        return redirect()->route('booking_kapal_index')->with('success', 'Booking Kapal Dibuat!');
    }


    public function konfirmasi_pembayaran(RentalKapal $rk){
        $rk->update([
            'status_pembayaran' => "Sudah Dibayar"
        ]);
        return redirect('booking_kapal_index')->with('Konfirmasi', 'Berhasil Mengkonfirmasi Pembayaran!');
    }

    public function batal_konfirmasi_pembayaran(RentalKapal $rk){
        $rk->update([
            'status_pembayaran' => "Belum Dibayar"
        ]);
        return redirect('booking_kapal_index')->with('Konfirmasi', 'Berhasil Membatalkan Konfirmasi Pembayaran!');
    }

    // public function index_rental_user(){
    //     $rk = RentalKapal::where('user_id', Auth::id())->get();
        
    //     return view('Booking_Kapal.index_user', compact('rk'));
    // }

    public function index_rental_user(){
        $rk = RentalKapal::where('user_id', Auth::id())
                        ->where('waktu_berangkat', '>=', Carbon::now()->toDateString())
                        ->where('status_pembayaran', 'Sudah Dibayar')            
                        ->get();
        return view('Booking_Kapal.index_user', compact('rk'));
    }

    public function index_rental_user_unpaid(){
        $rk = RentalKapal::where('user_id', Auth::id())
                        ->where('waktu_berangkat', '>=', Carbon::now()->toDateString())
                        ->where('status_pembayaran', 'Belum Dibayar')            
                        ->get();
        return view('Booking_Kapal.index_user_unpaid', compact('rk'));
    }

    public function history_booking(){
        $rk = RentalKapal::where('user_id', Auth::id())
                        ->where('waktu_berangkat', '<', Carbon::now()->toDateString())
                        ->where('status_pembayaran', 'Sudah Dibayar')
                        ->get();
        return view('Booking_Kapal.history_user', compact('rk'));  
    }

    public function upload_bukti_pembayaran(Request $request, RentalKapal $rk){
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $file = $request->file('gambar');
    
        $fileName = $this->generateRandomString(20);
    
        // Menggunakan public_path() untuk menunjuk ke direktori publik
        $path =  time() . $fileName . '.' . $file->getClientOriginalExtension(); 
        
        $file->move(public_path('storage/Booking_Kapal_Payment_Receipt/'), $path);
    
        $rk->update([
            'bukti_pembayaran' => $path
        ]);
        
        Session::flash('Konfirmasi', 'Berhasil Upload Bukti Pembayaran!');
    
        return redirect('index_rental_user_unpaid');
    }

    public function indexJenisRental()
    {
        $jenisRentals = JenisRentalKapal::all();
        return view('rental.indexJenisRental', compact('jenisRentals'));
    }    


    public function createJenisRental()
    {
        return view('rental.createJenisRental');
    }

    public function storeJenisRental(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
        ]);

        JenisRentalKapal::create($request->all());

        return redirect()->route('rental.indexJenisRental')->with('success', 'Jenis rental kapal berhasil ditambahkan.');
    }

    
}
