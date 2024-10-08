@extends('layouts.adminBar')

@section('content')

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Tampilkan SweetAlert dengan pesan flash
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
        });
    </script>
@endif

{{--  --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
{{-- <br><br>
<br><br> --}}

{{-- <div class="container">
    <form id="login" onsubmit="process(event)">
        <p>Enter your phone number:</p> --}}
        {{-- <input id="phone" type="tel" name="phone" /> --}}
        {{-- <input type="submit" class="btn" value="Verify" /> --}}
    {{-- </form>
</div>
<br>
<div class="alert alert-info" style="display: none;"></div> --}}

<body style="background-image: url('{{ asset('style2/img/bgcolor.jpg') }}'); background-size: cover; background-position: center;">
{{--  --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Daftarkan Akun</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Alamat Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nomor_telepon" class="col-md-4 col-form-label text-md-end" >Nomor Telepon</label>

                            <div class="col-md-6">
                                <input id="phone" class="form-control" type="tel" name="nomor_telepon" />
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

                                <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const phoneInputField = document.querySelector("#phone");
                                    const phoneInput = window.intlTelInput(phoneInputField, {
                                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                                    });

                                    phoneInputField.addEventListener("countrychange", function() {
                                        // Kosongkan nilai input field saat negara dipilih kembali
                                        phoneInputField.value = '';

                                        const selectedCountryData = phoneInput.getSelectedCountryData();
                                        const countryCode = selectedCountryData.dialCode;

                                        // Mendapatkan nomor telepon yang sudah ada di input
                                        let phoneNumber = phoneInput.getNumber();

                                        // Menghapus karakter non-digit dari nomor telepon yang ada
                                        phoneNumber = phoneNumber.replace(/\D/g, '');

                                        // Menambahkan kode negara ke awal nomor telepon jika belum ada
                                        if (!phoneNumber.startsWith(countryCode)) {
                                            phoneNumber = "+" + countryCode + phoneNumber;

                                            // Memperbarui nilai input dengan nomor telepon yang telah diformat
                                            phoneInput.setNumber(phoneNumber);
                                        }
                                    });

                                    function process(event) {
                                        event.preventDefault();
                                        const phoneNumber = phoneInput.getNumber();
                                        // Lakukan sesuatu dengan nomor telepon yang sudah diverifikasi
                                        console.log("Phone Number:", phoneNumber);
                                    }
                                });
                                </script>
                                {{-- <input id="nomor_telepon" type="tel" class="form-control" name="nomor_telepon" value="{{old('nomor_telepon')}}" required> --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-end">Jenis Kelamin</label>

                            <div class="col-md-6">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" value="{{ old('jenis_kelamin') }}" required>
                                    <option value="" disabled selected>----- Pilih Jenis Kelamin -----</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>

                                <script>
                                    window.addEventListener('DOMContentLoaded', (event) => {
                                        const selectElement = document.getElementById('jenis_kelamin');
                                        const disabledOptions = Array.from(selectElement.querySelectorAll('option[disabled]'));

                                        // Move disabled options to the top
                                        disabledOptions.forEach((option) => {
                                            selectElement.insertBefore(option, selectElement.firstChild);
                                        });
                                    });
                                </script>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end">Alamat</label>

                            <div class="col-md-6">
                                {{-- <input id="alamat" type="text" class="form-control" name="alamat" value="{{old('alamat')}}" required> --}}
                                <textarea id="alamat" class="form-control" name="alamat" value="{{old('alamat')}}" placeholder="isi alamat anda disini..." required></textarea>

                            </div>
                        </div>

                        <input type="hidden" name="role_id" value= "1">

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Konfirmasi Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Daftarkan
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