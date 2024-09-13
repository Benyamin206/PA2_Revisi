<?php

namespace App\Http\Controllers;

use Midtrans;
use DateTimeZone;
use App\Models\Rute;
use App\Models\Kapal;
use App\Models\Supir;
use App\Models\Jadwal;
use App\Models\Muatan;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PemesananJadwal;
use App\Models\DetailPesanJadwal;
use App\Models\DetailPesanJadwalPulang;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class PulangPergiController extends Controller
{

    private function cari_pergi($tanggal, $rute_id) {
        $Njadwals = Jadwal::with('rute', 'kapal', 'supir')->where('rute_id', $rute_id)->whereDate('waktu_berangkat', $tanggal)->get();
        if(!$Njadwals->isEmpty()){
            return true;
        }else{
            return false;
        }
    }

    private function cari_pulang($lokasi_pergi, $lokasi_tujuan, $tanggal){
        $rute = Rute::where('lokasi_berangkat', $lokasi_pergi)->where('lokasi_tujuan', $lokasi_tujuan)->first();
        if(!$rute){
            return false;
        }

        $Njadwals = Jadwal::with('rute', 'kapal', 'supir')->where('rute_id', $rute->id)->whereDate('waktu_berangkat', $tanggal)->get();
        if(!$Njadwals->isEmpty()){
            return true;
        }else{
            return false;
        }
        
    }

    public function filter_jadwal_pulang_pergi(Request $request){
        $rute = Rute::find($request->rute);
        $lokasi_berangkat = $rute->lokasi_berangkat;
        $lokasi_tujuan = $rute->lokasi_tujuan;
            
        if($this->cari_pergi($request->tanggal_pergi, $request->rute) && $this->cari_pulang($lokasi_tujuan, $lokasi_berangkat, $request->tanggal_pulang)){
            $Njadwals = Jadwal::with('rute', 'kapal', 'supir')->where('rute_id', $request->rute)->whereDate('waktu_berangkat', $request->tanggal_pergi)->get();
            $rute = Rute::where('lokasi_berangkat', $lokasi_tujuan)->where('lokasi_tujuan', $lokasi_berangkat)->first();
            $Njadwals2 = Jadwal::with('rute', 'kapal', 'supir')->where('rute_id', $rute->id)->whereDate('waktu_berangkat', $request->tanggal_pulang)->get();
            return view('Pulang_Pergi.pilih_pergi', compact('Njadwals','Njadwals2')); 
        }else{
        //    return "Tidak ditemukan jadwal yang cocok";
        return redirect('/')->with('nfPP', 'Tidak ditemukan jadwal yang cocok, coba pilih jadwal yang lain');
        }
    }

    public function tesPP(Request $request){
        echo $request->jadwal_berangkat. '  -  '. $request->jadwal_pulang;
    }

    private function kurangiStokPulang($pemesananJadwal, &$stokMuatan)
    {
        foreach ($pemesananJadwal as $pemesanan) {
            $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
            $ditambahkanTime = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $pemesanan->ditambahkan_pada);
            $selisihWaktu = strtotime($now) - strtotime($ditambahkanTime);
    
            $orderId = $pemesanan->id;
            $client = new Client();
            $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $orderId . '/status', [
                'headers' => [
                    'accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-r7MhU_nxELBt_mWd6J38SZX4:'),
                ],
            ]);
    
            // Decode response dari API Midtrans
            $data = json_decode($response->getBody(), true);
    
            $shouldDetuctStok = false;
    
            if ($pemesanan->status_pembayaran === "Paid" && !$pemesanan->refund) {
                // Pengurangan stok untuk pemesanan yang sudah dibayar dan tidak refund
                $shouldDetuctStok = true;
            } elseif ($selisihWaktu < 600 && (empty($data) || isset($data['status_code']) && $data['status_code'] == 404)) {
                // Pengurangan stok untuk pemesanan yang pending di lokal atau belum terdaftar di Midtrans
                $shouldDetuctStok = true;
            } elseif (isset($data['transaction_status']) && $data['transaction_status'] === 'pending') {
                // Pengurangan stok untuk pemesanan yang berstatus pending di Midtrans
                $shouldDetuctStok = true;
            }
    
            if ($shouldDetuctStok) {
                foreach ($pemesanan->detail_pesan_jadwal_pulang as $detail) {
                    // Kurangi sisa muatan
                    $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                }
            }
        }
    }

    private function kurangiStok($pemesananJadwal, &$stokMuatan)
    {
        foreach ($pemesananJadwal as $pemesanan) {
            $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
            $ditambahkanTime = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $pemesanan->ditambahkan_pada);
            $selisihWaktu = strtotime($now) - strtotime($ditambahkanTime);
    
            $orderId = $pemesanan->id;
            $client = new Client();
            $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $orderId . '/status', [
                'headers' => [
                    'accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-r7MhU_nxELBt_mWd6J38SZX4:'),
                ],
            ]);
    
            // Decode response dari API Midtrans
            $data = json_decode($response->getBody(), true);
    
            $shouldDetuctStok = false;
    
            if ($pemesanan->status_pembayaran === "Paid" && !$pemesanan->refund) {
                // Pengurangan stok untuk pemesanan yang sudah dibayar dan tidak refund
                $shouldDetuctStok = true;
            } elseif ($selisihWaktu < 600 && (empty($data) || isset($data['status_code']) && $data['status_code'] == 404)) {
                // Pengurangan stok untuk pemesanan yang pending di lokal atau belum terdaftar di Midtrans
                $shouldDetuctStok = true;
            } elseif (isset($data['transaction_status']) && $data['transaction_status'] === 'pending') {
                // Pengurangan stok untuk pemesanan yang berstatus pending di Midtrans
                $shouldDetuctStok = true;
            }
    
            if ($shouldDetuctStok) {
                foreach ($pemesanan->detail_pesan_jadwal as $detail) {
                    // Kurangi sisa muatan
                    $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                }
            }
        }
    }

    public function detail_stok_validasi4($jadwalId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $pemesananJadwal = PemesananJadwal::where('jadwal_id', $jadwalId)->get();
        $pemesananJadwalPulang = PemesananJadwal::where('jadwal_pulang_id', $jadwalId)->get();
        $stokMuatan = [];
    
        // Ambil semua muatan yang aktif dan inisialisasi sisa muatan
        $muatan = Muatan::where('aktif', true)->get();
        foreach ($muatan as $item) {
            $stokMuatan[$item->id] = $item->maksimal;
        }
        
        $this->kurangiStok($pemesananJadwal, $stokMuatan);

        // Jika terdapat pemesanan jadwal pulang, kurangi stok juga
        if ($pemesananJadwalPulang->isNotEmpty()) {
            $this->kurangiStokPulang($pemesananJadwalPulang, $stokMuatan);
        }
        return $stokMuatan;
    }




    //
    public function checkout_pulang_pergi(Request $request)
    {
        Log::info('Request yang diterima untuk checkout_pulang_pergi', $request->all());

        $validator = Validator::make($request->all(), [
            'muatan_pergi.*' => 'nullable|integer|min:0', 
            'muatan_pulang.*' => 'nullable|integer|min:0', 
        ]);

        if ($validator->fails()) {
            Log::info('Validasi gagal', $validator->errors()->toArray());
            return redirect()->route('detail_jadwal_pulang_pergi_form', [
                'jadwal_pergi_id' => $request->jadwal_pergi_id,
                'jadwal_pulang_id' => $request->jadwal_pulang_id
            ])->withErrors($validator)->withInput();
        }

        $totalMuatan = collect($request->muatan_pergi)->sum();
        $totalMuatanPulang  = collect($request->muatan_pulang)->sum();

        if ($totalMuatan <= 0 && $totalMuatanPulang <= 0) {
            Log::info('Tidak ada muatan yang dipilih untuk pergi dan pulang');
            return redirect()->route('detail_jadwal_pulang_pergi_form', [
                'jadwal_pergi_id' => $request->jadwal_pergi_id,
                'jadwal_pulang_id' => $request->jadwal_pulang_id
            ])->withErrors(['error' => 'Setidaknya satu muatan harus dipilih pada jadwal pergi dan pulang.'])->withInput();
        }

        if ($totalMuatan <= 0) {
            Log::info('Tidak ada muatan yang dipilih untuk pergi');
            return redirect()->route('detail_jadwal_pulang_pergi_form', [
                'jadwal_pergi_id' => $request->jadwal_pergi_id,
                'jadwal_pulang_id' => $request->jadwal_pulang_id
            ])->withErrors(['error' => 'Setidaknya satu muatan harus dipilih pada jadwal pergi.'])->withInput();
        }

        if ($totalMuatanPulang <= 0) {
            Log::info('Tidak ada muatan yang dipilih untuk pulang');
            return redirect()->route('detail_jadwal_pulang_pergi_form', [
                'jadwal_pergi_id' => $request->jadwal_pergi_id,
                'jadwal_pulang_id' => $request->jadwal_pulang_id
            ])->withErrors(['error' => 'Setidaknya satu muatan harus dipilih pada jadwal pulang.'])->withInput();
        }

        // stok muatan pergi
        $stokMuatanPergi = $this->detail_stok_validasi4($request->jadwal_pergi_id);
        $stokMuatanPulang = $this->detail_stok_validasi4($request->jadwal_pulang_id);

        // Gabungan pesan error untuk stok muatan
        $errors = new MessageBag();

        // validasi stok muatan pergi
        foreach ($request->muatan_pergi as $muatanId => $jumlah) {
            $muatan = Muatan::find($muatanId);
            if (!$muatan) {
                $errors->add('error', 'Muatan tidak valid.');
                continue;
            }
            if ($jumlah > $stokMuatanPergi[$muatanId]) {
                $errors->add('error', 'Muatan ' . $muatan->nama .' pada jadwal pergi tidak boleh melebihi stok.');
            }
        }

        // validasi stok muatan pulang
        foreach ($request->muatan_pulang as $muatanId => $jumlah) {
            $muatan = Muatan::find($muatanId);
            if (!$muatan) {
                $errors->add('error', 'Muatan tidak valid.');
                continue;
            }
            if ($jumlah > $stokMuatanPulang[$muatanId]) {
                $errors->add('error', 'Muatan ' . $muatan->nama .' pada jadwal pulang tidak boleh melebihi stok.');
            }
        }

        // Jika ada error, redirect kembali dengan error messages
        if ($errors->any()) {
            Log::info('Ada kesalahan dalam validasi stok muatan', $errors->toArray());
            return redirect()->route('detail_jadwal_pulang_pergi_form', [
                'jadwal_pergi_id' => $request->jadwal_pergi_id,
                'jadwal_pulang_id' => $request->jadwal_pulang_id
            ])->withErrors($errors)->withInput();
        }

        // Jika semua validasi lolos
        $pemesanan_jadwal = PemesananJadwal::create([
            'total_harga' => '1',
            'user_id' => Auth::id(),
            'jadwal_id' => $request->jadwal_pergi_id,
            'jadwal_pulang_id' => $request->jadwal_pulang_id,
            'ditambahkan_pada' => Carbon::now(new DateTimeZone('Asia/Jakarta'))
        ]);

        if (!$pemesanan_jadwal) {
            return redirect()->route('detail_jadwal_pulang_pergi_form', [
                'jadwal_pergi_id' => $request->jadwal_pergi_id,
                'jadwal_pulang_id' => $request->jadwal_pulang_id
            ])->withErrors(['error' => 'Gagal membuat pemesanan'])->withInput();
        }

        $totalAmount = 0;

        // detail pesan jadwal pergi
        foreach ($request->muatan_pergi as $muatanId => $jumlah) {
            // Validasi muatan_id (mungkin tidak diperlukan karena sudah divalidasi sebelumnya)
            $muatan = Muatan::find($muatanId);
            // if (!$muatan) {
            //     return redirect()->back()->withErrors(['error' => 'Muatan tidak valid.'])->withInput();
            // }
        
            // Pastikan jumlah muatan tidak kurang dari 1
            if ($jumlah < 1) {
                // Jika jumlah muatan kurang dari 1, lewati iterasi ini
                continue;
            }
        
            // Menghitung total amount
            $hargaPerItem = $muatan->harga_per_item;
            $totalAmount += $hargaPerItem * $jumlah;
        
            // Simpan detail pesanan jadwal
            $detailPesanJadwal = new DetailPesanJadwal();
            $detailPesanJadwal->pemesanan_jadwal_id = $pemesanan_jadwal->id;
            $detailPesanJadwal->muatan_id = $muatanId;
            $detailPesanJadwal->jumlah = $jumlah;
            $detailPesanJadwal->save(); // Simpan detail pesanan jadwal ke dalam database
        }

        // detail pesan jadwal pulang
        foreach ($request->muatan_pulang as $muatanId => $jumlah) {
            // Validasi muatan_id (mungkin tidak diperlukan karena sudah divalidasi sebelumnya)
            $muatan = Muatan::find($muatanId);
            // if (!$muatan) {
            //     return redirect()->back()->withErrors(['error' => 'Muatan tidak valid.'])->withInput();
            // }
        
            // Pastikan jumlah muatan tidak kurang dari 1
            if ($jumlah < 1) {
                // Jika jumlah muatan kurang dari 1, lewati iterasi ini
                continue;
            }
        
            // Menghitung total amount
            $hargaPerItem = $muatan->harga_per_item;
            $totalAmount += $hargaPerItem * $jumlah;
        
            // Simpan detail pesanan jadwal
            $detailPesanJadwalPulang = new DetailPesanJadwalPulang();
            $detailPesanJadwalPulang->pemesanan_jadwal_id = $pemesanan_jadwal->id;
            $detailPesanJadwalPulang->muatan_id = $muatanId;
            $detailPesanJadwalPulang->jumlah = $jumlah;
            $detailPesanJadwalPulang->save(); // Simpan detail pesanan jadwal ke dalam database
        }

            // Update total harga pemesanan jadwal
            $pemesanan_jadwal->update([
                'total_harga' => $totalAmount
            ]);        

        // Setelah pemesanan berhasil, lakukan redirect atau respons sesuai kebutuhan
        $user = Auth::user();


        // Set Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-r7MhU_nxELBt_mWd6J38SZX4';
        // Set Development/Sandbox Environment (default). Set true for Production Environment.
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $pemesanan_jadwal->id,
                'gross_amount' => $pemesanan_jadwal->total_harga,
            ),
            'customer_details' => array(
                'first name' => $user->name,
                'last_name' => '',
                'phone' => $user->nomor_telepon,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $pemesanan_jadwal->update([
            'snap_token' => $snapToken
        ]);

        $order = PemesananJadwal::findOrFail($pemesanan_jadwal->id);
        return view('Pesan_Jadwal.pembayaran_pp', compact('order'));
    }


    public function detail_jadwal($jadwalId){
        $jadwal = Jadwal::findOrFail($jadwalId);
        $pemesananJadwal = PemesananJadwal::where('jadwal_id', $jadwalId)->get();
        $transactions = [];
        $stokMuatan = $this->detail_stok_validasi4($jadwalId);
        if(!isset($stokMuatan)){
            // Ambil semua muatan yang aktif
            $muatan = Muatan::where('aktif', true)->get();
            // Buat array untuk menampung stok muatan
            $stokMuatan = [];
                        // Loop untuk mengisi stok muatan dari tabel muatan
            foreach ($muatan as $item) {
                $stokMuatan[$item->id] = $item->maksimal;
            }
        }
        $muatans = Muatan::where('aktif', true)->get();
        return view('Pesan_Jadwal.form2_pesan_jadwal', compact('jadwal', 'pemesananJadwal', 'transactions', 'stokMuatan', 'muatans'));
        // return view('Midtrans.lihatjadwal', compact('jadwal', 'pemesananJadwal', 'transactions'));
    }
    

    public function detail_jadwal_pulang_pergi(Request $request){
        $jadwalPergiId = $request->jadwal_berangkat;
        $jadwalPulangId = $request->jadwal_pulang;

        $jadwalPergi = Jadwal::findOrFail($jadwalPergiId);
        $jadwalPulang = Jadwal::findOrFail($jadwalPulangId);

        $pemesananJadwalPergi = PemesananJadwal::where('jadwal_id', $jadwalPergiId)->get();
        $pemesananJadwalPulang = PemesananJadwal::where('jadwal_id', $jadwalPulangId)->get();

        $stokMuatanPergi = $this->detail_stok_validasi4($jadwalPergiId);
        $stokMuatanPulang = $this->detail_stok_validasi4($jadwalPulangId);

        if(!isset($stokMuatanPergi)){
            // Ambil semua muatan yang aktif
            $muatan = Muatan::where('aktif', true)->get();
            // Buat array untuk menampung stok muatan
            $stokMuatanPergi = [];
                        // Loop untuk mengisi stok muatan dari tabel muatan
            foreach ($muatan as $item) {
                $stokMuatanPergi[$item->id] = $item->maksimal;
            }
        }

        if(!isset($stokMuatanPulang)){
            // Ambil semua muatan yang aktif
            $muatan = Muatan::where('aktif', true)->get();
            // Buat array untuk menampung stok muatan
            $stokMuatanPulang = [];
                        // Loop untuk mengisi stok muatan dari tabel muatan
            foreach ($muatan as $item) {
                $stokMuatanPulang[$item->id] = $item->maksimal;
            }
        }
        $muatans = Muatan::where('aktif', true)->get();
        return view('Pesan_Jadwal.form2_pesan_jadwal_pulang_pergi',
         compact('jadwalPergi',
                 'jadwalPulang', 
                'stokMuatanPergi',
                'stokMuatanPulang', 
                'muatans'));

    }

    public function form_informasi_muatan(Request $request)
    {
        $jadwalPergiId = $request->jadwal_pergi_id;
        $jadwalPulangId = $request->jadwal_pulang_id;
    
        $muatanPergi = $request->muatan_pergi;
        $muatanPulang = $request->muatan_pulang;
    
        $jadwalPergi = Jadwal::findOrFail($jadwalPergiId);
        $jadwalPulang = Jadwal::findOrFail($jadwalPulangId);
    
        $muatans = Muatan::where('aktif', true)->get();
    
        return view('Pesan_Jadwal.form_informasi_muatan', compact(
            'jadwalPergi',
            'jadwalPulang',
            'muatanPergi',
            'muatanPulang',
            'muatans'
        ));
    }
    



    public function showDetailJadwalPulangPergi(Request $request)
    {
        $jadwalPergiId = $request->query('jadwal_pergi_id');
        $jadwalPulangId = $request->query('jadwal_pulang_id');

        $jadwalPergi = Jadwal::findOrFail($jadwalPergiId);
        $jadwalPulang = Jadwal::findOrFail($jadwalPulangId);

        $stokMuatanPergi = $this->detail_stok_validasi4($jadwalPergiId);
        $stokMuatanPulang = $this->detail_stok_validasi4($jadwalPulangId);

        if (!isset($stokMuatanPergi)) {
            $muatan = Muatan::where('aktif', true)->get();
            $stokMuatanPergi = [];
            foreach ($muatan as $item) {
                $stokMuatanPergi[$item->id] = $item->maksimal;
            }
        }

        if (!isset($stokMuatanPulang)) {
            $muatan = Muatan::where('aktif', true)->get();
            $stokMuatanPulang = [];
            foreach ($muatan as $item) {
                $stokMuatanPulang[$item->id] = $item->maksimal;
            }
        }

        $muatans = Muatan::where('aktif', true)->get();

        return view('Pesan_Jadwal.form2_pesan_jadwal_pulang_pergi', compact(
            'jadwalPergi',
            'jadwalPulang',
            'stokMuatanPergi',
            'stokMuatanPulang',
            'muatans'
        ));
    }

    public function informasi_index(){
        return view('Informasi.index');
    }


}
