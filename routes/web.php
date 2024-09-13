<?php

use App\Models\Rute;
use Illuminate\Support\Str;
use App\Models\JadwalHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TryController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MuatanController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\InfomasiController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\PenumpangController;
use App\Http\Controllers\PulangPergiController;
use App\Http\Controllers\JadwalHarianController;
use App\Http\Controllers\PemilikKapalController;
use App\Http\Middleware\PemilikKapal;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// INFORMASI
Route::get('infomasi/index', [PulangPergiController::class, 'informasi_index'])->name('informasi_index');





// PPULANG PERGI

Route::post('filter_jadwal_cari_pulang_pergi', [PulangPergiController::class, 'filter_jadwal_pulang_pergi'])->name('filter_jadwal_pulang_pergi');
Route::post('tesPP', [PulangPergiController::class, 'tesPP'])->name('tesPP');

Route::get('detail_pp', [PulangPergiController::class, 'showDetailJadwalPulangPergi'])->name('detail_jadwal_pulang_pergi_form');
Route::post('oke/pp', [PulangPergiController::class, 'checkout_pulang_pergi'])->name('pp.oke');



Route::get('/', function () {
    $a = 1;
    $rutes = Rute::where('aktif', true)->get();    
    return view('home', compact('rutes'));
})->name('/');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home2', [HomepageController::class, 'homeBL'])->name('homeBL');




// MIDDLEWARE ADMIN
Route::middleware(['admin'])->group(function(){
    // Tambah Pemilik Kapal
    Route::get('/tambah_pemilik_kapal', [App\Http\Controllers\AdminController::class, 'tambah_pemilik_kapal'])->name('tambah_pemilik_kapal');
    Route::post('/store_pemilik_kapal', [App\Http\Controllers\AdminController::class, 'store_pemilik_kapal'])->name('store_pemilik_kapal');
    Route::get('/index_pemilik_kapal', [App\Http\Controllers\AdminController::class, 'index_pemilik_kapal'])->name('index_pemilik_kapal');




    // ABOUT SUPIR 
    Route::get('/tambah_supir', [App\Http\Controllers\AdminController::class, 'tambah_supir'])->name('tambah_supir');
    Route::post('/tambah_supir', [App\Http\Controllers\AdminController::class, 'store_supir'])->name('store_supir');
    Route::get('/index_supir', [App\Http\Controllers\AdminController::class, 'index_supir'])->name('index_supir');
    Route::get('/edit_supir/{supir}', [App\Http\Controllers\AdminController::class, 'edit_supir'])->name('edit_supir');
    Route::patch('/update_supir/{supir}', [App\Http\Controllers\AdminController::class, 'update_supir'])->name('update_supir');
    Route::delete('/hapus_supir/{supir}', [App\Http\Controllers\AdminController::class, 'hapus_supir'])->name('hapus_supir');






    // MUATAN
    Route::get('/muatan/index', [App\Http\Controllers\MuatanController::class, 'index_muatan'])->name('index_muatan');
    Route::get('/muatan/tambah', [App\Http\Controllers\MuatanController::class, 'tambah_muatan'])->name('tambah_muatan');
    Route::post('/muatan/store', [App\Http\Controllers\MuatanController::class, 'store_muatan'])->name('store_muatan');
    Route::get('/muatan/edit/{muatan}', [App\Http\Controllers\MuatanController::class, 'edit_muatan'])->name('edit_muatan');
    Route::patch('/muatan/update/{muatan}', [App\Http\Controllers\MuatanController::class, 'update_muatan'])->name('update_muatan');






    // RUTE
    Route::get('index_rute', [RuteController::class, 'index_rute'])->name('index_rute');
    Route::get('edit_rute/{rute}', [RuteController::class, 'edit_rute'])->name('edit_rute');
    Route::patch('update_rute/{rute}', [RuteController::class, 'update_rute'])->name('update_rute');
    Route::get('rute/tambah', [RuteController::class, 'tambah_rute'])->name('tambah_rute');
    Route::post('rute/store', [RuteController::class, 'store_rute'])->name('store_rute');




    // JADWAL
    Route::get('jadwal/index', [JadwalController::class, 'jadwal'])->name('index_jadwal');
    Route::get('jadwal/tambah', [JadwalController::class, 'tambah_jadwal'])->name('tambah_jadwal');
    Route::post('jadwal/store', [JadwalController::class, 'store_jadwal'])->name('store_jadwal');
    Route::get('jadwal/edit/{jadwal}', [JadwalController::class, 'edit_jadwal'])->name('edit_jadwal');
    Route::patch('jadwal/update/{jadwal}', [JadwalController::class, 'update_jadwal'])->name('update_jadwal');
 

    // REFUND
    Route::get('admin/refund', [RefundController::class, 'all_refund_admin'])->name('all_refund_admin');
    Route::patch('admin/store_pr/{drj}', [RefundController::class, 'store_payment_receipt'])->name('store_payment_receipt');
    Route::patch('admin/konfirmasi/{drj}', [RefundController::class, 'konfirmasi_pembayaran'])->name('konfirmasi_pembayaran_refund');
    Route::patch('admin/batal_konfirmasi/{drj}', [RefundController::class, 'batal_konfirmasi_pembayaran'])->name('batal_konfirmasi_pembayaran_refund');
    Route::patch('admin/update-payment/{drj}', [RefundController::class, 'update_payment_refund'])->name('update_payment_refund');


    // JADWAL HARIAN
    Route::get('jadwal/harian', [JadwalHarianController::class, 'index'])->name('jadwal.harian');
    Route::post('/terapkan_jadwal_harian', [JadwalHarianController::class, 'terapkan'])->name('terapkan_jadwal_harian');
    Route::get('jadwal/harian/tambah', [JadwalHarianController::class, 'tambah'])->name('jadwal.harian.tambah');
    Route::post('jadwal/harian/store', [JadwalHarianController::class, 'store'])->name('jadwal.harian.store');
    Route::get('jadwal/harian/edit/{jh}', [JadwalHarianController::class, 'edit'])->name('jadwal.harian.edit');
    Route::patch('jadwal/harian/update/{jh}', [JadwalHarianController::class, 'update'])->name('jadwal.harian.update');
    Route::delete('jadwal/harian/delete/{jh}', [JadwalHarianController::class, 'delete'])->name('jadwal.harian.delete');


    // // IZIN KAPAL
    // Route::get('kapal/non-izin', [AdminController::class, 'non_izin_kapal'])->name('kapal.non-izin');
    // Route::patch('kapal/approve', [AdminController::class, 'approve_kapal'])->name('kapal.approve');

    // IZIN KAPAL
    Route::get('kapal/non-izin', [AdminController::class, 'non_izin_kapal'])->name('kapal.non-izin');
    Route::patch('kapal/approve/{kapal}', [AdminController::class, 'approve_kapal'])->name('kapal.approve');



});






