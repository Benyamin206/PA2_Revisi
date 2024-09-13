@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@section('content')

<style>
    .card {
        width: 100%;
    }
    .card-img {
        height: 240px; /* Fixed height for the image */
        object-fit: cover;
    }
    .card-body {
        flex: 1 1 auto;
        overflow: auto;
    }
    .card-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: auto; /* Ensure footer sticks to the bottom */
    }
    .whatsapp-btn {
        display: flex;
        align-items: center;
        background-color: #25D366;
        color: white;
    }
    .whatsapp-btn:hover {
        background-color: #1DA851;
        color: white;
    }
    .whatsapp-btn i {
        margin-right: 8px; /* Space between icon and text */
    }
</style>
<br><br><br>
<div class="container">
    <h1>Booking Kapal</h1>
    <h2>Booking Kapal - Maksimal 1 hari</h2>

    <br><br><br>
    <!-- Example card -->
    @foreach($kapals as $k)
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ url('storage/Kapal_Image/'.$k->gambar) }}" class="img-fluid rounded-start card-img" alt="Card image">
            </div>
            <div class="col-md-8 d-flex flex-column">
                <div class="card-body">
                    <h5 class="card-title">{{$k->nama}}</h5>
                    <h5>Tersedia pada : {{$k->tanggal_tersedia_booking}}</h5>
                    <p class="card-text">{{$k->deskripsi}}</p>
                    <p class="card-text"><small class="text-body-secondary">Pemilik Kapal : {{$k->user->name}}</small></p>
                </div>
                <div class="card-footer bg-white border-0 mt-auto">
                    @if(Auth::check() && Auth::user()->role_id == 1)
                        <button 
                            class="btn whatsapp-btn" 
                            data-phone="{{ $k->user->nomor_telepon }}" 
                            data-nama="{{ $k->nama }}">
                            <i class="fab fa-whatsapp"></i> 
                            <span>Ajukan Rental</span>
                        </button>
                    @else
                        <button 
                            class="btn whatsapp-btn login-redirect">
                            <i class="fab fa-whatsapp"></i> 
                            <span>Hubungi kami</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br><br>
    @endforeach
    
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all datepickers
        flatpickr(".datepicker", {
            minDate: "today"
        });

        function formatPhoneNumber(phoneNumber) {
            // Menghapus semua karakter non-digit
            phoneNumber = phoneNumber.replace(/\D/g, '');
            
            // Memastikan nomor dimulai dengan kode negara
            if (phoneNumber.charAt(0) === '0') {
                phoneNumber = '62' + phoneNumber.slice(1);
            } else if (!phoneNumber.startsWith('62')) {
                phoneNumber = '62' + phoneNumber;
            }
            
            return phoneNumber;
        }
    
        document.querySelectorAll('.whatsapp-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var phoneNumber = button.getAttribute('data-phone');
                var namaKapal = button.getAttribute('data-nama');
                var formattedPhoneNumber = formatPhoneNumber(phoneNumber);
                var message = encodeURIComponent('Halo, saya tertarik untuk mem-booking kapal Anda dengan nama: ' + namaKapal + '. Bisakah Anda memberikan informasi lebih lanjut? Terima kasih.');
    
                var whatsappUrl = 'https://wa.me/' + formattedPhoneNumber + '?text=' + message;
                window.open(whatsappUrl, '_blank');
            });
        });

        document.querySelectorAll('.login-redirect').forEach(function(button) {
            button.addEventListener('click', function() {
                window.location.href = '{{ route("login") }}';
            });
        });
    });
</script>
@endsection
