{{-- @php
    if(Auth::id() == 2){
        $extend = 'layouts.adminBar';
    }else {
        $extend = 'layouts.app';
    }
@endphp --}}



<div class="container">
    <main class="py-4">
        <h1>Home User Body</h1>
        <h3>Hai kamu mau kemana ?</h3>

        <form action="{{route('filter_jadwal_cari_pergi')}}" method="POST">
            @csrf
            Pilih rute : <br>
            <select name="rute" id="" required>
                @foreach ($rutes as $r)
                    <option value="{{$r->id}}">{{$r->lokasi_berangkat}} ke {{$r->lokasi_tujuan}}</option>
                @endforeach
            </select> 
            <br><br>
            <p>Tanggal keberangkatan</p> 
            <input type="date" name="date" id="date" required>
            <button type="submit" class="btn btn-primary">cari tiket</button>       
        </form>
    </main>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan elemen input tanggal
        var dateInput = document.getElementById('date');

        // Mendapatkan tanggal saat ini
        var today = new Date();
        var todayISO = today.toISOString().split('T')[0]; // Format tanggal dalam ISO (YYYY-MM-DD)

        // Mengatur nilai minimum input tanggal ke tanggal hari ini
        dateInput.min = todayISO;
    });
</script>

<br>


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