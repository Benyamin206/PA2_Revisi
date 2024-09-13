<?php

namespace App\Http\Controllers;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PemesananJadwal;

class CallbackController extends Controller
{
    //

    public function callback(Request $request){
        $serverKey = 'SB-Mid-server-r7MhU_nxELBt_mWd6J38SZX4';
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement'){
                $order = PemesananJadwal::find($request->order_id);
                $order->update(['status_pembayaran' => 'Paid']);
            }
        }
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
$formattedNow = $now->format('Y-m-d H:i');
echo "Waktu saat ini: " . $formattedNow . "\n";

// Misalkan Anda mendapatkan waktu input dari pengguna melalui request
// Contoh: Request::input('user_datetime') berisi "2024-06-03 12:00:00"
$userInputDatetime = '2024-06-03 22:48';
$userDatetime = Carbon::createFromFormat('Y-m-d H:i', $userInputDatetime, 'Asia/Jakarta');

// Perbandingan waktu
$secondsDifference = $now->diffInSeconds($userDatetime);

if ($now->gt($userDatetime)) {
    echo "Waktu sekarang lebih besar dari waktu input pengguna.\n";
    echo "Perbedaan waktu: " . $secondsDifference . " detik.\n";
    echo "waktu Jadwal tidak boleh lebih kecil daripada waktu sekarang.\n";
} elseif ($now->lt($userDatetime)) {
    echo "Waktu sekarang lebih kecil dari waktu input pengguna dan memenuhi setengah.\n";
    echo "Perbedaan waktu: " . $secondsDifference . " detik.\n";
    if($secondsDifference > 7200){
        echo "Selisih waktu lebih dari 2 jam (valid).\n";
    }else{
        echo "Selisih waktu kurang dari atau sama dengan 2 jam (tidak valid).\n";
    }
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

}
