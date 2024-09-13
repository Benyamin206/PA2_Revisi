<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Rute;
use Illuminate\Http\Request;
use App\Models\PemesananJadwal;
use App\Models\DetailRefundJadwal;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class RefundController extends Controller
{
    //
    public function form_refund_jadwal(PemesananJadwal $pj){
        $tanggal1 = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $pj->jadwal->waktu_berangkat);
        // Tanggal kedua (misalnya tanggal sekarang)
        $tanggal2 = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',  \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta')));
        $diffInDays = $tanggal1->diffInDays($tanggal2);
        $potongan = 0;
        if($diffInDays == 1){
            $potongan = 50;
        }else if($diffInDays == 2 || $diffInDays == 3){
            $potongan = 40;
        }else if ($diffInDays >= 4){
            $potongan = 30;
        }

        return view('Refund.form_refund_jadwal', compact("pj", "potongan", "diffInDays"));
    }


    public function store_refund_jadwal(Request $request){

        $request->validate([
            'bank_tujuan' => 'required',
            'nomor_rekening' => 'required',
            'pemesanan_jadwal_id' => 'required'
        ]);

        $pj = PemesananJadwal::find($request->pemesanan_jadwal_id);

        // Tanggal pertama
        $tanggal1 = Carbon::createFromFormat('Y-m-d H:i:s', $request->waktu_berangkat);

        // Tanggal kedua (misalnya tanggal sekarang)
        $tanggal2 = Carbon::createFromFormat('Y-m-d H:i:s',  \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta')));

        // Menghitung selisih
        $diffInDays = $tanggal1->diffInDays($tanggal2);


        $potongan = 0;
        if($diffInDays == 1){
            $potongan = 50;
        }else if($diffInDays == 2 || $diffInDays == 3){
            $potongan = 40;
        }else if ($diffInDays >= 4){
            $potongan = 30;
        }

        $potong = ($pj->total_harga * ($potongan/100));
        $totalRefund = $pj->total_harga - $potong;

     $drj =    DetailRefundJadwal::create([
            'pemesanan_jadwal_id' => $request->pemesanan_jadwal_id,
            'bank_tujuan' => $request->bank_tujuan,
            'nomor_rekening' => $request->nomor_rekening,
            'status' => 'Sedang Diproses',
            'harga' => $totalRefund,
            'nama_penerima' => $request->nama_penerima
        ]);

        $pj->update([
            'refund' => true
        ]);

        $df = DetailRefundJadwal::where('pemesanan_jadwal_id', $pj->id)->first();

        // $rutes = Rute::where('aktif', true )->get();

        return view('Refund.refund_detail_passenger', compact('drj', 'df'));
    }


    public function konfirmasi_pembayaran(DetailRefundJadwal $drj){
        $drj->update([
            'status' => "Sudah Dibayar"
        ]);
        // return redirect('booking_kapal_index')->with('Konfirmasi', 'Berhasil Mengkonfirmasi Pembayaran!');
        return Redirect::route('all_refund_admin');
    }

    public function batal_konfirmasi_pembayaran(DetailRefundJadwal $drj){
        $drj->update([
            'status' => "Sedang Diproses"
        ]);
        return Redirect::route('all_refund_admin');
    }


    public function refund_detail_passenger(PemesananJadwal $pj){
        // $df = DetailRefundJadwal::where('pemesanan_jadwal_id', $pj->id)->get();
        $df = DetailRefundJadwal::where('pemesanan_jadwal_id', $pj->id)->first();

        // dd($df);
        return view('Refund.refund_detail_passenger', compact('df'));
    }

    
    public function all_refund_admin(){
        $ar = DetailRefundJadwal::class::all();

        return view('Refund.admin', compact('ar'));
    }

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

    public function store_payment_receipt(Request $request, DetailRefundJadwal $drj){
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $file = $request->file('gambar');

        $fileName = $this->generateRandomString(20);

        // Menggunakan public_path() untuk menunjuk ke direktori publik
        $path =  time() . $fileName . '.' . $file->getClientOriginalExtension(); 
        
        // Menggunakan move() untuk memindahkan file ke direktori publik
        $file->move(public_path('storage/Refund_Payment_Receipt/'), $path);
        
        $drj->update([
            'bukti_refund' => $path
        ]);

        return Redirect::route('all_refund_admin');
        
    }

    public function update_payment_refund(Request $request, DetailRefundJadwal $drj){

        $request->validate([
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Jika ada file gambar yang diunggah
        if($request->hasFile('gambar')){
            // Hapus file gambar lama
            if($drj->bukti_refund){
                $oldImagePath = 'storage/Refund_Payment_Receipt/' . $drj->bukti_refund;
                if(File::exists(public_path($oldImagePath))){
                    File::delete(public_path($oldImagePath));
                }
            }
    
            // Simpan file gambar baru
            $file = $request->file('gambar');
            $path = time(). '_' . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/Refund_Payment_Receipt/'), $path);
    
            // Update record Kapal dengan data baru, termasuk path gambar yang baru
            $drj->update([
                'bukti_refund' =>  $path
            ]);
        } 

        return Redirect::route('all_refund_admin');    

    }


}
