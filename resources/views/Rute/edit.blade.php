@extends('layouts.adminBar2')

@section('content')
<center><h1>Edit Rute</h1></center>

<div class="container">
    <h5><a href="{{route('index_rute')}}">Index Rute</a></h5>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Rute</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_rute', $rute) }}">
                        @csrf
                        @method('patch')

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label for="lokasi_berangkat" class="col-md-4 col-form-label text-md-end">Lokasi Berangkat</label>
                            <div class="col-md-6">
                                <input id="lokasi_berangkat" type="text" class="form-control" name="lokasi_berangkat" value="{{ old('lokasi_berangkat', $rute->lokasi_berangkat) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lokasi_tujuan" class="col-md-4 col-form-label text-md-end">Lokasi Tujuan</label>
                            <div class="col-md-6">
                                <input id="lokasi_tujuan" type="text" class="form-control" name="lokasi_tujuan" value="{{ old('lokasi_tujuan', $rute->lokasi_tujuan) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="aktif" class="col-md-4 col-form-label text-md-end">Status</label>
                            <div class="col-md-6">
                                <select name="aktif" id="aktif" class="form-control">
                                    <option value="1" {{ old('aktif', $rute->aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('aktif', $rute->aktif) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