// MIDDLEWARE PEMILIK KAPAL
Route::middleware(['pemilik_kapal'])->group(function(){
    Route::get('index_kapal', [PemilikKapalController::class, 'index_kapal'])->name('index_kapal');
    Route::get('tambah_kapal', [PemilikKapalController::class, 'tambah_kapal'])->name('tambah_kapal');
    Route::post('store_kapal', [PemilikKapalController::class, 'store_kapal'])->name('store_kapal');
    Route::get('edit_kapal/{kapal}', [PemilikKapalController::class, 'edit_kapal'])->name('edit_kapal');
    Route::patch('update_kapal/{kapal}', [PemilikKapalController::class, 'update_kapal'])->name('update_kapal');


    // Rental Kapal
    Route::get('tambah_booking', [RentalController::class, 'tambah_booking'])->name('tambah_booking');
    Route::get('booking_kapal_index', [RentalController::class, 'kapal_booking_index_pesan'])->name('booking_kapal_index');
    Route::post('kapal/booking/store', [RentalController::class, 'store_booking'])->name('store_booking');
    Route::patch('kapal/booking/konfirmasiPembayaran/{rk}', [RentalController::class, 'konfirmasi_pembayaran'])->name('konfirmasi_pembayaran_booking_kapal');
    Route::patch('kapal/booking/batalKonfirmasiPembayaran/{rk}', [RentalController::class, 'batal_konfirmasi_pembayaran'])->name('batal_konfirmasi_pembayaran_booking_kapal');

    Route::get('kapal/izin', [PemilikKapalController::class, 'izin_kapal'])->name('kapal.izin');


    // JENIS RENTAL KAPAL
    // Route untuk menampilkan semua jenis rental kapal
    Route::get('rental/jenis-rental', [RentalController::class, 'indexJenisRental'])->name('rental.indexJenisRental');

    // Route untuk menampilkan form tambah jenis rental
    Route::get('rental/jenis-rental/create', [RentalController::class, 'createJenisRental'])->name('rental.createJenisRental');

    // Route untuk menyimpan data jenis rental kapal
    Route::post('rental/jenis-rental', [RentalController::class, 'storeJenisRental'])->name('rental.storeJenisRental');

    
});




