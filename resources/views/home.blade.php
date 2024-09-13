{{-- Atur layout navbar --}}
@php
    // $extend = (Auth::user()->role_id == 2) ?  : ;
    if(Auth::check() && Auth::user()->role_id == 2){     // admin
        $extend = 'layouts.adminBar2';
    }else if(Auth::check() && Auth::user()->role_id == 3){ // ship owner
        $extend = 'layouts.pkBar';
    }else if(Auth::check() && Auth::user()->role_id == 1){ // passenger
        $extend = 'layouts.app';
    }else {
        $extend = 'layouts.app';
    }
@endphp

@extends($extend)




{{-- Atur konten --}}
@section('content')
@if(session('nfPP'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Display SweetAlert with flash message
    Swal.fire({
        icon: 'failed',
        title: 'Ups!',
        text: '{{ session('nfPP') }}',
    });
</script>
@endif
    {{-- Atur layout konten --}}
    @php
        if(Auth::check() && Auth::user()->role_id == 2) {
            $extendBody = 'layouts.homeBodyAdmin';
        } elseif (Auth::check() && Auth::user()->role_id == 1) {
            $extendBody = 'layouts.homeBodyUser2';
        }else if (Auth::check() && Auth::user()->role_id == 3){
            $extendBody = 'layouts.homeBodySO'; 
        }else {
            $extendBody = 'layouts.homeBodyUser2';
        }
    @endphp
    {{-- Masukkan konten --}}
    @include($extendBody)
@endsection
