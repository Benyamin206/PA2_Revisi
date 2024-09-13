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
use App\Models\InformasiMuatan;
use App\Models\PemesananJadwal;
use App\Models\DetailPesanJadwal;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailPesanJadwalPulang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class JadwalController extends Controller
{
    //

    public function jadwal(){
        $jadwals = Jadwal::with('rute', 'kapal', 'supir')
                          ->orderBy('updated_at', 'desc')  // Mengurutkan berdasarkan kolom updated_at secara descending
                          ->get();
    
        return view('Jadwal.index', compact('jadwals'));
    }
    

    public function tambah_jadwal(){
        $rutes = Rute::where('aktif', 1)->get();
        // $kapals = Kapal::where('aktif', 1)->get();
        $kapals = Kapal::where('aktif', 1)->where('diizinkan', true)->get(['id', 'nama', 'tanggal_tersedia_booking']);
        $nahkodas = Supir::where('aktif', 1)->get();

        return view('Jadwal.tambah', compact('rutes', 'kapals', 'nahkodas'));
    }

    public function store_jadwal(Request $request){
        $request->validate([
            'waktu_berangkat' => 'required|date_format:Y-m-d H:i',
            'rute_id' => 'required',
            'kapal_id' => 'required',
            'supir_id' => 'required',
        ]);

        $now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $formattedNow = $now->format('Y-m-d H:i');

        $userInputDatetime = $request->waktu_berangkat;
        $userDatetime = Carbon::createFromFormat('Y-m-d H:i', $userInputDatetime, 'Asia/Jakarta');

        $secondsDifference = $now->diffInSeconds($userDatetime);

        if ($now->gt($userDatetime)) {
            return back()->withErrors(['waktu_berangkat' => 'Waktu jadwal harus lebih 2 jam dibandingkan waktu sekarang']);
        }elseif ($now->lt($userDatetime)) {
            if($secondsDifference > 7200){
                Jadwal::create([
                    'waktu_berangkat' => $request->waktu_berangkat,
                    'rute_id' => $request->rute_id,
                    'kapal_id' => $request->kapal_id,
                    'supir_id' => $request->supir_id
                ]);
            }else{
                return back()->withErrors(['waktu_berangkat' => 'Waktu jadwal harus lebih 2 jam dibandingkan waktu sekarang']);
            }
        } else {
            return back()->withErrors(['waktu_berangkat' => 'Waktu jadwal harus lebih 2 jam dibandingkan waktu sekarang']);
        }

        return Redirect::route('index_jadwal');
    }
    

    public function tes()
    {
        // $data = [
        //     'message' => 'Ini adalah contoh data JSON',
        //     'items' => [
        //         [
        //             'id' => 1,
        //             'name' => 'Item 1',
        //             'description' => 'Deskripsi Item 1'
        //         ],
        //         [
        //             'id' => 2,
        //             'name' => 'Item 2',
        //             'description' => 'Deskripsi Item 2'
        //         ],
        //         [
        //             'id' => 3,
        //             'name' => 'Item 3',
        //             'description' => 'Deskripsi Item 3'
        //         ]
        //     ]
        // ];
    
        // return response()->json($data);

        
        // Mendapatkan waktu saat ini
$now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
$formattedNow = $now->format('Y-m-d H:i:s');
echo "Waktu saat ini: " . $formattedNow . "\n";

// Misalkan Anda mendapatkan waktu input dari pengguna melalui request
// Contoh: Request::input('user_datetime') berisi "2024-06-03 12:00:00"
$userInputDatetime = '2024-06-03 17:28:00';
$userDatetime = Carbon::createFromFormat('Y-m-d H:i:s', $userInputDatetime, 'Asia/Jakarta');

// Perbandingan waktu
$secondsDifference = $now->diffInSeconds($userDatetime);

if ($now->gt($userDatetime)) {
    echo "Waktu sekarang lebih besar dari waktu input pengguna.\n";
    echo "Perbedaan waktu: " . $secondsDifference . " detik.\n";
    echo "waktu Jadwal tidak boleh .\n";
} elseif ($now->lt($userDatetime)) {
    echo "Waktu sekarang lebih kecil dari waktu input pengguna.\n";
    echo "Perbedaan waktu: " . $secondsDifference . " detik.\n";
} else {
    echo "Waktu sekarang sama dengan waktu input pengguna.\n";
    echo "Perbedaan waktu: 0 detik.\n";
}
    


        // Perbandingan tangga
// Perbandingan tanggal
        
        // Contoh output:
        // Waktu saat ini: 2024-06-03 14:30:00
        // Waktu sekarang lebih besar dari waktu input pengguna.
        

    }
    

    public function edit_jadwal(Jadwal $jadwal){
        $rutes = Rute::where('aktif', 1)->get();
        $kapals = Kapal::where('aktif', 1)->get();
        $nahkodas = Supir::where('aktif', 1)->get();
        return view('Jadwal.edit', compact('jadwal','rutes', 'kapals', 'nahkodas'));
    }

    public function update_jadwal(Request $request, Jadwal $jadwal){
        $request->validate([
            'waktu_berangkat' => 'required|date_format:Y-m-d\TH:i',
            'rute_id' => 'required',
            'kapal_id' => 'required',
            'supir_id' => 'required',
        ]);
    
        $now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $userInputDatetime = $request->waktu_berangkat;
        $userDatetime = Carbon::createFromFormat('Y-m-d\TH:i', $userInputDatetime, 'Asia/Jakarta');
        $secondsDifference = $now->diffInSeconds($userDatetime);
    
        if ($request->waktu_berangkat == Carbon::parse($jadwal->waktu_berangkat)->format('Y-m-d\TH:i')) {
            // Jika waktu berangkat sama, update hanya rute, kapal, dan supir
            $jadwal->update([
                'rute_id' => $request->rute_id,
                'kapal_id' => $request->kapal_id,
                'supir_id' => $request->supir_id
            ]);
        } else {
            // Jika waktu berangkat berbeda, lakukan validasi tambahan
            if ($now->gt($userDatetime)) {
                return back()->withErrors(['waktu_berangkat' => 'Waktu jadwal harus lebih 2 jam dibandingkan waktu sekarang']);
            } elseif ($secondsDifference <= 7200) {
                return back()->withErrors(['waktu_berangkat' => 'Waktu jadwal harus lebih 2 jam dibandingkan waktu sekarang']);
            } else {
                $jadwal->update([
                    'waktu_berangkat' => $request->waktu_berangkat,
                    'rute_id' => $request->rute_id,
                    'kapal_id' => $request->kapal_id,
                    'supir_id' => $request->supir_id
                ]);
            }
        }
    
        return Redirect::route('index_jadwal');
    }
    
    


    public function index_jadwal_penumpang(){
        
        $Njadwals = Jadwal::with('rute', 'kapal', 'supir')->get();
        
        $jadwals = [];

        foreach($Njadwals as $j){
            $now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
            $now2 = strtotime($now);
            $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $j->waktu_berangkat);
            $waktuBerangkat2 = strtotime($waktuBerangkat) - 1800;

            if($waktuBerangkat2 > $now2 && $j->rute->aktif == true){
                $jadwals[] = $j;
            }
        }
        return view('Pesan_Jadwal.index', compact('jadwals'));
    }

    
    public function index_jadwal_penumpang_filter(Request $request){
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);
    
        $date = $request->date;

        if(!empty($date)){
            $Njadwals = Jadwal::with('rute', 'kapal', 'supir')->whereDate('waktu_berangkat', $date)->get();
        }else{
            $Njadwals = Jadwal::with('rute', 'kapal', 'supir')->get();
        }

        $jadwals = [];
    
        foreach($Njadwals as $j){
            $now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
            $now2 = strtotime($now);
            $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $j->waktu_berangkat);
            $waktuBerangkat2 = strtotime($waktuBerangkat) - 1800;

            if($waktuBerangkat2 > $now2){
                $jadwals[] = $j;
            }
        }
        return view('Pesan_Jadwal.index', compact('jadwals'));
        
    }


    public function detail_stok_validasi($jadwalId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $pemesananJadwal = PemesananJadwal::where('jadwal_id', $jadwalId)->get();
    
        $transactions = [];
        $stokMuatan = []; // Array untuk menyimpan sisa muatan
    
        foreach ($pemesananJadwal as $pemesanan) {
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
    
            if ((isset($data['status_code']) && ($data['status_code'] == 200 || $data['status_code'] == 201))) {
                $transactions[] = $data;
            }
    
            // Ambil semua muatan yang aktif
            $muatan = Muatan::where('aktif', true)->get();
    
            // Loop untuk mengisi stok muatan dari tabel muatan
            foreach ($muatan as $item) {
                $stokMuatan[$item->id] = $item->maksimal; // Inisialisasi sisa muatan
            }
    
            foreach ($pemesananJadwal as $pemesanan) {
                // Pengurangan stok untuk pemesanan jadwal yang berstatus 404 di hasil API Midtrans
                $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
                $ditambahkanTime = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $pemesanan->ditambahkan_pada);
                $selisihWaktu = strtotime($now) - strtotime($ditambahkanTime);
                if ($selisihWaktu < 600 && !in_array($pemesanan->id, array_column($transactions, 'order_id'))) {
                    foreach ($pemesanan->detail_pesan_jadwal as $detail) {
                        // Kurangi sisa muatan
                        $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                    }
                }
    
                // Pengurangan stok untuk pemesanan jadwal yang berstatus pending di hasil API Midtrans
                foreach ($transactions as $transaction) {
                    if (isset($transaction['transaction_status'])) {
                        if ($transaction['transaction_status'] === 'pending' && $transaction['order_id'] === $pemesanan->id) {
                            foreach ($pemesanan->detail_pesan_jadwal as $detail) {
                                // Kurangi sisa muatan
                                $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                            }
                        }
                    }
                }
    
                // Pengurangan stok untuk pemesanan jadwal yang berstatus Paid di database
                if ($pemesanan->status_pembayaran == "Paid" && $pemesanan->refund != 1) {
                    foreach ($pemesanan->detail_pesan_jadwal as $detail) {
                        // Kurangi sisa muatan
                        $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                    }
                }
            }
        }
    
        // Inisialisasi sisa muatan untuk muatan yang tidak digunakan pada pemesanan
        if (empty($stokMuatan)) {
            $muatan = Muatan::where('aktif', true)->get();
            foreach ($muatan as $item) {
                $stokMuatan[$item->id] = $item->maksimal;
            }
        }
    
        return $stokMuatan;
    }


    // public function checkout(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'muatan.*' => 'nullable|integer|min:0', // Validasi jumlah muatan
    //         // Tambahkan aturan validasi lainnya sesuai kebutuhan
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
        
    //     // Pastikan setidaknya ada satu muatan yang tidak kosong
    //     $totalMuatan = collect($request->muatan)->sum();
    //     if ($totalMuatan <= 0) {
    //         return redirect()->back()->withErrors(['error' => 'Setidaknya satu muatan harus dipilih.'])->withInput();
    //     }
    
    //     // $stokMuatan = $this->detail_stok_validasi($request->jadwal_id);
    //     $stokMuatan = $this->detail_stok_validasi4($request->jadwal_id);


    //     // Validasi stok muatan
    //     foreach ($request->muatan as $muatanId => $jumlah) {
    //         $muatan = Muatan::find($muatanId);
    //         if (!$muatan) {
    //             return redirect()->back()->withErrors(['error' => 'Muatan tidak valid.'])->withInput();
    //         }
    //         if ($jumlah > $stokMuatan[$muatanId]) {
    //             return redirect()->back()->withErrors(['error' => 'Muatan ' . $muatan->nama .' tidak boleh melebihi stok.'])->withInput();
    //         }
    //     }
        
    //     // Buat pemesanan jadwal
    //     $pemesanan_jadwal = PemesananJadwal::create([
    //         'total_harga' => '1',
    //         'user_id' => Auth::id(),
    //         'jadwal_id' => $request->jadwal_id,
    //         'ditambahkan_pada' => Carbon::now(new DateTimeZone('Asia/Jakarta'))
    //     ]);
    
    //     if (!$pemesanan_jadwal) {
    //         return redirect()->back()->withErrors(['error' => 'Gagal membuat pemesanan jadwal.'])->withInput();
    //     }
    
    //     // Menyimpan detail pesanan jadwal
    //     $totalAmount = 0;
    //     foreach ($request->muatan as $muatanId => $jumlah) {
    //         // Validasi muatan_id (mungkin tidak diperlukan karena sudah divalidasi sebelumnya)
    //         $muatan = Muatan::find($muatanId);
    //         if (!$muatan) {
    //             return redirect()->back()->withErrors(['error' => 'Muatan tidak valid.'])->withInput();
    //         }
        
    //         // Pastikan jumlah muatan tidak kurang dari 1
    //         if ($jumlah < 1) {
    //             // Jika jumlah muatan kurang dari 1, lewati iterasi ini
    //             continue;
    //         }
        
    //         // Menghitung total amount
    //         $hargaPerItem = $muatan->harga_per_item;
    //         $totalAmount += $hargaPerItem * $jumlah;
        
    //         // Simpan detail pesanan jadwal
    //         $detailPesanJadwal = new DetailPesanJadwal();
    //         $detailPesanJadwal->pemesanan_jadwal_id = $pemesanan_jadwal->id;
    //         $detailPesanJadwal->muatan_id = $muatanId;
    //         $detailPesanJadwal->jumlah = $jumlah;
    //         $detailPesanJadwal->save(); // Simpan detail pesanan jadwal ke dalam database
    //     }
        
        
    //     // Update total harga pemesanan jadwal
    //     $pemesanan_jadwal->update([
    //         'total_harga' => $totalAmount
    //     ]);
    
    //     // Setelah pemesanan berhasil, lakukan redirect atau respons sesuai kebutuhan
    //     $user = Auth::user();
    
    //     // Set Merchant Server Key
    //     \Midtrans\Config::$serverKey = 'SB-Mid-server-r7MhU_nxELBt_mWd6J38SZX4';
    //     // Set Development/Sandbox Environment (default). Set true for Production Environment.
    //     \Midtrans\Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;
    
    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' => $pemesanan_jadwal->id,
    //             'gross_amount' => $pemesanan_jadwal->total_harga,
    //         ),
    //         'customer_details' => array(
    //             'first name' => $user->name,
    //             'last_name' => '',
    //             'phone' => $user->nomor_telepon,
    //         ),
    //     );
    
    //     $snapToken = \Midtrans\Snap::getSnapToken($params);
    //     $pemesanan_jadwal->update([
    //         'snap_token' => $snapToken
    //     ]);
    
    //     // Redirect atau response sesuai kebutuhan Anda
    //     $order = PemesananJadwal::findOrFail($pemesanan_jadwal->id);
    //     return view('Pesan_Jadwal.pembayaran', compact('order'));
    // }

    
    
    
    public function pesanan(){
        // $pesanans = PemesananJadwal::where('snap_token', !NULL)->get();
        $pesanans = PemesananJadwal::whereNotNull('snap_token')->where('user_id', Auth::id())->where('status_pembayaran', 'Unpaid')->get();
        
        return view('Pesan_Jadwal.pesanan', compact('pesanans'));    
    }


    public function pembayaran($id){

        $order = PemesananJadwal::where('id', $id)->get()->first();

        return view('Pesan_Jadwal.pembayaran', compact('order'));
    }


    public function form_pesan_jadwal($id){
        $muatans = Muatan::where('aktif', true)->get();
        $jadwal = Jadwal::find($id);
        return view('Pesan_Jadwal.form_pesan_jadwal', compact('muatans','jadwal'));
    }

    public function detail_stok_validasi2($jadwalId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $pemesananJadwal = PemesananJadwal::where('jadwal_id', $jadwalId)->get();
        $stokMuatan = [];
    
        // Ambil semua muatan yang aktif
        $muatan = Muatan::where('aktif', true)->get();
    
        // Inisialisasi sisa muatan
        foreach ($muatan as $item) {
            $stokMuatan[$item->id] = $item->maksimal;
        }
    
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

            if($shouldDetuctStok == true){
                foreach ($pemesanan->detail_pesan_jadwal as $detail) {
                    // Kurangi sisa muatan
                    $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                }
            }
        }
        return $stokMuatan;
    }

    public function detail_stok_validasi3($jadwalId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        $pemesananJadwal = PemesananJadwal::where('jadwal_id', $jadwalId)->get();
        $stokMuatan = [];
    
        // Ambil semua muatan yang aktif
        $muatan = Muatan::where('aktif', true)->get();
    
        // Inisialisasi sisa muatan
        foreach ($muatan as $item) {
            $stokMuatan[$item->id] = $item->maksimal;
        }
    
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

            if($shouldDetuctStok == true){
                foreach ($pemesanan->detail_pesan_jadwal as $detail) {
                    // Kurangi sisa muatan
                    $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                }
            }
        }
        return $stokMuatan;
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



    public function isiInformasiMuatan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'muatan.*' => 'nullable|integer|min:0',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $totalMuatan = collect($request->muatan)->sum();
        if ($totalMuatan <= 0) {
            return redirect()->back()->withErrors(['error' => 'Setidaknya satu muatan harus dipilih.'])->withInput();
        }
    
        $stokMuatan = $this->detail_stok_validasi4($request->jadwal_id);

        foreach ($request->muatan as $muatanId => $jumlah) {
            $muatan = Muatan::find($muatanId);
            if (!$muatan) {
                return redirect()->back()->withErrors(['error' => 'Muatan tidak valid.'])->withInput();
            }
            if ($jumlah > $stokMuatan[$muatanId]) {
                return redirect()->back()->withErrors(['error' => 'Muatan ' . $muatan->nama .' tidak boleh melebihi stok.'])->withInput();
            }
        }
    
        $jadwal = Jadwal::find($request->jadwal_id);
        $muatans = Muatan::where('aktif', true)->get();
    
        return view('Pesan_Jadwal.form3_informasi_muatan', compact('jadwal', 'muatans', 'request'));
    }


