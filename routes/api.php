<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\CallbackController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/midtrans-callback', [CallbackController::class, 'callback'])->name('callback');

Route::get('/tes', [JadwalController::class, 'tes'])->name('tes');

Route::get('/tesapi', [CallbackController::class, 'tes'])->name('tesapi');

Route::get('tesapi2', function(){
    return 'success';
});

Route::get('stok-jadwal/{idJadwal}', [JadwalController::class, 'detail_stok_validasi4'])->name('stok-jadwal');



Route::get('tesApi', function(){
    echo "<h1>Halo</h1>";
});