// MIDDLEWARE PENUMPANG
Route::middleware(['penumpang'])->group(function(){
    // Pemesanan Jadwal
    Route::get('jadwal/formulir/{id}', [JadwalController::class, 'form_pesan_jadwal'])->name('form_pesan_jadwal');
    Route::post('jadwal/checkout', [JadwalController::class, 'checkout'])->name('checkout_jadwal');
    // Route::get('jadwal/pesanan', [JadwalController::class, 'pesanan'])->name('pesanan_jadwal');
    Route::get('jadwal/pembayaran/{id}', [JadwalController::class, 'pembayaran'])->name('pembayaran_jadwal');
    Route::get('jadwal/pesanan', [PesananController::class, 'pesanan_jadwal_paid'])->name('pesanan_jadwal_paid');
    Route::get('jadwal/pesanan_unpaid', [PesananController::class, 'pesanan_jadwal_unpaid'])->name('pesanan_jadwal_unpaid');
    Route::get('jadwal/bayar/{orderId}', [PesananController::class, 'bayar_jadwal'])->name('bayar_jadwal');

    
    // CheckOut
    Route::get('jadwal/detail/{idJadwal}', [JadwalController::class, 'detail_jadwal'])->name('detail_jadwal');
    Route::post('jadwal/isi-informasi-muatan', [JadwalController::class, 'isiInformasiMuatan'])->name('isi_informasi_muatan');
    Route::post('jadwal/checkout-final', [JadwalController::class, 'checkoutFinal'])->name('checkout_final');


    // Tiket
    Route::get('jadwal/tiket/{order_id}', [TiketController::class, 'invoice'])->name('My_tiket');


    //REFUND
    Route::get('jadwal/refund/{pj}', [RefundController::class, 'form_refund_jadwal'])->name('form_refund_jadwal');
    Route::post('jadwal/refund/store', [RefundController::class, 'store_refund_jadwal'])->name('store_refund_jadwal');
    Route::get('jadwal/refund/detail/{pj}', [RefundController::class, 'refund_detail_passenger'])->name('refund_detail_passenger');



    // RENTAL KAPAL
    Route::get('index_rental_user', [RentalController::class, 'index_rental_user'])->name('index_rental_user');
    Route::patch('rental/upload_pembayaran/{rk}', [RentalController::class, 'upload_bukti_pembayaran'])->name('upload_bukti_pembayaran_rental');
    Route::get('user/history_booking', [RentalController::class, 'history_booking'])->name('user.history_booking');
    Route::get('index_rental_user_unpaid', [RentalController::class, 'index_rental_user_unpaid'])->name('index_rental_user_unpaid');

    

    // PULANG PERGI
    Route::post('detail_pp', [PulangPergiController::class, 'detail_jadwal_pulang_pergi'])->name('detail_jadwal_pulang_pergi');

    Route::post('/form-informasi-muatan', [PulangPergiController::class, 'form_informasi_muatan'])->name('form_informasi_muatan');
    Route::post('/checkout-pulang-pergi', [PulangPergiController::class, 'checkout_pulang_pergi'])->name('checkout_pulang_pergi');



    // RIWAYAT
    Route::get('jadwal/riwayat', [RiwayatController::class, 'riwayat_jadwal'])->name('riwayat_jadwal.index');


});



// PENUMPANG NON-REGISTER
Route::get('jadwal/index_pesan/', [JadwalController::class, 'index_jadwal_penumpang'])->name('index_jadwal_penumpang');
Route::get('rental/available', [RentalController::class, 'kapal_booking_available'])->name('kapal_booking_available');





// MIDTRANS TRY
Route::get('midtrans/status/{id}', [MidtransController::class, 'checkOrderStatusSp']);
Route::get('midtrans/stok/{order_id}', [MidtransController::class, 'stok']);
Route::get('midtrans/jadwal/{jadwalId}', [MidtransController::class, 'lihatjadwal']);
Route::get('midtrans/tes_detail_stok', [JadwalController::class, 'tes_detail_stok']);



Route::get('midtrans/cek_muatan_validasi/{idJadwal}', [MidtransController::class, 'cek_muatan_validasi']);


// JADWAL TRY
// Route::get('try/filter_jadwal', [TryController::class, 'filter_jadwal']);
Route::get('try/home2', [TryController::class, 'home']);
Route::post('filter_jadwal', [TryController::class, 'index_jadwal_penumpang_filter'])->name('filter_jadwal');
Route::post('filter_jadwal_cari_pergi', [TryController::class, 'index_jadwal_cari_pergi_penumpang_filter'])->name('filter_jadwal_cari_pergi');

Route::post('/filter_jadwal2', [JadwalController::class, 'filterJadwal'])->name('filter_jadwal2');




// Tes API



// INCOME
Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
Route::get('/income/{date}', [IncomeController::class, 'show'])->name('income.show');
Route::get('/income2', [IncomeController::class, 'index2'])->name('income.index2');


