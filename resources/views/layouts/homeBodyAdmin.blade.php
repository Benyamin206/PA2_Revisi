{{-- @php
    if(Auth::id() == 2){
        $extend = 'layouts.adminBar';
    }else {
        $extend = 'layouts.app';
    }
@endphp --}}

{{-- <style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMRT01Q6F0Ne/HoPps0tM4XQlvJHTZ5vo7X6bD" crossorigin="anonymous">

</style> --}}

@php
use App\Models\Supir;
use App\Models\Kapal;
use App\Models\PemesananJadwal;
use Carbon\Carbon;

$nahkodas = Supir::all();
$kapals = Kapal::all();


$jumlahNahkoda = 0;
$jumlahKapal = 0;
$jumlahPendapatanHarian = 0;


foreach($nahkodas as $n){
    $jumlahNahkoda = $jumlahNahkoda + 1;
}

foreach($kapals as $k){
    $jumlahKapal = $jumlahKapal + 1;
}

$todayIncome = PemesananJadwal::where('refund', false)
            ->where('status_pembayaran', 'Paid')
            ->whereDate('ditambahkan_pada', Carbon::today())
            ->sum('total_harga');

@endphp



<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMRT01Q6F0Ne/HoPps0tM4XQlvJHTZ5vo7X6bD" crossorigin="anonymous">

<div class="container">
        <h1>Dashboard Admin</h1>
        <br><br>
        <div class="row">
            <!-- Card untuk Jumlah Nahkoda -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0 text-white bg-primary h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Jumlah Nahkoda</h5>
                    <i class="fas fa-user-tie fa-2x"></i>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    {{-- <h2 class="card-title display-4">{{ $jumlahNahkoda }}</h2> --}}
                    <h3 class="card-text" style="color: white; ">{{$jumlahNahkoda}} ORANG</h3>
                </div>
            </div>
        </div>

        <!-- Card untuk Jumlah Kapal -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0 text-white bg-success h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Jumlah Kapal</h5>
                    <i class="fas fa-ship fa-2x"></i>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    {{-- <h2 class="card-title display-4">{{ $jumlahKapal }}</h2> --}}
                    <h3 class="card-text" style="color: white; ">{{$jumlahKapal}} UNIT</h3>
                </div>
            </div>
        </div>

        <!-- Card untuk Jumlah Pendapatan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0 text-white bg-warning h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="color: black">Total pendapatan hari ini</h5>
                    <i class="fas fa-dollar-sign fa-2x"></i>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    {{-- <h2 class="card-title display-4">{{ $jumlahPendapatan }}</h2> --}}
                    <h3 class="card-text" style="color: black; "> Rp {{ number_format($todayIncome, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Font Awesome untuk ikon -->

        @yield('contentBody')
</div>

{{-- <h1>{{Auth::user()->role_id}}</h1>
<h1>{{Auth::id()}}</h1> --}}

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ __('Dashboard') }} {{Auth::user()->role->name}}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}