public function checkoutFinal(Request $request)
{
    $validator = Validator::make($request->all(), [
        'informasi.*' => 'nullable|array',
        'informasi.*.nama' => 'nullable|string|max:255',
        'informasi.*.alamat' => 'nullable|string|max:255',
        'informasi.*.umur' => 'nullable|integer|min:0',
        'informasi.*.nomor_plat' => 'nullable|string|max:255',
        'informasi.*.merk' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $muatanData = json_decode($request->input('muatan'), true);

    if (!is_array($muatanData)) {
        return redirect()->back()->withErrors(['error' => 'Data muatan tidak valid.'])->withInput();
    }

    $pemesanan_jadwal = PemesananJadwal::create([
        'total_harga' => '1',
        'user_id' => Auth::id(),
        'jadwal_id' => $request->jadwal_id,
        'ditambahkan_pada' => Carbon::now(new DateTimeZone('Asia/Jakarta'))
    ]);

    if (!$pemesanan_jadwal) {
        return redirect()->back()->withErrors(['error' => 'Gagal membuat pemesanan jadwal.'])->withInput();
    }

    $totalAmount = 0;

    foreach ($muatanData as $muatanId => $jumlah) {
        $muatan = Muatan::find($muatanId);
        if (!$muatan) {
            return redirect()->back()->withErrors(['error' => 'Muatan tidak valid.'])->withInput();
        }

        if ($jumlah < 1) {
            continue;
        }

        $hargaPerItem = $muatan->harga_per_item;
        $totalAmount += $hargaPerItem * $jumlah;

        $detailPesanJadwal = new DetailPesanJadwal();
        $detailPesanJadwal->pemesanan_jadwal_id = $pemesanan_jadwal->id;
        $detailPesanJadwal->muatan_id = $muatanId;
        $detailPesanJadwal->jumlah = $jumlah;
        $detailPesanJadwal->save();

        for ($i = 0; $i < $jumlah; $i++) {
            if ($muatan->jenis_muatan_id == 1) {
                InformasiMuatan::create([
                    'detail_pesan_jadwal_id' => $detailPesanJadwal->id,
                    'nama' => $request->informasi[$muatanId][$i]['nama'],
                    'alamat' => $request->informasi[$muatanId][$i]['alamat'],
                    'umur' => $request->informasi[$muatanId][$i]['umur'],
                ]);
            } elseif ($muatan->jenis_muatan_id == 2) {
                InformasiMuatan::create([
                    'detail_pesan_jadwal_id' => $detailPesanJadwal->id,
                    'nomor_plat' => $request->informasi[$muatanId][$i]['nomor_plat'],
                    'merk' => $request->informasi[$muatanId][$i]['merk'],
                ]);
            }
        }
    }

    $pemesanan_jadwal->update([
        'total_harga' => $totalAmount
    ]);

    $user = Auth::user();

    \Midtrans\Config::$serverKey = 'SB-Mid-server-r7MhU_nxELBt_mWd6J38SZX4';
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $pemesanan_jadwal->id,
            'gross_amount' => $pemesanan_jadwal->total_harga,
        ],
        'customer_details' => [

            'email' => $user->email,
            'phone' => $user->nomor_telepon,
        ],
    ];

                // 'first_name' => $user->name,
            // 'last_name' => '',


    $snapToken = \Midtrans\Snap::getSnapToken($params);
    $pemesanan_jadwal->update([
        'snap_token' => $snapToken
    ]);

    $order = PemesananJadwal::findOrFail($pemesanan_jadwal->id);
    return view('Pesan_Jadwal.pembayaran', compact('order'));
}


    
    

    // public function callback(Request $request)
    // {
    //     $serverKey = config('midtrans.server_key');
    //     $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
    
    //     if ($hashed == $request->signature_key) {
    //         if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
    //             $order = PemesananJadwal::find($request->order_id);
    //             $order->update(['status' => 'Paid']);
    //             return response()->json(['status' => 'success'], 200);
    //         }
    //     }
    
    //         return response()->json(['status' => 'error'], 400);
    // }
    
    

    public function detail_stok($jadwalId){
        $jadwal = Jadwal::findOrFail($jadwalId);
        $pemesananJadwal = PemesananJadwal::where('jadwal_id', $jadwalId)->get();

        $transactions = [];

        foreach ($pemesananJadwal as $pemesanan) {
            $orderId = $pemesanan->id; // Misalnya, gunakan ID pemesanan sebagai orderId
        
            // API untuk mendapatkan status transaksi dari Midtrans
            $client = new Client();
            $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $orderId . '/status', [
                'headers' => [
                    'accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode('SB-Mid-server-r7MhU_nxELBt_mWd6J38SZX4:'),
                ],
            ]);
        
            // Decode response dari API Midtrans
            $data = json_decode($response->getBody(), true);

            if ((isset($data['status_code']) && ($data['status_code'] == 200 || $data['status_code'] == 201))) {
                $transactions[] = $data;
            }
        
            // Ambil semua muatan yang aktif
            $muatan = Muatan::where('aktif', true)->get();

                // Buat array untuk menampung stok muatan
            $stokMuatan = [];

                // Loop untuk mengisi stok muatan dari tabel muatan
            foreach ($muatan as $item) {
                $stokMuatan[$item->id] = $item->maksimal;
            }


            foreach ($pemesananJadwal as $pemesanan) {

                // Pengurangan stok untuk pemesanan jadwal yang berstatus 404 di hasil API Midtrans
                $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
                $ditambahkanTime = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $pemesanan->ditambahkan_pada);
                $selisihWaktu = strtotime($now) - strtotime($ditambahkanTime);
                if($selisihWaktu < 600 && !in_array($pemesanan->id, array_column($transactions, 'order_id'))){
                    foreach ($pemesanan->detail_pesan_jadwal as $detail) {
                        $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                    }
                }
            

                // Pengurangan stok untuk pemesanan jadwal yang berstatus pending di hasil API Midtrans
                foreach ($transactions as $transaction) {
                    if(isset($transaction['transaction_status'])){
                        if ( $transaction['transaction_status'] === 'pending' && $transaction['order_id'] === $pemesanan->id) {
                            foreach ($pemesanan->detail_pesan_jadwal as $detail) {
                                $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                            }
                        }
                    }
                }


                // Pengurangan stok untuk pemesanan jadwal yang berstatus Paid di database
                if($pemesanan->status_pembayaran == "Paid"){
                    foreach($pemesanan->detail_pesan_jadwal as $detail){
                        $stokMuatan[$detail->muatan_id] -= $detail->jumlah;
                    }
                }
            }

            
        }
        
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

        // $total;
        // foreach($stokMuatan as $sm){
        //     $total = 
        // }
        // return view('Pesan_Jadwal.form2_pesan_jadwal', compact('jadwal', 'pemesananJadwal', 'transactions', 'stokMuatan', 'muatans'));
        // return view('Midtrans.lihatjadwal', compact('jadwal', 'pemesananJadwal', 'transactions'));
            return $stokMuatan;

    }
    
    public function tes_detail_stok(){
        $jadwal = Jadwal::whereIn('id', [17, 18])->get();
        $stok = $this->detail_stok(17);
        // $stok = $this->detail_stok(18);
        // $a = 1;
        // foreach($jadwal as $j){
        //     $j->stok 
        // }

        // $total = 0;
        // $muatans = Muatan::where('aktif', true)->get();
        // foreach($muatans as $m){
        //     $total = $total + $stok[$m->id];
        // }

        foreach($jadwal as $j){
            $stok = $this->detail_stok($j->id);
            $total = 0;
            $muatans = Muatan::where('aktif', true)->get();
            foreach($muatans as $m){
            $total = $total + $stok[$m->id];
        }
        }

        return view('Midtrans.tes_detail_stok', compact('total'));
    }

    public function tes_detail_stok2(){
        $jadwal = Jadwal::whereIn('id', [17, 18])->get();
        $stok = $this->detail_stok(17);
        // $stok = $this->detail_stok(18);
        // $a = 1;
        // foreach($jadwal as $j){
        //     $j->stok 
        // }

        // $total = 0;
        // $muatans = Muatan::where('aktif', true)->get();
        // foreach($muatans as $m){
        //     $total = $total + $stok[$m->id];
        // }

        foreach($jadwal as $j){
            $stok = $this->detail_stok($j->id);
            $total = 0;
            $muatans = Muatan::where('aktif', true)->get();
            foreach($muatans as $m){
            $total = $total + $stok[$m->id];
        }
        }

        return view('Midtrans.tes_detail_stok', compact('total'));
    }

}
