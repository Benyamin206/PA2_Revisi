@extends('layouts.app')

@section('content')
    <div class="container mt-5" style="width: 40%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Form Informasi Muatan</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('checkout_final') }}" method="post">
                            @csrf
                            @foreach($muatans as $muatan)
                                @for ($i = 0; $i < $request->muatan[$muatan->id]; $i++)
                                    <div class="form-group">
                                        <label for="informasi_{{ $muatan->id }}_{{ $i }}"><b>{{ $muatan->nama }} - Data {{ $i + 1 }}</b></label>
                                        @if($muatan->jenis_muatan_id == 1)
                                            <input type="text" name="informasi[{{ $muatan->id }}][{{ $i }}][nama]" class="form-control mt-2" placeholder="Nama" required>
                                            <input type="text" name="informasi[{{ $muatan->id }}][{{ $i }}][alamat]" class="form-control mt-2" placeholder="Alamat" required>
                                            <input type="number" name="informasi[{{ $muatan->id }}][{{ $i }}][umur]" class="form-control mt-2" placeholder="Umur" required>
                                        @elseif($muatan->jenis_muatan_id == 2)
                                            <input type="text" name="informasi[{{ $muatan->id }}][{{ $i }}][nomor_plat]" class="form-control mt-2" placeholder="Nomor Plat" required>
                                            <input type="text" name="informasi[{{ $muatan->id }}][{{ $i }}][merk]" class="form-control mt-2" placeholder="Merk" required>
                                        @endif
                                    </div>
                                    <br>
                                @endfor
                                <br>
                            @endforeach
                            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                            <input type="hidden" name="muatan" value="{{ json_encode($request->muatan) }}">
                            <button type="submit" class="btn btn-primary btn-lg">Lanjutkan ke Pembayaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
