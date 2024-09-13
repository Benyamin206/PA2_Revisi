@extends('layouts.app')

@section('content')

<div class="container">
    <h3>History</h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Pemesanan</th>
                    <th>Rute</th>
                    <th>Total Harga</th>
                    <th>Kapal</th>
                    <th>Detail Pemesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanans as $p)
                
                @if ($p->jadwal_pulang_id == NULL)
                @php
                    $tampilkan = false;
                    $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
                            $now2 = strtotime($now);
                            $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $p->jadwal->waktu_berangkat);
                            $waktuBerangkat2 = strtotime($waktuBerangkat);
                    if($now2 > $waktuBerangkat2){
                        $tampilkan = true;
                    }
                @endphp
                @elseif ($p->jadwal_pulang_id != NULL)
                @php
                    $tampilkan = false;
                    $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
                            $now2 = strtotime($now);
                            $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $p->jadwalPulang->waktu_berangkat);
                            $waktuBerangkat2 = strtotime($waktuBerangkat);
                    if($now2 > $waktuBerangkat2){
                        $tampilkan = true;
                    }
                @endphp
                @endif
                
                @if($tampilkan)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->jadwal->rute->lokasi_berangkat}} - {{$p->jadwal->rute->lokasi_tujuan}}</td>
                    <td>{{ 'Rp ' . number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td>{{$p->jadwal->kapal->nama}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{$p->id}}">
                            Detail Pemesanan
                        </button>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modals -->
@foreach($pemesanans as $p)
@if ($p->jadwal_pulang_id == NULL)
@php
    $tampilkan = false;
    $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
            $now2 = strtotime($now);
            $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $p->jadwal->waktu_berangkat);
            $waktuBerangkat2 = strtotime($waktuBerangkat);
    if($now2 > $waktuBerangkat2){
        $tampilkan = true;
    }
@endphp
@elseif ($p->jadwal_pulang_id != NULL)
@php
    $tampilkan = false;
    $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
            $now2 = strtotime($now);
            $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $p->jadwalPulang->waktu_berangkat);
            $waktuBerangkat2 = strtotime($waktuBerangkat);
    if($now2 > $waktuBerangkat2){
        $tampilkan = true;
    }
@endphp
@endif
@if ($tampilkan)
<div class="modal fade" id="modal{{$p->id}}" tabindex="-1" aria-labelledby="modal{{$p->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal{{$p->id}}Label">Detail Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4"><strong>ID Pemesanan:</strong></div>
                    <div class="col-md-8">{{$p->id}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Rute:</strong></div>
                    <div class="col-md-8">{{$p->jadwal->rute->lokasi_berangkat}} - {{$p->jadwal->rute->lokasi_tujuan}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Total Harga:</strong></div>
                    <div class="col-md-8">{{ 'Rp ' . number_format($p->total_harga, 0, ',', '.') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Kapal:</strong></div>
                    <div class="col-md-8">{{$p->jadwal->kapal->nama}}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Detail Pemesanan Pergi:</strong></div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            @foreach ($p->detail_pesan_jadwal as $dpj)
                            <li class="list-group-item">{{$dpj->muatan->nama}} = {{$dpj->jumlah}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Berangkat :</strong></div>
                    <div class="col-md-8">{{$p->jadwal->waktu_berangkat}}</div>
                </div>
                @if ($p->jadwal_pulang_id != NULL)
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Detail Pemesanan Pulang:</strong></div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            @foreach ($p->detail_pesan_jadwal as $dpj)
                            <li class="list-group-item">{{$dpj->muatan->nama}} = {{$dpj->jumlah}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Pulang :</strong></div>
                    <div class="col-md-8">{{$p->jadwalPulang->waktu_berangkat}}</div>
                </div>

                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach 
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><b><br><br>
@endsection
