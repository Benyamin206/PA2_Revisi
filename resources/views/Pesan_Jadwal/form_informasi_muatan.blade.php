@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('checkout_pulang_pergi') }}" method="post">
        @csrf
        <input type="hidden" name="jadwal_pergi_id" value="{{ $jadwalPergi->id }}">
        <input type="hidden" name="jadwal_pulang_id" value="{{ $jadwalPulang->id }}">
        <input type="hidden" name="muatan_pergi" value="{{ json_encode($muatanPergi) }}">
        <input type="hidden" name="muatan_pulang" value="{{ json_encode($muatanPulang) }}">

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Informasi Muatan Pergi</h2>
                    </div>
                    <div class="card-body">
                        @foreach ($muatans as $muatan)
                            @if (isset($muatanPergi[$muatan->id]) && $muatanPergi[$muatan->id] > 0)
                                <div class="form-group">
                                    <label for="info_pergi_{{ $muatan->id }}">{{ $muatan->nama }} - {{ $muatanPergi[$muatan->id] }} Item(s)</label>
                                    <textarea name="info_pergi[{{ $muatan->id }}]" id="info_pergi_{{ $muatan->id }}" class="form-control" rows="3" placeholder="Enter additional information"></textarea>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Informasi Muatan Pulang</h2>
                    </div>
                    <div class="card-body">
                        @foreach ($muatans as $muatan)
                            @if (isset($muatanPulang[$muatan->id]) && $muatanPulang[$muatan->id] > 0)
                                <div class="form-group">
                                    <label for="info_pulang_{{ $muatan->id }}">{{ $muatan->nama }} - {{ $muatanPulang[$muatan->id] }} Item(s)</label>
                                    <textarea name="info_pulang[{{ $muatan->id }}]" id="info_pulang_{{ $muatan->id }}" class="form-control" rows="3" placeholder="Enter additional information"></textarea>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Checkout</button>
        </div>
    </form>
</div>
@endsection
